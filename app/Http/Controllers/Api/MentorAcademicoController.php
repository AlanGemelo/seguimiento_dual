<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class MentorAcademicoController extends Controller
{
    public function index(): JsonResponse
    {
        $mentores=User::where('rol_id', 2)->get();

        return response()->json([
            'mentores' => $mentores
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);

       $mentor =  User::create([
            'titulo' => $request->titulo,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('12345678'),
            'rol_id' => 2
        ]);

        return response()->json([
            'mentor' => $mentor
        ], 201);
    }

    public function show($id): JsonResponse
    {

        $mentor=User::find($id);

        return response()->json([
            'mentor' => $mentor
        ]);
    }


    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'titulo' => ['string', 'max:255'],
            'name' => ['min:3', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $mentor=User::find($id);

        $mentor->update($request->all());

        return response()->json([
            'mentor' => $mentor
        ]);
    }

    public function destroy($id)
    {
        $mentor=User::find($id);
        $mentor->delete();

        return response()->noContent();
    }
}
