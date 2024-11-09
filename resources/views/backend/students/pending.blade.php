@extends('backend.layouts.app')
@section('title', 'Student Management')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pending Students</h1>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        @role('Super Admin')
                            <a href="{{ route('student.form') }}" target="_blank" class="btn btn-info">Create New Application</a>
                        @endrole
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td> <a href="{{ route('students.show', $student->id) }}">{{ $student->code }}
                                                </a></td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->mobile1 }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('students.show', $student->id) }}"
                                                        class="btn btn-sm btn-info mr-1"><i class="fas fa-eye"></i></a>
                                                    @role('Super Admin')
                                                        <a href="{{ route('students.approve', $student->id) }}" data-toggle="tooltip" data-placement="top"
                                                            class="btn btn-sm btn-success edit-btn mr-1" data-toggle="tooltip"
                                                            data-placement="top" title="Approve"><i class="fas fa-check"></i></a>
                                                        <a href="#">
                                                            <form method="POST"
                                                                action="{{ route('students.destroy', $student->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger mr-1" data-toggle="tooltip" data-placement="top"
                                                                title="Reject" onclick="return confirm('Are you sure you want to delete this item?')"><i class="fas fa-close"></i></button>
                                                            </form>
                                                        </a>
                                                    @endrole
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                stateSave: true,
                stateSaveCallback: function(settings, data) {
                    localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data))
                },
                stateLoadCallback: function(settings) {
                    return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance))
                },
            }).search($(this).val(), true, false, true);
        });
    </script>
@endpush
