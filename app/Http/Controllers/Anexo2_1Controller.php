<?php

namespace App\Http\Controllers;

use App\Models\Anexo1_3;
use App\Models\Anexo2_1;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

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

class Anexo2_1Controller extends Controller
{
    public function index()
    {
        $anexos = Anexo2_1::all();
        return view('anexos.anexo2_1.index', compact('anexos'));
    }

    public function create()
    {
        return view('anexos.anexo2_1.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'unidad_economica' => 'required|string',
            'periodo' => 'required|string',
            'fecha' => 'required|date',
            'seccion_1' => 'required|array',
            'seccion_2' => 'required|array',
            'seccion_3' => 'required|array',
        ]);

        Anexo2_1::create($request->all());
        return redirect()->route('anexo2_1.index')->with('success', 'Registro creado exitosamente.');
    }

    public function edit(Anexo2_1 $anexo2_1)
    {
        return view('anexos.anexo2_1.edit', compact('anexo2_1'));
    }

    public function update(Request $request, Anexo2_1 $anexo2_1)
    {
        $request->validate([
            'unidad_economica' => 'required|string',
            'periodo' => 'required|string',
            'fecha' => 'required|date',
            'seccion_1' => 'required|array',
            'seccion_2' => 'required|array',
            'seccion_3' => 'required|array',
        ]);

        $anexo2_1->update($request->all());
        return redirect()->route('anexo2_1.index')->with('success', 'Registro actualizado exitosamente.');
    }

    public function destroy(Anexo2_1 $anexo2_1)
    {
        $anexo2_1->delete();
        return redirect()->route('anexo2_1.index')->with('success', 'Registro eliminado exitosamente.');
    }

    public function generatePdf(Anexo2_1 $anexo2_1)
    {
        $data = [
            'unidad_economica' => $anexo2_1->unidad_economica,
            'periodo' => $anexo2_1->periodo,
            'fecha' => $anexo2_1->fecha,
            'seccion_1' => $anexo2_1->seccion_1,
            'seccion_2' => $anexo2_1->seccion_2,
            'seccion_3' => $anexo2_1->seccion_3
        ];

        $pdf = Pdf::loadView('pdf.anexo_2_1', $data);
        return $pdf->stream('anexo_2_1.pdf'); // Mostrar el PDF en el navegador
    }

    public function generateWord(Anexo2_1 $anexo2_1)
    {
        $phpWord = new PhpWord();

        // Agregar sección
        $section = $phpWord->addSection();

        // Título
        $section->addText("Evaluación para Seleccionar a la Unidad Económica", ['bold' => true, 'size' => 16]);
        $section->addText("Anexo 2.1", ['bold' => true, 'size' => 14]);

        // Información General
        $section->addText("Información General", ['bold' => true, 'size' => 12]);
        $section->addText("Unidad Económica: " . $anexo2_1->unidad_economica);
        $section->addText("Periodo: " . $anexo2_1->periodo);
        $section->addText("Fecha: " . $anexo2_1->fecha);

        // Sección 1
        $section->addText("Sección 1 - Situación Legal", ['bold' => true, 'size' => 12]);
        foreach ($anexo2_1->seccion_1 as $key => $value) {
            $section->addText("$key: $value");
        }

        // Sección 2
        $section->addText("Sección 2 - Situación Educativa/Formativa", ['bold' => true, 'size' => 12]);
        foreach ($anexo2_1->seccion_2 as $key => $value) {
            $section->addText("$key: $value");
        }

        // Sección 3
        $section->addText("Sección 3 - Factores Socioeconómicos", ['bold' => true, 'size' => 12]);
        foreach ($anexo2_1->seccion_3 as $key => $value) {
            $section->addText("$key: $value");
        }

        // Firma
        $section->addText("Firma del Responsable:", ['bold' => true, 'size' => 12]);
        $section->addText("___________________________");
        $section->addText("Nombre: [Nombre del Responsable]");

        // Guardar el archivo Word
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save(storage_path('anexo_2_1.docx'));

        return response()->download(storage_path('anexo_2_1.docx'));
    }

    public function exportPDF()
    {
        $data = $this->getDataForExport(); // Método para obtener los datos necesarios
        $pdf = PDF::loadView('anexos.anexo2_1.pdf', $data);
        return $pdf->download('anexo2_1.pdf');
    }

    public function exportWord()
    {
        $data = $this->getDataForExport(); // Método para obtener los datos necesarios
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText('Anexo 2.1 - Evaluación de la UE');
        // Agregar más contenido al documento Word usando $data
        $file = 'anexo2_1.docx';
        $phpWord->save($file, 'Word2007', true);
        return response()->download($file)->deleteFileAfterSend(true);
    }

    private function getDataForExport()
    {
        // Implementar lógica para obtener los datos necesarios para la exportación
        return [];
    }
}
