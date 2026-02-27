<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>ANEXO 1.3 - A CONCENTRADO DE UNIDADES ECONÓMICAS INTERESADAS EN EDUCACIÓN DUAL</title>
    <style>
        /* Configuración de la página (Horizontal) */
        @page {
            size: letter landscape;
            margin: 1cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.2;
            margin: 0;
        }

        /* Encabezado */
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #800020;
            /* Color institucional opcional */
            padding-bottom: 10px;
        }

        h1 {
            font-size: 14pt;
            margin: 0;
            text-transform: uppercase;
            color: #1a1a1a;
        }

        .subtitle {
            font-size: 10pt;
            margin-top: 5px;
            color: #666;
        }

        /* Estilos de la Tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Ayuda a que las columnas respeten el ancho */
            word-wrap: break-word;
        }

        th,
        td {
            border: 0.5pt solid #ccc;
            padding: 6px 4px;
            font-size: 7.5pt;
            /* Fuente pequeña para que quepa todo */
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
            color: #000;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }

        /* Zebra striping para lectura fácil */
        tr:nth-child(even) {
            background-color: #fafafa;
        }

        /* Ajustes específicos de columnas */
        .col-no {
            width: 25px;
            text-align: center;
        }

        .col-fecha {
            width: 60px;
            text-align: center;
        }

        .col-folio {
            width: 50px;
            text-align: center;
        }

        .col-tel {
            width: 70px;
        }

        .col-email {
            width: 90px;
        }

        /* Forzar saltos de línea en celdas largas */
        td {
            vertical-align: top;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Anexo 1.3A</h1>
        <div class="subtitle">Concentrado de Unidades Económicas Interesadas en Educación Dual</div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="col-no">No.</th>
                <th class="col-fecha">Registro</th>
                <th>Razón Social de la UE</th>
                <th>Representante</th>
                <th>Cargo</th>
                <th class="col-tel">Teléfono</th>
                <th class="col-email">Correo Elec.</th>
                <th>Domicilio</th>
                <th>Act. Económica</th>
                <th>Tamaño</th>
                <th class="col-folio">Folio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empresas as $index => $empresa)
                <tr>
                    <td class="col-no">{{ $index + 1 }}</td>
                    <td class="col-fecha">{{ $empresa->fecha_registro }}</td>
                    <td><strong>{{ $empresa->razon_social }}</strong></td>
                    <td>{{ $empresa->nombre_representante }}</td>
                    <td>{{ $empresa->cargo_representante }}</td>
                    <td class="col-tel">{{ $empresa->telefono }}</td>
                    <td class="col-email">{{ $empresa->email }}</td>
                    <td>{{ $empresa->direccion }}</td>
                    <td>{{ $empresa->actividad_economica }}</td>
                    <td>{{ $empresa->tamano_ue }}</td>
                    <td class="col-folio">{{ $empresa->id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
