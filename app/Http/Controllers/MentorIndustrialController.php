<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Estudiantes;
use App\Models\MentorIndustrial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        $mentorIndustrial=MentorIndustrial::find($id);
        $mentorIndustrial=$mentorIndustrial[0];
        return view('mentoresIndustriales.show', compact('mentorIndustrial'));
    }

    public function edit($id)
    {
        $mentorIndustrial=MentorIndustrial::find($id);
        $mentorIndustrial=$mentorIndustrial[0];

        return view('mentoresIndustriales.edit', compact('mentorIndustrial'));
    }

    public function update(Request $request, MentorIndustrial $mentorIndustrial)
    {
        $request->validate([
            'titulo' =>  ['string', 'max:255'],
            'name' => ['string', 'max:255'],
            'empresa_id' => ['integer', 'exists:' . Empresa::class . ',id'],
        ]);

        $mentorIndustrial->update($request->all());

        return redirect()->route('mentores.index')->with('status', 'Mentor industrial actualizado');
    }


    public function destroy($id)
    {
        $id=MentorIndustrial::find($id);
        $id->delete();

        return redirect()->route('mentores.index')->with('status', 'Mentor industrial eliminado');
    }

    public function showJson($id): JsonResponse
    {
        $mentor = MentorIndustrial::find($id);

        return response()->json($mentor);
    }
}
