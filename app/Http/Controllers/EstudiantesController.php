<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Empresa;
use App\Models\Estudiantes;
use App\Models\MentorIndustrial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->only('create', 'store', 'delete');
    }

    public function index(): View
    {
        $estudiantes = Estudiantes::all();
        $estudiantesDeleted = Estudiantes::onlyTrashed()->get();

        return view('estudiantes.index', compact('estudiantes', 'estudiantesDeleted'));
    }

    public function create(): View
    {
        $empresas = Empresa::all();
        $academico = User::where('rol_id', 2)->get();
        $industrial = MentorIndustrial::all();
        $carreras =  Carrera::where('id', '<>', 1)->get();

        return view('estudiantes.create', compact('empresas', 'academico', 'industrial', 'carreras'));
    }

    public function store(Request $request): RedirectResponse
    {
//        dd($request->all());
        $request->validate([
            'matricula' => ['integer', 'unique:' . Estudiantes::class, 'min:8'],
            'name' => ['string', 'min:3', 'max:255'],
            'curp' => ['string', 'min:17'],
            'fecha_na' => ['date'],
            'cuatrimestre' => ['integer', 'required',],
            'nombre_proyecto' => ['string', 'min:3'],
            'inicio_dual' => ['date'],
            'fin_dual' => ['date'],
            'ine' => ['file', 'mimes:pdf'],
            'evaluacion_form' => ['file', 'mimes:pdf'],
            'minutas' => ['file', 'mimes:pdf'],
            'carta_acp' => ['file', 'mimes:pdf'],
            'plan_form' => ['file', 'mimes:pdf'],
            'historial_academico' => ['file', 'mimes:pdf'],
            'perfil_ingles' => ['file', 'mimes:pdf'],
            'empresa_id' => ['required', 'integer', 'exists:' . Empresa::class . ',id'],
            'academico_id' => ['required', 'integer', 'exists:' . User::class . ',id'],
            'asesorin_id' => ['required', 'integer', 'exists:' . MentorIndustrial::class . ',id'],
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

        Estudiantes::create([
            'matricula' => $request->matricula,
            'name' => $request->name,
            'curp' => $request->curp,
            'fecha_na' => Carbon::parse($request->fecha_na)->format("Y-m-d"),
            'activo' => true,
            'cuatrimestre' => $request->cuatrimestre,
            'nombre_proyecto' => $request->nombre_proyecto,
            'inicio_dual' => Carbon::parse($request->inicio_dual)->format("Y-m-d"),
            'fin_dual' => Carbon::parse($request->fin_dual)->format("Y-m-d"),
            'beca' => true,
            'ine' => $ine,
            'evaluacion_form' => $evaluacion_form,
            'minutas' => $minutas,
            'carta_acp' => $carta_acp,
            'plan_form' => $plan_form,
            'historial_academico' => $historial_academico,
            'perfil_ingles' => $perfil_ingles,
            'empresa_id' => $request->empresa_id,
            'academico_id' => $request->academico_id,
            'asesorin_id' => $request->asesorin_id,
            'carrera_id' => $request->carrera_id,
        ]);

        return redirect()->route('estudiantes.index')->with('status', 'Estudiante creado');
    }

    public function show($id): View
    {
        $id = Hashids::decode($id);
        $estudiante = Estudiantes::where('matricula', $id)->get();
        $estudiante = $estudiante[0];

        return view('estudiantes.show', compact('estudiante'));
    }

    public function edit($id): View
    {
        $id = Hashids::decode($id);
        $estudiante = Estudiantes::where('matricula', $id)->get();
        $estudiante = $estudiante[0];
        $empresas = Empresa::all();
        $academico = User::where('rol_id', 2)->get();
        $industrial = MentorIndustrial::all();
        $carreras =  Carrera::where('id', '<>', 1)->get();
        $cuatrimestres =  [
            4,
            5,
            6,
            7,
            8,
        ];


        return view('estudiantes.edit', compact('estudiante', 'empresas', 'academico', 'industrial', 'carreras', 'cuatrimestres'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'matricula' => ['integer','min:8'],
            'name' => ['string', 'min:3', 'max:255'],
            'curp' => ['string', 'min:17'],
            'fecha_na' => ['date'],
            'cuatrimestre' => ['integer'],
            'nombre_proyecto' => ['string', 'min:3'],
            'inicio_dual' => ['date'],
            'fin_dual' => ['date'],
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
        ]);

        $estudiantes=Estudiantes::find($id);

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
            $request->all()
//            [
//            'matricula' => $request->matricula,
//            'name' => $request->name,
//            'curp' => $request->curp,
//            'fecha_na' => Carbon::parse($request->fecha_na)->format("Y-m-d"),
//            'activo' => true,
//            'cuatrimestre' => $request->cuatrimestre,
//            'nombre_proyecto' => $request->nombre_proyecto,
//            'inicio_dual' => Carbon::parse($request->inicio_dual)->format("Y-m-d"),
//            'fin_dual' => Carbon::parse($request->fin_dual)->format("Y-m-d"),
//            'beca' => true,
//            'ine' => $ine ?? $estudiantes->ine,
//            'evaluacion_form' => $evaluacion_form  ?? $estudiantes->evaluacion_form,
//            'minutas' => $minutas ?? $estudiantes->minutas,
//            'carta_acp' => $carta_acp ?? $estudiantes->carta_acp,
//            'plan_form' => $plan_form ?? $estudiantes->plan_form,
//            'historial_academico' => $historial_academico ?? $estudiantes->historial_academico,
//            'perfil_ingles' => $perfil_ingles ?? $estudiantes->perfil_ingles,
//            'empresa_id' => $request->empresa_id,
//            'academico_id' => $request->academico_id,
//            'asesorin_id' => $request->asesorin_id,
//            'carrera_id' => $request->carrera_id,
//        ]
        );

        return redirect()->route('estudiantes.index')->with('status', 'Estudiante actualizado');
    }

    public function destroy($id): RedirectResponse
    {
        $estudiante=Estudiantes::find($id);
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
