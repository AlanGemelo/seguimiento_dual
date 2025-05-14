<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Vencimiento del Convenio</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background-color: #ffffff;
            max-width: 650px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #004080;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            margin-top: 20px;
            font-size: 16px;
            color: #333333;
            line-height: 1.6;
        }
        .highlight {
            color: #004080;
            font-weight: bold;
        }
        .button {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 25px;
            background-color: #28a745;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #666666;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Notificación de Vencimiento del Convenio</h1>
        </div>
        <div class="content">
            <p>Estimado(a) {{ $asesorIn->titulo }}-{{ $asesorIn->name }} de la empresa <span class="highlight">{{ $nombreSujeto }}</span>,</p>
            <p>Nos dirigimos a usted para recordar que el convenio establecido entre la Universidad Tecnologica del Valle de Toluca y la empresa {{ $nombreSujeto }} está próximo a vencer. La fecha de vencimiento del convenio es el <span class="highlight">{{ $fechaVencimiento }}</span>.</p>
            <p>Para evitar cualquier interrupción en nuestra colaboración y asegurar que sigamos trabajando juntos hacia nuestros objetivos comunes, le invitamos a renovar el convenio a la mayor brevedad posible.</p>
        </div>
        <div class="footer">
            <p>Si tiene alguna duda o necesita más información, no dude en ponerse en contacto con nosotros.</p>
            <p>Gracias por su colaboración continua.</p>
            <p>© {{ date('Y') }} Universidad Tecnologica del Valle de Tolucaa. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
