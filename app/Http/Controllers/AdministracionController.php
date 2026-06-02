<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdministracionController extends Controller
{
    // variable global para comparar autenticacion
    protected $user;

    public function __construct()
    {
        $this->middleware('admin');

        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();
            $user = Auth::user();
            if (! $user || ! in_array($user->rol_id, [1, 4])) {
                abort(403);
            }

            return $next($request);
        });
    }

    public function index()
    {
        $files = Storage::disk('local')
            ->files('UTVT');

        rsort($files);

        $ultimoArchivo = $files[0] ?? null;

        return view(
            'administracion.index',
            compact(
                'files',
                'ultimoArchivo'
            )
        );
    }

    public function buscarPorEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where(
            'email',
            $request->email
        )->first();

        if (! $user) {

            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado',
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
                'nombre' => $user->name.' '.$user->apellidoP.' '.$user->apellidoM,
                'rol' => $roles[$user->rol_id] ?? 'Sin rol',
                'email' => $user->email,
                'estado' => $user->deleted_at
                    ? 'Inactivo'
                    : ($estadoAlumno[$user->activo] ?? 'Desconocido'),
            ],
        ]);
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {

            return back()->with(
                'error',
                'No se encontró un usuario con ese correo.'
            );
        }

        // CONTRASEÑA TEMPORAL
        $tempPassword = 'DUAL-'.strtoupper(Str::random(6));
        // GUARDAR
        $user->password = Hash::make($tempPassword);
        $user->force_password_change = true;
        $user->save();

        return back()
            ->with('success', 'Contraseña restablecida correctamente.')
            ->with('temp_password', $tempPassword)
            ->with('activeTab', 'password-reset');
    }

 public function backup()
{
    return back()->with(
        'warning',
        'La generación de backup está deshabilitada temporalmente.'
    );
}

    public function downloadBackup($file)
    {
        $file = urldecode($file);

        if (! Storage::disk('local')->exists($file)) {
            abort(404, 'Archivo no encontrado.');
        }

        return Storage::disk('local')->download($file);
    }
}
