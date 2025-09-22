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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        //Obtiene la cantidad de estudiantes asignados
          $empresas = Empresa::where('status', 1)
        ->withCount('estudiantes') 
        ->get();

       // $empresas = Empresa::where('status', 1)->get();              // Empresas activas
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

    public function registrar(Request $request, Empresa $empresa): RedirectResponse
    {

        $ue_size = array_column(config('ue_size.tamanos'), 'tamano_eu');
        //dd($ue_size);
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:empresas,email,' . $empresa->id,
            'telefono' => 'required|string|size:10',
            'inicio_conv' => 'required|date',
            'fin_conv' => 'required|date',
            'unidad_economica' => 'required|string|max:255',
            'fecha_registro' => 'required|date',
            'razon_social' => 'required|string|max:255',
            'nombre_representante' => 'required|string|max:255',
            'cargo_representante' => 'required|string|max:255',
            'actividad_economica' => 'required|string|max:255',
            'tamano_ue' => ['required', Rule::in($ue_size)],
            'folio' => 'nullable|string|max:255',
            'direccion' => 'required|string|max:255',
            'ine' => 'required|file|mimes:pdf,jpg',
            'convenioA' => 'nullable|file|mimes:pdf,jpg',
            'convenioMA' => 'nullable|file|mimes:pdf,jpg',
            'direcciones_ids' => 'required|array',
            'direcciones_ids.*' => 'exists:direccion_carreras,id',
        ]);

        $empresaNombre = Str::slug($data['nombre']);
        $fecha = now()->format('d-m-Y');

        if ($request->hasFile('ine')) {
            $file = $request->file('ine');
            $filename = "{$fecha}_{$empresaNombre}_ine." . $file->getClientOriginalExtension();
            $data['ine'] = $file->storeAs('empresas/documentos/ine', $filename, 'public');
        }

        if ($request->hasFile('convenioA')) {
            $file = $request->file('convenioA');
            $filename = "{$fecha}_{$empresaNombre}_convenioA." . $file->getClientOriginalExtension();
            $data['convenioA'] = $file->storeAs('empresas/documentos/convenioA', $filename, 'public');
        }

        if ($request->hasFile('convenioMA')) {
            $file = $request->file('convenioMA');
            $filename = "{$fecha}_{$empresaNombre}_convenioMA." . $file->getClientOriginalExtension();
            $data['convenioMA'] = $file->storeAs('empresas/documentos/convenioMA', $filename, 'public');
        }


        $empresa->update(Arr::except($data, ['direcciones_ids']));

        // Sincronizar relaciones
        $empresa->direcciones()->sync($data['direcciones_ids'] ?? []);

        // Cambiar estado
        $empresa->status = 1;
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

        //Procesamiento de documentos pdf jpg
        $empresaNombre = Str::slug($request->input('nombre'));
        $fecha = now()->format('d-m-Y');

        $convenioAPath = null;
        $convenioMAPath = null;

        if ($request->hasFile('convenioA')) {
            $file = $request->file('convenioA');
            $filename = $fecha . '_' . $empresaNombre . '_convenioA.' . $file->getClientOriginalExtension();
            $convenioAPath = $file->storeAs('empresas/documentos/convenioA', $filename, 'public');
        }

        if ($request->hasFile('convenioMA')) {
            $file = $request->file('convenioMA');
            $filename = $fecha . '_' . $empresaNombre . '_convenioMA.' . $file->getClientOriginalExtension();
            $convenioMAPath = $file->storeAs('empresas/documentos/convenioMA', $filename, 'public');
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

    public function show_establecidas($id)
    {
        $id = Hashids::decode($id);

        if (empty($id)) {
            return redirect()->route('empresas.index')->with('error', 'Empresa no encontrada.');
        }

        $empresa = Empresa::with('direcciones')->find($id[0]);

        if (!$empresa) {
            return redirect()->route('empresas.index')->with('error', 'Empresa no encontrada.');
        }

        return view('empresas.show_establecidas', compact('empresa'));
    }

    public function edit(Empresa $empresa): View
    {
        $tamano_eu = config('ue_size');
        $direcciones = DireccionCarrera::all(); // Asegúrate de obtener las direcciones
        return view('empresas.edit', compact('empresa', 'direcciones', 'tamano_eu'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        $ue_size = array_column(config('ue_size.tamanos'), 'tamano_eu');
        $request->validate([
            'nombre' => 'required|string|max:255',
            'razon_social' => 'nullable|string|max:255',
            'actividad_economica' => 'nullable|string|max:255',
            'unidad_economica' => 'nullable|string|max:255',
            'tamano_ue' => ['required', Rule::in($ue_size)],
            'folio' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'fecha_registro' => 'nullable|date',
            'email' => 'required|email|unique:empresas,email,' . $empresa->id,
            'telefono' => 'required|string|size:10',
            'nombre_representante' => 'required|string|max:255',
            'cargo_representante' => 'required|string|max:255',
            'direcciones_ids' => 'required|array',
            'direcciones_ids.*' => 'exists:direccion_carreras,id',
            'inicio_conv' => 'required|date',
            'anos_conv' => 'nullable|integer|min:0',
            'fin_conv' => 'required|date|after_or_equal:inicio_conv',
            'ine' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'convenioA' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'convenioMA' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $empresaNombre = Str::slug($request->input('nombre'));
        $fecha = now()->format('d-m-Y');

        $inePath = $empresa->ine;
        $convenioAPath = $empresa->convenioA;
        $convenioMAPath = $empresa->convenioMA;

        if ($request->hasFile('ine')) {
            $file = $request->file('ine');
            $filename = $fecha . '_' . $empresaNombre . '_ine.' . $file->getClientOriginalExtension();
            $inePath = $file->storeAs('empresas/documentos/ine', $filename, 'public');
        }

        if ($request->hasFile('convenioA')) {
            $file = $request->file('convenioA');
            $filename = $fecha . '_' . $empresaNombre . '_convenioA.' . $file->getClientOriginalExtension();
            $convenioAPath = $file->storeAs('empresas/documentos/convenioA', $filename, 'public');
        }

        if ($request->hasFile('convenioMA')) {
            $file = $request->file('convenioMA');
            $filename = $fecha . '_' . $empresaNombre . '_convenioMA.' . $file->getClientOriginalExtension();
            $convenioMAPath = $file->storeAs('empresas/documentos/convenioMA', $filename, 'public');
        }

        $empresa->update([
            'nombre' => $request->nombre,
            'razon_social' => $request->razon_social,
            'actividad_economica' => $request->actividad_economica,
            'unidad_economica' => $request->unidad_economica,
            'tamano_ue' => $request->tamano_ue,
            'folio' => $request->folio,
            'direccion' => $request->direccion,
            'fecha_registro' => $request->fecha_registro,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'nombre_representante' => $request->nombre_representante,
            'cargo_representante' => $request->cargo_representante,
            'inicio_conv' => $request->inicio_conv,
            'fin_conv' => $request->fin_conv,
            'ine' => $inePath,
            'convenioA' => $convenioAPath,
            'convenioMA' => $convenioMAPath,
        ]);

        $empresa->direcciones()->sync($request->direcciones_ids);

        return redirect()->route('empresas.index')->with('success', 'Empresa actualizada exitosamente.');
    }


    public function destroy(Empresa $id)
    {
        // dd($id);
        MentorIndustrial::where('empresa_id', $id->id)->delete();
        $id->delete();
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

    public function darAlta(Empresa $empresa): View
    {
        $tamano_eu = config('ue_size');
        //dd($tamano_eu);
        $direcciones = DireccionCarrera::all();
        return view('empresas.darAlta', compact('empresa', 'direcciones', 'tamano_eu'));
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
            'comentarios_baja' => $request->comentarios,
        ]);


        return redirect()->route('empresas.index')->with('success', 'La empresa ha sido suspendida temporalmente.');
    }

    public function reactivate($id)
    {
        $decodedId = Hashids::decode($id);

        if (empty($decodedId)) {
            return response()->json([
                'success' => false,
                'message' => 'Empresa no encontrada'
            ], 404);
        }

        $empresa = Empresa::findOrFail($decodedId[0]);

        // Verificar que esté suspendida
        if ($empresa->STATUS != 2) {
            return response()->json([
                'success' => false,
                'message' => 'Solo se pueden reactivar empresas suspendidas'
            ], 400);
        }

        // Reactivar la empresa
        $empresa->update([
            'STATUS' => 1, // 1 = Activa
            'motivo_baja' => null,
            'comentarios_baja' => null,
            'fecha_baja' => null
        ]);

        return redirect()->route('empresas.index')->with('success', 'La empresa ha sido reactivada temporalmente.');
    }
}
