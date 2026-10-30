@extends('layouts.app')

@section('title', 'Edit course')

@section('content')

    <div class="max-w-2xl">
        <h1 class="text-xl font-semibold mb-2">Edit course</h1>
        <p class="text-sm text-slate-500 mb-6">Update {{ $course->code }} and save your changes.</p>
    </div>

    @include('courses._form', [
        'action' => route('courses.update', $course),
        'method' => 'PUT',
        'submit' => 'Update course',
    ])

@endsection