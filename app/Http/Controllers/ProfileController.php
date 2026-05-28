<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Perfil público
     */
    public function index(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
            'section' => 'perfil'
        ]);
    }

    /**
     * Vista cambiar contraseña
     */
    public function password(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
            'section' => 'password'
        ]);
    }

    /**
     * Actualizar perfil
     */
    public function update(Request $request)
    {
        try {

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'apellidoP' => ['required', 'string', 'max:255'],
                'apellidoM' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email'],
            ]);

            $request->user()->update([
                'name' => $request->name,
                'apellidoP' => $request->apellidoP,
                'apellidoM' => $request->apellidoM,
                'email' => $request->email,
            ]);

            return back()->with('success', 'Perfil actualizado correctamente.');
        } catch (\Exception $e) {

            Log::error('Error actualizando perfil: ' . $e->getMessage());

            return back()->with('error', 'Ocurrió un error al actualizar el perfil.');
        }
    }
    /**
     * Actualizar contraseña
     */
    public function updatePassword(Request $request)
    {
        try {

            $request->validate([
                'current_password' => ['required', 'current_password'],
                'password' => [
                    'required',
                    'confirmed',
                    Password::min(8)
                        ->mixedCase()
                        ->numbers(),
                ],
            ], [
                'current_password.current_password' => 'La contraseña actual es incorrecta.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
            ]);

           
            $request->user()->update([
                'password' => Hash::make($request->password),
            ]);
            return back()->with('success', 'Contraseña actualizada correctamente');
           
        } catch (ValidationException $e) {
           
            throw $e;
              return back()->with('warning', 'Datos inválidos. Revisa la información ingresada');
           
        } catch (Exception $e) {
             return back()->with('error', 'Ocurrió un error al actualizar la contraseña');
           
        }
    }
}
