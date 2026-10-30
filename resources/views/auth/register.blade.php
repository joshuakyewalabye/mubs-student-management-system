@extends('layouts.guest')

@section('title', 'Create account')

@section('content')

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-200">
            <h1 class="text-xl font-semibold">Create account</h1>
            <p class="text-sm text-slate-500 mt-1">Register to view available courses and your registrations.</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="p-6 space-y-5">

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-600 mb-2">Full name</label>
                    <input id="name" name="name" type="text" class="input-field @error('name') border-red-400 @enderror"
                           placeholder="Full name" value="{{ old('name') }}" autofocus>
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-600 mb-2">Email</label>
                    <input id="email" name="email" type="email" class="input-field @error('email') border-red-400 @enderror"
                           placeholder="name@mubs.ac.ug" value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-600 mb-2">Password</label>
                    <div class="relative">
                        <input id="password" name="password" type="password" class="input-field pr-12 @error('password') border-red-400 @enderror"
                               placeholder="At least 8 characters">
                        <button type="button" data-password-toggle aria-controls="password" aria-label="Show password"
                                class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-500 hover:text-slate-700">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-600 mb-2">Confirm password</label>
                    <div class="relative">
                        <input id="password_confirmation" name="password_confirmation" type="password" class="input-field pr-12"
                               placeholder="Repeat the password">
                        <button type="button" data-password-toggle aria-controls="password_confirmation" aria-label="Show password"
                                class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-500 hover:text-slate-700">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

            </div>

            <div class="px-6 py-4 border-t border-slate-200">
                <button type="submit" class="w-full px-4 py-2.5 bg-[#2563eb] rounded-lg text-sm font-medium text-white hover:bg-[#1d4ed8]">Create account</button>
            </div>
        </form>
    </div>

    <p class="text-sm text-slate-500 text-center mt-5">
        Already have an account? <a href="{{ route('login') }}" class="text-[#2563eb] font-medium hover:underline">Sign in</a>
    </p>

@endsection
