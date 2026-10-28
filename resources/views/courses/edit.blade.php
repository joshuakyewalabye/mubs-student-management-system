@extends('layouts.app')

@section('title', 'Edit course')

@section('content')

    <div class="max-w-2xl">
        <h1 class="text-xl font-semibold mb-2">Edit course</h1>
        <p class="text-sm text-slate-500 mb-6">Update the course details and save your changes.</p>
    </div>

    {{-- $course does not exist yet (no model), so the form falls back to empty values.
         Later the controller will pass it in: return view('courses.edit', compact('course')); --}}
    @include('courses._form', [
        'action' => route('courses.update', $course->id ?? 1),
        'method' => 'PUT',
        'submit' => 'Update course',
    ])

@endsection
