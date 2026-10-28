@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    {{-- Page heading --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Welcome to the Student Management System</h1>
        <p class="text-slate-500 mt-1">Manage students, courses, lecturers and course registrations in one place.</p>
    </div>

    {{-- Stats cards (values are placeholders until we query the database) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center"><i data-lucide="users" class="w-5 h-5 text-[#2563eb]"></i></div>
                <div><p class="text-2xl font-bold">0</p><p class="text-sm text-slate-500">Students</p></div>
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center"><i data-lucide="book-open" class="w-5 h-5 text-[#d97706]"></i></div>
                <div><p class="text-2xl font-bold">0</p><p class="text-sm text-slate-500">Courses</p></div>
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center"><i data-lucide="graduation-cap" class="w-5 h-5 text-[#2563eb]"></i></div>
                <div><p class="text-2xl font-bold">0</p><p class="text-sm text-slate-500">Lecturers</p></div>
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center"><i data-lucide="clipboard-check" class="w-5 h-5 text-emerald-600"></i></div>
                <div><p class="text-2xl font-bold">0</p><p class="text-sm text-slate-500">Registrations</p></div>
            </div>
        </div>
    </div>

    {{-- Recent course registrations --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4">
        <h2 class="text-lg font-semibold">Recent course registrations</h2>
        <a href="#" class="inline-flex items-center px-4 py-2 bg-[#2563eb] rounded-lg text-sm font-medium text-white hover:bg-[#1d4ed8]">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>New registration
        </a>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50">
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Student</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Course</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Registered on</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-slate-500">View</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Placeholder rows. These become a @foreach over real registrations later. --}}
                    <tr class="border-b border-slate-200 hover:bg-slate-50">
                        <td class="py-3 px-4 text-sm">Student name</td>
                        <td class="py-3 px-4 text-sm text-slate-500">Course name</td>
                        <td class="py-3 px-4 text-sm text-slate-500">—</td>
                        <td class="py-3 px-4 text-center"><a href="#" class="text-[#2563eb]"><i data-lucide="eye" class="w-4 h-4 inline"></i></a></td>
                    </tr>
                    <tr class="border-b border-slate-200 hover:bg-slate-50">
                        <td class="py-3 px-4 text-sm">Student name</td>
                        <td class="py-3 px-4 text-sm text-slate-500">Course name</td>
                        <td class="py-3 px-4 text-sm text-slate-500">—</td>
                        <td class="py-3 px-4 text-center"><a href="#" class="text-[#2563eb]"><i data-lucide="eye" class="w-4 h-4 inline"></i></a></td>
                    </tr>
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-4 text-sm">Student name</td>
                        <td class="py-3 px-4 text-sm text-slate-500">Course name</td>
                        <td class="py-3 px-4 text-sm text-slate-500">—</td>
                        <td class="py-3 px-4 text-center"><a href="#" class="text-[#2563eb]"><i data-lucide="eye" class="w-4 h-4 inline"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
