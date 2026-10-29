<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            // code, title, credits, lecturer email
            ['BUC3131', 'Advanced Web Application Development', 4, 'grace.nakato@mubs.ac.ug'],
            ['BUC3122', 'Database Administration',              3, 'grace.nakato@mubs.ac.ug'],
            ['BUC3113', 'Systems Analysis and Design',          3, 'peter.okello@mubs.ac.ug'],
            ['BUC3124', 'Information Systems Security',         3, 'peter.okello@mubs.ac.ug'],
            ['BUC3105', 'Mobile Application Development',       4, 'grace.nakato@mubs.ac.ug'],
            ['BUC3116', 'Research Methods',                     3, 'peter.okello@mubs.ac.ug'],
        ];

        foreach ($courses as [$code, $title, $credits, $lecturerEmail]) {
            $lecturer = User::where('email', $lecturerEmail)->first();

            // updateOrCreate matches on the unique code, so no duplicates (Q2d)
            Course::updateOrCreate(
                ['code' => $code],
                [
                    'title'       => $title,
                    'credits'     => $credits,
                    'lecturer_id' => $lecturer?->id,
                ]
            );
        }
    }
}