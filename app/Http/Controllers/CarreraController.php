<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Estudiantes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class CarreraController extends Controller
{

    public function index()
    {
        $carreras = Carrera::where('id', '<>', 1)->get();

        return view('carrera.index', compact('carreras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'min:2', 'max:255', 'string']
        ]);

        Carrera::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('carreras.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'min:2', 'max:255', 'string']
        ]);

        $id = Hashids::decode($id);
        $carreras = Carrera::find($id);
        $carreras = $carreras[$id];

        $carreras->update($request->all());

        return redirect()->route('carreras.index')->with('status', 'Carrera Actualizada');
    }

    public function destroy($id)
    {
        $id = Hashids::decode($id);
        $carrera = Carrera::find($id);
        $carrera -> delete();
        return redirect()->route('carreras.index')->with('status', 'Carrera Eliminada');
    }

    public function showJson($id): JsonResponse
    {
        $carrera = Carrera::find($id);

        return response()->json($carrera);
    }

    public function create()
    {
        return view('carrera.create');
    }

    public function edit($id)
    {
        $carrera = Carrera::find($id);

        return view('carrera.edit', compact('carrera'));
    }
}
