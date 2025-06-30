<?php

namespace App\Http\Controllers;

use App\Models\Anexo1_2;
use App\Models\User;
use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;

class Anexo1_2Controller extends Controller
{
    public function index()
    {
        $anexos = Anexo1_2::all();
        return view('anexos.anexo1_2.index', compact('anexos'));
    }

    public function create()
    {
        $directores = Director::all(); // Cargar todos los directores
        $responsableIE = User::find(1); // Usuario con ID 1
        $responsableAcademico = User::find(1); // Usuario con ID 1 como responsable académico
        return view('anexos.anexo1_2.create', compact('directores', 'responsableIE', 'responsableAcademico'));
    }

    public function store(Request $request)
    {
        Log::info('Datos recibidos en store:', $request->all());

        $validatedData = $request->validate([
            'fecha_elaboracion' => 'required|date',
            'quien_elaboro_id' => 'required|exists:directors,id', // Validar relación con la tabla directors
            'nombre_firma_ie' => 'required|string', // Usuario con ID 1
            'actividades' => 'required|array',
            'actividades.*.actividad' => 'required|string',
            'actividades.*.responsable' => 'required|string',
            'actividades.*.unidad_medida' => 'required|string',
            'actividades.*.meta' => 'required|string',
            'actividades.*.periodo' => 'required|array',
            'actividades.*.presupuesto' => 'required|numeric|min:0',
        ]);

        Log::info('Validaciones pasadas:', $validatedData);

        try {
            $validatedData['actividades'] = json_encode($validatedData['actividades']); // Convertir actividades a JSON
            Anexo1_2::create($validatedData);
            Log::info('Registro creado exitosamente.');
            return redirect()->route('anexo1_2.index')->with('success', 'Registro creado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al guardar el registro en store:', ['error' => $e->getMessage()]);
            return redirect()->route('anexo1_2.create')->with('error', 'Error al crear el registro.');
        }
    }

    public function edit(Anexo1_2 $anexo1_2)
    {
        $directores = Director::all();
        $responsableIE = User::find(1);
        $responsableAcademico = User::find(1); // Responsable académico es el usuario con ID 2

        return view('anexos.anexo1_2.edit', compact('anexo1_2', 'directores', 'responsableIE', 'responsableAcademico'));
    }


    public function update(Request $request, Anexo1_2 $anexo1_2)
    {
        Log::info('Datos recibidos en update:', $request->all());

        $validatedData = $request->validate([
            'fecha_elaboracion' => 'required|date',
            'quien_elaboro_id' => 'required|exists:users,id',
            'nombre_firma_ie' => 'required|string', // Cambiado de nombre_firma_ie a nombre_firma_ie
            'actividades' => 'required|array',
        ]);

        Log::info('Validaciones pasadas en update:', $validatedData);

        try {
            $validatedData['actividades'] = json_encode($validatedData['actividades']); // Convertir competencias a JSON
            $anexo1_2->update($validatedData);
            return redirect()->route('anexo1_2.index')->with('success', 'Registro actualizado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar el registro en update:', ['error' => $e->getMessage()]);
            return redirect()->route('anexo1_2.edit', $anexo1_2->id)->with('error', 'Error al actualizar el registro.');
        }
    }

    public function destroy(Anexo1_2 $anexo1_2)
    {
        try {
            $anexo1_2->delete();
            return redirect()->route('anexo1_2.index')->with('success', 'Registro eliminado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar el registro en destroy:', ['error' => $e->getMessage()]);
            return redirect()->route('anexo1_2.index')->with('error', 'Error al eliminar el registro.');
        }
    }

    public function generatePdf(Anexo1_2 $anexo1_2)
    {
        $responsableAcademico = User::find(1); // Cargar el usuario con ID 1
        $responsableIE = User::find(1); // Definir correctamente la variable $responsableIE
        $pdf = Pdf::loadView('anexos.anexo1_2.pdf', compact('anexo1_2', 'responsableAcademico', 'responsableIE'));
        return $pdf->download('anexo1_2.pdf');
    }

    public function generateWord(Anexo1_2 $anexo1_2)
    {
        $responsableAcademico = User::find(1); // Cargar el usuario con ID 1
        $responsableIE = User::find(1); // Definir correctamente la variable $responsableIE
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Título del documento
        $section->addText('ANEXO 1.2', ['bold' => true, 'size' => 16], ['alignment' => 'center']);
        $section->addText('PROGRAMA DE DIFUSIÓN DE LA EDUCACIÓN DUAL', ['bold' => true, 'size' => 14], ['alignment' => 'center']);

        // Fecha de elaboración
        $section->addText('Fecha de Elaboración: ' . \Carbon\Carbon::parse($anexo1_2->fecha_elaboracion)->format('d/m/Y'));

        // Tabla de actividades
        $table = $section->addTable(['borderSize' => 6, 'borderColor' => '000000', 'width' => 100 * 50]);
        $table->addRow();
        $table->addCell(2000)->addText('ACTIVIDAD', ['bold' => true]);
        $table->addCell(2000)->addText('RESPONSABLE', ['bold' => true]);
        $table->addCell(2000)->addText('UNIDAD DE MEDIDA', ['bold' => true]);
        $table->addCell(2000)->addText('META', ['bold' => true]);
        $table->addCell(2000)->addText('PERIODO', ['bold' => true]);

        foreach ($anexo1_2->actividades as $actividad) {
            $table->addRow();
            $table->addCell(2000)->addText($actividad['actividad']);
            $table->addCell(2000)->addText($actividad['responsable']);
            $table->addCell(2000)->addText($actividad['unidad_medida']);
            $table->addCell(2000)->addText($actividad['meta']);
            $table->addCell(2000)->addText(implode(', ', $actividad['periodo']));
        }

        // Firmas
        $section->addText('ELABORÓ', ['bold' => true]); // Bold
        $section->addText(optional($anexo1_2->quienElaboro)->name);
        $section->addText('AUTORIZÓ', ['bold' => true]);
        $section->addText($anexo1_2->nombre_firma_ie);

        $fileName = 'anexo1_2.docx';
        $phpWord->save($fileName, 'Word2007', true);
        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
