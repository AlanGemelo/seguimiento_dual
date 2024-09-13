<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\DireccionCarrera;
use App\Models\Empresa;
use App\Models\Estudiantes;
use Google\Cloud\Core\Batch\Retry;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class CarreraController extends Controller
{

    public function index()
    {
        $carreras = Carrera::with('direccion')->where('id', '<>', 1)->get();
        return view('carrera.index', compact('carreras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'min:2', 'max:255', 'string'],
            'direccion_id' => ['required',  'max:255', 'numeric', 'exists:direccion_carreras,id']
        ]);
        $direcciones = DireccionCarrera::all();
        Carrera::create([
            'nombre' => $request->nombre,
            'direccion_id' => $request->direccion_id
        ]);

        return redirect()->route('carreras.index',compact('direcciones'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'min:2', 'max:255', 'string'],
            'direccion_id' => ['required',  'max:255', 'numeric', 'exists:direccion_carreras,id']

        ]);

        $id = Hashids::decode($id);
        $carreras = Carrera::find($id);
        $carreras = $carreras[$id];

        $carreras->update($request->all());

        return redirect()->route('carreras.index')->with('status', 'Carrera Actualizada');
    }

    public function destroy($id)
    {
        try {
            $carrera = Carrera::find($id);
            $carrera -> delete();
            return redirect()->route('carreras.index')->with('status', 'Carrera Eliminada');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Error de integridad referencial (clave foránea)
                return redirect()->route('carreras.index')->with('statusError', 'No se puede eliminar la carrera. Primero elimina los estudiantes asociados');
            }

            // Otro tipo de error, puedes manejarlo según tus necesidades
            return redirect()->route('carreras.index')->with('statusError', 'Error al eliminar la carrera: ' . $e->getMessage());
        }
    }

    public function showJson($id): JsonResponse
    {
        $carrera = Carrera::find($id);

        return response()->json($carrera);
    }

    public function create()
    {
        $direcciones = DireccionCarrera::all();
        return view('carrera.create',compact('direcciones'));
    }

    public function edit(Carrera $id)
    {
        dd($id);    

        return view('carrera.edit', compact('carrera'));
    }
}
