<?php

namespace App\Http\Controllers;

use App\Models\Anexo1_3;
use App\Models\Anexo2_1;
use App\Models\User;
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
        $anexos = Anexo2_1::with('autorizoUser')->get();
        return view('anexos.anexo2_1.index', compact('anexos'));
    }

    public function create()
    {
        $directores = User::where('rol_id', 4)->where('direccion_id', session('direccion')->id)->get();
        return view('anexos.anexo2_1.create', compact('directores'));
    }

    public function edit(Anexo2_1 $anexo2_1)
    {
        $directores = User::where('rol_id', 4)->where('direccion_id', session('direccion')->id)->get();
        return view('anexos.anexo2_1.edit', compact('anexo2_1', 'directores'));
    }

    private function calcularResultado($data)
    {
        $suma1 = array_sum($data['seccion_1']);
        $suma2 = array_sum($data['seccion_2']);
        $suma3 = array_sum($data['seccion_3']);

        $porcentaje1 = ($suma1 / 8) * 100;
        $porcentaje2 = ($suma2 / 18) * 100;
        $porcentaje3 = ($suma3 / 9) * 100;

        $promedio = ($porcentaje1 + $porcentaje2 + $porcentaje3) / 3;

        return $promedio;
    }

    private function interpretarResultado($promedio)
    {
        if ($promedio <= 45) {
            return 'Alta Vulnerabilidad; Unidad Económica no viable para incorporarse a ED.';
        } elseif ($promedio <= 66) {
            return 'Mediana Vulnerabilidad; Unidad Económica con opción a incorporarse a ED.';
        } else {
            return 'Baja Vulnerabilidad; Unidad Económica apta para incorporar a ED.';
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'unidad_economica' => 'required|string',
            'periodo' => 'required|string',
            'fecha' => 'required|date',
            'seccion_1' => 'required|array',
            'seccion_2' => 'required|array',
            'seccion_3' => 'required|array',
            'aplicador' => 'required|string',
            'autorizo' => 'required|integer|exists:users,id',
        ]);

        // Calcular el nivel de vulnerabilidad
        $puntos_seccion_1 = array_sum(array_map('intval', $validatedData['seccion_1']));
        $puntos_seccion_2 = array_sum($validatedData['seccion_2']);
        $puntos_seccion_3 = array_sum($validatedData['seccion_3']);

        $max_seccion_1 = 4; // Máximo de puntos en Sección 1
        $max_seccion_2 = 18; // Máximo de puntos en Sección 2
        $max_seccion_3 = 9; // Máximo de puntos en Sección 3

        $porcentaje_seccion_1 = ($puntos_seccion_1 / $max_seccion_1) * 100;
        $porcentaje_seccion_2 = ($puntos_seccion_2 / $max_seccion_2) * 100;
        $porcentaje_seccion_3 = ($puntos_seccion_3 / $max_seccion_3) * 100;

        $nivel_vulnerabilidad = ($porcentaje_seccion_1 + $porcentaje_seccion_2 + $porcentaje_seccion_3) / 3;

        // Determinar el resultado definitivo
        if ($nivel_vulnerabilidad <= 48) {
            $resultado_definitivo = 'Alta Vulnerabilidad';
        } elseif ($nivel_vulnerabilidad <= 68) {
            $resultado_definitivo = 'Mediana Vulnerabilidad';
        } else {
            $resultado_definitivo = 'Baja Vulnerabilidad';
        }

        // Agregar los campos calculados a los datos validados
        $validatedData['nivel_vulnerabilidad'] = $nivel_vulnerabilidad;
        $validatedData['resultado_definitivo'] = $resultado_definitivo;

        Anexo2_1::create($validatedData);

        return redirect()->route('anexo2_1.index')->with('success', 'Evaluación guardada con éxito. Resultado: ' . $resultado_definitivo);
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
            'aplicador' => 'required|string',
            'autorizo' => 'required|integer|exists:users,id',
        ]);

        $data = $request->all();
        $promedio = $this->calcularResultado($data);
        $interpretacion = $this->interpretarResultado($promedio);

        $data['nivel_vulnerabilidad'] = $promedio;
        $data['resultado_definitivo'] = $interpretacion;

        $anexo2_1->update($data);
        return redirect()->route('anexo2_1.index')->with('success', 'Registro actualizado exitosamente. Resultado: ' . $interpretacion);
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
            'seccion_3' => $anexo2_1->seccion_3,
            'aplicador' => $anexo2_1->aplicador,
            'autorizo' => $anexo2_1->autorizoUser->name,
            'nivel_vulnerabilidad' => $anexo2_1->nivel_vulnerabilidad,
            'resultado_definitivo' => $anexo2_1->resultado_definitivo,
        ];

        $pdf = Pdf::loadView('anexos.anexo2_1.pdf', $data);
        return $pdf->stream('anexo2_1.pdf');
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
        $section->addText("Nombre: " . $anexo2_1->autorizoUser->name);

        // Guardar el archivo Word
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save(storage_path('anexo_2_1.docx'));

        return response()->download(storage_path('anexo_2_1.docx'));
    }
}
