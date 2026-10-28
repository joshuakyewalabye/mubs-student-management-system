@extends('layouts.app')

@section('title', 'Registrations')

@section('content')

    {{-- Page heading --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-xl font-semibold">Course registrations</h1>
            <p class="text-sm text-slate-500 mt-1">See which students are registered for which courses.</p>
        </div>
        <a href="{{ route('registrations.create') }}" class="inline-flex items-center px-4 py-2 bg-[#2563eb] rounded-lg text-sm font-medium text-white hover:bg-[#1d4ed8]">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>New registration
        </a>
    </div>

    {{-- Filters --}}
    <form action="{{ route('registrations.index') }}" method="get" class="bg-white border border-slate-200 rounded-xl p-4 mb-6 grid grid-cols-1 sm:grid-cols-3 gap-3 shadow-sm">
        <input type="search" name="q" value="{{ request('q') }}" class="input-field sm:col-span-2" placeholder="Search by student or course">
        <button type="submit" class="px-4 py-2.5 bg-[#2563eb] rounded-xl text-sm font-medium text-white hover:bg-[#1d4ed8]">Search</button>
    </form>

    {{-- Registrations table --}}
    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px]">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50">
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Student</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Student number</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Course</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Registered on</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-slate-500">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Placeholder rows. These become a @foreach over real registrations once the models exist. --}}
                    @foreach ([1, 2, 3] as $row)
                        <tr class="border-b border-slate-200 hover:bg-slate-50">
                            <td class="py-3 px-4 text-sm">Student name</td>
                            <td class="py-3 px-4 text-sm text-slate-500">24/U/0000</td>
                            <td class="py-3 px-4 text-sm">BUC0000 · Course title</td>
                            <td class="py-3 px-4 text-sm text-slate-500">—</td>
                            <td class="py-3 px-4 text-center">
                                <form action="{{ route('registrations.destroy', $row) }}" method="POST" class="inline" onsubmit="return confirm('Remove this registration?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[#d97706]" title="Remove"><i data-lucide="trash-2" class="w-4 h-4 inline"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
