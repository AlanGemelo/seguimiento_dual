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
use Illuminate\Validation\Rule;


class CarreraController extends Controller
{

    //variable global para comparar autenticacion
    protected $user;

    public function __construct()
    {
        $this->middleware('admin');

        //Usa el middleware anónimo para capturar al usuario autenticado
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
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

    public function store(Request $request): RedirectResponse
    {
        // Obtener los valores válidos de grado académico desde config
        $valores_grado = array_column(config('niveles_academicos'), 'grado_academico');
        $request->validate([
            'grado_academico' => ['required', Rule::in($valores_grado)],
            'nombre' => ['required', 'min:2', 'max:255', 'string'],
            'direccion_id' => ['required',  'max:255', 'numeric', 'exists:direccion_carreras,id'],
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
        // Obtener los valores válidos de grado académico desde config
        $valores_grado = array_column(config('niveles_academicos'), 'grado_academico');

        $request->validate([
            'nombre' => ['required', 'min:2', 'max:255', 'string'],
            'direccion_id' => ['required',  'max:255', 'numeric', 'exists:direccion_carreras,id'],
            'grado_academico' => ['required', Rule::in($valores_grado)],
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
    }

    public function create():View
    {
        // Usuario autenticado desde la propiedad protegida
        $user = $this->user;

        //Niveles académicos desde config/niveles_academicos
        $grado_academico = config('niveles_academicos');

        if ($user->rol_id == 1) {
            $direcciones = DireccionCarrera::all();
        } else {
            $direccionId = session('direccion')->id ?? null;
            $direcciones = DireccionCarrera::WHERE('id', $direccionId)->get();
        }
        //dd($direccionId);
        return view('carrera.create', compact('direcciones', 'grado_academico'));
    }

    public function edit(Carrera $id): View
    {
        $grado_academico = config('niveles_academicos');

        $id->load('direccion');
        $carrera = $id;
        $direcciones = DireccionCarrera::get();
        return view('carrera.edit', compact('carrera', 'direcciones', 'grado_academico'));
    }
}
