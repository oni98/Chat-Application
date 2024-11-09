@extends('backend.layouts.app')
@section('title', 'Users Management')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Users Management</h1>
            </div>
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="card-title">Create A New User</h5>
                    </div>
                    {{-- @include('backend.partials.message') --}}
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="name">Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter your  Name">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="email">Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Enter your email">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="password">Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Enter your password">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="password_confirmation">Confirm Password<span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation" placeholder="Enter the password again">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="checkbox">
                                        <label class="custom-control-label" for="checkbox">Show Password</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="roles">Assign Roles<span class="text-danger">*</span></label>
                                    <select name="role" id="roles" class="form-control">
                                        @foreach ($roles as $role)
                                            @if ($role->name != 'Agent')
                                                <option value="{{ $role->name }}"> {{ $role->name }} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Create User</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#checkbox').on('change', function() {
                $('#password').attr('type', $('#checkbox').prop('checked') == true ? "text" : "password");
                $('#password_confirmation').attr('type', $('#checkbox').prop('checked') == true ? "text" : "password");
            });
        });
    </script>
@endpush
