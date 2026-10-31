<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentsSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            // student number, name, email, phone
            ['24/U/16689/EVE', 'Matovu Mathew Philip',    'mathew.matovu@mubs.ac.ug',     '+256700000001'],
            ['24/U/0611',      'Kyewalabye Joshua Joram', 'joshua.kyewalabye@mubs.ac.ug', '+256700000002'],
            ['24/U/0594',      'Kushaba Adrona',          'adrona.kushaba@mubs.ac.ug',    '+256700000003'],
            ['24/U/23155',     'Magumba Benjamin Samuel', 'benjamin.magumba@mubs.ac.ug',  '+256700000004'],
            ['24/U/0659',      'Magala Eric',             'eric.magala@mubs.ac.ug',       '+256700000005'],
            ['24/U/15620/EVE', 'Kasozi Sharif',           'sharif.kasozi@mubs.ac.ug',     '+256700000006'],
        ];

        foreach ($students as [$number, $name, $email, $phone]) {
            // Find this student's login account by email, so we can link them
            $user = User::where('email', $email)->first();

            // updateOrCreate matches on student_number, so re-running never duplicates (Q2d)
            Student::updateOrCreate(
                ['student_number' => $number],
                [
                    'user_id' => $user?->id,
                    'name'    => $name,
                    'email'   => $email,
                    'phone'   => $phone,
                ]
            );
        }
    }
}