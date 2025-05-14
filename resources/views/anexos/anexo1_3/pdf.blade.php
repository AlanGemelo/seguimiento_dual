<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anexo 1.3 - Encuesta a Unidades Económicas</title>
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
            font-size: 16pt;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .subtitle {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
        }
        .signature {
            margin-top: 50px;
            text-align: center;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('img/logo.png') }}" alt="Logo" height="80">
        <h1>UNIVERSIDAD TECNOLÓGICA DEL VALLE DE TOLUCA</h1>
    </div>

    <div class="title">ANEXO 1.3: ENCUESTA A UNIDADES ECONÓMICAS</div>

    <table>
        <tr>
            <th>Fecha de Realización:</th>
            <td>{{ \Carbon\Carbon::parse($anexo1_3->fecha_realizacion)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <th>Lugar:</th>
            <td>{{ $anexo1_3->lugar }}</td>
        </tr>
    </table>

    <div class="subtitle">DATOS DE LA UNIDAD ECONÓMICA</div>
    <table>
        <tr>
            <th>Razón Social:</th>
            <td>{{ $anexo1_3->razon_social }}</td>
        </tr>
        <tr>
            <th>RFC:</th>
            <td>{{ $anexo1_3->rfc }}</td>
        </tr>
        <tr>
            <th>Domicilio:</th>
            <td>{{ $anexo1_3->domicilio }}</td>
        </tr>
        <tr>
            <th>Nombre del Representante:</th>
            <td>{{ $anexo1_3->nombre_representante }}</td>
        </tr>
        <tr>
            <th>Cargo:</th>
            <td>{{ $anexo1_3->cargo_representante }}</td>
        </tr>
        <tr>
            <th>Teléfono:</th>
            <td>{{ $anexo1_3->telefono }}</td>
        </tr>
        <tr>
            <th>Correo Electrónico:</th>
            <td>{{ $anexo1_3->correo_electronico }}</td>
        </tr>
        <tr>
            <th>Actividad Económica:</th>
            <td>{{ $anexo1_3->actividad_economica }}</td>
        </tr>
        <tr>
            <th>Número de Empleados:</th>
            <td>{{ $anexo1_3->numero_empleados }}</td>
        </tr>
    </table>

    <div class="subtitle">PARTICIPACIÓN EN EDUCACIÓN DUAL</div>
    <table>
        <tr>
            <th>¿Ha participado anteriormente en Educación Dual?</th>
            <td>{{ $anexo1_3->participacion_anterior ? 'Sí' : 'No' }}</td>
        </tr>
        @if(!$anexo1_3->participacion_anterior)
        <tr>
            <th>Motivo de no participación:</th>
            <td>{{ $anexo1_3->motivo_no_participacion }}</td>
        </tr>
        @endif
        <tr>
            <th>¿Tiene interés en participar en Educación Dual?</th>
            <td>{{ $anexo1_3->interes_participar ? 'Sí' : 'No' }}</td>
        </tr>
        @if($anexo1_3->interes_participar)
        <tr>
            <th>Número de estudiantes que podría recibir:</th>
            <td>{{ $anexo1_3->numero_estudiantes }}</td>
        </tr>
        @else
        <tr>
            <th>Motivo de no interés:</th>
            <td>{{ $anexo1_3->motivo_no_interes }}</td>
        </tr>
        @endif
        <tr>
            <th>¿La información proporcionada fue clara?</th>
            <td>{{ $anexo1_3->informacion_clara ? 'Sí' : 'No' }}</td>
        </tr>
        @if($anexo1_3->comentarios_adicionales)
        <tr>
            <th>Comentarios adicionales:</th>
            <td>{{ $anexo1_3->comentarios_adicionales }}</td>
        </tr>
        @endif
    </table>

    <div class="signature">
        <p>_______________________________</p>
        <p>{{ $responsableIE->name }}</p>
        <p>Elaboró</p>
    </div>
</body>
</html>
