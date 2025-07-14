@php
    use RealRashid\SweetAlert\Facades\Alert;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>
        @hasSection('title')
            @yield('title') |
        @endif{{ config('app.name', 'Laravel') }}
    </title>

    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/select.dataTables.min.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Solucion tenporar a que no hay dominio-->
    <script>
        window.BASE_URL = '{{ env('BASE_URL', '') }}';
    </script>

    <style>
        .custom-loader {
            height: 100vh;
            width: 100vw;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
        }

        .loader-image {
            width: 100px;
            height: 100px;
            animation: loader-animation 2s infinite;
        }

        @keyframes loader-animation {
            0% {
                transform: scale(0) rotate(0deg);
                opacity: 1;
            }

            50% {
                transform: scale(1.5) rotate(180deg);
                opacity: 0.5;
            }

            100% {
                transform: scale(1) rotate(360deg);
                opacity: 1;
            }
        }

        .content-blur {
            filter: blur(5px);
        }

        @media (max-width: 768px) {
            #content {
                margin-top: 110px;
            }
        }
    </style>

    {{-- Page-specific CSS --}}
    @yield('styles')
    @stack('styles')
</head>

<body>
    <div class="container-fluid">
        {{-- Navigation --}}
        @include('layouts.navigation')

        <div class="row" id="content" style="margin-top: 80px;">
            <div class="custom-loader" id="loading">
                <img src="{{ asset('assets/images/logo-utvt-removebg-preview.png') }}" alt="Loading"
                    class="loader-image">
            </div>

            {{-- Content --}}
            @yield('content')
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Vendor JS -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>

    <!-- Plugin JS -->

    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script>
    <script src="{{ asset('assets/js/tooltips.js') }}"></script>
    <script src="{{ asset('assets/js/sweetAlert.js') }}"></script>
    <script src="{{ asset('js/form-validations.js') }}"></script>


    <!-- End custom js for this page-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


    <script>
        $(window).on('load', function() {
            $('#loading').fadeOut('slow', function() {
                $('#content').removeClass('content-blur');
            });
        });

        function filterTable(inputId, tableBodyId) {
            let input = document.getElementById(inputId);
            let filter = input.value.toLowerCase();
            let tableBody = document.getElementById(tableBodyId);
            let rows = tableBody.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName('td');
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }

                if (match) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    </script>

    <!-- Page-specific JS-->
    @yield('scripts')
    @stack('scripts')
</body>

</html>
