@extends('backend.layouts.auth')
@section('title', 'Admission')
@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/backend/library/selectric/public/selectric.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/backend/library/select2/dist/css/select2.css') }}">
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="text-uppercase">Admission Form</h4>
            </div>

            <div class="card-body" id="admission">
                <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="Name">Name<span class="text-danger">*</span> </label>
                            <input type="text" name="name" class="form-control" id="Name" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="mobile">Mobile No 1<span class="text-danger">*</span> </label>
                            <input type="text" name="mobile1" class="form-control" id="mobile" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">Email<span class="text-danger">*</span> </label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                    </div>

                    <div class="text-center">

                        <button type="submit" class="btn btn-primary">SUBMIT APPLICATION</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    
    <script src="{{ asset('assets/backend/library/select2/dist/js/select2.min.js') }}"></script>
@endpush
