<?php

namespace App\Http\Controllers;

use App\Models\Estudiantes;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Vinkla\Hashids\Facades\Hashids;

class MentorAcademicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('showJson');
    }

    public function index(): View
    {
        $mentores=User::where('rol_id', 2)->get();

        return view('mentoresacademicos.index', compact('mentores'));
    }

    public function create(): View
    {
        return view('mentoresacademicos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $user = User::create([
            'titulo' => $request->titulo,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('12345678'),
            'rol_id' => 2,
            'carrera_id' => 2
        ]);

        return redirect()->route('academicos.index')->with('message', 'Mentor Academico creado Correctamente');
    }

    public function show($id): View
    {
        $id=Hashids::decode($id);
        $mentor=User::find($id);
        $mentor=$mentor[0];

        return view('mentoresacademicos.show', compact('mentor'));
    }

    public function edit($id): View
    {
        $id=Hashids::decode($id);
        $mentor=User::find($id);
        $mentor=$mentor[0];

        return view('mentoresacademicos.edit', compact('mentor'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'titulo' => ['string', 'max:255'],
            'name' => ['min:3', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $mentor=User::find($id);
        if ($mentor->email === $request->email){
            return redirect()->route('academicos.index');
        }
        $mentor->update($request->all());

        return redirect()->route('academicos.index');
    }

    public function destroy($id)
    {
        $mentor=User::find($id);
        $mentor->delete();

        return redirect()->route('academicos.index')->with('messageDelete', 'Mentor Academico Eliminado Correctamente');
    }

    public function showJson($id): JsonResponse
    {
        $mentores = User::find($id);

        return response()->json($mentores);
    }
}
