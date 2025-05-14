<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Estudiantes;
use App\Models\MentorIndustrial;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
//use RealRashid\SweetAlert\Facades\Alert;
use Vinkla\Hashids\Facades\Hashids;

class MentorIndustrialController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {

$mentores = MentorIndustrial::with(['empresa','estudiantes'])->whereHas('empresa',function ($query){
            $query->where('direccion_id',session('direccion')->id);
})->get();

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
            'puesto' => ['required', 'string', 'max:255'],
            'empresa_id' => ['required', 'integer'],
        ]);

        MentorIndustrial::create([
            'titulo' => $request->titulo,
            'name' => $request->name,
            'puesto' => $request->puesto,
            'empresa_id' => $request->empresa_id,
        ]);

        return redirect()->route('mentores.index')->with('message', 'Mentor Industrial creado correctamente');
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
        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'puesto' => ['required', 'string', 'max:255'],
            'empresa_id' => ['required', 'integer'],
        ]);

        $mentor = MentorIndustrial::findOrFail($id);
        $mentor->update([
            'titulo' => $request->titulo,
            'name' => $request->name,
            'puesto' => $request->puesto,
            'empresa_id' => $request->empresa_id,
        ]);

        return redirect()->route('mentores.index')->with('message', 'Mentor Industrial actualizado correctamente');
    }


    public function destroy($id)
    {
        try {
            $id = MentorIndustrial::find($id);
            $id->delete();

            return redirect()->route('mentores.index')->with('status', 'Mentor industrial eliminado');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Error de integridad referencial (clave foránea)
                return redirect()->route('mentores.index')->with('statusError', 'No se puede eliminar el Mentor industrial. Primero elimina los estudiantes asociados');
            }

            // Otro tipo de error, puedes manejarlo según tus necesidades
            return redirect()->route('mentores.index')->with('statusError', 'Error al eliminar el Mentor industrial: ' . $e->getMessage());
        }
    }

    public function showJson($id): JsonResponse
    {
        $mentor = MentorIndustrial::find($id);

        return response()->json($mentor);
    }

    public function showForEmpresa($id): JsonResponse
    {
        $mentores = MentorIndustrial::where('empresa_id', $id)->get();

        return response()->json($mentores);
    }
}
