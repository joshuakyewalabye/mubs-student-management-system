<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    // List students, with an optional search (?q=...)
    public function index(Request $request)
    {
        // Each student also gets a courses_count column (how many courses they are registered for)
        $query = Student::withCount('courses');

        if ($search = $request->query('q')) {
            // One closure groups the OR conditions so they stay together
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('student_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $students = $query->orderBy('name')->get();

        return view('students.index', compact('students'));
    }

    // Show the empty form
    public function create()
    {
        return view('students.create');
    }

    // Validate, link a login account if one exists, save
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_number' => ['required', 'string', 'max:50', 'unique:students,student_number'],
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'email', 'max:255', 'unique:students,email'],
            'phone'          => ['nullable', 'string', 'max:30'],
        ]);

        // If a login account already uses this email and is not linked to another
        // student, link it so that person sees their own registrations
        $user = User::where('email', $data['email'])->first();

        if ($user && ! Student::where('user_id', $user->id)->exists()) {
            $data['user_id'] = $user->id;
        }

        Student::create($data);

        return redirect()->route('students.index')
            ->with('success', 'Student added successfully.');
    }

    // Student detail page: the student's registered courses, sorted by code
    public function show(Student $student)
    {
        $student->load(['courses' => fn ($q) => $q->orderBy('code')]);

        return view('students.show', compact('student'));
    }

    // Show the form filled with the student's current values
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Same rules as store, but a student may keep their own number and email
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'student_number' => ['required', 'string', 'max:50',
                Rule::unique('students', 'student_number')->ignore($student->id)],
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'email', 'max:255',
                Rule::unique('students', 'email')->ignore($student->id)],
            'phone'          => ['nullable', 'string', 'max:30'],
        ]);

        $student->update($data);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    // Delete the student; their registrations go too (cascadeOnDelete in the migration)
    public function destroy(Student $student)
    {
        $name = $student->name;

        $student->delete();

        return redirect()->route('students.index')
            ->with('success', "Student {$name} deleted.");
    }
}