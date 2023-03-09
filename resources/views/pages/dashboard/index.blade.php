@extends('layouts.app')

@section('title', 'Dashboard')

@section('scripts')
    <script>

        //when select with id student is changed, send ajax request to get student's attendance and update start_time
        $('#student').change(function () {
            let student_id = $(this).val();
            if (student_id != -100) {
                $.ajax({
                    url: '{{ route('user.get_attendance') }}',
                    type: 'GET',
                    data: {
                        student_id: student_id
                    },
                    success: function (data) {
                        console.log(data);
                            $('input[name="start_time"]').val(data.start_time);
                            $('input[name="end_time"]').val(data.end_time);

                    }
                })
            }
        })
    </script>
@endsection
@section('content')

    @if(session('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif
    @if(session('error'))
        <x-alert type="danger">{{ session('error') }}</x-alert>
    @endif
    <h1 class="h3 mb-3">Dashboard</h1>
    @include('pages.dashboard._inc.stats')
    @if(Auth::user()->role == 'teacher')
        @include('pages.dashboard._inc.attendance')
    @endif




@endsection
