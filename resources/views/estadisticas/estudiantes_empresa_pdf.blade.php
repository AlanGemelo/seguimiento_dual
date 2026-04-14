<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes por Empresa</title>
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
    </style>
</head>
<body>

    <h1>Estudiantes por Empresa</h1>
    <h2>Empresa: {{ $empresa->nombre }}</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Fecha de Registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudiantes as $estudiante)
                <tr>
                    <td>{{ $estudiante->id }}</td>
                    <td>{{ $estudiante->nombre }}</td>
                    <td>{{ $estudiante->email }}</td>
                    <td>{{ $estudiante->telefono }}</td>
                    <td>{{ $estudiante->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
