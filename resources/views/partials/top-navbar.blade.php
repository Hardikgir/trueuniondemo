<!-- Top Navbar -->
<header class="sticky top-0 z-50 flex items-center justify-between border-b border-solid border-b-[#392b28]/50 bg-[#181211]/80 backdrop-blur-md px-6 py-4 lg:px-20">
    <div class="flex items-center gap-4 text-white">
        <a href="{{ route('home') }}" class="flex items-center gap-4 text-white">
            <div class="size-8 text-primary">
                <span class="material-symbols-outlined !text-[32px]">favorite</span>
            </div>
            <h2 class="text-white text-xl font-bold leading-tight tracking-[-0.015em]">TrueUnion</h2>
        </a>
    </div>
    <div class="hidden lg:flex flex-1 justify-center gap-8">
        <nav class="flex items-center gap-9">
            <a class="text-white/80 hover:text-primary transition-colors text-sm font-medium leading-normal {{ request()->routeIs('home') ? 'text-white border-b-2 border-primary pb-0.5' : '' }}" href="{{ route('home') }}">Home</a>
            <a class="text-white/80 hover:text-primary transition-colors text-sm font-medium leading-normal {{ request()->routeIs('about') ? 'text-white border-b-2 border-primary pb-0.5' : '' }}" href="{{ route('about') }}">About Us</a>
            <a class="text-white/80 hover:text-primary transition-colors text-sm font-medium leading-normal {{ request()->routeIs('success-stories') ? 'text-white border-b-2 border-primary pb-0.5' : '' }}" href="{{ route('success-stories') }}">Success Stories</a>
            <a class="text-white/80 hover:text-primary transition-colors text-sm font-medium leading-normal {{ request()->routeIs('membership') ? 'text-white border-b-2 border-primary pb-0.5' : '' }}" href="{{ route('membership') }}">Membership</a>
        </nav>
    </div>
    <div class="flex items-center gap-4">
        @auth
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-white hover:text-primary transition-colors">
                <div class="size-8 rounded-full bg-cover bg-center border-2 border-primary" style="background-image: url('{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->full_name) . '&background=ec3713&color=fff' }}');"></div>
            </a>
        @else
            <a href="{{ route('login') }}" class="flex cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-6 bg-primary hover:bg-red-600 transition-colors text-white text-sm font-bold leading-normal tracking-[0.015em]">
                <span class="truncate">Login</span>
            </a>
        @endauth
    </div>
</header>

