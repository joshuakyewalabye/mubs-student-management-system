@extends('layouts.app')

@section('title', $student->name)

@section('content')

    {{-- Page heading --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <a href="{{ route('students.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-slate-700 mb-2">
                <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>Back to students
            </a>
            <h1 class="text-xl font-semibold">{{ $student->name }} · {{ $student->student_number }}</h1>
        </div>
        @can('edit students')
            <a href="{{ route('students.edit', $student) }}" class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-lg text-sm text-slate-600 hover:bg-slate-100">
                <i data-lucide="edit" class="w-4 h-4 mr-2"></i>Edit student
            </a>
        @endcan
    </div>

    {{-- Student details --}}
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6 shadow-sm grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div>
            <p class="text-sm text-slate-500">Email</p>
            <p class="text-sm font-medium mt-1">{{ $student->email }}</p>
        </div>
        <div>
            <p class="text-sm text-slate-500">Phone</p>
            <p class="text-sm font-medium mt-1">{{ $student->phone ?: '—' }}</p>
        </div>
        <div>
            <p class="text-sm text-slate-500">Login account</p>
            <p class="text-sm font-medium mt-1">{{ $student->user_id ? 'Linked' : 'Not linked' }}</p>
        </div>
    </div>

    {{-- Registered courses --}}
    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
        <div class="px-4 py-3 border-b border-slate-200 bg-slate-50">
            <h2 class="text-sm font-semibold text-slate-600">Registered courses ({{ $student->courses->count() }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px]">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Code</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Title</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Lecturer</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Registered on</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($student->courses as $course)
                        <tr class="border-b border-slate-200 hover:bg-slate-50">
                            <td class="py-3 px-4 text-sm font-medium">
                                <a href="{{ route('courses.show', $course) }}" class="text-[#2563eb] hover:underline">{{ $course->code }}</a>
                            </td>
                            <td class="py-3 px-4 text-sm">{{ $course->title }}</td>
                            <td class="py-3 px-4 text-sm text-slate-500">{{ $course->lecturer?->name ?? '—' }}</td>
                            <td class="py-3 px-4 text-sm text-slate-500">{{ $course->pivot->created_at?->format('d M Y') ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 px-4 text-center text-sm text-slate-500">This student is not registered for any course yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection