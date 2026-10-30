<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $user  = Auth::user();
        $query = CourseRegistration::with(['student', 'course']);

        // Only people with "view registrations" (the administrator) see everyone's.
        // Anyone else (a student) sees only their own.
        if (! $user->can('view registrations')) {
            $query->where('student_id', $user->student?->id ?? 0);
        }

        // Optional search by student name or number, or course code or title
        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('student', fn($s) => $s->where('name', 'like', "%{$search}%")
                        ->orWhere('student_number', 'like', "%{$search}%"))
                    ->orWhereHas('course', fn($c) => $c->where('title', 'like', "%{$search}%")
                            ->orWhere('code', 'like', "%{$search}%"));
            });
        }

        $registrations = $query->latest()->get();

        return view('registrations.index', compact('registrations'));
    }

    // Show the form, with real students and courses for the dropdowns
    public function create()
    {
        $students = Student::orderBy('name')->get();
        $courses  = Course::orderBy('code')->get();

        return view('registrations.create', compact('students', 'courses'));
    }

    // Validate, block duplicates, save
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id'  => ['required', 'exists:courses,id'],
        ]);

        // Friendly check first
        $alreadyRegistered = CourseRegistration::where('student_id', $data['student_id'])
            ->where('course_id', $data['course_id'])
            ->exists();

        if ($alreadyRegistered) {
            return back()->withInput()
                ->with('error', 'This student is already registered for that course.');
        }

        // Safety net: the unique index in the database refuses a duplicate too
        try {
            CourseRegistration::create($data);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) { // MySQL "duplicate entry" error code
                return back()->withInput()
                    ->with('error', 'This student is already registered for that course.');
            }
            throw $e; // any other database error is not ours to hide
        }

        return redirect()->route('registrations.index')
            ->with('success', 'Student registered successfully.');
    }

    // Laravel finds the row from {registration} in the URL and hands it in
    public function destroy(CourseRegistration $registration)
    {
        $registration->delete();

        return redirect()->route('registrations.index')
            ->with('success', 'Registration removed.');
    }
}
