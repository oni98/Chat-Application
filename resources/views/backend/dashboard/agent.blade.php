@extends('backend.layouts.app')
@section('title', 'Dashboard')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/library/fullcalendar/dist/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/library/datatables/media/css/jquery.dataTables.min.css') }}">
    <style>
        .fc-right {
            display: none;
        }
    </style>
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/backend/library/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/page/modules-calendar.js') }}"></script>
    <script src="{{ asset('assets/backend/library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "searching": false,
                "ordering": false,
                fnDrawCallback: function() {
                    $("#example1 thead").remove();
                }
            });
        });
    </script>
@endpush
