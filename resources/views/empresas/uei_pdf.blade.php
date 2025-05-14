<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANEXO 1.3A CONCENTRADO DE UNIDADES ECONÓMICAS INTERESADAS EN EDUCACIÓN DUAL</title>
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

    <h1>ANEXO 1.3A CONCENTRADO DE UNIDADES ECONÓMICAS INTERESADAS EN EDUCACIÓN DUAL</h1>

    <table>
        <thead>
            <tr>
                <th>NO.</th>
                <th>FECHA DE REGISTRO</th>
                <th>RAZÓN SOCIAL DE LA UE</th>
                <th>NOMBRE DEL REPRESENTANTE</th>
                <th>CARGO DEL REPRESENTANTE</th>
                <th>TELÉFONO</th>
                <th>CORREO ELEC.</th>
                <th>DOMICILIO</th>
                <th>PRINCIPAL ACT. ECONÓMICA</th>
                <th>TAMAÑO DE LA UE</th>
                <th>FOLIO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empresas as $index => $empresa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $empresa->fecha_registro }}</td>
                    <td>{{ $empresa->razon_social }}</td>
                    <td>{{ $empresa->nombre_representante }}</td>
                    <td>{{ $empresa->cargo_representante }}</td>
                    <td>{{ $empresa->telefono }}</td>
                    <td>{{ $empresa->email }}</td>
                    <td>{{ $empresa->direccion }}</td>
                    <td>{{ $empresa->actividad_economica }}</td>
                    <td>{{ $empresa->tamano_ue }}</td>
                    <td>{{ $empresa->folio }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
