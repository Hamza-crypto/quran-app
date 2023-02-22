<?php

namespace App\Http\Controllers;

use App\Models\TeacherStudents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'teacher')->get();
        $students = User::where('role', 'student')->get();

        return view('pages.users.index', get_defined_vars());
    }

    public function edit(User $user)
    {
        if ($user->role == User::ROLE_TEACHER) {
            $students = $user->students ?? null;
        }
        elseif($user->role == User::ROLE_STUDENT) {
            $assigned_teacher = $user->teacher()->first()->id ?? null;
            $teachers = User::where('role', User::ROLE_TEACHER)->get();
        }

        return view('pages.users.edit',
            [
                'user' => $user,
                'tab' => 'account',
                'teachers' => $teachers ?? null,
                'students' => $students ?? null,
                'assigned_teacher' => $assigned_teacher ?? null,
            ]);
    }

    public function update(User $user, Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'unique:users,email,' . $user->id,
            'role' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);


        Session::flash('success', __('Account information successfully updated.'));
        return back();
    }

    public function password_update(Request $request, User $user)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);
        Session::flash('password_update', 'Password updated successfully.');
        return back();

    }

    public function assign_teacher(Request $request, User $user)
    {
        $user_id = $user->id;
        $teacher_id = $request->teacher;

        //update or create new record
        TeacherStudents::updateOrCreate(
            ['student_id' => $user_id],
            ['teacher_id' => $teacher_id]
        );


//        $teacher_students = new TeacherStudents();
//        $teacher_students->student_id = $user_id;
//        $teacher_students->teacher_id = $teacher_id;
//        $teacher_students->save();

        Session::flash('success', 'Teacher assigned successfully.');
        return back();

    }

    public function destroy(User $user)
    {
        $user->delete();
        Session::flash('success', 'User deleted successfully.');
        return redirect()->route('users.index');
    }
}
