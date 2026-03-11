<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\DireccionCarrera;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class DireccionCarreraController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function select(DireccionCarrera $direccion)
    {
        session(['direccion' => $direccion]);
        $carreras = Carrera::with('direccion')->where('direccion_id', session('direccion')->id)->get();

        return view('carrera.index', compact('carreras'));
    }

    public function index(Request $request)
    {
        $activeTab = $request->input('tab', 'unidades_registradas');

        $searchDireccionCarrera = $request->input('search_direcciones');
        $searchDireccionesInactivas = $request->input('search_direcciones_carrera_inactivas');

        $pageDirecciones = $request->input('page_direcciones', 1);
        $pageEliminados = $request->input('page_eliminados', 1);
        // Busqueda de Direcciones de carrera

        $direccionesQuery = DireccionCarrera::query()
            ->withCount('programas')
            ->orderBy('name', 'asc');

        if (! empty($searchDireccionCarrera)) {
            $direccionesQuery->where(function ($q) use ($searchDireccionCarrera) {
                $q->where('name', 'LIKE', "%{$searchDireccionCarrera}%")
                    ->orWhere('email', 'LIKE', "%{$searchDireccionCarrera}%")
                    ->orWhere('telefono', 'LIKE', "%{$searchDireccionCarrera}%");
            });
        }

        // Direcciones de Carrera Inactivas
        // Direcciones de Carrera Inactivas
        $direccionesInactivasQuery = DireccionCarrera::onlyTrashed()
            ->orderBy('deleted_at', 'desc');

        if (! empty($searchDireccionesInactivas)) {
            $direccionesInactivasQuery->where(function ($q) use ($searchDireccionesInactivas) {
                $q->where('name', 'LIKE', "%{$searchDireccionesInactivas}%")
                    ->orWhere('email', 'LIKE', "%{$searchDireccionesInactivas}%")
                    ->orWhere('telefono', 'LIKE', "%{$searchDireccionesInactivas}%");
            });
        }

        $direccionesInactivas = $direccionesInactivasQuery
            ->paginate(10, ['*'], 'page_eliminados')
            ->appends($request->all());

        $direcciones = $direccionesQuery
            ->paginate(10, ['*'], 'page_direcciones')
            ->appends($request->all());

        return view('direccionescarrera.index', compact(
            'direcciones',
            'direccionesInactivas',
            'searchDireccionCarrera',
            'searchDireccionesInactivas',
            'activeTab'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('direccionescarrera.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDireccionCarreraRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['nullable', 'string', 'min:3', 'max:255'],
                'email_user' => ['required', 'string', 'max:255'], // validamos solo la parte inicial
                'telefono' => ['nullable', 'string', 'max:20'],
                'ext_telefonica' => ['nullable', 'string', 'max:20'],
            ]);

            // Combinar la parte inicial con el dominio
            $validated['email'] = $validated['email_user'].'@utvtol.edu.mx';

            // Crear el registro
            $direccion = DireccionCarrera::create([
                'name' => $validated['name'] ?? null,
                'email' => $validated['email'],
                'telefono' => $validated['telefono'] ?? null,
                'ext_telefonica' => $validated['ext_telefonica'] ?? null,
            ]);

            return redirect()
                ->route('direcciones.index')
                ->with('success', 'Dirección académica creada correctamente');

        } catch (QueryException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al guardar la dirección académica');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DireccionCarrera  $direccionCarrera
     * @return \Illuminate\Http\Response
     */
    public function show($hash)
    {
        $ids = Hashids::decode($hash);
        if (empty($ids)) {
            abort(404);
        }

        // Cambiar findOrFail a withTrashed()->findOrFail()
        $direccion = DireccionCarrera::withTrashed()->findOrFail($ids[0]);
        $direccion->load('programas', 'director');

        return view('direccionescarrera.show', compact('direccion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DireccionCarrera  $direccionCarrera
     * @return \Illuminate\Http\Response
     */
    public function edit($hash)
    {
        $ids = Hashids::decode($hash);
        $id = $ids[0] ?? null;

        if (! $id) {
            abort(404);
        }

        $direccion = DireccionCarrera::withTrashed()->findOrFail($id);

        return view('direccionescarrera.edit', compact('direccion', 'hash'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDireccionCarreraRequest  $request
     * @param  \App\Models\DireccionCarrera  $direccionCarrera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $hash)
    {
        $ids = Hashids::decode($hash);
        $id = $ids[0] ?? null;

        if (! $id) {
            abort(404);
        }

        // Buscar incluso registros eliminados
        $direccion = DireccionCarrera::withTrashed()->findOrFail($id);

        $validated = $request->validate([
            'name' => ['nullable', 'string', 'min:3', 'max:255'],
            'email_user' => ['required', 'string', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'ext_telefonica' => ['nullable', 'string', 'max:20'],
        ]);

        // Combinar email
        $validated['email'] = $validated['email_user'].'@utvtol.edu.mx';

        $direccion->update([
            'name' => $validated['name'] ?? null,
            'email' => $validated['email'],
            'telefono' => $validated['telefono'] ?? null,
            'ext_telefonica' => $validated['ext_telefonica'] ?? null,
        ]);

        return redirect()
            ->route('direcciones.index')
            ->with('success', 'Dirección académica actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DireccionCarrera  $direccionCarrera
     * @return \Illuminate\Http\Response
     */
    public function destroy($hash)
    {
        $ids = Hashids::decode($hash); // devuelve array

        if (empty($ids)) {
            return redirect()
                ->route('direcciones.index', ['tab' => 'direcciones_carrera_inactivas'])
                ->with('error', 'Dirección no encontrada.');
        }

        $id = $ids[0];

        try {
            $direccion = DireccionCarrera::findOrFail($id);
            $direccion->delete();

            return redirect()
                ->route('direcciones.index', ['tab' => 'direcciones_carrera_inactivas'])
                ->with('success', 'Dirección académica eliminada correctamente');

        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                return redirect()
                    ->route('direcciones.index', ['tab' => 'direcciones_carrera'])
                    ->with('warning', 'No se puede eliminar la dirección de carrera. Primero elimina los programas educativos asociados.');
            }

            return redirect()
                ->route('direcciones.index', ['tab' => 'direcciones_carrera'])
                ->with('error', 'Ocurrió un error al eliminar el registro.');
        }
    }

    public function forceDelete($hash)
    {
        $ids = Hashids::decode($hash);

        if (empty($ids)) {
            return redirect()->route('direcciones.index')->with('error', 'Dirección no encontrada.');
        }

        $id = $ids[0];

        try {
            $direccion = DireccionCarrera::withTrashed()->findOrFail($id);
            $direccion->forceDelete();

            return redirect()
                ->route('direcciones.index', ['tab' => 'direcciones_carrera_inactivas'])
                ->with('success', 'Registro eliminado permanentemente');

        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                return redirect()
                    ->route('direcciones.index', ['tab' => 'direcciones_carrera_inactivas'])
                    ->with('warning', 'No se puede eliminar definitivamente porque tiene registros relacionados.');
            }

            return redirect()
                ->route('direcciones.index', ['tab' => 'direcciones_carrera_inactivas'])
                ->with('error', 'Error al eliminar el registro.');
        }
    }

    public function showJson($id): JsonResponse
    {
        $decoded = Hashids::decode($id);

        if (empty($decoded)) {
            return response()->json(['error' => 'ID inválido'], 404);
        }

        // Con softDeletes
        $direccion = DireccionCarrera::withTrashed()->find($decoded[0]);

        if (! $direccion) {
            return response()->json(['error' => 'Dirección no encontrada'], 404);
        }

        return response()->json([
            'id' => $id,
            'name' => $direccion->name,
            'deleted' => $direccion->trashed(), // Indica si está softdeleted
        ]);
    }

    public function reactivate($id)
    {
        try {
            // Decodificar hash
            $decodedId = Hashids::decode($id);

            if (empty($decodedId)) {
                return redirect()
                    ->route('direcciones.index', ['tab' => 'direcciones_carrera_inactivas'])
                    ->with('error', 'ID inválido.');
            }

            $direccionId = $decodedId[0];

            // Buscar registro incluyendo los eliminados (SoftDeletes)
            $direccion = DireccionCarrera::withTrashed()->findOrFail($direccionId);

            // Verificar si ya está activo
            if (! $direccion->trashed()) {
                return redirect()
                    ->route('direcciones.index', ['tab' => 'direcciones_carrera'])
                    ->with('info', 'La dirección de carrera ya está activa.');
            }

            // Restaurar
            $direccion->restore();

            return redirect()
                ->route('direcciones.index', ['tab' => 'direcciones_carrera'])
                ->with('success', "La dirección de carrera '{$direccion->name}' ha sido restaurada correctamente.");

        } catch (\Exception $e) {
            \Log::error('Error al reactivar dirección de carrera: '.$e->getMessage());

            return redirect()
                ->route('direcciones.index', ['tab' => 'direcciones_carrera_inactivas'])
                ->with('error', 'Ocurrió un error al restaurar la dirección de carrera.');
        }
    }
}
