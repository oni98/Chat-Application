<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') &mdash; {{ @config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/backend/img/logo.png') }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/backend/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/fontawesome/css/all.min.css') }}">
    <!-- Datepicker -->
    <link rel="stylesheet" href="{{ asset('assets/backend/library/jquery-ui-dist/jquery-ui.min.css') }}">

    @stack('style')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/components.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.1/toastr.min.css"
        integrity="sha512-LEetX42b+K0TTmnfCNxYOrVTLlg36s06bJ8cutF3BpQT3VnpzdeqoYfn+FW2KBi/imYk2RpfQzlyzY7CrRW4CQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                {{-- <div class="row"> --}}
                    <!-- Footer -->
                    @include('backend.partials.auth-header')

                    <!-- Content -->
                    @yield('content')

                    <!-- Footer -->
                    @include('backend.partials.auth-footer')
                {{-- </div> --}}
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/backend/library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('assets/backend/library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('assets/backend/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/backend/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/backend/library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/stisla.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.1/toastr.min.js"
        integrity="sha512-pi7w4/MYBJ/7/NFGQ1OCInentlT3CCVVKU2udjNRWhxIOY5K2vxSPKYEa6EKbEZvHkgyEB8SMlSU8E84Ig81Og=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Datepicker -->
    <script src="{{ asset('assets/backend/library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    @stack('scripts')

    <!-- Template JS File -->
    <script src="{{ asset('assets/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom.js') }}"></script>
    <script>
        $(function() {
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
