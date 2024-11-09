@extends('backend.layouts.app')
@section('title', 'Profile')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
            </div>
            <div class="section-body">
                <h2 class="section-title">Hi, {{ auth()->user()->name }}</h2>
                <p class="section-lead">
                    Change information about yourself on this page.
                </p>

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                @if (auth()->user()->image)
                                    <img alt="image" src="{{ asset('storage/users/' . auth()->user()->image) }}"
                                        class="rounded-circle profile-widget-picture" id="blah">
                                @else
                                    <img alt="image" src="{{ asset('assets/backend/img/avatar/avatar-1.png') }}"
                                        class="rounded-circle profile-widget-picture" id="blah">
                                @endif
                            </div>
                            <div class="profile-widget-description">
                                <div class="profile-widget-name"> {{ auth()->user()->name }} <div
                                        class="text-muted d-inline font-weight-normal">
                                        <div class="slash"></div> {{ auth()->user()->email }}
                                    </div>
                                </div>
                            </div>

                            @role('Agent')
                                <a href="{{ route('agent.certificateDownload') }}" class="btn btn-primary">Click To Download Certificate</a>
                            @endrole
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card card-primary">
                            <form method="POST" class="needs-validation" action="{{ route('profile.update', auth()->user()->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                                            <div class="invalid-feedback">
                                                Please fill in the first name
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label for="password">Password</label>
                                            <input id="password" type="password" name="password" class="form-control" placeholder="Not Mandatory">
                                            <div class="invalid-feedback">
                                                Please fill in the first name
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Not Mandatory">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-sm-12">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="checkbox">
                                                <label class="custom-control-label" for="checkbox">Show Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12 custom-file">
                                            <label>Profile Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="image" class="form-control"
                                                    id="customFile" onchange="readURL(this);">
                                                {{-- <label class="custom-file-label" for="customFile">Choose file</label> --}}
                                            </div>
                                        </div>
                                    </div>

                                    @role('Agent')
                                    <div class="row mt-2">
                                        <div class="form-group col-md-6 col-6 custom-file">
                                            <label>Logo</label>
                                            <div class="custom-file">
                                                <input type="file" name="logo" class="form-control" id="customFile">
                                                {{-- <label class="custom-file-label" for="customFile">Choose file</label> --}}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-6 custom-file">
                                            <label>License</label>
                                            <div class="custom-file">
                                                <input type="file" name="license" class="form-control" id="customFile">
                                                {{-- <label class="custom-file-label" for="customFile">Choose file</label> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="form-group col-md-12 col-12 custom-file">
                                            <label>NID/Passport</label>
                                            <div class="custom-file">
                                                <input type="file" name="nid_or_passport" class="form-control" id="customFile">
                                                {{-- <label class="custom-file-label" for="customFile">Choose file</label> --}}
                                            </div>
                                        </div>
                                    </div>
                                    @endrole
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {
            $('#checkbox').on('change', function() {
                $('#password').attr('type', $('#checkbox').prop('checked') == true ? "text" : "password");
                $('#password_confirmation').attr('type', $('#checkbox').prop('checked') == true ? "text" : "password");
            });
        });
    </script>
@endpush