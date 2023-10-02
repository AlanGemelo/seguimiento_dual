<?php

namespace App\Http\Controllers;

use App\Models\Estudiantes;
use Carbon\Carbon;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{

    public function index()
    {
        $estudiantes = Estudiantes::all();

        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        return view('estudiantes.create');
    }

    public function store(Request $request)
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

    public function show($id)
    {
        $id=Hashids::decode($id);
        $estudiante=Estudiantes::where('matricula', $id)->get();
        $estudiante=$estudiante[0];

        return view('estudiantes.show', compact('estudiante'));
    }

    public function edit(Estudiantes $estudiantes)
    {
        //
    }

    public function update(Request $request, Estudiantes $estudiantes)
    {
        //
    }

    public function destroy(Estudiantes $estudiantes)
    {
        //
    }
}
