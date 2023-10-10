<?php

namespace App\Http\Controllers;

use App\Models\Estudiantes;
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

        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create(): View
    {
        return view('estudiantes.create');
    }

    public function store(Request $request): RedirectResponse
    {
//        dd($request->all());
        $request->validate([
            'matricula' => ['integer', 'unique:'.Estudiantes::class, 'min:8'],
            'name' => ['string', 'min:3', 'max:255'],
            'curp' => ['string', 'min:17'],
            'fecha_na' => ['date'],
            'cuatrimestre'=> ['integer'],
        ]);

        Estudiantes::create([
            'matricula' => $request->matricula,
            'name' => $request->name,
            'curp' => $request->curp,
            'fecha_na' => Carbon::parse($request->fecha_na)->format("Y-m-d"),
            'activo' => true,
            'cuatrimestre'=> $request->cuatrimestre,
        ]);

        return redirect()->route('estudiantes.index')->with('status', 'Estudiante creado');
    }

    public function show($id): View
    {
        $id=Hashids::decode($id);
        $estudiante=Estudiantes::where('matricula', $id)->get();
        $estudiante=$estudiante[0];

        return view('estudiantes.show', compact('estudiante'));
    }

    public function edit($id): View
    {
        $id=Hashids::decode($id);
        $estudiante=Estudiantes::where('matricula', $id)->get();
        $estudiante=$estudiante[0];

        return view('estudiantes.edit', compact('estudiante'));
    }

    public function update(Request $request, Estudiantes $estudiantes)
    {
        $request->validate([
            'matricula' => ['integer', 'required'],
            'name' => ['string', 'min:3', 'max:255'],
            'curp' => ['string', 'min:17'],
            'fecha_na' => ['date'],
            'cuatrimestre'=> ['integer'],
        ]);
    
        $estudiantes->update([
            'name' => $request->name,
            'curp' => $request->curp,
            'fecha_na' => Carbon::parse($request->fecha_na)->format("Y-m-d"),
            'cuatrimestre'=> $request->cuatrimestre,
        ]);
    
        return redirect()->route('estudiantes.index')->with('status', 'Estudiante actualizado');
    }

    public function destroy(Estudiantes $estudiantes)
    {
        $estudiantes->delete();

    return redirect()->route('estudiantes.index')->with('status', 'Estudiante eliminado');
    }

    public function showJson($id): JsonResponse
    {
        $estudiante=Estudiantes::where('matricula', $id)->get();

        return response()->json($estudiante);
    }
}
