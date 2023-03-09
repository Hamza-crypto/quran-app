<div class="row">
    <div class="col-12 col-lg-6 d-flex">
        <div class="card flex-fill">
            <div class="card-header">

                <h5 class="card-title mb-0">
                    Today Attendance
                </h5>
            </div>
         <div class="card-body">
             <form method="post" action="{{ route('user.mark_attendance') }}">
                 @csrf

                 <div class="form-group">
                     <label for="student">Student</label>
                     <select id="student" class="form-control select2" name="student" data-toggle="select2"
                             tabindex="0" aria-hidden="false">
                         <option value="-100">Select Student</option>

                         @foreach($students as $student)
                             <option value="{{ $student->id }}" >{{ $student->name }}</option>
                         @endforeach

                     </select>
                 </div>

                 <div class="form-group">
                     <label for="start_time">Start Time</label>
                     <input class="form-control form-control-lg mb-3 " type="time" name="start_time" required>
                 </div>
                 <div class="form-group">
                     <label for="end_time">End Time</label>
                     <input class="form-control form-control-lg mb-3 " type="time" name="end_time" >
                 </div>


                 <div class="form-group">
                     <button type="submit" class="btn btn-lg btn-primary">SAVE</button>
                 </div>

             </form>

         </div>
        </div>
    </div>

</div>
