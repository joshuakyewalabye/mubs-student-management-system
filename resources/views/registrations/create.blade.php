@extends('layouts.app')

@section('title', 'New registration')

@section('content')

    <div class="max-w-2xl">
        <h1 class="text-xl font-semibold mb-2">New registration</h1>
        <p class="text-sm text-slate-500 mb-6">Register a student for a course. A student cannot be registered for the same course twice.</p>
    </div>

    <form action="{{ route('registrations.store') }}" method="POST" class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm max-w-2xl">
        @csrf

        <div class="p-6 space-y-5">

            {{-- Student (placeholder options; later a @foreach over students) --}}
            <div>
                <label for="student_id" class="block text-sm font-medium text-slate-600 mb-2">Student</label>
                <select id="student_id" name="student_id" class="input-field @error('student_id') border-red-400 @enderror">
                    <option value="">Select a student</option>
                    <option value="1" @selected(old('student_id') == 1)>24/U/0000 · Student one (placeholder)</option>
                    <option value="2" @selected(old('student_id') == 2)>24/U/0001 · Student two (placeholder)</option>
                </select>
                @error('student_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Course (placeholder options; later a @foreach over courses) --}}
            <div>
                <label for="course_id" class="block text-sm font-medium text-slate-600 mb-2">Course</label>
                <select id="course_id" name="course_id" class="input-field @error('course_id') border-red-400 @enderror">
                    <option value="">Select a course</option>
                    <option value="1" @selected(old('course_id') == 1)>BUC0000 · Course one (placeholder)</option>
                    <option value="2" @selected(old('course_id') == 2)>BUC0001 · Course two (placeholder)</option>
                </select>
                {{-- This is where the "already registered" duplicate error will appear (Q4c). --}}
                @error('course_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="px-4 py-4 bg-white border-t border-slate-200 flex justify-between">
            <a href="{{ route('registrations.index') }}" class="px-4 py-2 border border-slate-200 rounded-lg text-sm text-slate-600 hover:bg-slate-100">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-[#2563eb] rounded-lg text-sm font-medium text-white hover:bg-[#1d4ed8]">Register student</button>
        </div>
    </form>

@endsection
