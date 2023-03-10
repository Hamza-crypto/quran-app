<?php

namespace Database\Seeders;

use App\Models\TeacherStudents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Hamza Siddique',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'role' => 'admin',
            ]
        );

         \App\Models\User::factory(10)->create(['role' => 'student']);
         \App\Models\User::factory(3)->create(['role' => 'teacher']);

        TeacherStudents::updateOrCreate(
            ['student_id' => 2],
            ['teacher_id' => 12]
        );

        TeacherStudents::updateOrCreate(
            ['student_id' => 3],
            ['teacher_id' => 12]
        );
    }
}
