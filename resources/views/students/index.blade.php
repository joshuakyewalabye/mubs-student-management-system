@extends('layouts.app')

@section('title', 'Students')

@section('content')

    {{-- Page heading --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-xl font-semibold">Students</h1>
            <p class="text-sm text-slate-500 mt-1">
                @can('create students')
                    Register, update and manage student records.
                @else
                    Browse the student records.
                @endcan
            </p>
        </div>
        @can('create students')
            <a href="{{ route('students.create') }}" class="inline-flex items-center px-4 py-2 bg-[#2563eb] rounded-lg text-sm font-medium text-white hover:bg-[#1d4ed8]">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>Add student
            </a>
        @endcan
    </div>

    {{-- Filters --}}
    <form action="{{ route('students.index') }}" method="get" class="bg-white border border-slate-200 rounded-xl p-4 mb-6 grid grid-cols-1 sm:grid-cols-3 gap-3 shadow-sm">
        <input type="search" name="q" value="{{ request('q') }}" class="input-field sm:col-span-2" placeholder="Search by name, student number or email">
        <button type="submit" class="px-4 py-2.5 bg-[#2563eb] rounded-xl text-sm font-medium text-white hover:bg-[#1d4ed8]">Search</button>
    </form>

    {{-- Students table --}}
    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px]">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50">
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Student number</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Name</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Email</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Courses</th>
                        @canany(['edit students', 'delete students'])
                            <th class="py-3 px-4 text-center text-sm font-semibold text-slate-500">Actions</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr class="border-b border-slate-200 hover:bg-slate-50">
                            <td class="py-3 px-4 text-sm">{{ $student->student_number }}</td>
                            <td class="py-3 px-4 text-sm">{{ $student->name }}</td>
                            <td class="py-3 px-4 text-sm text-slate-500">{{ $student->email }}</td>
                            <td class="py-3 px-4"><span class="text-xs px-2 py-1 rounded-full bg-blue-50 text-[#2563eb]">{{ $student->courses_count }} registered</span></td>
                            @canany(['edit students', 'delete students'])
                                <td class="py-3 px-4 text-center">
                                    <div class="inline-flex items-center gap-3">
                                        @can('edit students')
                                            <a href="{{ route('students.edit', $student) }}" class="text-[#2563eb]" title="Edit"><i data-lucide="edit" class="w-4 h-4 inline"></i></a>
                                        @endcan

                                        {{-- Delete must be a form: browsers can only send GET and POST,
                                             so @method('DELETE') tells Laravel it is really a DELETE. --}}
                                        @can('delete students')
                                            <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Delete this student and their registrations?');">
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
                            <td colspan="5" class="py-6 px-4 text-center text-sm text-slate-500">No students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection