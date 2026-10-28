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
                <option value="1" @selected(old('course_id') == 1)>Bachelor of Commerce</option>
                <option value="2" @selected(old('course_id') == 2)>Bachelor of Business Administration</option>
                <option value="3" @selected(old('course_id') == 3)>Bachelor of Science in Accounting</option>
                <option value="4" @selected(old('course_id') == 4)>Bachelor of Science in Finance</option>
                <option value="5" @selected(old('course_id') == 5)>Bachelor of Procurement and Supply Chain Management</option>
                <option value="6" @selected(old('course_id') == 6)>Bachelor of Human Resource Management</option>
                <option value="7" @selected(old('course_id') == 7)>Bachelor of International Business</option>
                <option value="8" @selected(old('course_id') == 8)>Bachelor of Real Estate Business Management</option>
                <option value="9" @selected(old('course_id') == 9)>Bachelor of Leadership and Governance</option>
                <option value="10" @selected(old('course_id') == 10)>Bachelor of Arts in Economics</option>
                <option value="11" @selected(old('course_id') == 11)>Bachelor of Business Computing</option>
                <option value="12" @selected(old('course_id') == 12)>Bachelor of Business Statistics</option>
                <option value="13" @selected(old('course_id') == 13)>Bachelor of Entrepreneurship and Small Business Management</option>
                <option value="14" @selected(old('course_id') == 14)>Bachelor of Office and Information Management</option>
                <option value="15" @selected(old('course_id') == 15)>Bachelor of Leadership and Community Development</option>
                <option value="16" @selected(old('course_id') == 16)>Bachelor of Travel and Tourism Management</option>
                <option value="17" @selected(old('course_id') == 17)>Bachelor of Catering and Hotel Management</option>
                <option value="18" @selected(old('course_id') == 18)>Bachelor of Leisure and Hospitality Management</option>
                <option value="19" @selected(old('course_id') == 19)>Bachelor of Leisure Events and Hotel Management</option>
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
