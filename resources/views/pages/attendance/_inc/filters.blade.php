<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form>
                    <input type="hidden" class="d-none" name="filter" value="true" hidden>
                    <div class="row">

                        @if(Auth::user()->role != 'teacher')
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="form-label" for="status">{{ __('Teacher') }}</label>
                                    <select name="teacher" id="teacher"
                                            class="form-control form-select custom-select select2"
                                            data-toggle="select2">
                                        <option value="-100">{{ __('Select Teacher') }}</option>
                                        @foreach($teachers as $user)
                                            <option
                                                value="{{ $user->id }}" {{ request()->teacher_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        @if(Auth::user()->role != 'student')
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="form-label" for="status">{{ __('Student') }}</label>
                                    <select name="student" id="student"
                                            class="form-control form-select custom-select select2"
                                            data-toggle="select2">
                                        <option value="-100">{{ __('Select Student') }}</option>
                                        @foreach($students as $user)
                                            <option
                                                value="{{ $user->id }}" {{ request()->student_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
