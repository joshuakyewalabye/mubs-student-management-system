@extends('layouts.app')

@section('title', $course->code)

@section('content')

    {{-- Page heading --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <a href="{{ route('courses.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-slate-700 mb-2">
                <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>Back to courses
            </a>
            <h1 class="text-xl font-semibold">{{ $course->code }} · {{ $course->title }}</h1>
        </div>
        @can('edit courses')
            <a href="{{ route('courses.edit', $course) }}" class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-lg text-sm text-slate-600 hover:bg-slate-100">
                <i data-lucide="edit" class="w-4 h-4 mr-2"></i>Edit course
            </a>
        @endcan
    </div>

    {{-- Course details --}}
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6 shadow-sm grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div>
            <p class="text-sm text-slate-500">Credit units</p>
            <p class="text-sm font-medium mt-1">{{ $course->credits }}</p>
        </div>
        <div>
            <p class="text-sm text-slate-500">Lecturer</p>
            <p class="text-sm font-medium mt-1">{{ $course->lecturer?->name ?? '—' }}</p>
        </div>
        <div>
            <p class="text-sm text-slate-500">Lecturer email</p>
            <p class="text-sm font-medium mt-1">{{ $course->lecturer?->email ?? '—' }}</p>
        </div>
    </div>

    {{-- Registered students: only for the administrator and the course lecturer --}}
    @if ($showStudents)
        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
            <div class="px-4 py-3 border-b border-slate-200 bg-slate-50">
                <h2 class="text-sm font-semibold text-slate-600">Registered students ({{ $course->students->count() }})</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px]">
                    <thead>
                        <tr class="border-b border-slate-200">
                            <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Student</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Student number</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Email</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Registered on</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($course->students as $student)
                            <tr class="border-b border-slate-200 hover:bg-slate-50">
                                <td class="py-3 px-4 text-sm">{{ $student->name }}</td>
                                <td class="py-3 px-4 text-sm text-slate-500">{{ $student->student_number }}</td>
                                <td class="py-3 px-4 text-sm text-slate-500">{{ $student->email }}</td>
                                <td class="py-3 px-4 text-sm text-slate-500">{{ $student->pivot->created_at?->format('d M Y') ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 px-4 text-center text-sm text-slate-500">No students are registered for this course yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <p class="text-sm text-slate-500">The list of registered students is visible to the administrator and the course lecturer only.</p>
    @endif

@endsection
