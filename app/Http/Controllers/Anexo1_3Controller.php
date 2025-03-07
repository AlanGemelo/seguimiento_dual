<?php

namespace App\Http\Controllers;

use App\Models\Anexo1_3;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf; // Asegurar que la clase PDF esté correctamente importada
use PhpOffice\PhpWord\PhpWord;

class Anexo1_3Controller extends Controller
{
    public function index()
    {
        $anexos = Anexo1_3::all();
        return view('anexos.anexo1_3.index', compact('anexos'));
    }

    public function create()
    {
        $users = User::all();
        return view('anexos.anexo1_3.create', compact('users'));
    }

    public function store(Request $request)
    {
        Log::info('Datos recibidos en store:', $request->all());

        $validatedData = $request->validate([
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
            'quien_elaboro_id' => 'required|integer',
        ]);

        // Convert 'on' to true for boolean fields
        $validatedData['participacion_anterior'] = $request->boolean('participacion_anterior');
        $validatedData['interes_participar'] = $request->boolean('interes_participar');
        $validatedData['informacion_clara'] = $request->boolean('informacion_clara');
        $validatedData['quien_elaboro_id'] = auth()->user()->id;

        Log::info('Validaciones pasadas:', $validatedData);

        try {
            Anexo1_3::create($validatedData);
            Log::info('Registro creado exitosamente.');
            return redirect()->route('anexo1_3.index')->with('success', 'Registro creado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al guardar el registro en store:', ['error' => $e->getMessage()]);
            return redirect()->route('anexo1_3.create')->with('error', 'Error al crear el registro.');
        }
    }

    public function edit(Anexo1_3 $anexo1_3)
    {
        $users = User::all();
        return view('anexos.anexo1_3.edit', compact('anexo1_3', 'users'));
    }

    public function update(Request $request, Anexo1_3 $anexo1_3)
    {
        $validatedData = $request->validate([
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

        // Convert 'on' to true for boolean fields
        $validatedData['participacion_anterior'] = $request->boolean('participacion_anterior');
        $validatedData['interes_participar'] = $request->boolean('interes_participar');
        $validatedData['informacion_clara'] = $request->boolean('informacion_clara');

        $anexo1_3->update($validatedData);
        return redirect()->route('anexo1_3.index')->with('success', 'Registro actualizado exitosamente.');
    }

    public function destroy(Anexo1_3 $anexo1_3)
    {
        $anexo1_3->delete();
        return redirect()->route('anexo1_3.index')->with('success', 'Registro eliminado exitosamente.');
    }

    public function generatePdf(Anexo1_3 $anexo1_3)
    {
        $pdf = Pdf::loadView('anexos.anexo1_3.pdf', compact('anexo1_3'));
        return $pdf->download('anexo1_3.pdf');
    }

    public function generateWord(Anexo1_3 $anexo1_3)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText('Anexo 1.3 -  Formato de Registro de Interesados de UE y Estudiantes ED');
        $section->addText('Fecha de Realización: ' . \Carbon\Carbon::parse($anexo1_3->fecha_realizacion)->format('d/m/Y'));
        $section->addText('Lugar: ' . $anexo1_3->lugar);
        $section->addText('Razón Social: ' . $anexo1_3->razon_social);
        $section->addText('RFC: ' . $anexo1_3->rfc);
        $section->addText('Domicilio: ' . $anexo1_3->domicilio);
        $section->addText('Nombre del Representante: ' . $anexo1_3->nombre_representante);
        $section->addText('Cargo del Representante: ' . $anexo1_3->cargo_representante);
        $section->addText('Teléfono: ' . $anexo1_3->telefono);
        $section->addText('Correo Electrónico: ' . $anexo1_3->correo_electronico);
        $section->addText('Actividad Económica: ' . $anexo1_3->actividad_economica);
        $section->addText('Número de Empleados: ' . $anexo1_3->numero_empleados);
        $section->addText('¿Ha participado anteriormente en Educación Dual?: ' . ($anexo1_3->participacion_anterior ? 'Sí' : 'No'));
        if (!$anexo1_3->participacion_anterior) {
            $section->addText('Motivo de no participación: ' . $anexo1_3->motivo_no_participacion);
        }
        $section->addText('¿Tiene interés en participar en Educación Dual?: ' . ($anexo1_3->interes_participar ? 'Sí' : 'No'));
        if ($anexo1_3->interes_participar) {
            $section->addText('Número de estudiantes que podría recibir: ' . $anexo1_3->numero_estudiantes);
        } else {
            $section->addText('Motivo de no interés: ' . $anexo1_3->motivo_no_interes);
        }
        $section->addText('¿La información proporcionada fue clara?: ' . ($anexo1_3->informacion_clara ? 'Sí' : 'No'));
        if ($anexo1_3->comentarios_adicionales) {
            $section->addText('Comentarios adicionales: ' . $anexo1_3->comentarios_adicionales);
        }
        $section->addText('Elaboró: ' . optional($anexo1_3->quienElaboro)->name);

        $fileName = 'anexo1_3.docx';
        $phpWord->save($fileName, 'Word2007', true);
        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
