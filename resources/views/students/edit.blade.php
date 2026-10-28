@extends('layouts.app')

@section('title', 'Edit student')

@section('content')

    <div class="max-w-2xl">
        <h1 class="text-xl font-semibold mb-2">Edit student</h1>
        <p class="text-sm text-slate-500 mb-6">Update the student's details and save your changes.</p>
    </div>

    {{-- $student does not exist yet (no model), so the form falls back to empty values.
         Later the controller will pass it in: return view('students.edit', compact('student')); --}}
    @include('students._form', [
        'action' => route('students.update', $student->id ?? 1),
        'method' => 'PUT',
        'submit' => 'Update student',
    ])

@endsection
