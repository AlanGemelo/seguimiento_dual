<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerta de Vencimiento de Convenio Local</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #0056b3;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
        }
        .content {
            margin-top: 20px;
            font-size: 16px;
            color: #333;
            line-height: 1.6;
        }
        .highlight {
            color: #0056b3;
            font-weight: bold;
        }
        .button {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #d9534f;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 15px;
        }
        .contact-info {
            margin-top: 30px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
        }
        .contact-info h3 {
            margin: 0 0 10px 0;
            font-size: 18px;
            color: #0056b3;
        }
        .contact-info p {
            margin: 5px 0;
        }
        .contact-buttons {
            margin-top: 20px;
            text-align: center;
        }
        .contact-buttons a {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #25d366;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 15px;
        }
        .contact-buttons a.email-button {
            background-color: #007bff;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #777777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Alerta de Vencimiento de Convenio Local</h1>
        </div>
        <div class="content">
            <p>Estimado(a) <strong>{{ $academico->name }}</strong>,</p>
            <p>Le informamos que el convenio actual con la empresa <span class="highlight">{{ $empresa->nombre }}</span> está próximo a vencer el día <span class="highlight">{{ $fechaVencimiento }}</span>.</p>
            <p>Para asegurar la continuidad de nuestra colaboración, le solicitamos gestionar la renovación del convenio a la mayor brevedad posible.</p>
            <p>Puedes revisar los detalles del convenio actual y proceder con la renovación accediendo al siguiente enlace:</p>
            <a href="{{ $enlaceRenovacion }}" class="button">Gestionar Renovación</a>
        </div>

        <!-- Sección de información de la empresa -->
        <div class="contact-info">
            <h3>Información de la Empresa</h3>
            <p><strong>Nombre:</strong> {{ $empresa->nombre }}</p>
            <p><strong>Teléfono:</strong> {{ $empresa->telefono }}</p>
            <p><strong>Email:</strong> {{ $empresa->email }}</p>
        </div>

        <!-- Botones de contacto -->
        <div class="contact-buttons">
            <a href="https://wa.me/{{ $empresa->telefono }}" class="button">Enviar WhatsApp</a>
            <a href="mailto:{{ $empresa->email }}" class="button email-button">Enviar Correo</a>
        </div>

        <div class="footer">
            <p>Gracias por su atención a este asunto importante.</p>
            <p>Atentamente,</p>
            <p>Departamento de Relaciones Institucionales</p>
            <p>© {{ date('Y') }} Universidad Ejemplo. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
