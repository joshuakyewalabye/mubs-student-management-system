@extends('layouts.app')

@section('title', 'Add student')

@section('content')

    <div class="max-w-2xl">
        <h1 class="text-xl font-semibold mb-2">Add student</h1>
        <p class="text-sm text-slate-500 mb-6">Enter the student's details to create a new record.</p>
    </div>

    @include('students._form', [
        'action' => route('students.store'),
        'method' => 'POST',
        'submit' => 'Save student',
    ])

@endsection
