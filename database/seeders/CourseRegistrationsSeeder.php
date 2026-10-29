<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use Illuminate\Database\Seeder;

class CourseRegistrationsSeeder extends Seeder
{
    public function run(): void
    {
       $registrations = [
    // student number => course codes
    '24/U/16689/EVE' => ['BCOM', 'BBA', 'BFIN'],
    '24/U/0611'      => ['BBC', 'BBS', 'BAEC'],
    '24/U/0594'      => ['BBC', 'BOIM'],
    '24/U/23155'     => ['BACC', 'BFIN', 'BCOM'],
    '24/U/0659'      => ['BBC', 'BESM', 'BIB'],
    '24/U/15620/EVE' => ['BHRM', 'BLG'],
];

        foreach ($registrations as $studentNumber => $courseCodes) {
            $student = Student::where('student_number', $studentNumber)->first();

            foreach ($courseCodes as $code) {
                $course = Course::where('code', $code)->first();

                if ($student && $course) {
                    // firstOrCreate: skips a pair that already exists (Q2d)
                    CourseRegistration::firstOrCreate([
                        'student_id' => $student->id,
                        'course_id'  => $course->id,
                    ]);
                }
            }
        }
    }
}