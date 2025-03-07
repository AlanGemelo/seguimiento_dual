<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anexo 1.2 - Programa de Difusión de la ED</title>
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
        .signature {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>ANEXO 1.2</h1>
        <h2>PROGRAMA DE DIFUSIÓN DE LA EDUCACIÓN DUAL</h2>
    </div>

    <table>
        <tr>
            <th>Fecha de Elaboración:</th>
            <td>{{ \Carbon\Carbon::parse($anexo1_2->fecha_elaboracion)->format('d/m/Y') }}</td>
        </tr>
    </table>

    <table>
        <tr>
            <th>ACTIVIDAD</th>
            <th>RESPONSABLE</th>
            <th>UNIDAD DE MEDIDA</th>
            <th>META</th>
            <th>PERIODO</th>
        </tr>
        @foreach($anexo1_2->actividades as $actividad)
        <tr>
            <td>{{ is_array($actividad['actividad']) ? implode(', ', $actividad['actividad']) : $actividad['actividad'] }}</td>
            <td>{{ is_array($actividad['responsable']) ? implode(', ', $actividad['responsable']) : $actividad['responsable'] }}</td>
            <td>{{ is_array($actividad['unidad_medida']) ? implode(', ', $actividad['unidad_medida']) : $actividad['unidad_medida'] }}</td>
            <td>{{ is_array($actividad['meta']) ? implode(', ', $actividad['meta']) : $actividad['meta'] }}</td>
            <td>{{ is_array($actividad['periodo']) ? implode(', ', $actividad['periodo']) : $actividad['periodo'] }}</td>
        </tr>
        @endforeach
    </table>

    <div class="signature">
        <p>ELABORÓ</p>
        <p>{{ optional($anexo1_2->quienElaboro)->name }}</p>
    </div>

    <div class="signature">
        <p>AUTORIZÓ</p>
        <p>{{ $anexo1_2->nombre_firma_ie }}</p>
    </div>
</body>
</html>
