<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Estudiantes;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
{
    $empresas = Empresa::all();

    return view('empresas.index', compact('empresas'));
}

public function create()
{
    $estudiantes = Estudiantes::all();

    return view('empresas.create', compact('estudiantes'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'descripcion' => ['required', 'string'],
    ]);

    $empresa = new Empresa();
    $empresa->name = $request->input('name');
    $empresa->descripcion = $request->input('descripcion');
    $empresa->save();

    return redirect()->route('empresas.index')->with('status', 'Empresa creada');
}

/**
 * Display the specified resource.
 *
 * @param  \App\Models\Empresa  $empresa
 * @return \Illuminate\Http\Response
 */
public function show(Empresa $empresa)
{
    return view('empresas.show', compact('empresa'));
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Models\Empresa  $empresa
 * @return \Illuminate\Http\Response
 */
public function edit(Empresa $empresa)
{
    $estudiantes = Estudiantes::all();

    return view('empresas.edit', compact('empresa', 'estudiantes'));
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Models\Empresa  $empresa
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, Empresa $empresa)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'descripcion' => ['required', 'string'],
    ]);

    $empresa->name = $request->input('name');
    $empresa->descripcion = $request->input('descripcion');
    $empresa->save();

    return redirect()->route('empresas.index')->with('status', 'Empresa actualizada');
}

/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Models\Empresa  $empresa
 * @return \Illuminate\Http\Response
 */
public function destroy(Empresa $empresa)
{
    $empresa->delete();

    return redirect()->route('empresas.index')->with('status', 'Empresa eliminada');
}
}
