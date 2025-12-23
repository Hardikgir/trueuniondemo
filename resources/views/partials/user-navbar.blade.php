<!-- Common User Navbar -->
<header class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-b-card-border bg-background-dark/95 backdrop-blur-md px-4 lg:px-10 py-3">
    <div class="flex items-center gap-8">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-4 text-white cursor-pointer">
            <div class="size-8 text-primary">
                <span class="material-symbols-outlined text-3xl">diversity_1</span>
            </div>
            <h2 class="text-white text-xl font-bold leading-tight tracking-[-0.015em]">Matrimony</h2>
        </a>
        <nav class="hidden lg:flex items-center gap-9">
            <a class="text-sm font-medium leading-normal transition-colors {{ request()->routeIs('dashboard') ? 'text-white font-bold' : 'text-text-muted hover:text-white' }}" href="{{ route('dashboard') }}">Dashboard</a>
            <a class="text-sm font-medium leading-normal transition-colors {{ request()->routeIs('matches') ? 'text-white font-bold' : 'text-text-muted hover:text-white' }}" href="{{ route('matches') }}">Matches</a>
            <a class="text-sm font-medium leading-normal transition-colors {{ request()->routeIs('requests') ? 'text-white font-bold' : 'text-text-muted hover:text-white' }}" href="{{ route('requests') }}">Inbox</a>
            <a class="text-sm font-medium leading-normal transition-colors {{ request()->routeIs('profile.edit') || request()->routeIs('profile.view') ? 'text-white font-bold' : 'text-text-muted hover:text-white' }}" href="{{ route('profile.edit') }}">Profile</a>
        </nav>
    </div>
    <div class="flex flex-1 justify-end gap-6 items-center">
        <div class="hidden md:flex w-full max-w-xs items-center rounded-full bg-surface-dark h-10 px-4 ring-1 ring-border-dark focus-within:ring-primary transition-all">
            <span class="material-symbols-outlined text-text-muted text-[20px]">search</span>
            <input class="w-full bg-transparent border-none text-white placeholder:text-text-muted focus:ring-0 text-sm ml-2" placeholder="Search by ID or Keyword"/>
        </div>
        <a href="{{ route('membership') }}" class="flex items-center justify-center rounded-full h-10 px-6 bg-primary text-white text-sm font-bold hover:bg-red-600 transition-colors shadow-[0_0_15px_rgba(236,55,19,0.3)]">
            Upgrade
        </a>
        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 border-2 border-card-border cursor-pointer relative" 
             style='background-image: url("{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->full_name) . '&background=ec3713&color=fff' }}");'>
            <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-background-dark"></div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-text-muted hover:text-white text-sm font-medium transition-colors">Logout</button>
        </form>
    </div>
</header>

