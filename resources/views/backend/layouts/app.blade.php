<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') | {{ @config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/backend/img/logo.png') }}">
    <!-- General CSS Files -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/backend/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/fontawesome/css/all.min.css') }}">
    <!-- Datepicker -->
    <link rel="stylesheet" href="{{ asset('assets/backend/library/jquery-ui-dist/jquery-ui.min.css') }}">

    @stack('style')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/components.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/backend/library/bootstrap-daterangepicker/daterangepicker.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/backend/library/summernote/dist/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/toastr.min.css') }}">

</head>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            @include('backend.partials.header')

            <!-- Sidebar -->
            @include('backend.partials.sidebar')

            <!-- Content -->
            @yield('content')

            <!-- Footer -->
            @include('backend.partials.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/backend/library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('assets/backend/library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('assets/backend/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/backend/fontawesome/js/all.min.js') }}"></script> --}}
    <script src="{{ asset('assets/backend/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/backend/library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/stisla.js') }}"></script>
    {{-- <script src="{{ asset('assets/backend/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script> --}}
    <script src="{{ asset('assets/backend/library/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/toastr.min.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('assets/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom.js') }}"></script>
    <!-- Datepicker -->
    <script src="{{ asset('assets/backend/library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    @stack('scripts')

    <script>
        $(function() {
            $('.summernote').summernote();

            $('.datepicker').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "dd-mm-yy"
            })
        })
    </script>
    <script>
        @if (Session::has('success'))

            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>

</html>
