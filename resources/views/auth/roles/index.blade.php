@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Roles Management</h1>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-md-12"><a href="{{ route('role.create') }}" class="btn btn-info">Create
                                New Role</a></div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('role.edit', $role->id) }}"
                                                   class="btn btn-sm btn-info"><i class="fas fa-edit">Edit</i></a>
                                                <form class="ms-3" action="{{ route('role.destroy', $role->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-edit">Delete</i></button>
                                                </form>
                                            </div>
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
