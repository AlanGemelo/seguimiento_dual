<?php

namespace App\Http\Controllers;

use App\Models\DireccionCarrera;
use App\Models\Empresa;
use App\Models\Estudiantes;
use App\Models\MentorIndustrial;
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

                $registrosConvenio = Empresa::with('asesorin')
                    ->whereDate('fin_conv', '<=', $hoy->copy()->addDays(15))->get();

                $hayAlertas = $registrosEstudiantes->count() > 0 || $registrosConvenio->count() > 0;

                return view('dashboardSuperAdmin', compact(
                    'direcciones', 'estudiantes', 'mentores', 'registrosEstudiantes', 'registrosConvenio', 'hayAlertas'
                ));

            case 3: // ESTUDIANTE
                $estudiante = Estudiantes::withTrashed()->where('user_id', $user->id)->first();

                return view('dashboardEstudiante', compact('estudiante'));

            case 4:// DIRECTOR/TUTOR
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

    private function cargarDashboardCarrera($direccion_id, $hoy): View
    {
        $direccion = DireccionCarrera::find($direccion_id);
        session()->put('direccion', $direccion ?? '');
        $user = Auth::user();

        $passwordPorDefecto = '12345678'; // tu contraseña por defecto
        $usaPasswordPorDefecto = Hash::check($passwordPorDefecto, $user->password);

        $estudiantes = Estudiantes::where('direccion_id', $direccion_id)->count();
        $mentores = MentorIndustrial::whereHas('estudiantes', function ($query) use ($direccion_id) {
            $query->where('direccion_id', $direccion_id);
        })->count();

        $registrosEstudiantes = Estudiantes::with('academico', 'asesorin')
            ->where('direccion_id', $direccion_id)
            ->whereDate('fin_dual', '<=', $hoy->copy()->addDays(15))
            ->where('activo', true)->get();

        $registrosConvenio = Empresa::whereHas('direccionesCarrera', function ($q) use ($direccion_id) {
            $q->where('direccion_id', $direccion_id);
        })->whereDate('fin_conv', '<=', $hoy->copy()->addDays(15))->get();

        $hayAlertas = $registrosEstudiantes->isNotEmpty() || $registrosConvenio->isNotEmpty();

        return view('dashboard', compact(
            'estudiantes', 'mentores', 'registrosEstudiantes', 'registrosConvenio', 'hayAlertas', 'usaPasswordPorDefecto'
        ));
    }
}
