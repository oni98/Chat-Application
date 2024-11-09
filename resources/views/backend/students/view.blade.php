@extends('backend.layouts.app')
@section('title', 'Student Management')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/library/datatables/media/css/jquery.dataTables.min.css') }}">
    <style>
        tr td {
            padding-top: 10px !important;
            padding-bottom: 10px !important;
        }
    </style>
@endpush
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Student Details</h1>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header row justify-content-between">
                        @role('Super Admin')
                            <div class="float-right">
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-info"
                                    data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        @endrole
                        <div class="col-md-12 mt-3 text-center">
                            <img src="{{ asset('assets/backend/img/logo-full.png') }}" alt="" width="10%">
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            {{-- @include('backend.partials.message') --}}
                            <table id="example1" class="table table-bordered table-striped">
                                <tr>
                                    <td class="col-md-3 font-weight-bold">Student Id</td>
                                    <td class="col-md-4">{{ $student->code }}</td>

                                    <td class="col-md-3 font-weight-bold">Name</td>
                                    <td class="col-md-4">{{ $student->name }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3 font-weight-bold">Mobile No 1</td>
                                    <td class="col-md-4">{{ $student->mobile1 }}</td>

                                    <td class="col-md-3 font-weight-bold">Email</td>
                                    <td class="col-md-4">{{ $student->email }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/backend/library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "ordering": false,
                "paginate": false,
                "bInfo": false,
                "searching": false,
                fnDrawCallback: function() {
                    $("#example1 thead").remove();
                }
            });
        })
    </script>
@endpush
