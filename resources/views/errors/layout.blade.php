<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Error')</title>

    <!-- Styles -->
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #c7dfcc;
            color: #2e2e2e;
        }

        .error-container {
            display: flex;
            height: 100vh;
        }

        .error-image {
            flex: 1;
            background: url('@yield("image", "https://via.placeholder.com/600x800")') center center no-repeat;
            background-size: cover;
        }

        .error-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
            background-color: #ffffff;
        }

        .error-code {
            font-size: 100px;
            font-weight: bold;
            color: #006837;
            margin: 0;
        }

        .error-message {
            font-size: 28px;
            font-weight: 600;
            color: #2e2e2e;
            margin: 20px 0;
        }

        .error-description {
            font-size: 16px;
            color: #2e2e2e;
            margin-bottom: 10px;
            max-width: 400px;
        }

        .btn-home {
            background-color: #f4b400;
            color: #2e2e2e;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-home:hover {
            background-color: #e0a800;
        }

        /* Botón de cerrar sesión estilizado */
        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            /* separa el icono del texto */
            background: linear-gradient(135deg, #f44336, #d32f2f);
            /* rojo degradado */
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.25);
            background: linear-gradient(135deg, #d32f2f, #b71c1c);
        }

        /* Icono dentro del botón (opcional) */
        .btn-logout i {
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .error-container {
                flex-direction: column;
            }

            .error-image {
                height: 40vh;
            }

            .error-content {
                height: auto;
                padding: 20px;
            }

        }
    </style>
</head>

<body>
    <div class="error-container">
        @hasSection('image')
            <div class="error-image"></div>
        @endif

        <div class="error-content">
            <div class="error-code">@yield('code', 'Error')</div>
            <div class="error-message">@yield('message', 'Algo salió mal.')</div>
            <div class="error-description">@yield('description')</div>
            <div class="error-action">@yield('action')</div>
        </div>
    </div>
</body>

</html>
