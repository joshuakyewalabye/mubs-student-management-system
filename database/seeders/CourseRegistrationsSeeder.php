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
            '24/U/16689/EVE' => ['BUC3131', 'BUC3122', 'BUC3113'],
            '24/U/0611'      => ['BUC3131', 'BUC3124', 'BUC3105'],
            '24/U/0594'      => ['BUC3131', 'BUC3116'],
            '24/U/23155'     => ['BUC3122', 'BUC3113', 'BUC3124'],
            '24/U/0659'      => ['BUC3131', 'BUC3105', 'BUC3116'],
            '24/U/15620/EVE' => ['BUC3113', 'BUC3124'],
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