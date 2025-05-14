<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa - {{ $unidad_economica }}</title>
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
        .signature-section {
            margin-top: 30px;
            text-align: right;
        }
        .signature-section p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <h1>Empresa - {{ $unidad_economica }}</h1>
    <h2>Datos de la Empresa</h2>

    <table>
        <tr>
            <th>Unidad Económica</th>
            <td>{{ $unidad_economica }}</td>
        </tr>
        <tr>
            <th>Fecha de Registro</th>
            <td>{{ $fecha_registro }}</td>
        </tr>
        <tr>
            <th>Razón Social</th>
            <td>{{ $razon_social }}</td>
        </tr>
        <tr>
            <th>Nombre del Representante</th>
            <td>{{ $nombre_representante }}</td>
        </tr>
        <tr>
            <th>Cargo del Representante</th>
            <td>{{ $cargo_representante }}</td>
        </tr>
        <tr>
            <th>Teléfono</th>
            <td>{{ $telefono }}</td>
        </tr>
        <tr>
            <th>Correo Electrónico</th>
            <td>{{ $correo_electronico }}</td>
        </tr>
        <tr>
            <th>Domicilio</th>
            <td>{{ $domicilio }}</td>
        </tr>
        <tr>
            <th>Actividad Económica</th>
            <td>{{ $actividad_economica }}</td>
        </tr>
        <tr>
            <th>Tamaño de la UE</th>
            <td>{{ $tamano_ue }}</td>
        </tr>
        <tr>
            <th>Folio</th>
            <td>{{ $folio }}</td>
        </tr>
    </table>

    <div class="signature-section">
        <p>Firma del Responsable:</p>
        <p>___________________________</p>
    </div>

</body>
</html>
