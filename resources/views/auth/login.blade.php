@extends('layouts.guest')

@section('title', 'Sign in')

@section('content')

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-200">
            <h1 class="text-xl font-semibold">Sign in</h1>
            <p class="text-sm text-slate-500 mt-1">Enter your email and password to continue.</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="p-6 space-y-5">

                {{-- Message when the email or password is wrong --}}
                @if (session('error'))
                    <div class="px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700">{{ session('error') }}</div>
                @endif

                {{-- Message after logging out or registering --}}
                @if (session('success'))
                    <div class="px-4 py-3 rounded-lg bg-emerald-50 border border-emerald-200 text-sm text-emerald-700">{{ session('success') }}</div>
                @endif

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-600 mb-2">Email</label>
                    <input id="email" name="email" type="email" class="input-field @error('email') border-red-400 @enderror"
                           placeholder="name@mubs.ac.ug" value="{{ old('email') }}" autofocus>
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-600 mb-2">Password</label>
                    <div class="relative">
                        <input id="password" name="password" type="password" class="input-field pr-12 @error('password') border-red-400 @enderror"
                               placeholder="Your password">
                        <button type="button" data-password-toggle aria-controls="password" aria-label="Show password"
                                class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-500 hover:text-slate-700">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300">
                    Remember me
                </label>

            </div>

            <div class="px-6 py-4 border-t border-slate-200">
                <button type="submit" class="w-full px-4 py-2.5 bg-[#2563eb] rounded-lg text-sm font-medium text-white hover:bg-[#1d4ed8]">Sign in</button>
            </div>
        </form>
    </div>

    <p class="text-sm text-slate-500 text-center mt-5">
        New here? <a href="{{ route('register') }}" class="text-[#2563eb] font-medium hover:underline">Create an account</a>
    </p>

@endsection
