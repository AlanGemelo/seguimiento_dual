<?php

namespace App\Http\Controllers;

use App\Models\DireccionCarrera;
use App\Models\Empresa;
use App\Models\Estudiantes;
use App\Models\MentorIndustrial;
use App\Models\Anexo2_1;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
use Barryvdh\DomPDF\Facade\Pdf;

class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $empresas = Empresa::where('status', 1)->get();
        $empresasInteresadas = Empresa::where('status', 0)->get();
        return view('empresas.index', compact('empresas', 'empresasInteresadas'));
    }

    public function interesadas()
    {
        $empresas = Empresa::where('status', 0)->get();
        return view('empresas.interesadas', compact('empresas'));
    }

    public function create(Request $request)
    {
        $direcciones = DireccionCarrera::get(); 
        //dd($direcciones);// Asegúrate de obtener las direcciones
        //$direcciones = DireccionCarrera::where('id',session('direccion')->id)->get();
        $anexo2_1 = Anexo2_1::find($request->anexo2_1_id);
        return view('empresas.create', compact('direcciones'));
    }

    public function registrar(Request $request, Empresa $empresa)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:empresas,email,' . $empresa->id,
            'direccion' => 'required|string',
            'telefono' => 'required|string|size:10',
            'inicio_conv' => 'required|date',
            'fin_conv' => 'required|date',
            //'ine' => 'nullable|file|mimes:pdf,jpg',
            'direcciones_ids' => 'required|array',
            'direcciones_ids.*' => 'exists:direccion_carreras,id',
            'convenioA' => 'nullable|file|mimes:pdf,jpg',
            'convenioMA' => 'nullable|file|mimes:pdf,jpg',
            // 'folio' => 'nullable|string|max:255',
        ]);

        $empresa->update($request->except('direcciones_ids'));
        if (isset($data['direcciones_ids']) && !empty($data['direcciones_ids'])) {
        $empresa->direcciones()->sync($data['direcciones_ids']);
        }
        $empresa->status = 1; // Cambiar el estado a registrada
        $empresa->save();

        return redirect()->route('empresas.index')->with('success', 'Empresa registrada exitosamente.');
    }

    public function store(Request $request, Empresa $empresa)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:empresas,email,' . $empresa->id,
            'direccion' => 'required|string',
            'telefono' => 'required|string|size:10',
            'inicio_conv' => 'required|date',
            'fin_conv' => 'required|date',
            //'ine' => 'nullable|file|mimes:pdf,jpg',
            'direcciones_ids' => 'required|array',
            'direcciones_ids.*' => 'exists:direccion_carreras,id',
            'convenioA' => 'nullable|file|mimes:pdf,jpg',
            'convenioMA' => 'nullable|file|mimes:pdf,jpg',
            // 'unidad_economica' => 'required|string|max:255',
            // 'fecha_registro' => 'required|date',
            //'razon_social' => 'required|string|max:255',
            //'nombre_representante' => 'required|string|max:255',
            //'cargo_representante' => 'required|string|max:255',
            //'actividad_economica' => 'required|string|max:255',
            //'tamano_ue' => 'required|integer',
            //'folio' => 'required|string|max:255',
        ]);

        $empresa = Empresa::create($request->except('direcciones_ids'));
        if (isset($data['direcciones_ids']) && !empty($data['direcciones_ids'])) {
        $empresa->direcciones()->sync($data['direcciones_ids']);
        }
        $empresa->status = 1; // Cambiar el estado a registrada
        return redirect()->route('empresas.index')->with('success', 'Empresa interesada creada exitosamente.');
    }

    /* public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad_economica' => 'required|string|max:255',
            'fecha_registro' => 'required|date',
            'razon_social' => 'required|string|max:255',
            'nombre_representante' => 'required|string|max:255',
            'cargo_representante' => 'required|string|max:255',
            'actividad_economica' => 'required|string|max:255',
            'tamano_ue' => 'required|integer',
            'folio' => 'required|string|max:255',
        ]);

        $empresa = Empresa::create($request->all());

        return redirect()->route('empresas.index')->with('success', 'Empresa interesada creada exitosamente.');
    } */

    public function show($id)
    {
        $id = Hashids::decode($id);
        if (empty($id)) {
            return redirect()->route('empresas.index')->with('error', 'Empresa no encontrada.');
        }
        $empresa = Empresa::find($id[0]);
        if (!$empresa) {
            return redirect()->route('empresas.index')->with('error', 'Empresa no encontrada.');
        }

        return view('empresas.show', compact('empresa'));
    }

    public function edit(Empresa $empresa)
    {
        $direcciones = DireccionCarrera::all(); // Asegúrate de obtener las direcciones
        return view('empresas.edit', compact('empresa', 'direcciones'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:empresas,email,' . $empresa->id,
            'direccion' => 'required|string',
            'telefono' => 'required|string|size:10',
            'inicio_conv' => 'required|date',
            'fin_conv' => 'required|date',
            'ine' => 'nullable|file|mimes:pdf,jpg',
            'direccion_id' => 'required|integer|exists:direccion_carreras,id',
            'convenioA' => 'nullable|file|mimes:pdf,jpg',
            'convenioMA' => 'nullable|file|mimes:pdf,jpg',
            // Nuevos campos
            'unidad_economica' => 'nullable|string|max:255',
            'fecha_registro' => 'nullable|date',
            'razon_social' => 'nullable|string|max:255',
            'nombre_representante' => 'nullable|string|max:255',
            'cargo_representante' => 'nullable|string|max:255',
            'actividad_economica' => 'nullable|string|max:255',
            'tamano_ue' => 'nullable|integer',
            'folio' => 'nullable|string|max:255',
        ]);

        $empresa->update($request->all());

        return redirect()->route('empresas.index')->with('success', 'Empresa actualizada exitosamente.');
    }

    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
        return redirect()->route('empresas.index')->with('success', 'Empresa eliminada exitosamente.');
    }

    public function showJson($id): JsonResponse
    {
        $empresa = Empresa::find($id);
        return response()->json($empresa);
    }

    public function downloadPDF(Empresa $empresa)
    {
        //return response()->json($empresa);
        $data = [
            'unidad_economica' => $empresa->unidad_economica,
            'fecha_registro' => $empresa->fecha_registro,
            'razon_social' => $empresa->razon_social,
            'nombre_representante' => $empresa->nombre_representante,
            'cargo_representante' => $empresa->cargo_representante,
            'telefono' => $empresa->telefono,
            'correo_electronico' => $empresa->email,
            'domicilio' => $empresa->direccion,
            'actividad_economica' => $empresa->actividad_economica,
            'tamano_ue' => $empresa->tamano_ue,
            'folio' => $empresa->folio,
        ];

        $pdf = Pdf::loadView('empresas.pdf', $data);
        return $pdf->download('empresa_' . $empresa->id . '.pdf');
    }

    public function darAlta(Empresa $empresa)
    {
        $direcciones = DireccionCarrera::all(); // Asegúrate de obtener las direcciones
        return view('empresas.darAlta', compact('empresa', 'direcciones'));
    }


    public function exportUeiPdf()
    {
        $empresasInteresadas = Empresa::where('status', 0)->get();
        $data = [
            'empresas' => $empresasInteresadas
        ];

        $pdf = Pdf::loadView('empresas.uei_pdf', $data);
        return $pdf->download('uei_interesadas.pdf');
    }
}
