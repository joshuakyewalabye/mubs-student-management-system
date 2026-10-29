<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Order matters: each seeder depends on the one before it
        $this->call([
            RolesAndPermissionsSeeder::class,   // roles must exist before users get them
            UsersSeeder::class,                 // users need roles
            StudentsSeeder::class,              // students link to users
            CoursesSeeder::class,               // courses link to lecturers (users)
            CourseRegistrationsSeeder::class,   // registrations link students to courses
        ]);
    }
}