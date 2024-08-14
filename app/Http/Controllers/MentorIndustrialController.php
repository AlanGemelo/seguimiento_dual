<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Estudiantes;
use App\Models\MentorIndustrial;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Vinkla\Hashids\Facades\Hashids;

class MentorIndustrialController extends Controller
{

    public function index()
    {
        $mentoresIndustriales = MentorIndustrial::all();

        return view('mentoresIndustriales.index', compact('mentoresIndustriales'));
    }


    public function create()
    {
        $empresas = Empresa::all();

        return view('mentoresIndustriales.create', compact('empresas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' =>  ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'empresa_id' => ['required', 'integer', 'exists:' . Empresa::class . ',id'],
        ]);

        MentorIndustrial::create([
            'titulo' => $request->titulo,
            'name' => $request->name,
            'empresa_id' => $request->empresa_id,
        ]);

        return redirect()->route('mentores.index')->with('status', 'Mentor industrial creado');
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

    public function update(Request $request, MentorIndustrial $mentorIndustrial, $id)
    {
        $request->validate([
            'titulo' =>  ['string', 'max:255'],
            'name' => ['string', 'max:255'],
            'empresa_id' => ['integer', 'exists:' . Empresa::class . ',id'],
        ]);
        $mentorIndustrial->find($id)->update($request->all());
        // $mentorIndustrial->find($id)->update([
        //     'titulo' => $request->titulo,
        //     'name' => $request->name,
        //     'empresa_id' => $request->empresa_id
        // ]);
        return redirect()->route('mentores.index')->with('status', 'Mentor industrial actualizado');
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
