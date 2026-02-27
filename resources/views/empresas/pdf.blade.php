<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ficha - {{ $unidad_economica }}</title>
    <style>
        @page {
            size: letter;
            margin: 2cm;
        }

        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
            line-height: 1.5;
            margin: 0;
        }

        /* Encabezado Estilizado */
        .header {
            border-bottom: 3px solid #1a3c5e;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 20px;
            color: #1a3c5e;
            margin: 0;
            text-transform: uppercase;
        }

        .header .folio {
            float: right;
            font-size: 14px;
            color: #d32f2f;
            font-weight: bold;
        }

        /* Secciones */
        .section-title {
            background-color: #f8f9fa;
            border-left: 5px solid #1a3c5e;
            padding: 5px 15px;
            font-size: 13px;
            font-weight: bold;
            color: #1a3c5e;
            margin: 20px 0 10px 0;
            text-transform: uppercase;
        }

        /* Tabla de Datos */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            padding: 10px;
            font-size: 11px;
            border-bottom: 1px solid #eee;
        }

        th {
            width: 35%;
            background-color: #ffffff;
            color: #666;
            text-align: left;
            font-weight: bold;
        }

        td {
            width: 65%;
            color: #000;
        }

        /* Área de Firma */
        .footer-sign {
            margin-top: 60px;
            width: 100%;
        }

        .signature-box {
            width: 250px;
            margin-left: auto;
            /* Alineado a la derecha */
            text-align: center;
        }

        .line {
            border-top: 1px solid #000;
            margin-bottom: 5px;
        }

        .signature-text {
            font-size: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="header">
        <span class="folio">FOLIO: {{ $folio }}</span>
        <h1>Empresa - Servicios de consultoría en administración, otros servicios
            relacionados con la contabilidad</h1>
        <small>Educación Dual | Unidad Económica</small>
    </div>

    <div class="section-title">Información General</div>
    <table>
        <tr>
            <th>Razón Social</th>
            <td><strong>{{ $razon_social }}</strong></td>
        </tr>
        <tr>
            <th>Nombre Comercial (UE)</th>
            <td>{{ $unidad_economica }}</td>
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
            <th>Fecha de Registro</th>
            <td>{{ $fecha_registro }}</td>
        </tr>
    </table>

    <div class="section-title">Datos del Representante</div>
    <table>
        <tr>
            <th>Nombre del Representante</th>
            <td>{{ $nombre_representante }}</td>
        </tr>
        <tr>
            <th>Cargo del Representante</th>
            <td>{{ $cargo_representante }}</td>
        </tr>
    </table>

    <div class="section-title">Ubicación y Contacto</div>
    <table>
        <tr>
            <th>Domicilio Completo</th>
            <td>{{ $domicilio }}</td>
        </tr>
        <tr>
            <th>Teléfono</th>
            <td>{{ $telefono }}</td>
        </tr>
        <tr>
            <th>Correo Electrónico</th>
            <td>{{ $correo_electronico }}</td>
        </tr>
    </table>

    <div class="footer-sign">
        <div class="signature-box">
            <div class="line"></div>
            <p class="signature-text">
                {{ $nombre_representante }}<br>
                Firma del Responsable
            </p>
        </div>
    </div>

</body>

</html>
