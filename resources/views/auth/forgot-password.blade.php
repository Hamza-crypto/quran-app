@extends('layouts.auth')

@section('title', 'Reset password')

@if (session('status'))
    @section('alert')
        <script>
            var notyf = new Notyf();

            notyf.open({
                'type': 'success',
                'message': '{{ session('status') }}',
                'duration': 60000,
                'ripple': true,
                'dismissible': true,
                'position': {x: 'right', y: 'top'}
            });
        </script>
    @endsection
@endif


@section('content')
    <div class="text-center mt-4">
        <h1 class="h2">Reset password</h1>
        <p class="lead">
            Enter your email to reset your password.
        </p>
    </div>

    <div class="card">
        <div class="card-body">



            <div class="m-sm-4">


                <form method="post" action="{{ route('password.email') }}">
                    @csrf

                    <x-input type="email" label="Email" placeholder="Enter your email"></x-input>

                    <div class="text-center mt-3">
                        <button
                            type="submit"
                            class="btn btn-lg btn-primary"
                        >
                            Reset password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
