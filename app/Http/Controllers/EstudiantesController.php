<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        $this->middleware('admin')->only('delete');
        // Permitir create y store para admin y mentor académico
        $this->middleware(function ($request, $next) {
            if (auth()->user()->rol_id === 1 || auth()->user()->rol_id === 2 || auth()->user()->rol_id === 4) {
                return $next($request);
            }
            abort(403, 'No tienes permiso para acceder a esta página');
        })->only(['create', 'store']);
    }

    /**
     * Muestra la lista de estudiantes.
     */

    public function index(Request $request)
    {

        $hoy = Carbon::now();
        // Buscar registros en las tablas que coincidan con la fecha de 15 días antes
        $registros = Estudiantes::with('academico', 'asesorin')->whereDate('fin_dual', '<=', $hoy->addDays(15))->where('activo', true)->get();
        $registrosConvenio = Empresa::with('asesorin')->whereDate('fin_conv', '<=', $hoy->addDays(15))->get();

        // Enviar correos por cada registro
        // foreach ($registrosConvenio as $registro) {
        // Mail::to('al222010229@utvtol.edu.mx')->send(new UniMentorMailable($registro, $registro->fin_conv,$registro->asesorin,env('APP_URL')));
        //Mail::to('alanortega.dp@gmail.com')->send(new UniMentorMailable($registro, $registro->fin_conv,$registro->asesorin,
        //env('APP_URL'),session('direccion')->email,session('direccion')->name));
        // Mail::to($registro->email)->send(new EmpresaMailable($registro->nombre, $registro->fin_conv,$registro->asesorin));
        $search = $request->input('search');
        $searchCandidatos = $request->input('search_candidatos');
        $searchAcademicos = $request->input('search_academicos');
        $searchEliminados = $request->input('search_eliminados');

        $pageEstudiantes = $request->input('page_estudiantes', 1);
        $pageCandidatos = $request->input('page_candidatos', 1);
        $pageAcademicos = $request->input('page_academicos', 1);
        $pageEliminados = $request->input('page_eliminados', 1);

        // $direccionId = session('direccion')->id ?? null;
        $direccionId = session('direccion')?->id ?? null;

        $query = Estudiantes::with('academico', 'carrera', 'usuario')
            ->where('activo', true)
            ->where('direccion_id', $direccionId)
            ->orderBy('name', 'asc');

        if ($request->has('search') && !empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $estudiantes = $query->paginate(10);

        Log::info('El ID de dirección es: ' . $direccionId);
        $candidatos = Estudiantes::where('activo', false)
            ->where('name', 'LIKE', '%' . $searchCandidatos . '%')
            ->where('direccion_id', $direccionId)
            ->orderBy('name', 'asc')
            ->simplePaginate(10, ['*'], 'page_candidatos', $pageCandidatos);

        $academico = User::where('rol_id', 2)->where('name', 'LIKE', '%' . $searchAcademicos . '%')->where('direccion_id', $direccionId)->simplePaginate(10, ['*'], 'page_academicos', $pageAcademicos);
        $estudiantesDeleted = Estudiantes::where('direccion_id', $direccionId)->with('academico', 'carrera')->onlyTrashed()->where('name', 'LIKE', '%' . $searchEliminados . '%')->simplePaginate(10, ['*'], 'page_eliminados', $pageEliminados);

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

        return view('estudiantes.index', compact('estudiantes', 'estudiantesDeleted', 'situation', 'becas', 'academico', 'candidatos', 'search', 'searchCandidatos', 'searchAcademicos', 'searchEliminados'));
    }


    /**
     * Muestra el formulario para crear un nuevo estudiante.
     */
    public function create()
    {
        $user = Auth::user();
        $direccionId = session('direccion')->id ?? null;

        // Datos comunes para todos los roles
        $situation = [
            ['id' => 0, 'name' => 'Primera vez'],
            ['id' => 1, 'name' => 'Renovacion Dual']
        ];

        $tipoBeca = [
            ['id' => 0, 'name' => 'Apoyo por Empresa'],
            ['id' => 1, 'name' => 'Beca Dual Comecyt'],
        ];

        $becas = [
            ['id' => 0, 'name' => 'Si'],
            ['id' => 1, 'name' => 'No']
        ];

        // Para administradores (rol_id = 1)
        if ($user->rol_id === 1) {
            $direcciones = DireccionCarrera::all();
            $empresas = Empresa::with('direccionesCarrera')->get();
            $academicos = User::where('rol_id', 2)->get();
            $carreras = Carrera::all();
            $asesores = MentorIndustrial::with('empresa')->get();
        }
        // Para otros roles con dirección asignada
        else {
            $direcciones = DireccionCarrera::where('id', $direccionId)->get();

            $empresas = Empresa::whereHas('direccionesCarrera', function ($q) use ($direccionId) {
                $q->where('direccion_id', $direccionId);
            })->get();

            $academicos = User::where('rol_id', 2)
                ->where('direccion_id', $direccionId)
                ->get();

            $carreras = Carrera::where('direccion_id', $direccionId)->get();
            $mentores = MentorIndustrial::with('empresa')->get();
            $asesores = MentorIndustrial::whereHas('empresa.direccionesCarrera', function ($q) use ($direccionId) {
                $q->where('direccion_id', $direccionId);
            })->get();
        }

        return view('estudiantes.create', compact(
            'empresas',
            'academicos',
            'carreras',
            'situation',
            'tipoBeca',
            'becas',
            'direcciones',
            'asesores',
        ));
    }

    /**
     * Muestra el formulario para crear un nuevo candidato.
     */
    public function crearC(): View
    {
        $user = Auth::user();
        $direccionId = session('direccion')->id ?? null;

        if ($user->rol_id === 1) {
            $direcciones = DireccionCarrera::get();
            $academico = User::get();
            $carreras =  Carrera::get();

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
        } else {
            $direcciones = DireccionCarrera::where("id", session('direccion')->id)->get();
            $academico = User::where('direccion_id', session('direccion')->id)->where('rol_id', [1, 2, 4])->get();
            $carreras =  Carrera::where('direccion_id', session('direccion')->id)->get();

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
        }

        return view('estudiantes.createCandidato', compact('academico', 'carreras', 'situation', 'direcciones'));
    }

    /**
     * Almacena un nuevo estudiante en la base de datos.
     */
    public function store(Request $request): RedirectResponse
    {

        //dd($request->all());

        $request->validate([
            'matricula' => ['integer', 'unique:' . Estudiantes::class, 'min:9'],
            'name' => ['string', 'min:3', 'max:255'],
            'apellidoP' => ['string', 'min:3', 'max:255'],
            'apellidoM' => ['string', 'min:3', 'max:255'],
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
            'ine' => ['file', 'mimes:pdf', 'required'],
            // 'historial_academico' => ['file', 'mimes:pdf'],
            // 'perfil_ingles' => ['file', 'mimes:pdf'],
            'formato54' => ['nullable', 'array'],
            'formato54.*' => ['file', 'mimes:pdf,jpeg,png'],
            'inicio' => ['date'],
            'fin' => ['date'],
            'beca' => ['required', 'integer', 'in:0,1'],
            'tipoBeca' => ['nullable', 'integer', 'in:0,1'],
            'direccion_id' => ['required', 'integer', 'exists:' . DireccionCarrera::class . ',id'],
            'carrera_id' => ['required', 'integer', 'exists:' . Carrera::class . ',id'],
        ]);

        $formato54Paths = [];

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

        if ($request->hasFile('formato54')) {
            foreach ($request->file('formato54') as $file) {
                $path = 'formato54/' . $request->matricula . '_' . date('Y-m-d') . '_' . $file->getClientOriginalName();
                $storedPath = $file->storeAs('public', $path);
                $formato54Paths[] = $storedPath;
            }
        }

        if ($request->file('formato55')) {
            $formato55 = 'formato55/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formato55')->getClientOriginalName();
            $formato55 = $request->file('formato55')->storeAs('public', $formato55);
        }

        // Guardar como JSON en la base de datos
        $formato54Json = json_encode($formato54Paths);


        $user = User::create([
            'titulo' => 'Estudiante',
            'name' => $request->name,
            'apellidoP' => $request->apellidoP,
            'apellidoM' => $request->apellidoM,
            'email' => $request->email ?? ('al' . $request->matricula . '@utvtol.edu.mx'),
            'password' => Hash::make($request->matricula),
            'rol_id' => 3,
            'carrera_id' => $request->carrera_id,
            'direccion_id' => $request->direccion_id,

        ]);

        Estudiantes::create([
            'matricula' => $request->matricula,
            'name' => $request->name,
            'apellidoP' => $request->apellidoP,
            'apellidoM' => $request->apellidoM,
            'curp' => $request->curp,
            'fecha_na' => Carbon::parse($request->fecha_na)->format("Y-m-d"),
            'activo' => true,
            'cuatrimestre' => $request->cuatrimestre,
            'nombre_proyecto' => $request->nombre_proyecto ?? NULL,
            'inicio_dual' => Carbon::parse($request->inicio_dual)->format("Y-m-d") ?? NULL,
            'fin_dual' => Carbon::parse($request->fin_dual)->format("Y-m-d") ?? NULL,
            'inicio' => Carbon::parse($request->fin_dual)->format("Y-m-d") ?? NULL,
            'fin' => Carbon::parse($request->fin_dual)->format("Y-m-d") ?? NULL,
            'beca' => $request->beca,
            'tipoBeca' => $request->tipoBeca,
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
            'formato51' => $formato51 ?? NULL,
            'formato54' => $formato54Json ?? NULL,
            'formato55' => $formato55 ?? NULL,
            'empresa_id' => $request->empresa_id ?? NULL,
            'academico_id' => $request->academico_id ?? NULL,
            'asesorin_id' => $request->asesorin_id ?? NULL,
            'carrera_id' => $request->carrera_id,
            'direccion_id' => $request->direccion_id,
            'user_id' => $user->id
        ]);

        return redirect()->route('estudiantes.index')->with('status', 'Estudiante creado');
    }

    /**
     * Almacena un nuevo candidato en la base de datos.
     */
    public function candidato(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'matricula' => ['integer', 'unique:' . Estudiantes::class, 'min:8'],
            'name' => ['string', 'min:3', 'max:255'],
            'apellidoP' => ['string', 'min:3', 'max:255'],
            'apellidoM' => ['string', 'min:3', 'max:255'],
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
        $user = User::create([
            'titulo' => 'Estudiante',
            'name' => $request->name,
            'apellidoP' => $request->apellidoP,
            'apellidoM' => $request->apellidoM,
            'email' => 'al' . $request->email . '@utvtol.edu.mx',
            'password' => Hash::make($request->matricula),
            'rol_id' => 3,
            'carrera_id' => $request->carrera_id,
            'direccion_id' => $request->direccion_id,

        ]);

        Estudiantes::create([
            'matricula' => $request->matricula,
            'name' => $request->name,
            'apellidoP' => $request->apellidoP,
            'apellidoM' => $request->apellidoM,
            'curp' => $request->curp,
            'fecha_na' => Carbon::parse($request->fecha_na)->format("Y-m-d"),
            'activo' => false,
            'cuatrimestre' => $request->cuatrimestre,
            'inicio' => $request->filled('inicio') ? Carbon::parse($request->inicio)->format('Y-m-d') : null,
            'fin' => $request->filled('fin') ? Carbon::parse($request->fin)->format('Y-m-d') : null,
            'ine' => $ine ?? NULL,
            'historial_academico' => $historial_academico ?? NULL,
            'perfil_ingles' => $perfil_ingles ?? NULL,
            'carrera_id' => $request->carrera_id,
            'direccion_id' => $request->direccion_id,
            'user_id' => $user->id
        ]);


        return redirect()->route('estudiantes.index')->with('status', 'Estudiante creado');
    }

    /**
     * Muestra un PDF.
     */
    public function showPdf($url, $data)
    {
        $pdf = PDF::loadView($url, $data);
        return $pdf->download('invoice.pdf');
    }

    /**
     * Muestra los detalles de un estudiante.
     */
    public function show($id)
    {
        $id = Hashids::decode($id);

        $estudiante = Estudiantes::with('direccion', 'empresa', 'carrera')->where('matricula', $id)->where('direccion_id', session('direccion')->id)->get();
        $estudiante = $estudiante[0];


        return view('estudiantes.show', compact('estudiante'));
    }

    /**
     * Muestra los detalles de un candidato.
     */
    public function showC($id): View
    {

        $id = Hashids::decode($id);

        $estudiante = Estudiantes::with('direccion')->where('direccion_id', session('direccion')->id)->where('matricula', $id)->get();
        $estudiante = $estudiante[0];

        return view('estudiantes.showC', compact('estudiante'));
    }

    /**
     * Muestra el formulario para editar un estudiante.
     */

    public function edit($id)
    {


        $user = Auth::user();
        $direccionId = session('direccion')->id;
        $id = Hashids::decode($id);

        // Obtener el estudiante
        $estudiante = Estudiantes::with('empresa')
            ->where('matricula', $id)
            ->firstOrFail();

        // Datos comunes
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

        $cuatrimestres = [4, 5, 6, 7, 8, 9, 10];




        // Lógica condicional para diferentes roles (como en create())
        if ($user->rol_id === 1) {
            $direcciones = DireccionCarrera::all();
            $empresas = Empresa::with('direccionesCarrera')->get();
            $academicos = User::where('rol_id', 2)->get();
            $carreras = Carrera::all();
            $industrials = MentorIndustrial::with('empresa')->get();
        } else {
            $direcciones = DireccionCarrera::where('id', $direccionId)->get();
            $empresas = Empresa::whereHas('direccionesCarrera', function ($q) use ($direccionId) {
                $q->where('direccion_id', $direccionId);
            })->get();
            $academicos = User::where('rol_id', 2)
                ->where('direccion_id', $direccionId)
                ->get();
            $carreras = Carrera::where('direccion_id', $direccionId)->get();
            $industrials = MentorIndustrial::whereHas('empresa.direccionesCarrera', function ($q) use ($direccionId) {
                $q->where('direccion_id', $direccionId);
            })->get();
        }

        $vista = $user->rol_id == 1 || $user->rol_id == 4 ? 'editAdmin' : 'edit';

        return view('estudiantes.' . $vista, compact(
            'estudiante',
            'situation',
            'empresas',
            'academicos',
            'industrials',
            'carreras',
            'cuatrimestres',
            'becas',
            'tipoBeca',
            'direcciones'
        ));
    }

    /**
     * Actualiza los datos de un estudiante.
     */
    public function update(Request $request, $id)
    {
        //  dd($request->all());
        $request->validate([
            'matricula' => ['integer', 'min:8'],
            'name' => ['string', 'min:3', 'max:255'],
            'apellidoP' => ['string', 'min:3', 'max:255'],
            'apellidoM' => ['string', 'min:3', 'max:255'],
            'curp' => ['string', 'min:17'],
            'fecha_na' => ['date'],
            'beca' => ['required', 'integer'],
            'tipoBeca' => ['nullable', 'integer'],
            'cuatrimestre' => ['integer'],
            'nombre_proyecto' => ['string', 'min:3'],
            'inicio_dual' => ['date'],
            //  'fin_dual' => ['date'],
            'fin' => ['date'],
            'inicio' => ['date'],
            'ine' => ['file', 'mimes:pdf'],
            //'evaluacion_form' => ['file', 'mimes:pdf'],
            // 'minutas' => ['file', 'mimes:pdf'],
            //'carta_acp' => ['file', 'mimes:pdf'],
            //'plan_form' => ['file', 'mimes:pdf'],
            'formato54' => ['nullable', 'array'],
            'formato54.*' => ['file'],
            'deleted_files' => ['nullable', 'string'],
            'historial_academico' => ['file', 'mimes:pdf'],
            'perfil_ingles' => ['file', 'mimes:pdf'],
            'empresa_id' => ['integer', 'exists:' . Empresa::class . ',id'],
            'academico_id' => ['integer', 'exists:' . User::class . ',id'],
            'asesorin_id' => ['integer', 'exists:' . MentorIndustrial::class . ',id'],
            'carrera_id' => ['integer', 'exists:' . Carrera::class . ',id'],
            'direccion_id' => ['integer', 'exists:' . DireccionCarrera::class . ',id'],
        ]);

        /*    dd([
            'beca' => $request->beca,
            'tipoBeca' => $request->tipoBeca
        ]); */

        $inicioDual = Carbon::parse($request->inicio_dual);
        $finDual = Carbon::parse($request->fin_dual);

        $id = Hashids::decode($id);
        $estudiantes = Estudiantes::find($id[0]);
        $estudiantes->beca = $request->beca;
        $estudiantes->tipoBeca = $request->tipoBeca;

        // Manejo de archivos únicos
        if ($request->file('ine')) {
            $ine = $request->file('ine')->storeAs('public', 'ine/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('ine')->getClientOriginalName());
        }
        if ($request->file('evaluacion_form')) {
            $evaluacion_form = $request->file('evaluacion_form')->storeAs('public', 'evaluacion_form/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('evaluacion_form')->getClientOriginalName());
        }
        if ($request->file('minutas')) {
            $minutas = $request->file('minutas')->storeAs('public', 'minutas/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('minutas')->getClientOriginalName());
        }
        if ($request->file('carta_acp')) {
            $carta_acp = $request->file('carta_acp')->storeAs('public', 'carta_acp/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('carta_acp')->getClientOriginalName());
        }
        if ($request->file('plan_form')) {
            $plan_form = $request->file('plan_form')->storeAs('public', 'plan_form/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('plan_form')->getClientOriginalName());
        }
        if ($request->file('historial_academico')) {
            $historial_academico = $request->file('historial_academico')->storeAs('public', 'historial_academico/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('historial_academico')->getClientOriginalName());
        }
        if ($request->file('perfil_ingles')) {
            $perfil_ingles = $request->file('perfil_ingles')->storeAs('public', 'perfil_ingles/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('perfil_ingles')->getClientOriginalName());
        }
        if ($request->file('formatoA')) {
            $formatoA = $request->file('formatoA')->storeAs('public', 'formatoA/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formatoA')->getClientOriginalName());
        }
        if ($request->file('formatoB')) {
            $formatoB = $request->file('formatoB')->storeAs('public', 'formatoB/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formatoB')->getClientOriginalName());
        }
        if ($request->file('formatoC')) {
            $formatoC = $request->file('formatoC')->storeAs('public', 'formatoC/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formatoC')->getClientOriginalName());
        }
        if ($request->file('formato51')) {
            $formato51 = $request->file('formato51')->storeAs('public', 'formato51/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formato51')->getClientOriginalName());
        }
        if ($request->file('formato55')) {
            $formato55 = $request->file('formato55')->storeAs('public', 'formato55/' . $request->matricula . '_' . date('Y-m-d') . '_' . $request->file('formato55')->getClientOriginalName());
        }

        // 🔁 NUEVO BLOQUE: Manejo de múltiples archivos en formato54
        $currentFiles = !empty($estudiantes->formato54) ? json_decode($estudiantes->formato54, true) : [];

        if ($request->deleted_files) {
            $deletedIndexes = explode(',', $request->deleted_files);
            foreach ($deletedIndexes as $index) {
                if (isset($currentFiles[$index])) {
                    Storage::delete($currentFiles[$index]);
                    unset($currentFiles[$index]);
                }
            }
            $currentFiles = array_values($currentFiles); // reindexar
        }

        $newFiles = [];
        if ($request->hasFile('formato54')) {
            foreach ($request->file('formato54') as $file) {
                $path = 'formato54/' . $request->matricula . '_' . date('Y-m-d') . '_' . $file->getClientOriginalName();
                $storedPath = $file->storeAs('public', $path);
                $newFiles[] = $storedPath;
            }
        }

        $allFiles = array_merge($currentFiles, $newFiles);
        $formato54Json = !empty($allFiles) ? json_encode($allFiles) : null;


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
            'formato54' => $formato54Json,
            'formato55' => $formato55 ?? $estudiantes->formato55,
            'activo' => true,
            'beca' => $request->beca,

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

        if (User::find($estudiantes->user_id) === null) {
            User::create([
                'titulo' => 'Estudiante',
                'name' => $request->name,
                'apellidoP' => $request->apellidoP,
                'apellidoM' => $request->apellidoM,
                'email' => 'al' . $request->matricula . '@utvtol.edu.mx',
                'password' => Hash::make('12345678'),
                'rol_id' => 3,
                'carrera_id' => $request->carrera_id,
                'direccion_id' => $request->direccion_id,
            ]);
        }


        return redirect()->route('estudiantes.index')->with('status', 'Estudiante actualizado');
    }

    /**
     * Actualiza los documentos duales de un estudiante.
     */
    public function updateDocDual(Request $request, $id)
    {


        $id = Hashids::decode($id);
        $estudiantes = Estudiantes::find($id)->first();



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

        return view('dashboardEstudiante', [
            'estudiante' => $estudiantes,
            'success' => 'Estudiante actualizado correctamente.' // Mensaje de éxito
        ]);
    }

    /**
     * Actualiza el formulario de un estudiante.
     */
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

    /**
     * Elimina un estudiante.
     */
    public function destroy($id, Request $request)
    {

        $estudiante = Estudiantes::find($id);
        $estudiante->update([
            'status' => $request->status,
        ]);
        $estudiante->delete();

        return redirect()->route('estudiantes.index')->with('status', 'Estudiante eliminado');
    }


    /**
     * Muestra los datos de un estudiante en formato JSON.
     */
    public function showJson($id): JsonResponse
    {
        $estudiante = Estudiantes::withTrashed()->where('matricula', $id)->get();

        return response()->json($estudiante);
    }

    /**
     * Restaura un estudiante eliminado.
     */
    public function restoreEstudiante($id)
    {
        $elemento = Estudiantes::withTrashed()->where('matricula', $id)->first();
        $elemento->restore();
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante Restaurado.');
    }

    /**
     * Elimina permanentemente un estudiante.
     */
    public function forceDelete($id): RedirectResponse
    {
        $estudiante = Estudiantes::onlyTrashed()->where('matricula', $id)->first();
        //        dd($estudiante);
        $estudiante->forceDelete();
        //
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante Eliminado Correctamente.');
    }

    public function exportPdf($matricula)
    {
        $estudiante = Estudiantes::findOrFail($matricula);
        $data = [
            'no' => $estudiante->matricula,
            'nombre' => $estudiante->name . ' ' . $estudiante->apellidoP . ' ' . $estudiante->apellidoM,
            'programa_educativo' => $estudiante->carrera->nombre,
            'le_queda_claro' => 'SI', // Suponiendo que siempre es "SI"
            'le_interesa' => 'SI', // Suponiendo que siempre es "SI"
            'no_interesado' => '', // Suponiendo que no hay razón para no estar interesado
        ];

        $pdf = Pdf::loadView('estudiantes.pdf', $data);
        return $pdf->download('estudiante_' . $estudiante->matricula . '.pdf');
    }
}
