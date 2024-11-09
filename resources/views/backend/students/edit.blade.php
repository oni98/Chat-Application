@extends('backend.layouts.app')
@section('title', 'Application')
@push('style')
    <!-- CSS Libraries -->
    
    <link rel="stylesheet" href="{{ asset('assets/backend/library/select2/dist/css/select2.css') }}">
@endpush
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Application Details</h1>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="col-md-12">
                            <img src="{{ asset('assets/backend/img/logo-full.png') }}" alt="" width="10%">
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <form action="{{ route('students.update', $student->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="code">Student Id<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="code" value="{{ $student->code }}"
                                        readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Name">Name<span class="text-danger">*</span> </label>
                                    <input type="text" name="name" value="{{ $student->name }}" class="form-control"
                                        id="Name" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="mobile">Mobile No 1<span class="text-danger">*</span> </label>
                                    <input type="text" name="mobile1" value="{{ $student->mobile1 }}"
                                        class="form-control" id="mobile" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">Email<span class="text-danger">*</span> </label>
                                    <input type="email" name="email" value="{{ $student->email }}" class="form-control"
                                        id="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Application</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-body -->
            </form>
    </div>
    <!-- /.card -->
    </div><!-- /.container-fluid -->
    </section>
@endsection

@push('scripts')
    
    <script src="{{ asset('assets/backend/library/select2/dist/js/select2.min.js') }}"></script>
@endpush
