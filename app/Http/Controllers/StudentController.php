<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::withCount('courses');

        // Optional search by name, student number or email
        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('student_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $students = $query->orderBy('name')->get();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'student_number' => ['required', 'string', 'max:50', 'unique:students,student_number'],
            'email'          => ['required', 'email', 'max:255', 'unique:students,email'],
            'phone'          => ['nullable', 'string', 'max:30'],
        ]);

        Student::create($data);

        return redirect()->route('students.index')
            ->with('success', 'Student added successfully.');
    }

    // The routes include students.show, but the brief needs no separate page
    public function show(Student $student)
    {
        return redirect()->route('students.index');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'student_number' => ['required', 'string', 'max:50',
                                 Rule::unique('students', 'student_number')->ignore($student->id)],
            'email'          => ['required', 'email', 'max:255',
                                 Rule::unique('students', 'email')->ignore($student->id)],
            'phone'          => ['nullable', 'string', 'max:30'],
        ]);

        $student->update($data);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        // Remove the student's registrations first, so the foreign key cannot block the delete
        $student->registrations()->delete();
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student removed.');
    }
}