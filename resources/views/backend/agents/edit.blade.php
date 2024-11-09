@extends('backend.layouts.app')
@section('title', 'Agent')
@push('style')
    <style>
        .card-header {
            border-bottom: none !important;
        }
    </style>
@endpush
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Agent Info</h1>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="col-md-12 mt-5">
                            <img src="{{ asset('storage/agents/' . $agent->code . '/' . $agent->logo) }}" alt=""
                                width="20%">
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ route('agents.update', $agent->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="name">Agent ID<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="code" value="{{ $agent->code }}"
                                        readonly>
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="agency_name">Agency Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="agency_name"
                                        value="{{ $agent->agency_name }}">
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="email">Email<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email" value="{{ $agent->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Agent</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection

@push('scripts')
@endpush
