<?php

namespace App\Http\Controllers;

use App\Models\Anexo1_1;
use App\Models\Carrera;
use App\Models\User;
use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;

class Anexo1_1Controller extends Controller
{
    public function index()
    {
        $anexos = Anexo1_1::all();
        return view('anexos.anexo1_1.index', compact('anexos'));
    }

    public function create()
    {
        $carreras = Carrera::where('direccion_id', session('direccion')->id)->get();
        $users = User::whereIn('rol_id', [2])->get();
        $directors = Director::where('direccion_id', session('direccion')->id)->get();
        return view('anexos.anexo1_1.create', compact('carreras', 'users', 'directors'));
    }

    public function store(Request $request)
    {
        Log::info('Datos recibidos en store:', $request->all());

        $validatedData = $request->validate([
            'institucion_educativa' => 'required|string',
            'programa_educativo_id' => 'required|exists:carreras,id',
            'fecha_elaboracion' => 'required|date',
            'responsable_programa_id' => 'required|exists:users,id',
            'responsable_academico_id' => 'required|exists:directors,id',
            'competencias' => 'required|array',
            'competencias.*.competencia' => 'required|string',
            'competencias.*.actividad' => 'required|string',
            'competencias.*.asignatura' => 'required|string',
            'competencias.*.cuatrimestre' => 'required|integer|min:1|max:11',
        ]);

        Log::info('Datos validados en store:', $validatedData);

        try {
            Anexo1_1::create($validatedData);
            return redirect()->route('anexo1_1.index')->with('success', 'Registro creado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al guardar el registro en store:', ['error' => $e->getMessage()]);
            return redirect()->route('anexo1_1.create')->with('error', 'Error al crear el registro.');
        }
    }

    public function edit(Anexo1_1 $anexo1_1)
    {
        $carreras = Carrera::where('direccion_id', session('direccion')->id)->get();
        $users = User::whereIn('rol_id', [2, 3, 4])->get();
        $directors = Director::where('direccion_id', session('direccion')->id)->get();
        return view('anexos.anexo1_1.edit', compact('anexo1_1', 'carreras', 'users', 'directors'));
    }

    public function update(Request $request, Anexo1_1 $anexo1_1)
    {
        Log::info('Datos recibidos en update:', $request->all());

        $validatedData = $request->validate([
            'institucion_educativa' => 'required|string',
            'programa_educativo_id' => 'required|exists:carreras,id',
            'fecha_elaboracion' => 'required|date',
            'responsable_programa_id' => 'required|exists:users,id',
            'responsable_academico_id' => 'required|exists:directors,id',
            'competencias' => 'required|array',
            'competencias.*.competencia' => 'required|string',
            'competencias.*.actividad' => 'required|string',
            'competencias.*.asignatura' => 'required|string',
            'competencias.*.cuatrimestre' => 'required|integer|min:1|max:11',
        ]);

        Log::info('Datos validados en update:', $validatedData);

        try {
            $anexo1_1->update($validatedData);
            return redirect()->route('anexo1_1.index')->with('success', 'Registro actualizado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar el registro en update:', ['error' => $e->getMessage()]);
            return redirect()->route('anexo1_1.edit', $anexo1_1->id)->with('error', 'Error al actualizar el registro.');
        }
    }

    public function destroy(Anexo1_1 $anexo1_1)
    {
        try {
            $anexo1_1->delete();
            return redirect()->route('anexo1_1.index')->with('success', 'Registro eliminado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar el registro en destroy:', ['error' => $e->getMessage()]);
            return redirect()->route('anexo1_1.index')->with('error', 'Error al eliminar el registro.');
        }
    }

    public function generatePdf(Anexo1_1 $anexo1_1)
    {
        $pdf = Pdf::loadView('anexos.anexo1_1.pdf', compact('anexo1_1'));
        return $pdf->download('anexo1_1.pdf');
    }

    public function generateWord(Anexo1_1 $anexo1_1)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Título del documento
        $section->addText(
            'ANEXO 1.1: CATÁLOGO DE COMPETENCIAS PROFESIONALES POR PROGRAMA EDUCATIVO',
            ['bold' => true, 'size' => 14, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'center']
        );
        $section->addTextBreak(1);

        // Información de la institución y programa educativo
        $section->addText(
            'Institución Educativa (1): ' . $anexo1_1->institucion_educativa,
            ['size' => 12, 'color' => '000000', 'name' => 'Arial']
        );
        $section->addText(
            'Programa Educativo (2): ' . $anexo1_1->carrera->nombre,
            ['size' => 12, 'color' => '000000', 'name' => 'Arial']
        );
        $section->addText(
            'Fecha de Elaboración: ' . \Carbon\Carbon::parse($anexo1_1->fecha_elaboracion)->format('d/m/Y'),
            ['size' => 12, 'color' => '000000', 'name' => 'Arial']
        );
        $section->addTextBreak(1);

