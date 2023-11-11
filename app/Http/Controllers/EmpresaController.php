<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Estudiantes;
use App\Models\MentorIndustrial;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class EmpresaController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except('showJson');
    }

    public function index()
    {
        $empresas = Empresa::all();

        return view('empresas.index', compact('empresas'));
    }

    public function create()
    {
        $mentores=MentorIndustrial::all();

        return view('empresas.create', compact('mentores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'inicio_conv' => ['required', 'date'],
            'fin_conv' => ['required', 'date'],
        ]);

        $empresa = Empresa::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'inicio_conv' => Carbon::parse($request->inicio_conv)->format("Y-m-d"),
            'fin_conv' => Carbon::parse($request->fin_conv)->format("Y-m-d"),
        ]);

        return redirect()->route('empresas.index')->with('status', 'Empresa creada');
    }

    public function show($id)
    {
        $id = Hashids::decode($id);
        $empresa=Empresa::find($id);
        $empresa=$empresa[0];

        return view('empresas.show', compact('empresa'));
    }

    public function edit($id)
    {
        $id = Hashids::decode($id);
        $empresa=Empresa::find($id);
        $empresa=$empresa[0];

        $estudiantes = Estudiantes::all();

        return view('empresas.edit', compact('empresa', 'estudiantes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'inicio_conv' => ['required', 'date'],
            'fin_conv' => ['required', 'date'],
        ]);

        $empresa=Empresa::find($id);

        $empresa->update([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'inicio_conv' => Carbon::parse($request->inicio_conv)->format("Y-m-d"),
            'fin_conv' => Carbon::parse($request->fin_conv)->format("Y-m-d"),
        ]);

        return redirect()->route('empresas.index')->with('status', 'Empresa actualizada');
    }

    public function destroy($id)
    {
        $empresa=Empresa::find($id);

        $empresa->delete();

        return redirect()->route('empresas.index')->with('status', 'Empresa eliminada');
    }

    public function showJson($id): JsonResponse
    {
        $empresa = Empresa::find($id);

        return response()->json($empresa);
    }
}
