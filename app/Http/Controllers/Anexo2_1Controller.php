<?php

namespace App\Http\Controllers;

use App\Models\Anexo1_3;
use Illuminate\Http\Request;

class Anexo1_3Controller extends Controller
{
    public function index()
    {
        $anexos = Anexo1_3::all();
        return view('anexos.anexo1_3.index', compact('anexos'));
    }

    public function create()
    {
        return view('anexos.anexo1_3.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_realizacion' => 'required|date',
            'lugar' => 'required|string',
            'razon_social' => 'required|string',
            'rfc' => 'required|string|size:13',
            'domicilio' => 'required|string',
            'nombre_representante' => 'required|string',
            'cargo_representante' => 'required|string',
            'telefono' => 'required|string|size:10',
            'correo_electronico' => 'required|email',
            'actividad_economica' => 'required|string',
            'numero_empleados' => 'required|integer',
            'participacion_anterior' => 'required|boolean',
            'motivo_no_participacion' => 'nullable|string',
            'interes_participar' => 'required|boolean',
            'numero_estudiantes' => 'nullable|integer',
            'motivo_no_interes' => 'nullable|string',
            'informacion_clara' => 'required|boolean',
            'comentarios_adicionales' => 'nullable|string',
        ]);

        Anexo1_3::create($request->all());
        return redirect()->route('anexo1_3.index')->with('success', 'Registro creado exitosamente.');
    }

    public function edit(Anexo1_3 $anexo1_3)
    {
        return view('anexos.anexo1_3.edit', compact('anexo1_3'));
    }

    public function update(Request $request, Anexo1_3 $anexo1_3)
    {
        $request->validate([
            'fecha_realizacion' => 'required|date',
            'lugar' => 'required|string',
            'razon_social' => 'required|string',
            'rfc' => 'required|string|size:13',
            'domicilio' => 'required|string',
            'nombre_representante' => 'required|string',
            'cargo_representante' => 'required|string',
            'telefono' => 'required|string|size:10',
            'correo_electronico' => 'required|email',
            'actividad_economica' => 'required|string',
            'numero_empleados' => 'required|integer',
            'participacion_anterior' => 'required|boolean',
            'motivo_no_participacion' => 'nullable|string',
            'interes_participar' => 'required|boolean',
            'numero_estudiantes' => 'nullable|integer',
            'motivo_no_interes' => 'nullable|string',
            'informacion_clara' => 'required|boolean',
            'comentarios_adicionales' => 'nullable|string',
        ]);

        $anexo1_3->update($request->all());
        return redirect()->route('anexo1_3.index')->with('success', 'Registro actualizado exitosamente.');
    }

    public function destroy(Anexo1_3 $anexo1_3)
    {
        $anexo1_3->delete();
        return redirect()->route('anexo1_3.index')->with('success', 'Registro eliminado exitosamente.');
    }

    public function generatePdf(Anexo1_3 $anexo1_3)
    {
        // ...generar PDF...
    }

    public function generateWord(Anexo1_3 $anexo1_3)
    {
        // ...generar Word...
    }
}
