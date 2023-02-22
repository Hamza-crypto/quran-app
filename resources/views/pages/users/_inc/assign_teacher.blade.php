<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">This student is assigned to:</h5>
    </div>
    <div class="card-body">

        <form method="post" action="{{ route('user.assign_teacher' ,$user->id) }}">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="role">Teacher</label>
                <select id="teacher" class="form-control select2" name="teacher" data-toggle="select2"
                        tabindex="0" aria-hidden="false">
                    <option value="-100">Select Teacher</option>

                @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" @if($assigned_teacher == $teacher->id) selected @endif>{{ $teacher->name }}</option>
                    @endforeach

                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update account</button>
        </form>
    </div>
</div>


