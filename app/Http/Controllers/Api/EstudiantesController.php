<?php

namespace App\Http\Controllers\Api;

use App\Models\Estudiantes;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class EstudiantesController extends Controller
{
    public function index(): JsonResponse
    {
        $estudiantes = Estudiantes::all();

        return response()->json([
            'estudiantes' => $estudiantes
        ]);
    }

    public function store(Request $request): JsonResponse
    {
//        dd($request->all());
        $request->validate([
            'matricula' => ['integer', 'unique:'.Estudiantes::class, 'min:8'],
            'name' => ['string', 'min:3', 'max:255'],
            'curp' => ['string', 'min:17'],
            'fecha_na' => ['date'],
            'cuatrimestre'=> ['integer'],
        ]);

       $estudiante = Estudiantes::create([
            'matricula' => $request->matricula,
            'name' => $request->name,
            'curp' => $request->curp,
            'fecha_na' => Carbon::parse($request->fecha_na)->format("Y-m-d"),
            'activo' => true,
            'cuatrimestre'=> $request->cuatrimestre,
        ]);

        return response()->json([
            'estudiante' => $estudiante
        ], 201);
    }

    public function show($id): JsonResponse
    {
        $estudiante=Estudiantes::where('matricula', $id)->get();

        return response()->json([
            'estudiante' => $estudiante
        ]);
    }

    public function update(Request $request, Estudiantes $estudiantes)
    {
        //
    }

    public function destroy(Estudiantes $estudiantes)
    {
        //
    }
}
