@extends('backend.layouts.app')
@section('title', 'Users Management')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Users Management</h1>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-md-12"><a href="{{ route('users.create') }}" class="btn btn-info">Create
                                New User</a></div>
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
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach ($user->roles as $perm)
                                                    <span class="badge badge-info py-2 my-2">
                                                        {{ $perm->name }}
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td class="row">
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-sm btn-info mr-1"><i class="fas fa-edit"></i></a>
                                                <a href="#">
                                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this item?')"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </a>
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
                "autoWidth": true
            });
        });
    </script>
@endpush
