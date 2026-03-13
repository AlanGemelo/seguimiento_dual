<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\DireccionCarrera;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Vinkla\Hashids\Facades\Hashids;

class CarreraController extends Controller
{
    // variable global para comparar autenticacion
    protected $user;

    public function __construct()
    {
        $this->middleware('admin');

        // Usa el middleware anónimo para capturar al usuario autenticado
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $search_carreras = $request->input('search_carreras');
        $search_eliminados = $request->input('search_eliminados');

        $direccionId = session('direccion')->id ?? null;

        // Query carreras activas
        $query = Carrera::with('direccion')
            ->orderBy('nombre', 'asc');

        if ($user->rol_id !== 1) {
            $query->where('direccion_id', $direccionId);
        }

        if (! empty($search_carreras)) {
            $query->where(function ($q) use ($search_carreras) {
                $q->whereRaw('LOWER(nombre) LIKE ?', ['%'.strtolower($search_carreras).'%']);
            });
        }

        $carreras = $query->paginate(10, ['*'], 'page_carreras')
            ->appends([
                'tab' => 'carreras',
                'search_carreras' => $search_carreras,
            ]);

        // Query eliminados
        $deletedQuery = Carrera::onlyTrashed()
            ->with('direccion')
            ->orderBy('deleted_at', 'desc');

        if ($user->rol_id !== 1) {
            $deletedQuery->where('direccion_id', $direccionId);
        }

        if (! empty($search_eliminados)) {
            $deletedQuery->where(function ($q) use ($search_eliminados) {
                $q->whereRaw('LOWER(nombre) LIKE ?', ['%'.strtolower($search_eliminados).'%']);
            });
        }

        $carrerasDeleted = $deletedQuery->paginate(10, ['*'], 'page_eliminados')
            ->appends([
                'tab' => 'eliminados',
                'search_eliminados' => $search_eliminados,
            ]);

        return view('carrera.index', compact('carreras', 'carrerasDeleted'));
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
            'direccion_id' => $request->direccion_id,
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
        // Decodificar hash
        $decoded = Hashids::decode($id);

        if (empty($decoded)) {
            return response()->json(['error' => 'Programa educativo no encontrado'], 404);
        }

        $id = $decoded[0];
        try {
            $carrera = Carrera::find($id);
            $carrera->delete();

            return redirect()->route('carreras.index', ['tab' => 'programas_inactivos'])
                ->with('status', 'Carrera Eliminada');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Error de integridad referencial (clave foránea)
                return redirect()->route('carreras.index')
                    ->with('statusError', 'No se puede eliminar la carrera. Primero elimina los estudiantes asociados');
            }

            // Otro tipo de error, puedes manejarlo según tus necesidades
            return redirect()->route('carreras.index')
                ->with('statusError', 'Error al eliminar la carrera: '.$e->getMessage());
        }
    }

    public function forceDelete($id): RedirectResponse
    {
        // Decodificar hash
        $decoded = Hashids::decode($id);

        if (empty($decoded)) {
            return redirect()->route('carreras.index', ['tab' => 'programas_inactivos'])
                ->with('error', 'Programa educativo no encontrado');
        }

        $id = $decoded[0];

        try {
            $carrera = Carrera::onlyTrashed()->find($id);

            if (! $carrera) {
                return redirect()->route('carreras.index', ['tab' => 'programas_inactivos'])
                    ->with('error', 'Programa educativo no encontrado o no está eliminado');
            }

            $carrera->forceDelete();

            return redirect()->route('carreras.index', ['tab' => 'programas_inactivos'])
                ->with('success', 'Programa Educativo Eliminado Correctamente.');

        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                return redirect()->route('carreras.index', ['tab' => 'programas_inactivos'])
                    ->with('warning', 'No se puede eliminar la carrera. Primero elimina los estudiantes asociados');
            }

            return redirect()->route('carreras.index', ['tab' => 'programas_inactivos'])
                ->with('error', 'Error al eliminar la carrera: '.$e->getMessage());
        }
    }

    public function showJson($hashId): JsonResponse
    {
        // Decodificar hash
        $decoded = Hashids::decode($hashId);

        if (empty($decoded)) {
            return response()->json(['error' => 'Programa educativo no encontrado'], 404);
        }

        $id = $decoded[0];

        // Traer incluso si está soft deleted
        $carrera = Carrera::withTrashed()->find($id);

        if (! $carrera) {
            return response()->json(['error' => 'Programa educativo no encontrado'], 404);
        }

        return response()->json($carrera);
    }

    public function show($id): View
    {

        // Decodificar hash
        $decoded = Hashids::decode($id);

        if (empty($decoded)) {
            return response()->json(['error' => 'Programa educativo no encontrado'], 404);
        }

        $id = $decoded[0];

        $carrera = Carrera::withTrashed()->findOrFail($id);

        $direcciones = DireccionCarrera::all();

        return view('carrera.show', compact('carrera', 'direcciones'));
    }

    public function create(): View
    {
        // Usuario autenticado desde la propiedad protegida
        $user = $this->user;

        // Niveles académicos desde config/niveles_academicos
        $grado_academico = config('niveles_academicos');

        if ($user->rol_id == 1) {
            $direcciones = DireccionCarrera::all();
        } else {
            $direccionId = session('direccion')->id ?? null;
            $direcciones = DireccionCarrera::WHERE('id', $direccionId)->get();
        }

        // dd($direccionId);
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

    public function restore($hashId): RedirectResponse
    {
        try {
            $decoded = Hashids::decode($hashId);

            if (empty($decoded)) {
                return redirect()->route('carreras.index', ['tab' => 'programas_inactivos'])
                    ->with('error', 'Programa Academico no encontrado');
            }

            $id = $decoded[0];

            $carrera = Carrera::onlyTrashed()->find($id);

            if (! $carrera) {
                return redirect()->route('carreras.index', ['tab' => 'programas_inactivos'])
                    ->with('error', 'Programa Academico no encontrado o no está eliminado');
            }

            $carrera->restore();

            return redirect()->route('carreras.index', ['tab' => 'programas_inactivos'])
                ->with('success', 'Programa Academico Restaurado.');

        } catch (\Exception $e) {
            return redirect()->route('carreras.index', ['tab' => 'programas_inactivos'])
                ->with('error', 'Hubo un problema al restaurar el Programa Academico: '.$e->getMessage());
        }
    }
}
