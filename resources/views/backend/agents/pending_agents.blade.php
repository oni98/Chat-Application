@extends('backend.layouts.app')
@section('title', 'Pending Agents')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pending Agents</h1>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-md-12"><a href="{{ route('agents.registerForm') }}" class="btn btn-info">Create New
                                Agent</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            {{-- @include('backend.partials.message') --}}
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Agent ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agents as $agent)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $agent->code }}</td>
                                            <td>{{ $agent->agency_name }}</td>
                                            <td>{{ $agent->email }}</td>
                                            <td class="row">
                                                <a href="{{ route('agents.show', $agent->id) }}"
                                                    class="btn btn-sm btn-success mr-1"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('agents.approve', $agent->id) }}"
                                                    class="btn btn-sm btn-info mr-1" data-toggle="tooltip"
                                                    data-placement="top" title="Approve"><i class="fas fa-check"></i></a>
                                                <a href="#">
                                                    <form method="POST" action="{{ route('agents.destroy', $agent->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" data-toggle="tooltip" data-placement="top"
                                                            title="Decline" class="btn btn-sm btn-danger mr-1"
                                                            onclick="return confirm('Are you sure you want to delete this item?')"><i
                                                                class="fas fa-close"></i></button>
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
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true
            });
        });
    </script>
@endpush