        // Tabla de competencias
        $table = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '000000',
            'width' => 100 * 50,
            'cellMargin' => 50,
        ]);

        // Encabezado de la tabla
        $table->addRow();
        $table->addCell(2000, ['bgColor' => 'D9D9D9'])->addText(
            'NO.',
            ['bold' => true, 'size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'center']
        );
        $table->addCell(5000, ['bgColor' => 'D9D9D9'])->addText(
            'COMPETENCIAS A DESARROLLAR',
            ['bold' => true, 'size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'center']
        );
        $table->addCell(5000, ['bgColor' => 'D9D9D9'])->addText(
            'ACTIVIDADES DE APRENDIZAJE',
            ['bold' => true, 'size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'center']
        );
        $table->addCell(5000, ['bgColor' => 'D9D9D9'])->addText(
            'ASIGNATURAS',
            ['bold' => true, 'size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'center']
        );
        $table->addCell(3000, ['bgColor' => 'D9D9D9'])->addText(
            'CUATRIMESTRE/SEMESTRE',
            ['bold' => true, 'size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'center']
        );

        // Filas de competencias
        foreach ($anexo1_1->competencias as $index => $competencia) {
            $table->addRow();
            $table->addCell(2000)->addText(
                $index + 1,
                ['size' => 12, 'color' => '000000', 'name' => 'Arial'],
                ['alignment' => 'center']
            );
            $table->addCell(5000)->addText(
                $competencia['competencia'],
                ['size' => 12, 'color' => '000000', 'name' => 'Arial']
            );
            $table->addCell(5000)->addText(
                $competencia['actividad'],
                ['size' => 12, 'color' => '000000', 'name' => 'Arial']
            );
            $table->addCell(5000)->addText(
                $competencia['asignatura'],
                ['size' => 12, 'color' => '000000', 'name' => 'Arial']
            );
            $table->addCell(3000)->addText(
                $competencia['cuatrimestre'],
                ['size' => 12, 'color' => '000000', 'name' => 'Arial'],
                ['alignment' => 'center']
            );
        }

        // Firmas
        $section->addTextBreak(2);
        $section->addText(
            'ELABORA',
            ['bold' => true, 'size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'left']
        );
        $section->addText(
            '_______________________________',
            ['size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'left']
        );
        $section->addText(
            $anexo1_1->responsablePrograma->name,
            ['size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'left']
        );
        $section->addText(
            'Responsable del Programa Educativo',
            ['size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'left']
        );
        $section->addTextBreak(1);
        $section->addText(
            'AUTORIZA',
            ['bold' => true, 'size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'left']
        );
        $section->addText(
            '_______________________________',
            ['size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'left']
        );
        $section->addText(
            $anexo1_1->responsableAcademico->nombre,
            ['size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'left']
        );
        $section->addText(
            'Responsable Académico en la IE',
            ['size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'left']
        );

        // Referencias
        $section->addTextBreak(2);
        $section->addText(
            'INSTRUCTIVO PARA EL LLENADO',
            ['bold' => true, 'size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'left']
        );
        $section->addTextBreak(1);

        $refTable = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '000000',
            'width' => 100 * 50,
            'cellMargin' => 50,
        ]);
        $refTable->addRow();
        $refTable->addCell(2000, ['bgColor' => 'D9D9D9'])->addText(
            'REFERENCIA',
            ['bold' => true, 'size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'center']
        );
        $refTable->addCell(8000, ['bgColor' => 'D9D9D9'])->addText(
            'DESCRIPCIÓN',
            ['bold' => true, 'size' => 12, 'color' => '000000', 'name' => 'Arial'],
            ['alignment' => 'center']
        );

        $references = [
            '1' => 'Registrar el nombre de la Institución Educativa donde se imparte el programa de estudios.',
            '2' => 'Registrar el nombre del Programa Educativo o carrera que se está analizando.',
            '3' => 'Describir las competencias específicas que se enuncian en el programa de estudio de las asignaturas propuestas para ED.',
            '4' => 'Describir de manera clara y precisa las actividades de aprendizaje que deben realizarse para el logro de las competencias específicas.',
            '5' => 'Colocar nombre y clave de las asignaturas.',
            '6' => 'Indicar el periodo del plan del estudio en el que se desarrollan las competencias referidas.',
        ];

        foreach ($references as $ref => $desc) {
            $refTable->addRow();
            $refTable->addCell(2000)->addText(
                $ref,
                ['size' => 12, 'color' => '000000', 'name' => 'Arial'],
                ['alignment' => 'center']
            );
            $refTable->addCell(8000)->addText(
                $desc,
                ['size' => 12, 'color' => '000000', 'name' => 'Arial']
            );
        }

        // Guardar el documento
        $fileName = 'anexo1_1.docx';
        $phpWord->save($fileName, 'Word2007', true);
        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
