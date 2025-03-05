<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anexo 1.1 - Competencias del Programa Educativo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .title {
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #000000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000000;
        }
        th, td {
            padding: 8px;
            text-align: left;
            font-size: 12pt;
            color: #000000;
        }
        th {
            background-color: #D9D9D9;
            font-weight: bold;
            text-align: center;
        }
        .signature {
            margin-top: 30px;
            text-align: left;
        }
        .signature p {
            margin: 5px 0;
            font-size: 12pt;
            color: #000000;
        }
        .references {
            margin-top: 30px;
        }
        .references h3 {
            font-size: 12pt;
            font-weight: bold;
            color: #000000;
        }
    </style>
</head>
<body>


    <div class="title">ANEXO 1.1: CATÁLOGO DE COMPETENCIAS PROFESIONALES POR PROGRAMA EDUCATIVO</div>

    <table>
        <tr>
            <th>Institución Educativa (1):</th>
            <td>{{ $anexo1_1->institucion_educativa }}</td>
        </tr>
        <tr>
            <th>Programa Educativo (2):</th>
            <td>{{ $anexo1_1->carrera->nombre }}</td>
        </tr>
        <tr>
            <th>Fecha de Elaboración:</th>
            <td>{{ \Carbon\Carbon::parse($anexo1_1->fecha_elaboracion)->format('d/m/Y') }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>NO.</th>
                <th>COMPETENCIAS A DESARROLLAR</th>
                <th>ACTIVIDADES DE APRENDIZAJE</th>
                <th>ASIGNATURAS</th>
                <th>CUATRIMESTRE/SEMESTRE</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anexo1_1->competencias as $index => $competencia)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $competencia['competencia'] }}</td>
                    <td>{{ $competencia['actividad'] }}</td>
                    <td>{{ $competencia['asignatura'] }}</td>
                    <td style="text-align: center;">{{ $competencia['cuatrimestre'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature">
        <p><strong>ELABORA</strong></p>
        <p>_______________________________</p>
        <p>{{ $anexo1_1->responsablePrograma->name }}</p>
        <p>Responsable del Programa Educativo</p>
    </div>

    <div class="signature">
        <p><strong>AUTORIZA</strong></p>
        <p>_______________________________</p>
        <p>{{ $anexo1_1->responsableAcademico->nombre }}</p>
        <p>Responsable Académico en la IE</p>
    </div>

    <div class="references">
        <h3>INSTRUCTIVO PARA EL LLENADO</h3>
        <table>
            <thead>
                <tr>
                    <th>REFERENCIA</th>
                    <th>DESCRIPCIÓN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td>Registrar el nombre de la Institución Educativa donde se imparte el programa de estudios.</td>
                </tr>
                <tr>
                    <td style="text-align: center;">2</td>
                    <td>Registrar el nombre del Programa Educativo o carrera que se está analizando.</td>
                </tr>
                <tr>
                    <td style="text-align: center;">3</td>
                    <td>Describir las competencias específicas que se enuncian en el programa de estudio de las asignaturas propuestas para ED.</td>
                </tr>
                <tr>
                    <td style="text-align: center;">4</td>
                    <td>Describir de manera clara y precisa las actividades de aprendizaje que deben realizarse para el logro de las competencias específicas.</td>
                </tr>
                <tr>
                    <td style="text-align: center;">5</td>
                    <td>Colocar nombre y clave de las asignaturas.</td>
                </tr>
                <tr>
                    <td style="text-align: center;">6</td>
                    <td>Indicar el periodo del plan del estudio en el que se desarrollan las competencias referidas.</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
