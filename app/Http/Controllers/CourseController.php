<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $user  = Auth::user();
        $query = Course::with('lecturer')->withCount('students');

        // Administrator and student have "view courses" and see every course.
        // A lecturer does not, so they see only the courses assigned to them.
        if (! $user->can('view courses')) {
            $query->where('lecturer_id', $user->id);
        }

        // Optional search by course code or title
        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%");
            });
        }

        $courses = $query->orderBy('code')->get();

        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $user = Auth::user();

        // A lecturer may open only their own courses; anyone else gets 403
        if (! $user->can('view courses') && (int) $course->lecturer_id !== (int) $user->id) {
            abort(403);
        }

        // Only the administrator and lecturers may see who is registered.
        // A student must not see the other students.
        $showStudents = $user->can('view registrations') || $user->can('view assigned courses');

        $course->load('lecturer');
        if ($showStudents) {
            $course->load(['students' => fn ($q) => $q->orderBy('name')]);
        }

        return view('courses.show', compact('course', 'showStudents'));
    }

    // Show the empty form, with the lecturers for the dropdown
    public function create()
    {
        $lecturers = User::role('lecturer')->orderBy('name')->get();

        return view('courses.create', compact('lecturers'));
    }

    // Validate and save a new course
    public function store(Request $request)
    {
        $data = $request->validate([
            'code'        => ['required', 'string', 'max:20', 'unique:courses,code'],
            'title'       => ['required', 'string', 'max:255'],
            'credits'     => ['required', 'integer', 'between:1,10'],
            'lecturer_id' => ['nullable', 'exists:users,id'],
        ]);

        Course::create($data);

        return redirect()->route('courses.index')
            ->with('success', 'Course added successfully.');
    }

    // Show the form filled with the course's current values
    public function edit(Course $course)
    {
        $lecturers = User::role('lecturer')->orderBy('name')->get();

        return view('courses.edit', compact('course', 'lecturers'));
    }

    // Same rules as store, but a course may keep its own code
    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'code'        => ['required', 'string', 'max:20',
                Rule::unique('courses', 'code')->ignore($course->id)],
            'title'       => ['required', 'string', 'max:255'],
            'credits'     => ['required', 'integer', 'between:1,10'],
            'lecturer_id' => ['nullable', 'exists:users,id'],
        ]);

        $course->update($data);

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    // Delete the course; its registrations go too (cascadeOnDelete in the migration)
    public function destroy(Course $course)
    {
        $code = $course->code;

        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', "Course {$code} deleted.");
    }
}
