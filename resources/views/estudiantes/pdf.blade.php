<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANEXO 1.3B RELACIÓN DE ESTUDIANTES INTERESADOS EN EDUCACIÓN DUAL</title>
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
    </style>
</head>
<body>

    <h1>ANEXO 1.3B RELACIÓN DE ESTUDIANTES INTERESADOS EN EDUCACIÓN DUAL</h1>

    <table>
        <thead>
            <tr>
                <th>NO.</th>
                <th>NO. DE CONTROL, MATRÍCULA O CUENTA</th>
                <th>NOMBRE</th>
                <th>PROGRAMA EDUCATIVO</th>
                <th>¿LE QUEDA CLARO QUE ES LA EDUCACIÓN DUAL?</th>
                <th>¿LE INTERESA PARTICIPAR EN EDUCACIÓN DUAL?</th>
                <th>EN CASO DE NO ESTAR INTERESADO, EXPRESE BREVEMENTE PORQUÉ</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $no }}</td>
                <td>{{ $nombre }}</td>
                <td>{{ $programa_educativo }}</td>
                <td>{{ $le_queda_claro }}</td>
                <td>{{ $le_interesa }}</td>
                <td>{{ $no_interesado }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
