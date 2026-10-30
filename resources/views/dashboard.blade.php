@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @php
        // How each card type looks (icon + colours)
        $styles = [
            'students'      => ['users',          'bg-blue-50',    'text-[#2563eb]'],
            'courses'       => ['book-open',      'bg-amber-50',   'text-[#d97706]'],
            'lecturers'     => ['graduation-cap', 'bg-blue-50',    'text-[#2563eb]'],
            'registrations' => ['clipboard-check','bg-emerald-50', 'text-emerald-600'],
        ];
    @endphp

    {{-- Page heading --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">{{ $heading }}</h1>
        <p class="text-slate-500 mt-1">{{ $subtitle }}</p>
    </div>

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
        @foreach ($cards as $card)
            @php [$icon, $bg, $text] = $styles[$card['type']]; @endphp
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg {{ $bg }} flex items-center justify-center"><i data-lucide="{{ $icon }}" class="w-5 h-5 {{ $text }}"></i></div>
                    <div><p class="text-2xl font-bold">{{ $card['value'] }}</p><p class="text-sm text-slate-500">{{ $card['label'] }}</p></div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Recent registrations --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4">
        <h2 class="text-lg font-semibold">{{ $tableTitle }}</h2>
        @can('create registrations')
            <a href="{{ route('registrations.create') }}" class="inline-flex items-center px-4 py-2 bg-[#2563eb] rounded-lg text-sm font-medium text-white hover:bg-[#1d4ed8]">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>New registration
            </a>
        @endcan
    </div>

    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50">
                        @if ($showStudent)
                            <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Student</th>
                        @endif
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Course</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-slate-500">Registered on</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registrations as $registration)
                        <tr class="border-b border-slate-200 hover:bg-slate-50">
                            @if ($showStudent)
                                <td class="py-3 px-4 text-sm">{{ $registration->student->name }}</td>
                            @endif
                            <td class="py-3 px-4 text-sm text-slate-500">{{ $registration->course->code }} · {{ $registration->course->title }}</td>
                            <td class="py-3 px-4 text-sm text-slate-500">{{ $registration->created_at?->format('d M Y') ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-6 px-4 text-center text-sm text-slate-500">No registrations to show yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection