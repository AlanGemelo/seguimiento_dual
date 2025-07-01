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
        $empresas = Empresa::where('status', 1)->get();              // Empresas activas
        $empresasInteresadas = Empresa::where('status', 0)->get();  // Empresas interesadas
        $empresasSuspendidas = Empresa::where('status', 2)->get();  // Empresas con baja temporal (suspendidas)

        return view('empresas.index', compact('empresas', 'empresasInteresadas', 'empresasSuspendidas'));
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
            'direccion_id' => 'required|integer|exists:direccion_carreras,id',
            'telefono' => 'required|string|size:10',
            'inicio_conv' => 'required|date',
            'fin_conv' => 'required|date',
            'unidad_economica' => 'required|string|max:255',
            'fecha_registro' => 'required|date',
            'razon_social' => 'required|string|max:255',
            'nombre_representante' => 'required|string|max:255',
            'cargo_representante' => 'required|string|max:255',
            'actividad_economica' => 'required|string|max:255',
            'tamano_ue' => 'required|integer',
            'folio' => 'nullable|string|max:255',
            'ine' => 'nullable|file|mimes:pdf,jpg',
            'convenioA' => 'nullable|file|mimes:pdf,jpg',
            'convenioMA' => 'nullable|file|mimes:pdf,jpg',
            'direcciones_ids' => 'required|array',
            'direcciones_ids.*' => 'exists:direccion_carreras,id',

        ]);

        if ($request->file('ine')) {
            $ine = 'ine/' . $request->nombre . '_' . date('Y-m-d') . '_' . $request->file('ine')->getClientOriginalName();
            $ine = $request->file('ine')->storeAs('public', $ine);
        }

        if ($request->hasFile('convenioA')) {
            $convenioA = 'convenioA/' . $request->nombre . '_' . date('Y-m-d') . '_' . $request->file('convenioA')->getClientOriginalName();
            $convenioA = $request->file('convenioA')->storeAs('public', $convenioA);
        }
        if ($request->hasFile('convenioMA')) {
            $convenioMA = 'convenioMA/' . $request->nombre . '_' . date('Y-m-d') . '_' . $request->file('convenioMA')->getClientOriginalName();
            $convenioMA = $request->file('convenioMA')->storeAs('public', $convenioMA);
        }

        if (!empty($data['direcciones_ids'])) {

            $empresa->direcciones()->sync($data['direcciones_ids']);
        }

        $empresa->update($request->except('direcciones_ids'));

        if (isset($data['direcciones_ids']) && !empty($data['direcciones_ids'])) {
            $empresa->direcciones()->sync($data['direcciones_ids']);
        }

        $empresa->status = 1; // Cambiar el estado a registrada
        $empresa->save();

        return redirect()->route('empresas.index')->with('success', 'Empresa registrada exitosamente.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:empresas,email',
            'direccion' => 'required|string',
            'telefono' => 'required|string|size:10',
            'inicio_conv' => 'required|date',
            'fin_conv' => 'required|date',
            'direcciones_ids' => 'required|array',
            'direcciones_ids.*' => 'exists:direccion_carreras,id',
            'convenioA' => 'required|file|mimes:pdf,jpeg,png|max:5120',
            'convenioMA' => 'required|file|mimes:pdf,jpeg,png|max:5120',
        ]);

        // Almacenar documentos
        $convenioAPath = null;
        $convenioMAPath = null;

        if ($request->hasFile('convenioA')) {
            $convenioAPath = $request->file('convenioA')->store('empresas/documentos', 'public');
        }

        if ($request->hasFile('convenioMA')) {
            $convenioMAPath = $request->file('convenioMA')->store('empresas/documentos', 'public');
        }

        // Crear la empresa con los datos del formulario
        $empresa = Empresa::create([
            'nombre' => $data['nombre'],
            'email' => $data['email'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
            'inicio_conv' => $data['inicio_conv'],
            'fin_conv' => $data['fin_conv'],
            'convenioA' => $convenioAPath,
            'convenioMA' => $convenioMAPath,
            'status' => 1, // Empresa registrada
        ]);

        // Asociar direcciones de carrera
        if (isset($data['direcciones_ids']) && !empty($data['direcciones_ids'])) {
            $empresa->direcciones()->sync($data['direcciones_ids']);
        }

        return redirect()->route('empresas.index')->with('success', 'Empresa creada exitosamente.');
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

        $empresa = Empresa::with('direcciones')->find($id[0]);

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

    public function suspendForm($id)
    {
        $suspensionReasons = [
            'Cierre definitivo o quiebra',
            'Término del contrato de colaboración',
            'Cambio de razón social o fusión empresarial',
            'Reestructuración interna de la empresa',
            'Incumplimiento de requisitos legales o administrativos',
            'Falta de estudiantes o participantes asignados',
            'Problemas de calidad o desempeño en la formación',
            'Motivos voluntarios de la empresa',
            'Cambio de domicilio fuera del área de cobertura',
            'Cambio de giro o actividad económica de la empresa'
        ];

        $id = Hashids::decode($id);
        if (empty($id)) {
            return redirect()->route('empresas.index')->with('error', 'Empresa no encontrada.');
        }
        $empresa = Empresa::find($id[0]);
        if (!$empresa) {
            return redirect()->route('empresas.index')->with('error', 'Empresa no encontrada.');
        }

        return view('empresas.suspend-form', compact('empresa', 'suspensionReasons'));
    }
    public function suspend(Request $request, $id)
    {


        $validated = $request->validate([
            'motivo_baja' => 'required',
            'fecha_baja' => 'required|date',
        ]);
        $empresa = Empresa::findOrFail($id);
        //dd($request->all());
        $empresa->update([
            'STATUS' => 2,
            'motivo_baja' => $request->motivo_baja,
            'fecha_baja' => $request->fecha_baja,
            'comentarios' => $request->comentarios
        ]);


        return redirect()->route('empresas.index')->with('success', 'La empresa ha sido suspendida temporalmente.');
    }


    public function reactivate($id) {}
}
