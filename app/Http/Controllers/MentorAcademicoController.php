<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Mail\DocumentoVencimientoNotification;
use App\Models\DireccionCarrera;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;

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

   public function index()
{
    $user = Auth::user();

    // Si es administrador
    if ($user->rol_id === 1) {
        $mentores = User::where('rol_id', 2)->with('direccion')->get();
        $mentoresDeleted = User::onlyTrashed()->where('rol_id', 2)->get();
    } else {
        // Si no es administrador, filtra por su dirección
        $direccionId = session('direccion')->id ?? null;

        $mentores = User::where('rol_id', 2)
            ->with('direccion')
            ->where('direccion_id', $direccionId)
            ->get();

        $mentoresDeleted = User::onlyTrashed()
            ->where('rol_id', 2)
            ->where('direccion_id', $direccionId)
            ->get();
    }

    return view('mentoresacademicos.index', compact('mentores', 'mentoresDeleted'));
}

    public function create(): View
    {
        $direcciones = DireccionCarrera::all();
        return view('mentoresacademicos.create', compact('direcciones'));
    }

    public function store(Request $request)
    {
        $username = str_replace(['@utvtol.edu.mx', ' '], '', $request->email);
        $emailCompleto = $username . '@utvtol.edu.mx';
        $request->merge([
            'email' => $emailCompleto
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
            $request->validate(['email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class]]);
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

            return redirect()->route('academicos.index')->with('messageDelete', 'Mentor Academico Eliminado Correctamente');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Error de integridad referencial (clave foránea)
                return redirect()->route('academicos.index')->with('statusError', 'No se puede eliminar el Mentor Academico. Primero elimina los estudiantes asociados');
            }

            // Otro tipo de error, puedes manejarlo según tus necesidades
            return redirect()->route('academicos.index')->with('statusError', 'Error al eliminar el Mentor Academico: ' . $e->getMessage());
        }
    }

    public function showJson($id): JsonResponse
    {
        $mentores = User::withTrashed()->find($id);
        return response()->json($mentores);
    }

    public function restoreMentor($id): RedirectResponse
    {
        $mentor = User::onlyTrashed()->find($id);
        $mentor->restore();

        return redirect()->route('academicos.index')->with('success', 'Mentor Academico Restaurado.');
    }

    public function forceDelete($id): RedirectResponse
    {
        $mentor = User::onlyTrashed()->find($id);
        $mentor->forceDelete();

        return redirect()->route('academicos.index')->with('success', 'Mentor Academico Eliminado Correctamente.');
    }
}
