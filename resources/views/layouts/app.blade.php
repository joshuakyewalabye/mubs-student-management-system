<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — MUBS Student Management</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/logo.png') }}">

    {{-- Inter font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Tailwind (CDN, same as the template) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] } } } };
    </script>

    {{-- Template's own CSS: border-l-3, input-field, menu-dropdown, scrollbar --}}
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    {{-- Lucide icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-white text-slate-900 font-sans antialiased min-h-screen">

    {{-- Sidebar toggle (checkbox, no JavaScript).
         Must stay here as a sibling of the header and sidebar, because
         the template's "peer-checked" classes only work between siblings. --}}
    <input type="checkbox" id="sidebar-toggle" class="peer hidden">
    <label for="sidebar-toggle" class="fixed inset-0 bg-slate-900/30 z-30 hidden peer-checked:block sm:!hidden"></label>

    @include('partials.header')
    @include('partials.sidebar')

    <div class="pt-16 sm:pl-64 min-h-screen flex flex-col">
        <main class="flex-1 pb-8 px-4 sm:px-8 lg:px-10 pt-6">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
