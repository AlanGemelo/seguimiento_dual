<!DOCTYPE html>
<html>
<head>
    <title>Anexo 2.1 - Evaluación para Seleccionar a la Unidad Económica</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { font-size: 18px; text-align: center; }
        h2 { font-size: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        .section { margin-bottom: 20px; }
        .signature { margin-top: 40px; text-align: right; }
    </style>
</head>
<body>
    <h1>Evaluación para Seleccionar a la Unidad Económica</h1>
    <h2>Anexo 2.1</h2>

    <div class="section">
        <h3>Información General</h3>
        <p><strong>Unidad Económica:</strong> {{ $unidad_economica }}</p>
        <p><strong>Periodo:</strong> {{ $periodo }}</p>
        <p><strong>Fecha:</strong> {{ $fecha }}</p>
    </div>

    <div class="section">
        <h3>Sección 1 - Situación Legal</h3>
        <table>
            <tr>
                <th>Pregunta</th>
                <th>Respuesta</th>
            </tr>
            @foreach($seccion_1 as $key => $value)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $value }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <h3>Sección 2 - Situación Educativa/Formativa</h3>
        <table>
            <tr>
                <th>Pregunta</th>
                <th>Respuesta</th>
            </tr>
            @foreach($seccion_2 as $key => $value)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $value }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <h3>Sección 3 - Factores Socioeconómicos</h3>
        <table>
            <tr>
                <th>Pregunta</th>
                <th>Respuesta</th>
            </tr>
            @foreach($seccion_3 as $key => $value)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $value }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="signature">
        <p>Firma del Responsable:</p>
        <p>___________________________</p>
        <p>Nombre: [Nombre del Responsable]</p>
    </div>
</body>
</html>
