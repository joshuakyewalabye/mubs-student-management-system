@extends('layouts.app')

@section('title', 'Courses')

@section('content')

    {{-- Page heading --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-xl font-semibold">Courses</h1>
            <p class="text-sm text-slate-500 mt-1">
                @can('create courses')
                    Create, update and manage the courses offered.
                @elsecan('view courses')
                    Browse the courses offered.
                @else
                    The courses assigned to you.
                @endcan
            </p>
        </div>
        @can('create courses')
            <a href="{{ route('courses.create') }}" class="inline-flex items-center px-4 py-2 bg-[#2563eb] rounded-lg text-sm font-medium text-white hover:bg-[#1d4ed8]">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>Add course
            </a>
        @endcan
    </div>

    {{-- Filters --}}
    <form action="{{ route('courses.index') }}" method="get" class="bg-white border border-slate-200 rounded-xl p-4 mb-6 grid grid-cols-1 sm:grid-cols-3 gap-3 shadow-sm">
        <input type="search" name="q" value="{{ request('q') }}" class="input-field sm:col-span-2" placeholder="Search by course code or title">
        <button type="submit" class="px-4 py-2.5 bg-[#2563eb] rounded-xl text-sm font-medium text-white hover:bg-[#1d4ed8]">Search</button>
    </form>

    {{-- Courses table --}}
    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px]">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50">
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Code</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Title</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Credits</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Lecturer</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Students</th>
                        @canany(['edit courses', 'delete courses'])
                            <th class="py-3 px-4 text-center text-sm font-semibold text-slate-500">Actions</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                        <tr class="border-b border-slate-200 hover:bg-slate-50">
                            <td class="py-3 px-4 text-sm font-medium">
                                <a href="{{ route('courses.show', $course) }}" class="text-[#2563eb] hover:underline">{{ $course->code }}</a>
                            </td>
                            <td class="py-3 px-4 text-sm">{{ $course->title }}</td>
                            <td class="py-3 px-4 text-sm text-slate-500">{{ $course->credits }}</td>
                            <td class="py-3 px-4 text-sm text-slate-500">{{ $course->lecturer?->name ?? '—' }}</td>
                            <td class="py-3 px-4"><span class="text-xs px-2 py-1 rounded-full bg-blue-50 text-[#2563eb]">{{ $course->students_count }} registered</span></td>
                            @canany(['edit courses', 'delete courses'])
                                <td class="py-3 px-4 text-center">
                                    <div class="inline-flex items-center gap-3">
                                        @can('edit courses')
                                            <a href="{{ route('courses.edit', $course) }}" class="text-[#2563eb]" title="Edit"><i data-lucide="edit" class="w-4 h-4 inline"></i></a>
                                        @endcan

                                        @can('delete courses')
                                            <form action="{{ route('courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Delete this course?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-[#d97706]" title="Delete"><i data-lucide="trash-2" class="w-4 h-4 inline"></i></button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            @endcanany
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 px-4 text-center text-sm text-slate-500">No courses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
