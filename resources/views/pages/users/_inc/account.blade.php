@php
    $name = old("name", $user->name ?? '');
@endphp

<div class="tab-pane fade @if($tab == 'account') show active @endif" id="account" role="tabpanel">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Basic Info</h5>
        </div>
        <div class="card-body">

            <form method="post" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PATCH')

                <x-input
                    type="text"
                    label="Name"
                    name="name"
                    placeholder="Enter your name"
                    :value="$user->name"
                ></x-input>

                <x-input
                    type="text"
                    label="Email"
                    name="email"
                    placeholder="Enter your email"
                    :value="$user->email"

                ></x-input>

                <div class="form-group">
                    <label for="role">{{ 'Role' }}</label>
                    <select id="role" class="form-control select2 @error('role') is-invalid @enderror" name="role" data-toggle="select2">

                        @foreach(\App\Models\User::USER_ROLES as $role)
                            <option value="{{ $role }}" @if($user->role == $role) selected @endif>{{ ucfirst($role) }}</option>
                        @endforeach
                    </select>
                    @error('role')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update account</button>
            </form>
        </div>
    </div>
</div>

@if( $user->role == \App\Models\User::ROLE_STUDENT)
    @include('pages.users._inc.assign_teacher')
@else
    @include('pages.users._inc.assigned_students')
@endif


