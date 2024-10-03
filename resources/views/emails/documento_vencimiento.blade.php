<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Vencimiento de Documentos</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #0073e6;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .content {
            margin-top: 20px;
            font-size: 16px;
            color: #333333;
            line-height: 1.5;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #0073e6;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #999999;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Notificación de Vencimiento de Documentos</h1>
        </div>
        <div class="content">
            <p>Estimado(a) {{ $academico }},</p>
            <p>Queremos informarle que los documentos de su alumno: {{ $nombreAlumno  }} están próximos a vencer. La fecha de vencimiento es: <strong>{{ $fechaVencimiento }}</strong>.</p>
            <p>Por favor, asegúrese de verificar la renovación de los convenios antes de la fecha indicada para evitar cualquier inconveniente.</p>
            <p>Puede acceder a su cuenta y actualizar los documentos haciendo clic en el siguiente enlace:</p>
            <a href="{{ $enlaceSistema }}" class="button">Acceder al Sistema</a>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Universidad Tecnologica del Valle de Toluca. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
