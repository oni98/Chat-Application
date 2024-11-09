@extends('backend.layouts.auth')
@section('title', 'Register')
@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/backend/library/selectric/public/selectric.css') }}">
@endpush
@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="text-uppercase">Consultant Registration</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('agents.register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="agency_name" class="col-form-label text-md-end">{{ __('Agency Name') }}<span
                                    class="text-danger">*</span></label>
                            <input id="agency_name" type="text" class="form-control" name="agency_name"
                                value="{{ old('agency_name') }}" required autocomplete="name" autofocus>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="col-form-label text-md-end">{{ __('Email') }}<span
                                    class="text-danger">*</span></label>
                            <input id="email" type="text" class="form-control" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password" class="col-form-label text-md-end">{{ __('Password') }}<span
                                    class="text-danger">*</span></label>

                            <input id="password" type="password" class="form-control" name="password" required
                                autocomplete="new-password">
                        </div>
                        <div class="col-md-6">
                            <label for="password-confirm"
                                class="col-form-label text-md-end">{{ __('Confirm Password') }}<span
                                    class="text-danger">*</span></label>

                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('REGISTER NOW') }}
                        </button>
                        <p class="my-2">Already have an account? <a class="text-primary2"
                                href="{{ route('login') }}">Sign In</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('assets/backend/library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('assets/backend/library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/backend/js/page/auth-register.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#checkbox').on('change', function() {
                $('#password').attr('type', $('#checkbox').prop('checked') == true ? "text" : "password");
                $('#password-confirm').attr('type', $('#checkbox').prop('checked') == true ? "text" : "password");
            });
        });
    </script>
@endpush
