@extends('backend.layouts.app')
@section('title', 'Agent')
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
                <h1>Agent Info</h1>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header row justify-content-between">
                        <div class="d-flex">
                            @if ($agent->status == 1)
                                <a href="{{ route('agents.edit', $agent->id) }}" class="btn btn-info" data-toggle="tooltip"
                                    data-placement="top" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @else
                                <a href="{{ route('agents.approve', $agent->id) }}" class="btn btn-sm btn-info mr-1"
                                    data-toggle="tooltip" data-placement="top" title="Approve"><i
                                        class="fas fa-check"></i></a>
                                <a href="#">
                                    <form method="POST" action="{{ route('agents.destroy', $agent->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mr-1"
                                            onclick="return confirm('Are you sure you want to delete this item?')"
                                            data-toggle="tooltip" data-placement="top" title="Decline"><i
                                                class="fas fa-close"></i></button>
                                    </form>
                                </a>
                            @endif
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="col-md-12 my-2">
                                <img src="{{ asset('storage/agents/' . $agent->code . '/' . $agent->logo) }}" alt=""
                                    width="20%">
                            </div>
                            {{-- @include('backend.partials.message') --}}
                            <table id="example1" class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Agent ID</td>
                                        <td class="">{{ $agent->code }}</td>

                                        <td class="font-weight-bold">Agency Name</td>
                                        <td class="">{{ $agent->agency_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Email</td>
                                        <td class="">{{ $agent->email }}</td>
                                    </tr>

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
