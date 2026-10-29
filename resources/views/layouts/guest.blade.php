<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sign in') — MUBS Student Management</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] } } } };
    </script>

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased min-h-screen">

    {{-- Guest layout: no sidebar or header, used for login and register only. --}}
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10">

        <div class="flex items-center gap-3 mb-6">
          <img src="{{ asset('assets/img/logo.png') }}" alt="MUBS logo" class="h-20 w-auto">
            <span class="text-lg font-bold">MUBS Student Management</span>
        </div>

        <div class="w-full max-w-md">
            @yield('content')
        </div>

        <p class="text-xs text-slate-500 mt-6">&copy; {{ date('Y') }} Makerere University Business School</p>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
