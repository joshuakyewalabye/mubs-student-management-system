@php
    // One place to define the sidebar links. To add a page later, add one line here.
    // 'route'  = the route name the link points to
    // 'match'  = the route pattern that should highlight the link ('students.*' covers index, create, edit)
    $mainLinks = [
        ['label' => 'Dashboard',     'icon' => 'layout-dashboard', 'route' => 'dashboard',           'match' => 'dashboard'],
        ['label' => 'Students',      'icon' => 'users',            'route' => 'students.index',      'match' => 'students.*'],
        ['label' => 'Courses',       'icon' => 'book-open',        'route' => 'courses.index',       'match' => 'courses.*'],
        ['label' => 'Registrations', 'icon' => 'clipboard-check',  'route' => 'registrations.index', 'match' => 'registrations.*'],
    ];
@endphp

<aside class="fixed top-0 left-0 z-40 w-64 h-screen pt-16 -translate-x-full peer-checked:translate-x-0 sm:translate-x-0 bg-white border-r border-slate-200 flex flex-col">
    <div class="flex-1 px-3 py-4 overflow-y-auto sidebar-scrollbar">

        <div class="space-y-1 mb-5">
            <p class="px-3 text-xs font-semibold text-slate-400 uppercase mb-2">Main</p>

            @foreach ($mainLinks as $link)
                @php $active = request()->routeIs($link['match']); @endphp

                {{-- Route::has() keeps the link safe: until a route exists, the link goes to '#' instead of crashing --}}
                <a href="{{ Route::has($link['route']) ? route($link['route']) : '#' }}"
                   class="sidebar-item border-l-3 flex items-center p-2 rounded-lg group text-sm transition-all duration-200 pl-3
                          {{ $active ? 'active border-[#2563eb] bg-blue-50 text-[#2563eb]' : 'border-transparent text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                    <i data-lucide="{{ $link['icon'] }}"
                       class="w-5 h-5 transition-colors {{ $active ? 'text-[#2563eb]' : 'text-slate-400 group-hover:text-[#2563eb]' }}"></i>
                    <span class="ms-3 text-sm font-medium">{{ $link['label'] }}</span>
                </a>
            @endforeach
        </div>

        <div class="space-y-1 mb-5">
            <p class="px-3 text-xs font-semibold text-slate-400 uppercase mb-2">Account</p>

            <a href="#" class="sidebar-item border-l-3 border-transparent text-slate-500 flex items-center p-2 rounded-lg hover:bg-slate-50 hover:text-slate-900 group text-sm transition-all duration-200 pl-3">
                <i data-lucide="user-cog" class="w-5 h-5 text-slate-400 group-hover:text-[#2563eb] transition-colors"></i>
                <span class="ms-3 text-sm font-medium">My Account</span>
            </a>
        </div>
    </div>

    {{-- User card (placeholder until authentication gives us the real user) --}}
    <div class="mt-auto border-t border-slate-200 p-4">
        <div class="flex items-center space-x-3 mb-3">
            <div class="relative">
                <div class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center bg-white text-sm font-semibold text-[#2563eb]">U</div>
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full"></div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-slate-900 truncate">User name</p>
                <p class="text-xs text-slate-500 truncate">user@mubs.ac.ug</p>
            </div>
        </div>
        <div class="flex items-center gap-2 px-3 py-2 bg-white rounded-lg border border-slate-200">
            <i data-lucide="graduation-cap" class="w-4 h-4 text-[#2563eb]"></i>
            <span class="text-xs font-semibold text-slate-800 uppercase tracking-wide">Role</span>
        </div>
    </div>
</aside>
