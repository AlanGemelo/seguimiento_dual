<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Estudiantes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Str;

class AdministracionController extends Controller
{
    // variable global para comparar autenticacion
    protected $user;

    public function __construct()
    {
        $this->middleware('admin');

        // Usa el middleware anónimo para capturar al usuario autenticado
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function index(Request $request): View
    {
        return view('administracion.index');
    }

    public function buscarPorEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where(
            'email',
            $request->email
        )->first();

        if (!$user) {

            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ]);
        }

        $roles = [
            1 => 'Administrador',
            2 => 'Mentor',
            3 => 'Estudiante',
            4 => 'Director',
        ];

        $estadoAlumno = [
            0 => 'Candidato',
            1 => 'Dual',
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'nombre' => $user->name . ' ' . $user->apellidoP . ' ' . $user->apellidoM,
                'rol' => $roles[$user->rol_id] ?? 'Sin rol',
                'email' => $user->email,
                'estado' => $user->deleted_at
                    ? 'Inactivo'
                    : ($estadoAlumno[$user->activo] ?? 'Desconocido'),
            ]
        ]);
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {

            return back()->with(
                'error',
                'No se encontró un usuario con ese correo.'
            );
        }

        // CONTRASEÑA TEMPORAL
        $tempPassword = 'DUAL-' . strtoupper(Str::random(6));
        // GUARDAR
        $user->password = Hash::make($tempPassword);
        $user->force_password_change = true;
        $user->save();
        return back()
            ->with('success', 'Contraseña restablecida correctamente.')
            ->with('temp_password', $tempPassword)
            ->with('activeTab', 'password-reset');
    }
}
