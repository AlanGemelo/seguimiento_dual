<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\DireccionCarrera;
use App\Models\Empresa;
use App\Models\Estudiantes;
use Google\Cloud\Core\Batch\Retry;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;

class CarreraController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $user = Auth::user();

        // Si es administrador o tiene rol que debe ver todo (por ejemplo rol_id 1)
        if ($user->rol_id === 1) {
            $carreras = Carrera::with('direccion')->get();
        }
        // Si es un usuario con dirección asignada en sesión
        elseif (session()->has('direccion') && session('direccion') !== null) {
            $carreras = Carrera::with('direccion')
                ->where('direccion_id', session('direccion')->id)
                ->get();
        }
        // Otro caso: no tiene permiso o no se puede mostrar nada
        else {
            $carreras = collect();
        }

        return view('carrera.index', compact('carreras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grado_academico' => ['required', 'in:Licenciatura,Ingeniería,Técnico Superior Universitario'],
            'nombre' => ['required', 'min:2', 'max:255', 'string'],
            'direccion_id' => ['required',  'max:255', 'numeric', 'exists:direccion_carreras,id']
        ]);
        $direcciones = DireccionCarrera::all();
        Carrera::create([
            'grado_academico' => $request->grado_academico,
            'nombre' => $request->nombre,
            'direccion_id' => $request->direccion_id
        ]);

        return redirect()->route('carreras.index', compact('direcciones'));
    }

    public function update(Request $request, Carrera $id)
    {
        $request->validate([
            'nombre' => ['required', 'min:2', 'max:255', 'string'],
            'direccion_id' => ['required',  'max:255', 'numeric', 'exists:direccion_carreras,id']

        ]);

        // $id = Hashids::decode($id);

        $id->update($request->all());

        return redirect()->route('carreras.index')->with('status', 'Carrera Actualizada');
    }

    public function destroy($id)
    {
        try {
            $carrera = Carrera::find($id);
            $carrera->delete();
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

    public function show(Carrera $carrera): View
    {
        $direcciones = DireccionCarrera::all();
        return view('carrera.show', compact('carrera', 'direcciones'));

        return response()->json($carrera);
    }

    public function create()
    {
        $direcciones = DireccionCarrera::all();
        return view('carrera.create', compact('direcciones'));
    }

    public function edit(Carrera $id)
    {
        $id->load('direccion');
        $carrera = $id;
        $direcciones = DireccionCarrera::get();
        return view('carrera.edit', compact('carrera', 'direcciones'));
    }
}
