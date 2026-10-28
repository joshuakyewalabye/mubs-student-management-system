@extends('layouts.app')

@section('title', 'Add course')

@section('content')

    <div class="max-w-2xl">
        <h1 class="text-xl font-semibold mb-2">Add course</h1>
        <p class="text-sm text-slate-500 mb-6">Enter the course details and assign a lecturer.</p>
    </div>

    @include('courses._form', [
        'action' => route('courses.store'),
        'method' => 'POST',
        'submit' => 'Save course',
    ])

@endsection
