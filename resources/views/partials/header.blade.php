<header class="w-full bg-white/70 backdrop-blur-md shadow-sm py-4 px-6 md:px-10 sticky top-0 z-10">
    <div class="w-full mx-auto flex justify-between items-center">
        <a href="{{ route('home') }}" class="header-logo">TrueUnion</a>
        <nav class="hidden md:flex items-center space-x-6">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">{{ __('Home') }}</a>
            <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">{{ __('About') }}</a>
            <a href="{{ route('membership') }}" class="nav-link {{ request()->routeIs('membership') ? 'active' : '' }}">{{ __('Membership') }}</a>
            <a href="{{ route('search') }}" class="nav-link {{ request()->routeIs('search') ? 'active' : '' }}">{{ __('Search') }}</a>
            <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">{{ __('Contact') }}</a>
        </nav>
        <div class="flex items-center space-x-3">
            {{-- Language Switcher Dropdown --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">
                    <span>{{ strtoupper(app()->getLocale()) }}</span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-32 bg-white rounded-lg shadow-xl z-20" style="display: none;">
                    <a href="{{ route('language.switch', 'en') }}" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">English</a>
                    <a href="{{ route('language.switch', 'hi') }}" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">हिन्दी</a>
                    <a href="{{ route('language.switch', 'gu') }}" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">ગુજરાતી</a>
                </div>
            </div>

            @auth
                {{-- User is logged in --}}
                <a href="{{ route('dashboard') }}" class="hidden sm:inline-block bg-indigo-100 text-indigo-600 px-4 py-2 rounded-lg font-semibold hover:bg-indigo-200 transition">{{ __('Dashboard') }}</a>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-block bg-red-100 text-red-600 px-4 py-2 rounded-lg font-semibold hover:bg-red-200 transition">{{ __('Admin Panel') }}</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="hidden sm:inline-block">
                    @csrf
                    <button type="submit" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">{{ __('Logout') }}</button>
                </form>
            @else
                {{-- User is a guest --}}
                <a href="{{ route('signup') }}" class="hidden sm:inline-block bg-indigo-100 text-indigo-600 px-4 py-2 rounded-lg font-semibold hover:bg-indigo-200 transition">{{ __('Sign Up') }}</a>
                <a href="{{ route('login') }}" class="hidden sm:inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">{{ __('Login') }}</a>
            @endauth
        </div>
    </div>
</header>

{{-- Add Alpine.js for dropdown functionality --}}
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

