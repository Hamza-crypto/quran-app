<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\TeacherStudents;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AttendanceController extends Controller
{
    public function index(){
        $data = request()->all();

        $user = Auth::user();
        $attendance = Attendance::with('users');

        if(isset($data['student_id'])){
            $attendance = $attendance->where('student_id', $data['student_id']);
            dump('student');
        }

        if(isset($data['teacher_id'])){
            $attendance = $attendance->where('teacher_id', $data['teacher_id']);
        }

        if($user->role == 'teacher'){
            $attendance = $attendance->where('teacher_id', $user->id)->get();
            $students = $user->students;
            $teachers = [];
        }
        elseif($user->role == 'student'){
            $attendance = $attendance->where('student_id', $user->id)->get();
            $students = [];
            $teachers = $user->teacher;
        }
        elseif ($user->role == 'admin'){
            $attendance = $attendance->get();
            $students = User::where('role', 'student')->get();
            $teachers = User::where('role', 'teacher')->get();
        }


        $attendance = $attendance->map(function ($item, $key) {
            $item->duration = Carbon::parse($item->start_time)->diffInMinutes($item->end_time);
            return $item;
        });
        return view('pages.attendance.index', compact('attendance', 'students', 'teachers'));
    }
    public function mark_attendance(Request $request, User $user)
    {
        $student_id = $request->student;
        if($student_id == -100){
            Session::flash('error', 'Please select a student.');
            return back();
        }
        $teacher_id = Auth::id();

        if($request->has('start_time') ){
            $start_time = $request->start_time;
            $start = date('Y-m-d H:i:s', strtotime($start_time));
            if ($request->end_time != null)  {

                $end_time = $request->end_time;
                $end = date('Y-m-d H:i:s', strtotime($end_time));
                Attendance::updateOrCreate(
                    ['student_id' => $student_id, 'teacher_id' => $teacher_id],
                    ['start_time' => $start, 'end_time' => $end]
                );
            }
            else{

                Attendance::updateOrCreate(
                    ['student_id' => $student_id, 'teacher_id' => $teacher_id],
                    ['start_time' => $start]
                );
            }

        }

        Session::flash('success', 'Attendance marked successfully.');
        return back();

    }

    public function get_attendance(Request $request, User $user)
    {
        $student_id = $request->student_id;
        $teacher_id = Auth::id();
        $attendance = Attendance::where('student_id', $student_id)->where('teacher_id', $teacher_id)->first();
        if($attendance)
        {
            //get only time from timestamp
            $attendance->start_time = date('H:i', strtotime($attendance->start_time));
            if($attendance->end_time != null) $attendance->end_time = date('H:i', strtotime($attendance->end_time));
            return response()->json(['start_time' => $attendance->start_time, 'end_time' => $attendance->end_time]);
        }
        else return response()->json(['start_time' => null, 'end_time' => null]);


    }
}
