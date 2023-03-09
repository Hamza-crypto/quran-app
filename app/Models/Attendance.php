<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_id',
        'start_time',
        'end_time',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'student_id', 'id')->select('id', 'name', 'email');

    }
}
