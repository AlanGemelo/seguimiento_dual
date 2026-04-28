<?php

namespace App\Http\Controllers;

use App\Models\DireccionCarrera;
use App\Models\Empresa;
use App\Models\Estudiantes;
use App\Models\MentorIndustrial;
use App\Models\Convenio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function welcome(): View|RedirectResponse
    {
        return redirect()->route('dashboard');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $hoy = now();

        switch ($user->rol_id) {
            case 1: // SUPERADMIN
                // Si ya seleccionó una carrera, mostrar el dashboard de esa carrera
                if (session()->has('direccion_id')) {
                    return $this->cargarDashboardCarrera(session('direccion_id'), $hoy);
                }

                // Si NO ha seleccionado, mostrar el Index con todas las carreras
                $direcciones = DireccionCarrera::with('programas')->get();
                $estudiantes = Estudiantes::count();
                $mentores = MentorIndustrial::count();

                // Alertas globales
                $registrosEstudiantes = Estudiantes::with('academico', 'asesorin')
                    ->whereDate('fin_dual', '<=', $hoy->copy()->addDays(15))
                    ->where('activo', true)->get();

                $registrosConvenio = Convenio::with('empresa.asesorin')
                    ->whereDate('fin', '<=', $hoy->copy()->addDays(15))
                    ->get();

                $hayAlertas = $registrosEstudiantes->count() > 0 || $registrosConvenio->count() > 0;

                return view('dashboardSuperAdmin', compact(
                    'direcciones',
                    'estudiantes',
                    'mentores',
                    'registrosEstudiantes',
                    'registrosConvenio',
                    'hayAlertas'
                ));

            case 3: // ESTUDIANTE

                $usaPasswordPorDefecto = $this->usaPasswordPorDefecto($user);

                $becas = [
                    0 => 'Si',
                    1 => 'No',
                ];

                $tipoBeca = [
                    0 => 'Apoyo por Empresa',
                    1 => 'Beca Dual Comecyt',
                ];

                $estudiante = Estudiantes::withTrashed()
                    ->with('academico') // cargar académico
                    ->where('user_id', $user->id)
                    ->first();

                return view('dashboardEstudiante', compact(
                    'estudiante',
                    'becas',
                    'tipoBeca',
                    'usaPasswordPorDefecto'
                ));

            case 4: // DIRECTOR/TUTOR
            default:
                // Se carga el dashboard usando la carrera que el director tiene en la base de datos
                return $this->cargarDashboardCarrera($user->direccion_id, $hoy);
        }
    }

    public function seleccionarCarrera($id): RedirectResponse
    {
        if (Auth::user()->rol_id == 1) {
            session(['direccion_id' => $id]);
        }

        return redirect()->route('dashboard');
    }

    public function resetearCarrera(): RedirectResponse
    {
        if (Auth::user()->rol_id == 1) {
            session()->forget(['direccion_id', 'direccion']);
        }

        return redirect()->route('dashboard');
    }

    private function usaPasswordPorDefecto($user): bool
    {
        $passwordPorDefecto = '12345678';

        return Hash::check($passwordPorDefecto, $user->password);
    }

    private function cargarDashboardCarrera($direccion_id, $hoy): View
    {
        $direccion = DireccionCarrera::find($direccion_id);
        session()->put('direccion', $direccion ?? '');

        $user = Auth::user();

        // verifica si el usuario usa la contraseña por defecto
        $usaPasswordPorDefecto = $this->usaPasswordPorDefecto($user);

        $hoy = now();

        // query base de estudiantes visibles en dashboard
        $estudiantesQuery = Estudiantes::with('academico', 'asesorin')
            ->where('activo', true);

        // si el usuario es mentor académico, solo ve sus alumnos
        if ($user->rol_id == 2) {

            $estudiantesQuery->where('academico_id', $user->id);
        } else {

            // otros roles ven estudiantes filtrados por dirección
            $estudiantesQuery->where('direccion_id', $direccion_id);
        }

        // total de estudiantes según el filtro aplicado
        $estudiantes = (clone $estudiantesQuery)->count();

        // mentores filtrados por dirección (sin cambio de lógica)
        $mentores = MentorIndustrial::whereHas('estudiantes', function ($query) use ($direccion_id) {
            $query->where('direccion_id', $direccion_id);
        })->count();

        // estudiantes próximos a vencer (15 días)
        $registrosEstudiantes = (clone $estudiantesQuery)
            ->whereDate('fin_dual', '<=', $hoy->copy()->addDays(15))
            ->get();

        // convenios próximos a vencer
        $registrosConvenio = Convenio::whereHas('empresa.direccionesCarrera', function ($q) use ($direccion_id) {
            $q->where('direccion_id', $direccion_id);
        })
            ->whereDate('fin', '<=', $hoy->copy()->addDays(15))
            ->get();

        // validación de alertas generales del dashboard
        $hayAlertas = $registrosEstudiantes->isNotEmpty() || $registrosConvenio->isNotEmpty();

        return view('dashboard', compact(
            'estudiantes',
            'mentores',
            'registrosEstudiantes',
            'registrosConvenio',
            'hayAlertas',
            'usaPasswordPorDefecto'
        ));
    }
}
