<header class="w-full bg-white/70 backdrop-blur-md shadow-sm py-4 px-6 md:px-10 sticky top-0 z-10">
    <div class="w-full mx-auto flex justify-between items-center">
        <a href="{{ route('home') }}" class="header-logo">TrueUnion</a>
        <nav class="hidden md:flex items-center space-x-6">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('membership') }}" class="nav-link {{ request()->routeIs('membership') ? 'active' : '' }}">Membership</a>
            <a href="{{ route('search') }}" class="nav-link {{ request()->routeIs('search') ? 'active' : '' }}">Search</a>
            <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        </nav>
        <div class="flex items-center space-x-3">
            @auth
                {{-- If user is logged in --}}
                <a href="{{ route('dashboard') }}" class="bg-indigo-100 text-indigo-600 px-4 py-2 rounded-lg font-semibold hover:bg-indigo-200 transition">Dashboard</a>
                
                {{-- Show Admin Panel link only if user is an admin --}}
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="bg-red-100 text-red-600 px-4 py-2 rounded-lg font-semibold hover:bg-red-200 transition">Admin Panel</a>
                @endif
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">Logout</button>
                </form>
            @else
                {{-- If user is a guest --}}
                <a href="{{ route('signup') }}" class="bg-indigo-100 text-indigo-600 px-4 py-2 rounded-lg font-semibold hover:bg-indigo-200 transition">Sign Up</a>
                <a href="{{ route('login') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">Login</a>
            @endauth
        </div>
    </div>
</header>
