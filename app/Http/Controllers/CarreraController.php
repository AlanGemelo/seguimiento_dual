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
            'name' => ['required', 'min:2', 'max:6', 'string']
        ]);

        Carrera::create([
            'name' => $request->name
        ]);

        return redirect()->route('carreras.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'min:2', 'max:6', 'string']
        ]);

        $id=Hashids::decode($id);
        $carreras = Carrera::find($id);
        $carreras=$carreras[0];

        $carreras->update($request->all());

        return redirect()->route('carreras.index')->with('status', 'Carrera Actualizada');
    }

    public function destroy($id)
    {
        $id=Hashids::decode($id);
        $carreras = Carrera::find($id);
        $carreras=$carreras[0];

        $carreras->delete();

        return redirect()->route('carreras.index')->with('status', 'Carrera Eliminada');
    }

    public function showJson($id): JsonResponse
    {
        $carrera = Carrera::find($id);

        return response()->json($carrera);
    }
}
