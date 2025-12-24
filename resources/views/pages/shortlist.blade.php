<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Shortlist & Favorites - Matrimony</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Theme Configuration -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ec3713",
                        "background-light": "#f8f6f6",
                        "background-dark": "#221310",
                        "surface-dark": "#2d1a17",
                        "surface-highlight": "#3a221f"
                    },
                    fontFamily: {
                        "display": ["Spline Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "1rem", 
                        "lg": "2rem", 
                        "xl": "3rem", 
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        /* Custom scrollbar for sidebar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #3a221f;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #ec3713;
        }
        
        .hover-card-trigger:hover .hover-action-reveal {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-background-light dark:bg-background-dark text-gray-900 dark:text-white font-display overflow-x-hidden selection:bg-primary selection:text-white">
    <div class="flex flex-1 overflow-hidden">
        @include('partials.user-sidebar')
        
        <div class="flex min-h-screen relative flex-1 lg:ml-80">
        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col min-h-screen relative p-6 lg:p-12 xl:p-16">
            <div class="max-w-[1200px] mx-auto w-full flex flex-col gap-10 pb-24">
                <!-- Header & Stats -->
                <header class="flex flex-wrap items-end justify-between gap-8">
                    <div class="flex flex-col gap-2 max-w-xl">
                        <h2 class="text-5xl md:text-6xl lg:text-7xl font-black text-white tracking-tighter leading-[0.9]">
                            Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-orange-500">Shortlist.</span>
                        </h2>
                        <p class="text-gray-400 text-lg font-light mt-2 max-w-md">Candidates you've saved for a closer look. Connect with them before they find someone else.</p>
                    </div>
                    <!-- Stats Cards -->
                    <div class="flex gap-4">
                        <div class="flex flex-col justify-center px-6 py-4 rounded-xl bg-surface-dark border border-white/5 min-w-[140px]">
                            <p class="text-gray-400 text-sm font-medium uppercase tracking-wider">Saved</p>
                            <div class="flex items-baseline gap-1">
                                <span class="text-4xl font-bold text-white">{{ $totalCount }}</span>
                                <span class="text-sm text-gray-500">profiles</span>
                            </div>
                        </div>
                        <div class="flex flex-col justify-center px-6 py-4 rounded-xl bg-surface-dark border border-primary/20 min-w-[140px] relative overflow-hidden">
                            <div class="absolute -right-4 -top-4 size-16 bg-primary/10 rounded-full blur-xl"></div>
                            <p class="text-primary text-sm font-medium uppercase tracking-wider">Mutual</p>
                            <div class="flex items-baseline gap-1">
                                <span class="text-4xl font-bold text-white">{{ $mutualCount }}</span>
                                <span class="text-sm text-gray-500">favorites</span>
                            </div>
                        </div>
                    </div>
                </header>
                
                <!-- Filters / Chips -->
                <div class="flex flex-wrap items-center gap-3 py-2 overflow-x-auto no-scrollbar">
                    <button class="h-10 px-6 rounded-full bg-white text-background-dark font-bold text-sm border border-transparent hover:scale-105 transition-transform">
                        All Profiles
                    </button>
                    <button class="h-10 px-6 rounded-full bg-surface-dark text-gray-300 font-medium text-sm border border-white/10 hover:border-primary/50 hover:text-white transition-all">
                        Recently Added
                    </button>
                    <button class="h-10 px-6 rounded-full bg-surface-dark text-gray-300 font-medium text-sm border border-white/10 hover:border-primary/50 hover:text-white transition-all flex items-center gap-2">
                        <span class="size-2 rounded-full bg-green-500 animate-pulse"></span>
                        Online Now
                    </button>
                    <button class="h-10 px-6 rounded-full bg-surface-dark text-gray-300 font-medium text-sm border border-white/10 hover:border-primary/50 hover:text-white transition-all">
                        Most Compatible
                    </button>
                </div>
                
                <!-- Profile List (Placards) -->
                @if($shortlistedUsers->count() > 0)
                <div class="flex flex-col gap-6">
                    @foreach($shortlistedUsers as $profile)
                    <div class="group hover-card-trigger relative flex flex-col md:flex-row items-start md:items-center gap-6 p-5 rounded-xl md:rounded-[2.5rem] {{ $profile->isMutual ?? false ? 'bg-gradient-to-r from-[#3a1d18] to-surface-dark border border-primary/20 hover:border-primary/50' : 'bg-surface-dark border border-white/5 hover:border-primary/30 hover:bg-surface-highlight' }} transition-all duration-300 shadow-xl">
                        @if($profile->isMutual ?? false)
                        <!-- Special Tag for Mutual Favorite -->
                        <div class="absolute top-0 right-0 md:right-auto md:left-8 -mt-3 bg-gradient-to-r from-orange-500 to-primary text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full shadow-lg z-10">
                            Mutual Favorite
                        </div>
                        @endif
                        
                        <!-- Image -->
                        <div class="relative shrink-0 {{ $profile->isMutual ?? false ? 'mt-2 md:mt-0' : '' }}">
                            <div class="size-24 md:size-32 rounded-full bg-cover bg-center border-4 {{ $profile->isMutual ?? false ? 'border-primary/30 group-hover:border-primary/60' : 'border-background-dark group-hover:border-primary/20' }} transition-colors duration-300" 
                                 style="background-image: url('{{ $profile->profile_image ? asset('storage/' . $profile->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($profile->full_name) . '&size=400&background=ec3713&color=fff' }}');">
                            </div>
                            <div class="absolute bottom-1 right-1 bg-background-dark p-1 rounded-full">
                                @if($profile->isMutual ?? false)
                                <div class="bg-primary text-white text-[10px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-lg shadow-primary/40">
                                    <span class="material-symbols-outlined text-[10px]">favorite</span> Match
                                </div>
                                @else
                                <div class="{{ ($profile->matchPercentage ?? 95) >= 90 ? 'bg-primary' : 'bg-gray-700' }} text-white text-[10px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[10px]">verified</span> {{ $profile->matchPercentage ?? 95 }}%
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="flex-1 min-w-0 flex flex-col gap-2">
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                                <h3 class="text-2xl md:text-3xl font-bold text-white group-hover:text-primary transition-colors">
                                    <a href="{{ route('profile.view', $profile->id) }}">{{ $profile->full_name }}, {{ $profile->age ?? 'N/A' }}</a>
                                </h3>
                                @if($profile->marital_status)
                                <span class="px-3 py-1 rounded-full bg-white/5 text-gray-400 text-xs font-medium border border-white/5">{{ $profile->marital_status }}</span>
                                @endif
                                @if($profile->height)
                                <span class="px-3 py-1 rounded-full bg-white/5 text-gray-400 text-xs font-medium border border-white/5">{{ $profile->height }}</span>
                                @endif
                            </div>
                            @if($profile->occupation)
                            <p class="text-lg text-gray-300 font-medium">{{ $profile->occupation }}</p>
                            @endif
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                @if($profile->location)
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">location_on</span> 
                                    {{ $profile->location }}
                                </span>
                                @endif
                                @if($profile->mother_tongue)
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">translate</span> 
                                    {{ $profile->mother_tongue }}
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex flex-row md:flex-col lg:flex-row items-center gap-3 w-full md:w-auto mt-2 md:mt-0">
                            @if($profile->canChat ?? false)
                            <a href="#" class="flex-1 md:flex-none h-12 px-6 rounded-full bg-white text-primary font-bold text-sm hover:bg-gray-100 transition-colors flex items-center justify-center gap-2 shadow-lg transform hover:-translate-y-0.5 active:translate-y-0">
                                <span class="material-symbols-outlined text-[20px]">chat</span>
                                <span>Message</span>
                            </a>
                            @else
                            <form action="{{ route('profile.send-interest', $profile) }}" method="POST" class="flex-1 md:flex-none">
                                @csrf
                                <button type="submit" class="w-full h-12 px-6 rounded-full bg-primary text-white font-bold text-sm hover:bg-red-600 transition-colors flex items-center justify-center gap-2 shadow-[0_4px_20px_rgba(236,55,19,0.3)] hover:shadow-[0_4px_25px_rgba(236,55,19,0.5)] transform hover:-translate-y-0.5 active:translate-y-0">
                                    <span class="material-symbols-outlined text-[20px]">favorite</span>
                                    <span>Connect</span>
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('profile.toggle-shortlist', $profile) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" aria-label="Remove from shortlist" class="size-12 rounded-full border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 hover:border-white/30 transition-all">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                            </form>
                            <a href="{{ route('profile.view', $profile) }}" aria-label="View Profile" class="size-12 rounded-full border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 hover:border-white/30 transition-all md:hidden xl:flex">
                                <span class="material-symbols-outlined">arrow_outward</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="size-24 bg-surface-dark rounded-full flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-5xl text-gray-500">star_border</span>
                    </div>
                    <h3 class="text-white text-2xl font-bold mb-2">Your shortlist is empty</h3>
                    <p class="text-gray-400 max-w-md mb-8">Start exploring profiles and add them to your shortlist to keep track of your favorites.</p>
                    <a href="{{ route('matches') }}" class="bg-primary text-white px-8 py-3 rounded-full font-bold hover:bg-red-600 transition-colors">
                        Browse Matches
                    </a>
                </div>
                @endif
                
                @if($shortlistedUsers->count() > 0)
                <!-- Footer / Load More -->
                <div class="flex justify-center mt-8">
                    <p class="text-gray-500 text-sm">You've reached the end of your shortlist.</p>
                </div>
                @endif
            </div>
        </main>
        </div>
    </div>
</body>
</html>

