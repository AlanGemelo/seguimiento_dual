<?php

namespace App\Http\Controllers;

use App\Models\DireccionCarrera;
use App\Models\Estudiantes;
use App\Models\Empresa;
use App\Models\MentorIndustrial;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function welcome(): View|RedirectResponse
    {
        return redirect()->route('dashboard');
    }

    /* public function dashboard()
    {
        $direccion = DireccionCarrera::find(Auth::user()->direccion_id);

        session()->put('direccion',  $direccion ?? '');
        $estudiantes = Estudiantes::count();
        $mentores = MentorIndustrial::count();
        $auth = Auth::user();
        if ($auth->rol_id == 1) {
            session()->forget('direccion');
            $direcciones = DireccionCarrera::all();
            return view('dashboardSuperAdmin', compact(['estudiantes', 'mentores', 'direcciones']));
            //return view('admin.dashboard', compact(['estudiantes', 'mentores', 'direcciones']));
        } else if ($auth->rol_id == 3) {

            $estudiante = Estudiantes::withTrashed()->where('user_id', $auth->id)->first();
            return view('dashboardEstudiante', compact('estudiante'));
        } else if ($auth->rol_id == 4) {
            return view('dashboard', compact(['estudiantes', 'mentores']));
        } else {
            return view('dashboard', compact(['estudiantes', 'mentores']));
        }
    } */

    public function dashboard()
    {
        $user = Auth::user();
        $hoy = now();

        $estudiantes = Estudiantes::count();
        $mentores = MentorIndustrial::count();

        switch ($user->rol_id) {
            case 1: // Super Admin
                session()->forget('direccion');
                $direcciones = DireccionCarrera::all();

                $registrosEstudiantes = Estudiantes::with('academico', 'asesorin')
                    ->whereDate('fin_dual', '<=', $hoy->copy()->addDays(15))
                    ->where('activo', true)
                    ->get();

                $registrosConvenio = Empresa::with('asesorin')
                    ->whereDate('fin_conv', '<=', $hoy->copy()->addDays(15))
                    ->get();

                $hayAlertas = $registrosEstudiantes->count() > 0 || $registrosConvenio->count() > 0;


                return view('dashboardSuperAdmin', compact(
                    'estudiantes',
                    'mentores',
                    'direcciones',
                    'registrosEstudiantes',
                    'registrosConvenio',
                    'hayAlertas'
                ));

            case 3: // Estudiante
                $estudiante = Estudiantes::withTrashed()
                    ->where('user_id', $user->id)
                    ->first();

                return view('dashboardEstudiante', compact('estudiante'));

            case 4:
            default:
                $direccion = DireccionCarrera::find($user->direccion_id);
                session()->put('direccion', $direccion ?? '');

                $estudiantes = Estudiantes::where('direccion_id', $user->direccion_id)->count();
                $mentores = MentorIndustrial::whereHas('estudiantes', function ($query) use ($user) {
                    $query->where('direccion_id', $user->direccion_id);
                })->count();

                $registrosEstudiantes = Estudiantes::with('academico', 'asesorin')
                    ->where('direccion_id', $user->direccion_id)
                    ->whereDate('fin_dual', '<=', $hoy->copy()->addDays(15))
                    ->where('activo', true)
                    ->get();

                $registrosConvenio = Empresa::whereHas('direccionesCarrera', function ($q) use ($user) {
                    $q->where('direccion_id', $user->direccion_id);
                })
                    ->whereDate('fin_conv', '<=', $hoy->copy()->addDays(15))
                    ->get();

                $hayAlertas = $registrosEstudiantes->isNotEmpty() || $registrosConvenio->isNotEmpty();

                return view('dashboard', compact(
                    'estudiantes',
                    'mentores',
                    'registrosEstudiantes',
                    'registrosConvenio',
                    'hayAlertas'
                ));
        }
    }
}
