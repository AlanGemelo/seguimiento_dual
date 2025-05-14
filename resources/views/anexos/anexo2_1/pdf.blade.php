<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anexo 2.1 - Evaluación y Selección de la UE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #000;
        }
        h1 {
            font-size: 18px;
            text-align: center;
            margin-bottom: 10px;
        }
        h2 {
            font-size: 16px;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .total-row {
            background-color: #e6e6e6;
            font-weight: bold;
        }
        .signature-section {
            margin-top: 30px;
            text-align: right;
        }
        .signature-section p {
            margin: 5px 0;
        }
        .instructions {
            margin-top: 30px;
            font-size: 12px;
        }
        .instructions h3 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .instructions ul {
            list-style-type: none;
            padding: 0;
        }
        .instructions ul li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

    <h1>Anexo 2 Evaluación y selección de la UE</h1>
    <h2>2.1 Evaluación y selección de la UE</h2>

    <p><strong>ANEXO 2.1</strong></p>
    <p><strong>EVALUACIÓN PARA SELECCIONAR A LA UNIDAD ECONÓMICA</strong></p>

    <p>Unidad Económica: {{ $unidad_economica }}</p>
    <p>Periodo: {{ $periodo }}</p>
    <p>Fecha: {{ $fecha }}</p>

    <div class="section-title">SECCIÓN 1</div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>SITUACIÓN LEGAL</th>
                <th>1</th>
                <th>2</th>
                <th>(4)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>¿La UE está legalmente constituida, acreditada con el ordenamiento de creación o registro ante al Servicio de Administración Tributaria?</td>
                <td>{{ $seccion_1['legalmente_constituida'] == 'Sí' ? 'X' : '' }}</td>
                <td>{{ $seccion_1['legalmente_constituida'] == 'No' ? 'X' : '' }}</td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td>¿La UE está dispuesta a firmar el Convenio Específico de Cooperación, con la Institución Educativa?</td>
                <td>{{ $seccion_1['convenio_cooperacion'] == 'Sí' ? 'X' : '' }}</td>
                <td>{{ $seccion_1['convenio_cooperacion'] == 'No' ? 'X' : '' }}</td>
                <td></td>
            </tr>
            <tr>
                <td>3</td>
                <td>¿La UE está dispuesta a firmar el Convenio de Aprendizaje, entre la IE, la UE y el Estudiante Dual?</td>
                <td>{{ $seccion_1['convenio_aprendizaje'] == 'Sí' ? 'X' : '' }}</td>
                <td>{{ $seccion_1['convenio_aprendizaje'] == 'No' ? 'X' : '' }}</td>
                <td></td>
            </tr>
            <tr>
                <td>4</td>
                <td>¿La UE está dispuesta a firmar el Convenio Marco de Colaboración con la IE?</td>
                <td>{{ $seccion_1['convenio_marco'] == 'Sí' ? 'X' : '' }}</td>
                <td>{{ $seccion_1['convenio_marco'] == 'No' ? 'X' : '' }}</td>
                <td></td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="2">TOTAL</td>
                <td>(5)</td>
                <td>(6)</td>
                <td>(7)</td>
            </tr>
        </tfoot>
    </table>

    <div class="section-title">SECCIÓN 2</div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>SITUACIÓN EDUCATIVA/FORMATIVA</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>5</td>
                <td>¿La UE cuenta con personal capacitado y actualizado en las áreas de conocimiento afines al perfil de egreso del estudiante dual?</td>
                <td>{{ $seccion_2['personal_capacitado'] == '1' ? 'X' : '' }}</td>
                <td>{{ $seccion_2['personal_capacitado'] == '2' ? 'X' : '' }}</td>
                <td>{{ $seccion_2['personal_capacitado'] == '3' ? 'X' : '' }}</td>
            </tr>
            <tr>
                <td>6</td>
                <td>¿La UE cuenta con áreas especializadas afines al perfil de egreso del estudiante dual?</td>
                <td>{{ $seccion_2['areas_especializadas'] == '1' ? 'X' : '' }}</td>
                <td>{{ $seccion_2['areas_especializadas'] == '2' ? 'X' : '' }}</td>
                <td>{{ $seccion_2['areas_especializadas'] == '3' ? 'X' : '' }}</td>
            </tr>
            <tr>
                <td>7</td>
                <td>¿La UE puede delegar a un Mestre que cuente con el menos título de nivel licenciatura, responsable de conducir el proceso de aprendizaje del estudiante dual?</td>
                <td>{{ $seccion_2['mentor_licenciatura'] == '1' ? 'X' : '' }}</td>
                <td>{{ $seccion_2['mentor_licenciatura'] == '2' ? 'X' : '' }}</td>
                <td>{{ $seccion_2['mentor_licenciatura'] == '3' ? 'X' : '' }}</td>
            </tr>
            <tr>
                <td>8</td>
                <td>¿La UE puede cumplir con un plan de formación acorde a los planes y programas de la IE?</td>
                <td>{{ $seccion_2['plan_formacion'] == '1' ? 'X' : '' }}</td>
                <td>{{ $seccion_2['plan_formacion'] == '2' ? 'X' : '' }}</td>
                <td>{{ $seccion_2['plan_formacion'] == '3' ? 'X' : '' }}</td>
            </tr>
            <tr>
                <td>9</td>
                <td>¿La UE tiene la capacidad de llevar a cabo el plan de formación por un año como mínimo y tres años como máximo?</td>
                <td>{{ $seccion_2['capacidad_plan'] == '1' ? 'X' : '' }}</td>
                <td>{{ $seccion_2['capacidad_plan'] == '2' ? 'X' : '' }}</td>
                <td>{{ $seccion_2['capacidad_plan'] == '3' ? 'X' : '' }}</td>
            </tr>
            <tr>
                <td>10</td>
                <td>¿La UE puede generar Puertos de Aprendizaje?</td>
                <td>{{ $seccion_2['puestos_aprendizaje'] == '1' ? 'X' : '' }}</td>
                <td>{{ $seccion_2['puestos_aprendizaje'] == '2' ? 'X' : '' }}</td>
                <td>{{ $seccion_2['puestos_aprendizaje'] == '3' ? 'X' : '' }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="2">SUMA</td>
                <td>(5)</td>
                <td>(6)</td>
                <td>(7)</td>
            </tr>
        </tfoot>
    </table>

    <div class="section-title">SECCIÓN 3</div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>FACTORES SOCIOECONÓMICOS</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>11</td>
                <td>¿La UE está en posibilidad de brindar apoyos económicos, transporte, alimentación, oro su calor?</td>
                <td>{{ $seccion_3['apoyos_economicos'] == '1' ? 'X' : '' }}</td>
                <td>{{ $seccion_3['apoyos_economicos'] == '2' ? 'X' : '' }}</td>
                <td>{{ $seccion_3['apoyos_economicos'] == '3' ? 'X' : '' }}</td>
            </tr>
            <tr>
                <td>12</td>
                <td>¿La UE está a menos de 20 km de distancia de la IE?</td>
                <td>{{ $seccion_3['menos_20km'] == '1' ? 'X' : '' }}</td>
                <td>{{ $seccion_3['menos_20km'] == '2' ? 'X' : '' }}</td>
                <td>{{ $seccion_3['menos_20km'] == '3' ? 'X' : '' }}</td>
            </tr>
            <tr>
                <td>13</td>
                <td>¿La UE cuida que las actividades de los estudiantes dual no sean peligrosas para su salud, seguridad, moralidad, etc.?</td>
                <td>{{ $seccion_3['actividades_seguras'] == '1' ? 'X' : '' }}</td>
                <td>{{ $seccion_3['actividades_seguras'] == '2' ? 'X' : '' }}</td>
                <td>{{ $seccion_3['actividades_seguras'] == '3' ? 'X' : '' }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="2">SUMA</td>
                <td>(5)</td>
                <td>(6)</td>
                <td>(7)</td>
            </tr>
        </tfoot>
    </table>

    <div class="signature-section">
        <p>APLICADOR: {{ $aplicador }}</p>
        <p>AUTORIZO: {{ $autorizo }}</p>
        <p>NOMBRE Y FIRMA</p>
        <p>RESPONSABLE ACADÉMICO EN LA IE</p>
    </div>

    <div class="instructions">
        <h3>INSTRUCTIVO PARA EL LLENADO</h3>
        <ul>
            <li><strong>1</strong> Registrar el nombre de la Unidad Económica.</li>
            <li><strong>2</strong> Registrar el período escolar en que se está evaluando a la Unidad Económica.</li>
            <li><strong>3</strong> Describir la fecha de aplicación de la Evaluación.</li>
            <li><strong>4</strong> Marcar con una “X” la columna que corresponda, donde los valores de cada columna son:
                <ul>
                    <li>Sección 1: 1 = No, 2 = Sí.</li>
                    <li>Secciones 2 y 3: 1 = No Cumple, 2 = Socialmente, 3 = Cumple.</li>
                </ul>
            </li>
        </ul>
    </div>

</body>
</html>
