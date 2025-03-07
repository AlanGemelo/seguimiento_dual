<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DireccionCarrera;
use App\Models\Carrera;
use App\Models\Estudiantes;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DireccionCarreraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function select(DireccionCarrera $direccion): JsonResponse
    {
        session(['direccion' => $direccion]);
        $carreras = Carrera::with('direccion')->where('direccion_id', session('direccion')->id)->get();

        return response()->json($carreras,200);
    }

    public function index(): JsonResponse
    {
        $direcciones = Estudiantes::all();
        return response()->json($direcciones);
    }

    public function create(): JsonResponse
    {
        return response()->json(['message' => 'Formulario para crear una nueva dirección de carrera']);
    }

    public function store(Request $request): JsonResponse
    {



        $direccion = DireccionCarrera::create($request->all());
        return response()->json($direccion, 201);
    }

    public function show(DireccionCarrera $direccion): JsonResponse
    {
        $direccion->load('programas', 'director');
        return response()->json($direccion);
    }

    public function edit(DireccionCarrera $direccion): JsonResponse
    {
        return response()->json($direccion);
    }

    public function update(Request $request, DireccionCarrera $direccion): JsonResponse
    {
        $direccion->update($request->all());
        return response()->json(['message' => 'Dirección de carrera actualizada correctamente']);
    }

    public function destroy(DireccionCarrera $direccion): JsonResponse
    {
        try {
            $direccion->delete();
            return response()->json(['message' => 'Dirección de carrera eliminada correctamente']);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return response()->json(['error' => 'No se puede eliminar la dirección de carrera. Primero elimina los programas educativos asociados'], 409);
            }
            return response()->json(['error' => 'Error al eliminar la dirección de carrera: ' . $e->getMessage()], 500);
        }
    }
}
