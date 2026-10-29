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
    // code, title
    ['BCOM',  'Bachelor of Commerce'],
    ['BBA',   'Bachelor of Business Administration'],
    ['BACC',  'Bachelor of Science in Accounting'],
    ['BFIN',  'Bachelor of Science in Finance'],
    ['BPSM',  'Bachelor of Procurement and Supply Chain Management'],
    ['BHRM',  'Bachelor of Human Resource Management'],
    ['BIB',   'Bachelor of International Business'],
    ['BREM',  'Bachelor of Real Estate Business Management'],
    ['BLG',   'Bachelor of Leadership and Governance'],
    ['BAEC',  'Bachelor of Arts in Economics'],
    ['BBC',   'Bachelor of Business Computing'],
    ['BBS',   'Bachelor of Business Statistics'],
    ['BESM',  'Bachelor of Entrepreneurship and Small Business Management'],
    ['BOIM',  'Bachelor of Office and Information Management'],
    ['BLCD',  'Bachelor of Leadership and Community Development'],
    ['BTTM',  'Bachelor of Travel and Tourism Management'],
    ['BCHM',  'Bachelor of Catering and Hotel Management'],
    ['BLHM',  'Bachelor of Leisure and Hospitality Management'],
    ['BLEHM', 'Bachelor of Leisure Events and Hotel Management'],
];

$lecturers = [
    User::where('email', 'bashir.mutebi@mubs.ac.ug')->first(),
    User::where('email', 'mosh.gyagenda@mubs.ac.ug')->first(),
];

foreach ($courses as $i => [$code, $title]) {
    // Alternate the two lecturers across the programmes
    $lecturer = $lecturers[$i % 2];

    Course::updateOrCreate(
        ['code' => $code],
        [
            'title'       => $title,
            'credits'     => 3,
            'lecturer_id' => $lecturer?->id,
        ]
    );
}
    }
}