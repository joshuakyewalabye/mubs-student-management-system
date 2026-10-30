<header class="fixed top-0 z-50 w-full bg-white border-b border-slate-200">
    <div class="px-2 py-2 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">

            {{-- Brand + mobile menu button --}}
            <div class="flex items-center">
                <label for="sidebar-toggle" class="inline-flex items-center p-2 text-slate-500 rounded-lg sm:hidden hover:bg-slate-100 cursor-pointer">
                    <span class="sr-only">Open sidebar</span>
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </label>
                <a href="{{ route('dashboard') }}" class="flex items-center ms-2 md:me-8">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="MUBS Student Management" class="h-10 w-10 me-3">
                    <div class="flex flex-col">
                        <span class="font-semibold text-slate-900 text-base">MUBS Student Management</span>
                        <span class="text-xs text-slate-500">Makerere University Business School</span>
                    </div>
                </a>
            </div>

            {{-- User menu --}}
            <div class="flex items-center space-x-3">
                <details class="menu-dropdown relative">
                    <summary class="flex items-center gap-2 bg-slate-50 rounded-lg p-1 text-sm border border-slate-200 hover:bg-slate-100 cursor-pointer list-none">
                        <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-[#2563eb] border border-blue-100 text-xs font-semibold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                        <div class="hidden md:block text-left mr-1">
                            <div class="text-xs font-medium text-slate-900">{{ Auth::user()->name }}</div>
                            <div class="text-[10px] text-slate-500">{{ ucfirst(Auth::user()->getRoleNames()->first() ?? 'No role') }}</div>
                        </div>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                    </summary>
                    <div class="absolute right-0 mt-2 w-56 bg-white border border-slate-200 rounded-lg shadow-lg z-50">
                        <div class="px-4 py-3 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-slate-600 hover:bg-slate-50"><i data-lucide="user" class="w-4 h-4 mr-2"></i>My Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-200">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-[#d97706] hover:bg-slate-50">
                                <i data-lucide="log-out" class="w-4 h-4 mr-2"></i>Sign out
                            </button>
                        </form>
                    </div>
                </details>
            </div>

        </div>
    </div>
</header>