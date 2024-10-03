<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Mail\DocumentoVencimientoNotification;
use App\Mail\EmpresaMailable;
use App\Mail\UniMentorMailable;
use App\Models\Carrera;
use App\Models\DireccionCarrera;
use App\Models\Empresa;
use App\Models\Estudiantes;
use App\Models\MentorIndustrial;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EstudiantesController extends Controller
{
//    -- Estatus---
//     0-Primera vez
//     1-Renovacion Dual
//     2-Reprobacion
//     3-Terminio de convenio
//     4-Ciclo de renovacion concluido
//     5-Termino del PE

    public function __construct()
    {
        $this->middleware('admin')->only('create', 'store', 'delete');
    }

    public function index()
    {
      
        $estudiantes = Estudiantes::with('academico','carrera')->where('activo' ,true)->get();
        $academico = User::where('rol_id', 2)->get();
        $candidatos = Estudiantes::where('activo', false)->get();

        $estudiantesDeleted = Estudiantes::onlyTrashed()->get();
        $situation = [
            ['id' => 0, 'name' => 'Reprobacion'],
            ['id' => 1, 'name' => 'Termino de Convenio'],
            ['id' => 2, 'name' => 'Ciclo de Renovacion Concluido'],
            ['id' => 3, 'name' => 'Termino del PE']
        ];
        $becas = [
            ['id' => 0, 'name' => 'Si'],
            ['id' => 1, 'name' => 'No']
        ];

        $hoy = Carbon::now();

        // Buscar registros en las tablas que coincidan con la fecha de 15 días antes
     
        return view('estudiantes.index', compact('estudiantes', 'estudiantesDeleted','situation','becas','academico','candidatos'));
    }

    public function create(): View
    {
        $direcciones = DireccionCarrera::all();
        $empresas = Empresa::all();
        $academico = User::where('rol_id', 2)->get();
        $carreras =  Carrera::where('id', '<>', 1)->get();
        
        $situation = [
            ['id' => 0, 'name' => 'Primera vez'],
            ['id' => 1, 'name' => 'Renovacion Dual']
        ];
        $tipoBeca = [
            ['id' => 0, 'name' => 'Apoyo por Empresa'],
            ['id' => 1, 'name' => 'Beca Dual Comecyt']
        ];
        $becas = [
            ['id' => 0, 'name' => 'Si'],
            ['id' => 1, 'name' => 'No']
        ];

        return view('estudiantes.create', compact('empresas', 'academico', 'carreras','situation','tipoBeca','becas','direcciones'));
    }
    public function crearC(): View
    {
        $direcciones = DireccionCarrera::all();
        $academico = User::where('rol_id', 2)->get();
        $carreras =  Carrera::where('id', '<>', 1)->get();
        
        $situation = [
            ['id' => 0, 'name' => 'Primera vez'],
            ['id' => 1, 'name' => 'Renovacion Dual']
        ];
        $tipoBeca = [
            ['id' => 0, 'name' => 'Apoyo por Empresa'],
            ['id' => 1, 'name' => 'Beca Dual Comecyt']
        ];
        $becas = [
            ['id' => 0, 'name' => 'Si'],
            ['id' => 1, 'name' => 'No']
        ];

        return view('estudiantes.createCandidato', compact( 'academico', 'carreras','situation','direcciones'));
    }
    
    

    public function store(Request $request): RedirectResponse
    {


        $request->validate([
            'matricula' => ['integer', 'unique:' . Estudiantes::class, 'min:8'],
            'name' => ['string', 'min:3', 'max:255'],
            'curp' => ['string', 'min:17'],
            'fecha_na' => ['date'],
            'cuatrimestre' => ['integer', 'required'],
            'nombre_proyecto' => ['string', 'min:3'],
            'inicio_dual' => ['date'],
            'fin_dual' => ['date'],
            'empresa_id' => ['required', 'integer', 'exists:' . Empresa::class . ',id'],
            'academico_id' => ['required', 'integer', 'exists:' . User::class . ',id'],
            'asesorin_id' => ['required', 'integer', 'exists:' . MentorIndustrial::class . ',id'],
            'status' => ['required', 'integer'],
            

            'ine' => ['file', 'mimes:pdf','required'],
            'historial_academico' => ['file', 'mimes:pdf'],
            'perfil_ingles' => ['file', 'mimes:pdf'],
            'inicio' => ['date'],
            'fin' => ['date'],
            'direccion_id' => ['required', 'integer', 'exists:' . DireccionCarrera::class . ',id'],

            'carrera_id' => ['required', 'integer', 'exists:' . Carrera::class . ',id'],
        ]);


        if ($request->file('ine')) {
            $ine = 'ine/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('ine')->getClientOriginalName();
            $ine = $request->file('ine')->storeAs('public', $ine);
        }

        if ($request->file('evaluacion_form')) {
            $evaluacion_form = 'evaluacion_form/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('evaluacion_form')->getClientOriginalName();
            $evaluacion_form = $request->file('evaluacion_form')->storeAs('public', $evaluacion_form);
        }

        if ($request->file('minutas')) {
            $minutas = 'minutas/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('minutas')->getClientOriginalName();
            $minutas = $request->file('minutas')->storeAs('public', $minutas);
        }

        if ($request->file('carta_acp')) {
            $carta_acp = 'carta_acp/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('carta_acp')->getClientOriginalName();
            $carta_acp = $request->file('carta_acp')->storeAs('public', $carta_acp);
        }

        if ($request->file('plan_form')) {
            $plan_form = 'plan_form/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('plan_form')->getClientOriginalName();
            $plan_form = $request->file('plan_form')->storeAs('public', $plan_form);
        }

        if ($request->file('historial_academico')) {
            $historial_academico = 'historial_academico/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('historial_academico')->getClientOriginalName();
            $historial_academico = $request->file('historial_academico')->storeAs('public', $historial_academico);
        }

        if ($request->file('perfil_ingles')) {
            $perfil_ingles = 'perfil_ingles/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('perfil_ingles')->getClientOriginalName();
            $perfil_ingles = $request->file('perfil_ingles')->storeAs('public', $perfil_ingles);
        }
        if ($request->file('formatoA')) {
            $formatoA = 'formatoA/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formatoA')->getClientOriginalName();
            $formatoA = $request->file('formatoA')->storeAs('public', $formatoA);
        }
        if ($request->file('formatoB')) {
            $formatoB = 'formatoB/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formatoB')->getClientOriginalName();
            $formatoB = $request->file('formatoB')->storeAs('public', $formatoB);
        }
        if ($request->file('formatoC')) {
            $formatoC = 'formatoC/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formatoC')->getClientOriginalName();
            $formatoC = $request->file('formatoC')->storeAs('public', $formatoC);
        }
        if ($request->file('formato51')) {
            $formato51 = 'formato51/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formato51')->getClientOriginalName();
            $formato51 = $request->file('formato51')->storeAs('public', $formato51);
        }
        if ($request->file('formato51')) {
            $formato54 = 'formato54/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formato54')->getClientOriginalName();
            $formato54 = $request->file('formato54')->storeAs('public', $formato54);
        }
        if ($request->file('formato55')) {
            $formato55 = 'formato55/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formato55')->getClientOriginalName();
            $formato55 = $request->file('formato55')->storeAs('public', $formato55);
        }

        Estudiantes::create([
            'matricula' => $request->matricula,
            'name' => $request->name,
            'curp' => $request->curp,
            'fecha_na' => Carbon::parse($request->fecha_na)->format("Y-m-d"),
            'activo' => true,
            'cuatrimestre' => $request->cuatrimestre,
            'nombre_proyecto' => $request->nombre_proyecto ?? NULL,
            'inicio_dual' => Carbon::parse($request->inicio_dual)->format("Y-m-d") ?? NULL,
            'fin_dual' => Carbon::parse($request->fin_dual)->format("Y-m-d") ?? NULL,
            'inicio' => Carbon::parse($request->fin_dual)->format("Y-m-d") ?? NULL,
            'fin' => Carbon::parse($request->fin_dual)->format("Y-m-d") ?? NULL,
            'beca' => true,
            'status' => $request->status,
            'ine' => $ine ?? NULL,
            'evaluacion_form' => $evaluacion_form ?? NULL,
            'minutas' => $minutas ?? NULL,
            'carta_acp' => $carta_acp ?? NULL,
            'plan_form' => $plan_form ?? NULL,
            'historial_academico' => $historial_academico ?? NULL,
            'perfil_ingles' => $perfil_ingles ?? NULL,
            'formatoA' => $formatoA ?? NULL,
            'formatoB' => $formatoB ?? NULL,
            'formatoC' => $formatoC ?? NULL,
            'formato51' => $formatoC ?? NULL,
            'formato54' => $formatoC ?? NULL,
            'formato55' => $formatoC ?? NULL,
            'empresa_id' => $request->empresa_id ?? NULL,
            'academico_id' => $request->academico_id ?? NULL,
            'asesorin_id' => $request->asesorin_id ?? NULL,
            'carrera_id' => $request->carrera_id,
            'direccion_id' => $request->direccion_id,
        ]);

        return redirect()->route('estudiantes.index')->with('status', 'Estudiante creado');
    }

    public function candidato(Request $request): RedirectResponse
    {


        $request->validate([
            'matricula' => ['integer', 'unique:' . Estudiantes::class, 'min:8'],
            'name' => ['string', 'min:3', 'max:255'],
            'curp' => ['string', 'min:17'],
            'fecha_na' => ['date'],
            'cuatrimestre' => ['integer', 'required',],

            'ine' => ['file', 'mimes:pdf'],
            'historial_academico' => ['file', 'mimes:pdf'],
            'inicio' => ['date'],
            'fin' => ['date'],
            'direccion_id' => ['required', 'integer', 'exists:' . DireccionCarrera::class . ',id'],

            'carrera_id' => ['required', 'integer', 'exists:' . Carrera::class . ',id'],
        ]);


        if ($request->file('ine')) {
            $ine = 'ine/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('ine')->getClientOriginalName();
            $ine = $request->file('ine')->storeAs('public', $ine);
        }

        if ($request->file('historial_academico')) {
            $historial_academico = 'historial_academico/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('historial_academico')->getClientOriginalName();
            $historial_academico = $request->file('historial_academico')->storeAs('public', $historial_academico);
        }

        if ($request->file('perfil_ingles')) {
            $perfil_ingles = 'perfil_ingles/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('perfil_ingles')->getClientOriginalName();
            $perfil_ingles = $request->file('perfil_ingles')->storeAs('public', $perfil_ingles);
        }
     

        Estudiantes::create([
            'matricula' => $request->matricula,
            'name' => $request->name,
            'curp' => $request->curp,
            'fecha_na' => Carbon::parse($request->fecha_na)->format("Y-m-d"),
            'activo' => false,
            'cuatrimestre' => $request->cuatrimestre,
            'inicio' => Carbon::parse($request->fin_dual)->format("Y-m-d") ?? NULL,
            'fin' => Carbon::parse($request->fin_dual)->format("Y-m-d") ?? NULL,
            'ine' => $ine ?? NULL,
            'historial_academico' => $historial_academico ?? NULL,
            'perfil_ingles' => $perfil_ingles ?? NULL,
            'carrera_id' => $request->carrera_id,
            'direccion_id' => $request->direccion_id,
        ]);
      

        return redirect()->route('estudiantes.index')->with('status', 'Estudiante creado');
    }
    public function showPdf($url, $data)
    {
        $pdf = PDF::loadView($url, $data);
        return $pdf->download('invoice.pdf');
    }

    public function show($id): View
    {

        $id = Hashids::decode($id);

        $estudiante = Estudiantes::with('direccion','empresa','carrera')->where('matricula', $id)->get();
        $estudiante = $estudiante[0];

        return view('estudiantes.show', compact('estudiante'));
    }
    public function showC($id): View
    {

        $id = Hashids::decode($id);

        $estudiante = Estudiantes::with('direccion')->where('matricula', $id)->get();
        $estudiante = $estudiante[0];

        return view('estudiantes.showC', compact('estudiante'));
    }

    public function edit($id): View
    {
        $direcciones = DireccionCarrera::all();
        $id = Hashids::decode($id);
        $estudiante = Estudiantes::where('matricula', $id)->get();
        $estudiante = $estudiante[0];
        $empresas = Empresa::all();
        $academicos = User::where('rol_id', 2)->get();
        $carreras =  Carrera::where('id', '<>', 1)->get();
        $cuatrimestres =  [
            4,
            5,
            6,
            7,
            8,
        ];
        
        $becas = [
            ['id' => 0, 'name' => 'Si'],
            ['id' => 1, 'name' => 'No']
        ];
        $tipoBeca = [
            ['id' => 0, 'name' => 'Apoyo por Empresa'],
            ['id' => 1, 'name' => 'Beca Dual Comecyt']
        ];

      
        
        
        $industrials = MentorIndustrial::all();
        $vista = Auth::user()->rol_id == 1 ? 'editAdmin' : 'edit';

        return view('estudiantes.' . $vista, compact('estudiante', 'empresas', 'academicos', 'industrials', 'carreras', 'cuatrimestres','becas','tipoBeca','direcciones'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'matricula' => ['integer', 'min:8'],
            'name' => ['string', 'min:3', 'max:255'],
            'curp' => ['string', 'min:17'],
            'fecha_na' => ['date'],
            'beca'=>[ 'integer'],
            'cuatrimestre' => ['integer'],
            'nombre_proyecto' => ['string', 'min:3'],
            'inicio_dual' => ['date'],
            'fin_dual' => ['date'],
            'fin' => ['date'],
            'inicio' => ['date'],

            'ine' => ['file', 'mimes:pdf'],
            'evaluacion_form' => ['file', 'mimes:pdf'],
            'minutas' => ['file', 'mimes:pdf'],
            'carta_acp' => ['file', 'mimes:pdf'],
            'plan_form' => ['file', 'mimes:pdf'],
            'historial_academico' => ['file', 'mimes:pdf'],
            'perfil_ingles' => ['file', 'mimes:pdf'],
            'empresa_id' => ['integer', 'exists:' . Empresa::class . ',id'],
            'academico_id' => ['integer', 'exists:' . User::class . ',id'],
            'asesorin_id' => ['integer', 'exists:' . MentorIndustrial::class . ',id'],
            'carrera_id' => ['integer', 'exists:' . Carrera::class . ',id'],
            'direccion_id' => ['integer', 'exists:' . DireccionCarrera::class . ',id'],
        ]);
        $inicioDual = Carbon::parse($request->inicio_dual);
        $finDual = Carbon::parse($request->fin_dual);
        if ($inicioDual->diffInYears($finDual) !== 1) {
            // Si la diferencia no es de un año, retornar un error
            return redirect()->back()->withErrors(['fin_dual' => 'La diferencia entre inicio dual y fin dual debe ser de un año.']);
        }
        $id = Hashids::decode($id);
        $estudiantes = Estudiantes::find($id);
        $estudiantes = $estudiantes[0];

        if ($request->file('ine')) {
            $ine = 'ine/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('ine')->getClientOriginalName();
            $ine = $request->file('ine')->storeAs('public', $ine);
        }
        if ($request->file('evaluacion_form')) {
            $evaluacion_form = 'evaluacion_form/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('evaluacion_form')->getClientOriginalName();
            $evaluacion_form = $request->file('evaluacion_form')->storeAs('public', $evaluacion_form);
        }

        if ($request->file('minutas')) {
            $minutas = 'minutas/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('minutas')->getClientOriginalName();
            $minutas = $request->file('minutas')->storeAs('public', $minutas);
        }

        if ($request->file('carta_acp')) {
            $carta_acp = 'carta_acp/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('carta_acp')->getClientOriginalName();
            $carta_acp = $request->file('carta_acp')->storeAs('public', $carta_acp);
        }

        if ($request->file('plan_form')) {
            $plan_form = 'plan_form/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('plan_form')->getClientOriginalName();
            $plan_form = $request->file('plan_form')->storeAs('public', $plan_form);
        }

        if ($request->file('historial_academico')) {
            $historial_academico = 'historial_academico/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('historial_academico')->getClientOriginalName();
            $historial_academico = $request->file('historial_academico')->storeAs('public', $historial_academico);
        }

        if ($request->file('perfil_ingles')) {
            $perfil_ingles = 'perfil_ingles/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('perfil_ingles')->getClientOriginalName();
            $perfil_ingles = $request->file('perfil_ingles')->storeAs('public', $perfil_ingles);
        }
        if ($request->file('formatoA')) {
            $formatoA = 'formatoA/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formatoA')->getClientOriginalName();
            $formatoA = $request->file('formatoA')->storeAs('public', $formatoA);
        }
        if ($request->file('formatoB')) {
            $formatoB = 'formatoB/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formatoB')->getClientOriginalName();
            $formatoB = $request->file('formatoB')->storeAs('public', $formatoB);
        }
        if ($request->file('formatoC')) {
            $formatoC = 'formatoC/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formatoC')->getClientOriginalName();
            $formatoC = $request->file('formatoC')->storeAs('public', $formatoC);
        }
        if ($request->file('formato51')) {
            $formato51 = 'formato51/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formato51')->getClientOriginalName();
            $formato51 = $request->file('formato51')->storeAs('public', $formato51);
        }
        if ($request->file('formato51')) {
            $formato54 = 'formato54/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formato54')->getClientOriginalName();
            $formato54 = $request->file('formato54')->storeAs('public', $formato54);
        }
        if ($request->file('formato55')) {
            $formato55 = 'formato55/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formato55')->getClientOriginalName();
            $formato55 = $request->file('formato55')->storeAs('public', $formato55);
        }
        $estudiantes->fill([

            'ine' => $ine ?? $estudiantes->ine,
            'evaluacion_form' => $evaluacion_form  ?? $estudiantes->evaluacion_form,
            'minutas' => $minutas ?? $estudiantes->minutas,
            'carta_acp' => $carta_acp ?? $estudiantes->carta_acp,
            'plan_form' => $plan_form ?? $estudiantes->plan_form,
            'historial_academico' => $historial_academico ?? $estudiantes->historial_academico,
            'perfil_ingles' => $perfil_ingles ?? $estudiantes->perfil_ingles,
            'formatoA' => $formatoA ?? $estudiantes->formatoA,
            'formatoB' => $formatoB ?? $estudiantes->formatoB,
            'formatoC' => $formatoC ?? $estudiantes->formatoC,
            'formato51' => $formato51 ?? $estudiantes->formato51,
            'formato54' => $formato54 ?? $estudiantes->formato54,
            'formato55' => $formato55 ?? $estudiantes->formato55,
            'activo' => true,

        ]);
        $estudiantes->save();

        $estudiantes->update($request->except([
            'ine',
            'evaluacion_form',
            'minutas',
            'carta_acp',
            'plan_form',
            'historial_academico',
            'formatoA',
            'formatoB',
            'formatoC',
            'formato51',
            'formato54',
            'formato55',
            'perfil_ingles',
            
        ]));

        User::create([
            'titulo' => 'Estudiante',
            'name' => $request->name,
            'email' => $request->matricula.'@gmail.com',
            'password' => Hash::make('12345678'),
            'rol_id' => 3,
            'carrera_id' => $request->carrera_id,
            'direccion_id' => $request->direccion_id,
        ]);


        return redirect()->route('estudiantes.index')->with('status', 'Estudiante actualizado');
    }
    public function updateDocDual(Request $request, $id)
    {
     
     
        $id = Hashids::decode($id);
        $estudiantes = Estudiantes::find($id);
        $estudiantes = $estudiantes[0];

      
        if ($request->file('formato54')) {
            $formato54 = 'formato54/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formato54')->getClientOriginalName();
            $formato54 = $request->file('formato54')->storeAs('public', $formato54);
        }
    
        $estudiantes->fill([
            'formato54' => $formato54 ?? $estudiantes->formato54,
        ]);
        $estudiantes->save();

        $estudiantes->update($request->except([
            'formato54',
        ]));

        $estudiante = Estudiantes::where('matricula', strtok(Auth::user()->email,'@'))->first();


        return view('dashboardEstudiante', [
            'estudiante' => $estudiante,
            'success' => 'Estudiante actualizado correctamente.' // Mensaje de éxito
        ]);    }
  

    public function updateForm(Request $request, $id)
    {
        $request->validate([
            'nombre_proyecto' => ['string', 'min:3'],
            'inicio_dual' => ['date'],
            'fin_dual' => ['date'],
            'evaluacion_form' => ['file', 'mimes:pdf'],
            'minutas' => ['file', 'mimes:pdf'],
            'carta_acp' => ['file', 'mimes:pdf'],
            'plan_form' => ['file', 'mimes:pdf'],
            'historial_academico' => ['file', 'mimes:pdf'],
            'perfil_ingles' => ['file', 'mimes:pdf'],
            'empresa_id' => ['integer', 'exists:' . Empresa::class . ',id'],
            'academico_id' => ['integer', 'exists:' . User::class . ',id'],
            'asesorin_id' => ['integer', 'exists:' . MentorIndustrial::class . ',id'],
            'carrera_id' => ['integer', 'exists:' . Carrera::class . ',id'],
        ]);


        $inicioDual = Carbon::parse($request->inicio_dual);
        $finDual = Carbon::parse($request->fin_dual);
        if ($inicioDual->diffInYears($finDual) !== 1) {
            // Si la diferencia no es de un año, retornar un error
            return redirect()->back()->withErrors(['fin_dual' => 'La diferencia entre inicio dual y fin dual debe ser de un año.']);
        }
        $id = Hashids::decode($id);
        $estudiantes = Estudiantes::find($id);
        $estudiantes = $estudiantes[0];

        if ($request->file('ine')) {
            $ine = 'ine/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('ine')->getClientOriginalName();
            $ine = $request->file('ine')->storeAs('public', $ine);
        }

        if ($request->file('evaluacion_form')) {
            $evaluacion_form = 'evaluacion_form/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('evaluacion_form')->getClientOriginalName();
            $evaluacion_form = $request->file('evaluacion_form')->storeAs('public', $evaluacion_form);
        }

        if ($request->file('minutas')) {
            $minutas = 'minutas/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('minutas')->getClientOriginalName();
            $minutas = $request->file('minutas')->storeAs('public', $minutas);
        }

        if ($request->file('carta_acp')) {
            $carta_acp = 'carta_acp/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('carta_acp')->getClientOriginalName();
            $carta_acp = $request->file('carta_acp')->storeAs('public', $carta_acp);
        }

        if ($request->file('plan_form')) {
            $plan_form = 'plan_form/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('plan_form')->getClientOriginalName();
            $plan_form = $request->file('plan_form')->storeAs('public', $plan_form);
        }

        if ($request->file('historial_academico')) {
            $historial_academico = 'historial_academico/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('historial_academico')->getClientOriginalName();
            $historial_academico = $request->file('historial_academico')->storeAs('public', $historial_academico);
        }

        if ($request->file('perfil_ingles')) {
            $perfil_ingles = 'perfil_ingles/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('perfil_ingles')->getClientOriginalName();
            $perfil_ingles = $request->file('perfil_ingles')->storeAs('public', $perfil_ingles);
        }
        $estudiantes->update(
            $request->all(),
            [
                'ine' => $ine ?? $estudiantes->ine,
                'evaluacion_form' => $evaluacion_form  ?? $estudiantes->evaluacion_form,
                'minutas' => $minutas ?? $estudiantes->minutas,
                'carta_acp' => $carta_acp ?? $estudiantes->carta_acp,
                'plan_form' => $plan_form ?? $estudiantes->plan_form,
                'historial_academico' => $historial_academico ?? $estudiantes->historial_academico,
                'perfil_ingles' => $perfil_ingles ?? $estudiantes->perfil_ingles,
            ]
        );

        return redirect()->route('estudiantes.index')->with('status', 'Estudiante actualizado');
    }

    public function destroy($id, Request $request)
    {

        $estudiante = Estudiantes::find($id);
        $estudiante->update([
            'status'=> $request->status,
        ]);
        $estudiante->delete();

        return redirect()->route('estudiantes.index')->with('status', 'Estudiante eliminado');
    }

    public function showJson($id): JsonResponse
    {
        $estudiante = Estudiantes::withTrashed()->where('matricula', $id)->get();

        return response()->json($estudiante);
    }

    public function restoreEstudiante($id): RedirectResponse
    {
        $estudiante = Estudiantes::onlyTrashed()->where('matricula', $id)->first();
        $estudiante->restore();

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante Restaurado.');
    }

    public function forceDelete($id): RedirectResponse
    {
        $estudiante = Estudiantes::onlyTrashed()->where('matricula', $id)->first();
        //        dd($estudiante);
        $estudiante->forceDelete();
        //
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante Eliminado Correctamente.');
    }
}
