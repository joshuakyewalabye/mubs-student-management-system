<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('administrator')) {
            $subtitle = 'Manage students, courses, lecturers and course registrations in one place.';
            $cards = [
                ['type' => 'students',      'label' => 'Students',      'value' => Student::count()],
                ['type' => 'courses',       'label' => 'Courses',       'value' => Course::count()],
                ['type' => 'lecturers',     'label' => 'Lecturers',     'value' => User::role('lecturer')->count()],
                ['type' => 'registrations', 'label' => 'Registrations', 'value' => CourseRegistration::count()],
            ];
            $tableTitle    = 'Latest course registrations';
            $registrations = CourseRegistration::with(['student', 'course'])->latest()->take(5)->get();
            $showStudent   = true;

        } elseif ($user->hasRole('lecturer')) {
            $subtitle  = 'See the courses assigned to you and the students registered in them.';
            $courseIds = $user->courses()->pluck('id');
            $cards = [
                ['type' => 'courses',       'label' => 'My courses',        'value' => $courseIds->count()],
                ['type' => 'students',      'label' => 'Students in my courses', 'value' => CourseRegistration::whereIn('course_id', $courseIds)->distinct()->count('student_id')],
            ];
            $tableTitle    = 'Latest registrations in my courses';
            $registrations = CourseRegistration::with(['student', 'course'])
                                ->whereIn('course_id', $courseIds)->latest()->take(5)->get();
            $showStudent   = true;

        } else {
            // Student: only their own records
            $subtitle  = 'Browse the courses offered and see the ones you are registered for.';
            $student   = $user->student;
            $myRegistrations = $student
                ? CourseRegistration::with('course')->where('student_id', $student->id)
                : CourseRegistration::whereRaw('1 = 0');
            $cards = [
                ['type' => 'registrations', 'label' => 'My registrations', 'value' => $student ? $student->registrations()->count() : 0],
                ['type' => 'courses',       'label' => 'Courses available', 'value' => Course::count()],
            ];
            $tableTitle    = 'My course registrations';
            $registrations = $myRegistrations->latest()->take(5)->get();
            $showStudent   = false;
        }

        return view('dashboard', [
            'heading'       => 'Welcome, ' . $user->name,
            'subtitle'      => $subtitle,
            'cards'         => $cards,
            'tableTitle'    => $tableTitle,
            'registrations' => $registrations,
            'showStudent'   => $showStudent,
        ]);
    }
}