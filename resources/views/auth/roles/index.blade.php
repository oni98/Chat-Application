@extends('backend.layouts.app')
@section('title', 'Roles Management')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Roles Management</h1>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-md-12"><a href="{{ route('roles.create') }}" class="btn btn-info">Create
                                New Role</a></div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            {{-- @include('backend.partials.message') --}}
                            <table id="table-1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Permissions</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @foreach ($role->permissions as $perm)
                                                    <span class="badge badge-info py-2 my-2">
                                                        {{ $perm->name }}
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('roles.edit', $role->id) }}"
                                                    class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                                <a class="btn btn-sm btn-danger"
                                                    href="{{ route('roles.destroy', $role->id) }}" class="nav-link"
                                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <form id="delete-form-{{ $role->id }}"
                                                    action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                    style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
            $("#table-1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "ordering": false,
            });
        });
    </script>
@endpush
