@php use RealRashid\SweetAlert\Facades\Alert; @endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')&nbsp;|&nbsp;{{ config('app.name') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <!-- Plugin css for this page -->
    {{--    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/js/select.dataTables.min.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
    <!-- favicon -->    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" />


</head>

<body>
    <!-- container-scroller -->
    <div class="container-scroller">
        @include('layouts.navigation')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.navbar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="semipolar-spinner" :style="spinnerStyle" id="loading">
                        <div class="ring"></div>
                        <div class="ring"></div>
                        <div class="ring"></div>
                        <div class="ring"></div>
                        <div class="ring"></div>
                    </div>
                    @yield('content')
                </div>
                <style>
                    .semipolar-spinner,
                    .semipolar-spinner * {
                        box-sizing: border-box;
                    }

                    .semipolar-spinner {
                        height: 100%;
                        width: 100%;
                        position: relative;
                    }

                    .semipolar-spinner .ring {
                        border-radius: 50%;
                        position: absolute;
                        border: calc(65px * 0.05) solid transparent;
                        border-top-color: #ff1d5e;
                        border-left-color: #ff1d5e;
                        animation: semipolar-spinner-animation 2s infinite;
                    }

                    .semipolar-spinner .ring:nth-child(1) {
                        height: calc(65px - 65px * 0.2 * 0);
                        width: calc(65px - 65px * 0.2 * 0);
                        top: calc(65px * 0.1 * 0);
                        left: calc(65px * 0.1 * 0);
                        animation-delay: calc(2000ms * 0.1 * 4);
                        z-index: 5;
                    }

                    .semipolar-spinner .ring:nth-child(2) {
                        height: calc(65px - 65px * 0.2 * 1);
                        width: calc(65px - 65px * 0.2 * 1);
                        top: calc(65px * 0.1 * 1);
                        left: calc(65px * 0.1 * 1);
                        animation-delay: calc(2000ms * 0.1 * 3);
                        z-index: 4;
                    }

                    .semipolar-spinner .ring:nth-child(3) {
                        height: calc(65px - 65px * 0.2 * 2);
                        width: calc(65px - 65px * 0.2 * 2);
                        top: calc(65px * 0.1 * 2);
                        left: calc(65px * 0.1 * 2);
                        animation-delay: calc(2000ms * 0.1 * 2);
                        z-index: 3;
                    }

                    .semipolar-spinner .ring:nth-child(4) {
                        height: calc(65px - 65px * 0.2 * 3);
                        width: calc(65px - 65px * 0.2 * 3);
                        top: calc(65px * 0.1 * 3);
                        left: calc(65px * 0.1 * 3);
                        animation-delay: calc(2000ms * 0.1 * 1);
                        z-index: 2;
                    }

                    .semipolar-spinner .ring:nth-child(5) {
                        height: calc(65px - 65px * 0.2 * 4);
                        width: calc(65px - 65px * 0.2 * 4);
                        top: calc(65px * 0.1 * 4);
                        left: calc(65px * 0.1 * 4);
                        animation-delay: calc(2000ms * 0.1 * 0);
                        z-index: 1;
                    }

                    @keyframes semipolar-spinner-animation {
                        50% {
                            transform: rotate(360deg) scale(0.7);
                        }
                    }
                </style>
                <!-- Mostrar el mensaje de alerta -->

            </div>
        </div>
    </div>
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/tooltips.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <!-- End custom js for this page-->
    <script>
        $(window).on('load', function() {
            $('#loading').hide();
        })
    </script>

</body>

</html>
