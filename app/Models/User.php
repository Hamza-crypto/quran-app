<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Impersonate;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public const ROLE_ADMIN = 'admin';
    public const ROLE_STUDENT = 'student';
    public const ROLE_TEACHER = 'teacher';

    public const USER_ROLES = [
        self::ROLE_ADMIN => self::ROLE_ADMIN,
        self::ROLE_STUDENT => self::ROLE_STUDENT,
        self::ROLE_TEACHER => self::ROLE_TEACHER,
    ];

    //select particular columns from users table relationship

    public function students()
    {
        return $this->belongsToMany(User::class, 'teacher_students', 'teacher_id', 'student_id')->select('users.id', 'name', 'email');
    }

    public function teacher()
    {
        return $this->belongsToMany(User::class, 'teacher_students', 'student_id', 'teacher_id');
    }




}
