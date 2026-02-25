<?php

namespace App\Http\Controllers;

use App\Models\DireccionCarrera;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Vinkla\Hashids\Facades\Hashids;

class MentorAcademicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('showJson');
    }

    public function alerts()
    {

        return redirect()->route('estudiantes.index')->with('message', 'Correo enviado correctamente');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        // Busqueda por tab mentores
        $search_mentores = $request->input('search_mentores');

        // Busqueda por tab eliminados
        $search_eliminados = $request->input('search_eliminados');

        // Obtener direccion si no es admin
        $direccionId = session('direccion')->id ?? null;

        // Query base mentores activos
        $query = User::where('rol_id', 2)
            ->with('direccion')
            ->orderBy('name', 'asc');

        // Filtrar por direccion si no es admin
        if ($user->rol_id !== 1) {
            $query->where('direccion_id', $direccionId);
        }

        // Aplicar busqueda mentores activos
        if (! empty($search_mentores)) {
            $query->where(function ($q) use ($search_mentores) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($search_mentores).'%'])
                    ->orWhereRaw('LOWER(apellidoP) LIKE ?', ['%'.strtolower($search_mentores).'%'])
                    ->orWhereRaw('LOWER(apellidoM) LIKE ?', ['%'.strtolower($search_mentores).'%'])
                    ->orWhereRaw('LOWER(email) LIKE ?', ['%'.strtolower($search_mentores).'%']);
            });
        }

        // Paginacion mentores activos
        $mentores = $query->paginate(10, ['*'], 'page_mentores')
            ->appends([
                'tab' => 'mentores',
                'search_mentores' => $search_mentores,
            ]);

        // Query base mentores eliminados
        $deletedQuery = User::onlyTrashed()
            ->where('rol_id', 2)
            ->with('direccion')
            ->orderBy('deleted_at', 'desc');

        // Filtrar por direccion si no es admin
        if ($user->rol_id !== 1) {
            $deletedQuery->where('direccion_id', $direccionId);
        }

        // Aplicar busqueda eliminados
        if (! empty($search_eliminados)) {
            $deletedQuery->where(function ($q) use ($search_eliminados) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($search_eliminados).'%'])
                    ->orWhereRaw('LOWER(apellidoP) LIKE ?', ['%'.strtolower($search_eliminados).'%'])
                    ->orWhereRaw('LOWER(apellidoM) LIKE ?', ['%'.strtolower($search_eliminados).'%'])
                    ->orWhereRaw('LOWER(email) LIKE ?', ['%'.strtolower($search_eliminados).'%']);
            });
        }

        // Paginacion eliminados
        $mentoresDeleted = $deletedQuery->paginate(10, ['*'], 'page_eliminados')
            ->appends([
                'tab' => 'eliminados',
                'search_eliminados' => $search_eliminados,
            ]);

        return view('mentoresacademicos.index', compact(
            'mentores',
            'mentoresDeleted',
            'search_mentores',
            'search_eliminados'
        ));
    }

    public function create(): View
    {
        $direcciones = DireccionCarrera::all();

        return view('mentoresacademicos.create', compact('direcciones'));
    }

    public function store(Request $request)
    {
        $username = str_replace(['@utvtol.edu.mx', ' '], '', $request->email);
        $emailCompleto = $username.'@utvtol.edu.mx';
        $request->merge([
            'email' => $emailCompleto,
        ]);

        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'apellidoP' => ['required', 'string', 'min:3', 'max:255'],
            'apellidoM' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'direccion_id' => ['required', 'integer'],
        ]);

        $user = User::create([
            'titulo' => $request->titulo,
            'name' => $request->name,
            'apellidoP' => $request->apellidoP,
            'apellidoM' => $request->apellidoM,
            'email' => $request->email,
            'password' => Hash::make('12345678'),
            'rol_id' => 2,
            'carrera_id' => 2,
            'direccion_id' => $request->direccion_id,
        ]);

        return redirect()->route('academicos.index')->with('message', 'Mentor Académico creado correctamente');
    }

    public function show($id): View
    {
        $id = Hashids::decode($id);
        $mentor = User::with(['direccion', 'estudiantes'])->find($id);
        $direcciones = DireccionCarrera::all()->find($id);
        $mentor = $mentor[0];

        return view('mentoresacademicos.show', compact('mentor'));
    }

    public function showE($id): View
    {
        $id = Hashids::decode($id);
        $mentor = User::find($id);
        $mentor = $mentor[0];

        return view('mentoresacademicos.show', compact('mentor'));
    }

    public function edit($id): View
    {
        $id = Hashids::decode($id);
        $mentor = User::with('direccion')->find($id);
        $mentor = $mentor[0];
        $direcciones = DireccionCarrera::all();

        return view('mentoresacademicos.edit', compact('mentor', 'direcciones'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'titulo' => ['string', 'max:255'],
            'name' => ['min:3', 'string', 'max:255'],
            'apellidoP' => ['string', 'min:3', 'max:255'],
            'apellidoM' => ['string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'direccion_id' => ['required', 'integer'],
        ]);

        $mentor = User::find($id);
        if ($request->email !== $mentor->email) {
            $request->validate(['email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class]]);
            $mentor->update(['email' => $request->email], $request->all());
        }
        $mentor->update($request->all());

        return redirect()->route('academicos.index');
    }

    public function destroy($id)
    {
        try {
            $mentor = User::find($id);
            $mentor->delete();

            return redirect()->route('academicos.index', ['tab' => 'eliminados'])
                ->with('messageDelete', 'Mentor Academico Eliminado Correctamente');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Error de integridad referencial (clave foránea)
                return redirect()->route('academicos.index')->with('statusError', 'No se puede eliminar el Mentor Academico. Primero elimina los estudiantes asociados');
            }

            // Otro tipo de error, puedes manejarlo según tus necesidades
            return redirect()->route('academicos.index')->with('statusError', 'Error al eliminar el Mentor Academico: '.$e->getMessage());
        }
    }

    public function showJson($id): JsonResponse
    {
        $mentores = User::withTrashed()->find($id);

        return response()->json($mentores);
    }

    public function restoreMentor($id): RedirectResponse
    {
        try {

            $mentor = User::onlyTrashed()->find($id);
            $mentor->restore();

            return redirect()->route('academicos.index', ['tab' => 'mentores'])->with('success', 'Mentor Academico Restaurado.');
        } catch (\Exception $e) {
            // En caso de error, redirigir con mensaje de error
            return redirect()->route('academicos.index')->with('error', 'Hubo un problema al restaurar al mentor: '.$e->getMessage());
        }
    }

    public function forceDelete($id): RedirectResponse
    {
        $mentor = User::onlyTrashed()->find($id);
        $mentor->forceDelete();

        return redirect()->route('academicos.index', ['tab' => 'eliminados'])
            ->with('success', 'Mentor Academico Eliminado Correctamente.');
    }
}
