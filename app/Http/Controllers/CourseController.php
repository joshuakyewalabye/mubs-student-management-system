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
        $lecturers = $this->lecturers();

        return view('courses.create', compact('lecturers'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        Course::create($data);

        return redirect()->route('courses.index')
            ->with('success', 'Course added successfully.');
    }

    public function edit(Course $course)
    {
        $lecturers = $this->lecturers();

        return view('courses.edit', compact('course', 'lecturers'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $this->validated($request, $course);

        $course->update($data);

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        // Remove the course's registrations first, so the foreign key cannot block the delete
        $course->students()->detach();
        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Course removed.');
    }

    // Users who hold the lecturer role, for the dropdown and for validation
    private function lecturers()
    {
        return User::role('lecturer')->orderBy('name')->get();
    }

    // One rule set for both store and update
    private function validated(Request $request, ?Course $course = null): array
    {
        return $request->validate([
            'code'        => ['required', 'string', 'max:20',
                              Rule::unique('courses', 'code')->ignore($course?->id)],
            'title'       => ['required', 'string', 'max:255'],
            'credits'     => ['required', 'integer', 'min:1', 'max:10'],
            'lecturer_id' => ['nullable', Rule::in($this->lecturers()->pluck('id'))],
        ]);
    }
}