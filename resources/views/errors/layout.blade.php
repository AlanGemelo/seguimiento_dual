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
