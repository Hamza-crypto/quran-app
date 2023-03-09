@extends('layouts.app')

@section('title', 'Attendance')

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#gateway-table').DataTable();

            $('#teacher').change(function () {
                let teacher_id = $(this).val();
                if (teacher_id != -100) {
                    window.location.href = '{{ route('attendance.index') }}?teacher_id=' + teacher_id;
                }
            });

            $('#student').change(function () {
                let student_id = $(this).val();
                if (student_id != -100) {
                    window.location.href = '{{ route('attendance.index') }}?student_id=' + student_id;
                }
            })
        });



    </script>
@endsection

@section('content')
    @if(session('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif

   @include('pages.attendance._inc.filters')
    <h1 class="h3 mb-3">All Attendance</h1>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="gateway-table" class="table table-striped" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Duration (Minutes) </th>
                        </tr>
                        </thead>

                        @foreach($attendance as $attend)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $attend->users->name }}</td>
                                <td>{{ $attend->start_time }}</td>
                                <td>{{ $attend->end_time }}</td>
                                <td>{{ $attend->duration }}</td>

                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
