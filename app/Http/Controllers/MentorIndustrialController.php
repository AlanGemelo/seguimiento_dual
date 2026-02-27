<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\MentorIndustrial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
// use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class MentorIndustrialController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->rol_id === 1) {
            $mentores = MentorIndustrial::with(['empresa.direccionesCarrera'])->get();
        } elseif (session()->has('direccion')) {

            $direccionId = session('direccion')->id;
            // dd($direccionId);
            $mentores = MentorIndustrial::with(['empresa.direccionesCarrera'])
                ->whereHas('empresa.direccionesCarrera', function ($q) use ($direccionId) {
                    $q->where('direccion_id', $direccionId);
                })->get();
        } else {
            $mentores = collect();
            dd($mentores);
        }

        return view('mentoresIndustriales.index', compact('mentores'));
    }

    public function create()
    {
        $empresas = Empresa::all();

        return view('mentoresIndustriales.create', compact('empresas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'apellidoP' => ['required', 'string', 'min:3', 'max:255'],
            'apellidoM' => ['required', 'string', 'min:3', 'max:255'],
            'puesto' => ['required', 'string', 'max:255'],
            'empresa_id' => ['required', 'integer'],
        ]);

        MentorIndustrial::create([
            'titulo' => $request->titulo,
            'name' => $request->name,
            'apellidoP' => $request->apellidoP,
            'apellidoM' => $request->apellidoM,
            'puesto' => $request->puesto,
            'empresa_id' => $request->empresa_id,
        ]);

        return redirect()
            ->route('mentores.index')
            ->with('success', 'Mentor Industrial creado correctamente');
    }

    public function show($id)
    {
        $id = Hashids::decode($id);
        $mentorIndustrial = MentorIndustrial::find($id);
        $mentorIndustrial = $mentorIndustrial[0];

        return view('mentoresIndustriales.show', compact('mentorIndustrial'));
    }

    public function edit($id)
    {
        $id = Hashids::decode($id);
        $mentorIndustrial = MentorIndustrial::find($id);
        $mentorIndustrial = $mentorIndustrial[0];

        $empresas = Empresa::all();

        return view('mentoresIndustriales.edit', compact('mentorIndustrial', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        try {
            $request->validate([
                'titulo' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'apellidoP' => ['required', 'string', 'min:3', 'max:255'],
                'apellidoM' => ['required', 'string', 'min:3', 'max:255'],
                'puesto' => ['required', 'string', 'max:255'],
                'empresa_id' => ['required', 'integer'],
            ]);

            $mentor = MentorIndustrial::findOrFail($id);
            $mentor->update([
                'titulo' => $request->titulo,
                'name' => $request->name,
                'apellidoP' => $request->apellidoP,
                'apellidoM' => $request->apellidoM,
                'puesto' => $request->puesto,
                'empresa_id' => $request->empresa_id,
            ]);

            return redirect()->route('mentores.index')
                ->with('success', 'Mentor Industrial actualizado correctamente');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Mentor no encontrado.');
        } catch (\Throwable $e) {
            // Log del error para depuración
            \Log::error('Error al actualizar mentor: '.$e->getMessage());

            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el mentor.');
        }
    }

    public function destroy($id)
    {
        $idDecoded = Hashids::decode($id);
        $id = $idDecoded[0] ?? null;

        if (! $id) {
            return redirect()->route('mentores.index')
                ->with('error', 'ID inválido.');
        }

        try {
            $mentor = MentorIndustrial::find($id);

            if (! $mentor) {
                return redirect()->route('mentores.index')
                    ->with('error', 'Mentor no encontrado.');
            }

            $mentor->delete();

            return redirect()->route('mentores.index')
                ->with('success', 'Mentor industrial eliminado');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                return redirect()->route('mentores.index')->with('warning', 'No se puede eliminar el Mentor industrial. Primero elimina los estudiantes asociados');
            }

            return redirect()->route('mentores.index')->with('error', 'Error al eliminar el Mentor industrial: '.$e->getMessage());
        }
    }

    public function showJson($id): JsonResponse
    {
        // Descodificacion del ID
        $decoded = Hashids::decode($id);
        $id = $decoded[0] ?? null;

        $mentor = MentorIndustrial::find($id);

        return response()->json($mentor);
    }

    public function showForEmpresa($id): JsonResponse
    {
        $usuario = Auth::user();

        if (! in_array($usuario->rol_id, [1, 2, 4])) {
            return response()->json(['error' => 'No autorizado.'], 403);
        }
        $mentores = MentorIndustrial::where('empresa_id', $id)->get();

        return response()->json($mentores);
    }
}
