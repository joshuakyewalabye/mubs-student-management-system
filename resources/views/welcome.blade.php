<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome — MUBS Student Management</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] } } } };
    </script>
</head>
<body class="font-sans antialiased text-white">

    {{-- Full-screen background: the photo with a dark layer on top so the text stays readable.
         If campus.jpg is missing, the plain blue background colour shows instead. --}}
    <div class="min-h-screen bg-[#1e3a8a] bg-cover bg-center flex flex-col"
         style="background-image: linear-gradient(rgba(15, 23, 42, 0.65), rgba(15, 23, 42, 0.75)), url('{{ asset('assets/img/campus.jpg') }}');">

        <main class="flex-1 flex items-center justify-center px-4 py-10">
            <div class="w-full max-w-lg text-center">

                {{-- Logo on a white circle so it stays visible on the dark background --}}
                <div class="mx-auto mb-6 h-24 w-24 rounded-full bg-white flex items-center justify-center shadow-lg">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="MUBS logo" class="h-20 w-20 object-contain">
                </div>

                <h1 class="text-3xl sm:text-4xl font-bold">Welcome to MUBS</h1>
                <p class="mt-3 text-base sm:text-lg text-slate-200">Makerere University Business School Student Management System</p>
                <p class="mt-4 text-sm text-slate-300">Sign in to access your account, or create one if you are new here.</p>

                {{-- A logged-in visitor gets one button; a guest gets Sign in and Create account --}}
                <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-8 py-3 bg-[#2563eb] rounded-lg text-sm font-medium text-white hover:bg-[#1d4ed8]">Go to dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-8 py-3 bg-[#2563eb] rounded-lg text-sm font-medium text-white hover:bg-[#1d4ed8]">Sign in</a>
                        <a href="{{ route('register') }}" class="px-8 py-3 border border-white/70 rounded-lg text-sm font-medium text-white hover:bg-white/10">Create account</a>
                    @endauth
                </div>

            </div>
        </main>

        <footer class="py-4 text-center text-xs text-slate-300">&copy; {{ date('Y') }} Makerere University Business School</footer>
    </div>

</body>
</html>