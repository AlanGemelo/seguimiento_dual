<?php

namespace App\Http\Controllers;

use App\Models\DireccionCarrera;
use App\Models\Empresa;
use App\Models\Estudiantes;
use App\Models\MentorIndustrial;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class EmpresaController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
 

    public function index()
    {
        $empresas = Empresa::where('direccion_id',session('direccion')->id)->get();
        Empresa::with('direccion')->get();

        return view('empresas.index', compact('empresas'));
    }

    public function create()
    {
        $mentores = MentorIndustrial::with(['empresa'=>function($query){
            $query->where('direccion_id',session('direccion')->id);
        }])->get();
        $direcciones = DireccionCarrera::all();

        return view('empresas.create', compact('mentores','direcciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:10'],
            'convenioMA' => ['file', 'mimes:pdf,jpg'],
            'convenioA' => ['file', 'mimes:pdf'],
            'inicio_conv' => ['required', 'date'],
            'fin_conv' => ['required', 'date'],

        ]);
        if ($request->file('convenioA')) {
            $convenioA = 'convenioA/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('convenioA')->getClientOriginalName();
            $convenioA = $request->file('convenioA')->storeAs('public', $convenioA);
        }
        if ($request->file('convenioMA')) {
            $convenioMA = 'convenioMA/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('convenioMA')->getClientOriginalName();
            $convenioMA = $request->file('convenioMA')->storeAs('public', $convenioMA);
        }

        $empresa = Empresa::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'convenioA' => $convenioA,
            'convenioMA' => $convenioMA,
            'inicio_conv' => Carbon::parse($request->inicio_conv)->format("Y-m-d"),
            'fin_conv' => Carbon::parse($request->fin_conv)->format("Y-m-d"),
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion_id' => session('direccion')->id ?? Auth::user()->direccion_id,
        ]);

        return redirect()->route('empresas.index')->with('status', 'Empresa creada');
    }

    public function show( $id)
    {
        $id = Hashids::decode($id);
        $empresa = Empresa::find($id);
        $empresa = $empresa[0];

        return view('empresas.show', compact('empresa'));
    }

    public function edit($id)
    {
        $id = Hashids::decode($id);
        $empresa = Empresa::find($id);
        $empresa = $empresa[0];
        $direcciones = DireccionCarrera::all();


        return view('empresas.edit', compact('empresa','direcciones'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'inicio_conv' => ['required', 'date'],
            'fin_conv' => ['required', 'date'],
            'email' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:10'],
        ]);

        $empresa = Empresa::find($id);

        $empresa->update([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'inicio_conv' => Carbon::parse($request->inicio_conv)->format("Y-m-d"),
            'fin_conv' => Carbon::parse($request->fin_conv)->format("Y-m-d"),
            'email' => $request->email,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('empresas.index')->with('status', 'Empresa actualizada');
    }

    public function destroy($id)
    {
        try {
            $carrera = Empresa::find($id);
            $carrera->delete();

            return redirect()->route('empresas.index')->with('status', 'Carrera Eliminada');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Error de integridad referencial (clave foránea)
                return redirect()->route('empresas.index')->with('statusError', 'No se puede eliminar la Empresa. Primero elimina los mentores academicos asociados');
            }

            // Otro tipo de error, puedes manejarlo según tus necesidades
            return redirect()->route('empresas.index')->with('statusError', 'Error al eliminar la Empresa: ' . $e->getMessage());
        }
    }

    public function showJson($id): JsonResponse
    {
        $empresa = Empresa::find($id);

        return response()->json($empresa);
    }
}
