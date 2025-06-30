<?php

namespace App\Http\Controllers;

use App\Models\Anexo1_3;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf; // Asegurar que la clase PDF esté correctamente importada
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Carbon;

class Anexo1_3Controller extends Controller
{
    public function index()
    {
        $anexos = Anexo1_3::all();
        return view('anexos.anexo1_3.index', compact('anexos'));
    }

    public function create()
    {
        // $responsableIE = User::get(); // Cargar el usuario con ID 1
        $responsableIE = auth()->user();
        return view('anexos.anexo1_3.create', compact('responsableIE'));
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
        //$responsableIE = User::find(1); // Cargar el usuario con ID 1
        $responsableIE = auth()->user();
        return view('anexos.anexo1_3.edit', compact('anexo1_3', 'responsableIE'));
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
        $responsableIE = User::find(1); // Cargar el usuario con ID 1

        $pdf = Pdf::loadView('anexos.anexo1_3.pdf', compact('anexo1_3', 'responsableIE'));
        return $pdf->download('anexo1_3.pdf');
    }

    public function generateWord(Anexo1_3 $anexo1_3)
    {
        $responsableIE = auth()->user();

        $phpWord = new PhpWord();

        $phpWord->addTitleStyle(1, ['name' => 'Arial', 'size' => 14, 'bold' => true], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $phpWord->addTitleStyle(2, ['name' => 'Arial', 'size' => 12, 'bold' => true], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
        $sectionStyle = ['name' => 'Arial', 'size' => 12,];
        $tableStyle = ['borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 108];
        $cellStyleColumn = ['bgColor' => 'f2f2f2', 'bold' => true];
        $paragraphJustify = ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH];
        $phpWord->addTableStyle('TableStyle', $tableStyle);

        $section = $phpWord->addSection();
        $section->addTitle('UNIVERSIDAD TECNOLÓGICA DEL VALLEDE TOLUCA');
        $section->addTextBreak();
        $section->addTitle('ANEXO 1.3: ENCUESTA A UNIDADES ECONÓMICAS', 2);
        $section->addTextBreak();

        $tableDatosGenerales = $section->addTable('TableStyle');
        $tableDatosGenerales->addRow();
        $tableDatosGenerales->addCell(8000, $cellStyleColumn)->addText('Fecha de Realización:', $sectionStyle);
        $tableDatosGenerales->addCell(4000)->addText(Carbon::parse($anexo1_3->fecha_realizacion)->format('d/m/Y'), $sectionStyle);
        $tableDatosGenerales->addRow();
        $tableDatosGenerales->addCell(8000, $cellStyleColumn)->addText('Lugar:', $sectionStyle);
        $tableDatosGenerales->addCell(4000)->addText($anexo1_3->lugar, $sectionStyle);

        $section->addTextBreak();
        $section->addTitle('Datos de la unidad económica', 2);
        $tableUnidadEconomica = $section->addTable('TableStyle');
        $tableUnidadEconomica->addRow();
        $tableUnidadEconomica->addCell(5000, $cellStyleColumn)->addText('Razón Social:', $sectionStyle, $paragraphJustify);
        $tableUnidadEconomica->addCell(7000)->addText($anexo1_3->razon_social, $sectionStyle, $paragraphJustify);

        $tableUnidadEconomica->addRow();
        $tableUnidadEconomica->addCell(5000, $cellStyleColumn)->addText('RFC:', $sectionStyle, $paragraphJustify);
        $tableUnidadEconomica->addCell(7000)->addText($anexo1_3->rfc, $sectionStyle, $paragraphJustify);

        $tableUnidadEconomica->addRow();
        $tableUnidadEconomica->addCell(5000, $cellStyleColumn)->addText('Domicilio:', $sectionStyle, $paragraphJustify);
        $tableUnidadEconomica->addCell(7000)->addText($anexo1_3->domicilio, $sectionStyle, $paragraphJustify);

        $tableUnidadEconomica->addRow();
        $tableUnidadEconomica->addCell(5000, $cellStyleColumn)->addText('Nombre del Representante:', $sectionStyle, $paragraphJustify);
        $tableUnidadEconomica->addCell(7000)->addText($anexo1_3->nombre_representante, $sectionStyle, $paragraphJustify);

        $tableUnidadEconomica->addRow();
        $tableUnidadEconomica->addCell(5000, $cellStyleColumn)->addText('Cargo del Representante:', $sectionStyle, $paragraphJustify);
        $tableUnidadEconomica->addCell(7000)->addText($anexo1_3->cargo_representante, $sectionStyle, $paragraphJustify);

        $tableUnidadEconomica->addRow();
        $tableUnidadEconomica->addCell(5000, $cellStyleColumn)->addText('Teléfono:', $sectionStyle, $paragraphJustify);
        $tableUnidadEconomica->addCell(7000)->addText($anexo1_3->telefono, $sectionStyle, $paragraphJustify);

        $tableUnidadEconomica->addRow();
        $tableUnidadEconomica->addCell(4000, $cellStyleColumn)->addText('Correo Electrónico:', $sectionStyle, $paragraphJustify);
        $tableUnidadEconomica->addCell(8000)->addText($anexo1_3->correo_electronico, $sectionStyle, $paragraphJustify);

        $tableUnidadEconomica->addRow();
        $tableUnidadEconomica->addCell(4000, $cellStyleColumn)->addText('Actividad Económica:', $sectionStyle, $paragraphJustify);
        $tableUnidadEconomica->addCell(8000)->addText($anexo1_3->actividad_economica, $sectionStyle, $paragraphJustify);

        $tableUnidadEconomica->addRow();
        $tableUnidadEconomica->addCell(4000, $cellStyleColumn)->addText('Número de Empleados:', $sectionStyle, $paragraphJustify);
        $tableUnidadEconomica->addCell(8000)->addText($anexo1_3->numero_empleados, $sectionStyle, $paragraphJustify);

        $section->addTextBreak();
        $section->addTitle('Participación en educación dual', 2);
        $tableEducacionDual = $section->addTable('TableStyle');
        $tableEducacionDual->addRow();
        $tableEducacionDual->addCell(11000, $cellStyleColumn)->addText('¿Ha participado anteriormente en Educación Dual?', $sectionStyle, $paragraphJustify);
        $tableEducacionDual->addCell(6000)->addText($anexo1_3->participacion_anterior ? 'Sí' : 'No', $sectionStyle, $paragraphJustify);

        if (!$anexo1_3->participacion_anterior) {
            $tableEducacionDual->addRow();
            $tableEducacionDual->addCell(9000, $cellStyleColumn)->addText('Motivo de no participación:', $sectionStyle, $paragraphJustify);
            $tableEducacionDual->addCell(6000)->addText($anexo1_3->motivo_no_participacion, $sectionStyle, $paragraphJustify);
        }

        $tableEducacionDual->addRow();
        $tableEducacionDual->addCell(9000, $cellStyleColumn)->addText('¿Tiene interés en participar en Educación Dual?', $sectionStyle, $paragraphJustify);
        $tableEducacionDual->addCell(6000)->addText($anexo1_3->interes_participar ? 'Sí' : 'No', $sectionStyle, $paragraphJustify);

        if ($anexo1_3->interes_participar) {
            $tableEducacionDual->addRow();
            $tableEducacionDual->addCell(9000, $cellStyleColumn)->addText('Número de estudiantes que podría recibir:', $sectionStyle, $paragraphJustify);
            $tableEducacionDual->addCell(6000)->addText($anexo1_3->numero_estudiantes, $sectionStyle, $paragraphJustify);
        } else {
            $tableEducacionDual->addRow();
            $tableEducacionDual->addCell(9000, $cellStyleColumn)->addText('Motivo de no interés:', $sectionStyle, $paragraphJustify);
            $tableEducacionDual->addCell(6000)->addText($anexo1_3->motivo_no_interes, $sectionStyle, $paragraphJustify);
        }

        $tableEducacionDual->addRow();
        $tableEducacionDual->addCell(9000, $cellStyleColumn)->addText('¿La información proporcionada fue clara?', $sectionStyle, $paragraphJustify);
        $tableEducacionDual->addCell(6000)->addText($anexo1_3->informacion_clara ? 'Sí' : 'No', $sectionStyle, $paragraphJustify);

        if (!empty($anexo1_3->comentarios_adicionales)) {
            $tableEducacionDual->addRow();
            $tableEducacionDual->addCell(9000, $cellStyleColumn)->addText('Comentarios adicionales:', $sectionStyle, $paragraphJustify);
            $tableEducacionDual->addCell(6000)->addText($anexo1_3->comentarios_adicionales, $sectionStyle, $paragraphJustify);
        }

        $section->addTextBreak();
        $section->addTextBreak();
        $section->addText('___________________________', $sectionStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $section->addText($responsableIE->name .' '.$responsableIE->apellidoP .' '. $responsableIE->apellidoM, $sectionStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $section->addText('Elaboró', $sectionStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);

        $fileName = 'anexo1_3.docx';
        $phpWord->save($fileName, 'Word2007', true);
        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
