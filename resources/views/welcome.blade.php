<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome — MUBS Student Management</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] } } } };
    </script>
</head>
<body class="font-sans antialiased text-white">

    {{-- Full-screen photo. Three layers sit on top of it, from top to bottom:
         1. a soft dark patch at the bottom edge, for the copyright line
         2. a dark oval in the centre that fades out toward the edges, for the text
         3. the photo itself (campus.png). If it is missing, the plain blue colour shows. --}}
    <div class="relative min-h-screen bg-[#1e3a8a] bg-cover bg-center flex items-center justify-center px-4 py-16"
         style="background-image:
            linear-gradient(to top, rgba(15, 23, 42, 0.55), rgba(15, 23, 42, 0) 18%),
            radial-gradient(ellipse at center, rgba(15, 23, 42, 0.62) 0%, rgba(15, 23, 42, 0.34) 55%, rgba(15, 23, 42, 0.12) 100%),
            url('{{ asset('assets/img/campus.png') }}');">

        {{-- The content group, centred horizontally and vertically by the flex container above --}}
        <main class="text-center">

            <img src="{{ asset('assets/img/logo.png') }}" alt="MUBS logo" class="mx-auto mb-5 h-24 sm:h-28 w-auto object-contain">

            <h1 class="text-3xl sm:text-5xl font-semibold tracking-tight text-white">Welcome to MUBS</h1>
            <p class="mt-3 text-base sm:text-lg text-white/85">
                Makerere University Business School<br>
                Student Management System
            </p>

            {{-- A logged-in visitor gets one button; a guest gets Sign in and Create account --}}
            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center items-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-8 py-3 rounded-full bg-[#2563eb] text-sm font-medium text-white hover:bg-[#1d4ed8]">Go to dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-8 py-3 rounded-full bg-[#2563eb] text-sm font-medium text-white hover:bg-[#1d4ed8]">Sign in</a>
                    <a href="{{ route('register') }}" class="px-8 py-3 rounded-full bg-white/15 ring-1 ring-white/30 backdrop-blur-md text-sm font-medium text-white hover:bg-white/25">Create account</a>
                @endauth
            </div>
        </main>

        {{-- Copyright line pinned to the bottom, so it does not shift the centred group --}}
        <footer class="absolute bottom-4 inset-x-0 text-center text-xs text-white/80">&copy; {{ date('Y') }} Makerere University Business School</footer>

    </div>

</body>
</html>