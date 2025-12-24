<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard - Matrimony</title>
    <!-- Google Fonts: Newsreader and Material Symbols -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet"/>
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
                        "primary-dark": "#c52b0d",
                        "background-light": "#f8f6f6",
                        "background-dark": "#181211",
                        "surface-dark": "#271d1c",
                        "surface-border": "#392b28",
                        "text-muted": "#b9a19d",
                        "text-secondary": "#b9a19d",
                    },
                    fontFamily: {
                        "display": ["Newsreader", "serif"],
                        "sans": ["Newsreader", "serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.375rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem", 
                        "2xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Newsreader', serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #221310;
        }
        ::-webkit-scrollbar-thumb {
            background: #392b28;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #ec3713;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-background-light dark:bg-background-dark min-h-screen flex flex-col overflow-x-hidden text-white selection:bg-primary selection:text-white">
    <div class="flex flex-1 overflow-hidden">
        @include('partials.user-sidebar')
        
        <!-- Main Layout -->
        <main class="flex-1 h-full overflow-y-auto relative flex flex-col lg:ml-80">
            <div class="flex-1 w-full max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-10 py-8">
        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-green-500/20 border border-green-500 text-green-300 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Header & Filters -->
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-8">
            <div class="flex flex-col gap-2">
                <p class="text-white text-5xl font-black italic tracking-tight font-display">Curated for You</p>
                <p class="text-text-muted text-lg font-light">Daily matches tailored to your preferences.</p>
            </div>
            <!-- Filter Chips -->
            <div class="flex gap-3 flex-wrap">
                @if($user->dob)
                    <button class="group flex h-9 items-center gap-2 rounded-full border border-surface-border bg-transparent px-4 hover:bg-surface-border transition-colors">
                        <span class="text-white text-sm font-medium">Age {{ Carbon\Carbon::parse($user->dob)->age }}+</span>
                        <span class="material-symbols-outlined text-white text-[16px] group-hover:rotate-180 transition-transform">keyboard_arrow_down</span>
                    </button>
                @endif
                @if($user->city)
                    <button class="group flex h-9 items-center gap-2 rounded-full border border-surface-border bg-transparent px-4 hover:bg-surface-border transition-colors">
                        <span class="text-white text-sm font-medium">{{ $user->city }}</span>
                        <span class="material-symbols-outlined text-white text-[16px] group-hover:rotate-180 transition-transform">keyboard_arrow_down</span>
                    </button>
                @endif
                @if($user->caste)
                    <button class="group flex h-9 items-center gap-2 rounded-full border border-surface-border bg-transparent px-4 hover:bg-surface-border transition-colors">
                        <span class="text-white text-sm font-medium">{{ $user->caste }}</span>
                        <span class="material-symbols-outlined text-white text-[16px] group-hover:rotate-180 transition-transform">keyboard_arrow_down</span>
                    </button>
                @endif
                <a href="{{ route('matches') }}" class="flex h-9 items-center justify-center rounded-full bg-primary/10 text-primary hover:bg-primary hover:text-white px-4 text-sm font-bold transition-colors">
                    Filters
                </a>
            </div>
        </div>

        <!-- Featured Hero Match -->
        @if($featuredMatch)
        <div class="w-full mb-16 @container">
            <div class="relative flex flex-col md:flex-row bg-surface-dark rounded-2xl overflow-hidden shadow-2xl ring-1 ring-white/5 group">
                <!-- Large Image -->
                <div class="w-full md:w-5/12 aspect-[4/5] md:aspect-auto bg-cover bg-center relative" 
                     style='background-image: url("{{ $featuredMatch->profile_image ? asset('storage/' . $featuredMatch->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($featuredMatch->full_name) . '&size=400&background=ec3713&color=fff' }}");'>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent md:hidden"></div>
                </div>
                <!-- Content -->
                <div class="flex-1 p-8 md:p-12 flex flex-col justify-center relative">
                    <!-- Match Badge -->
                    <div class="absolute top-6 right-6 md:top-8 md:right-8">
                        <div class="relative flex items-center justify-center size-20 rounded-full border-4 border-primary/20 bg-background-dark/80 backdrop-blur">
                            <svg class="absolute inset-0 w-full h-full -rotate-90 text-primary" viewbox="0 0 36 36">
                                <path class="stroke-current" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke-dasharray="98, 100" stroke-width="3"></path>
                            </svg>
                            <span class="text-white font-bold text-lg">98%</span>
                        </div>
                    </div>
                    <div class="flex flex-col items-start gap-4 z-10">
                        <span class="bg-primary/20 text-primary text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest">Top Pick</span>
                        <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight">{{ $featuredMatch->full_name }}, {{ $featuredMatch->age ?? 'N/A' }}</h1>
                        <div class="flex flex-wrap gap-x-6 gap-y-2 text-lg text-text-muted italic">
                            @if($featuredMatch->occupation)
                            <span class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">work</span>
                                {{ $featuredMatch->occupation }}
                            </span>
                            @endif
                            @if($featuredMatch->city || $featuredMatch->state)
                            <span class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">location_on</span>
                                {{ $featuredMatch->city }}{{ $featuredMatch->state ? ', ' . $featuredMatch->state : '' }}
                            </span>
                            @endif
                        </div>
                        @if($featuredMatch->languages_known)
                        <p class="mt-4 text-gray-300 text-lg leading-relaxed max-w-xl font-light">
                            "{{ \Illuminate\Support\Str::limit($featuredMatch->languages_known, 150) }}"
                        </p>
                        @endif
                        <div class="flex flex-wrap gap-2 mt-2">
                            @if($featuredMatch->marital_status)
                            <span class="px-3 py-1 rounded bg-white/5 text-sm text-gray-300">{{ $featuredMatch->marital_status }}</span>
                            @endif
                            @if($featuredMatch->diet)
                            <span class="px-3 py-1 rounded bg-white/5 text-sm text-gray-300">{{ $featuredMatch->diet }}</span>
                            @endif
                            @if($featuredMatch->height)
                            <span class="px-3 py-1 rounded bg-white/5 text-sm text-gray-300">{{ $featuredMatch->height }}</span>
                            @endif
                            @if($featuredMatch->mother_tongue)
                            <span class="px-3 py-1 rounded bg-white/5 text-sm text-gray-300">{{ $featuredMatch->mother_tongue }}</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-4 mt-8 w-full md:w-auto">
                            <form method="POST" action="{{ route('profile.send-interest', $featuredMatch) }}" class="inline">
                                @csrf
                                <button type="submit" class="flex-1 md:flex-none h-12 px-8 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg flex items-center justify-center gap-2 transition-all transform hover:scale-105 shadow-lg shadow-primary/20">
                                    <span class="material-symbols-outlined">favorite</span>
                                    Send Interest
                                </button>
                            </form>
                            <a href="{{ route('profile.view', $featuredMatch) }}" class="size-12 rounded-lg border border-surface-border text-text-muted hover:text-white hover:bg-surface-border flex items-center justify-center transition-colors">
                                <span class="material-symbols-outlined">visibility</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Secondary Suggestions Grid -->
        @if($suggestions && $suggestions->count() > 0)
        <div class="flex flex-col gap-6">
            <div class="flex items-center justify-between px-2">
                <h2 class="text-3xl font-bold text-white tracking-tight">More Suggestions</h2>
                <a class="text-primary hover:text-white text-sm font-semibold flex items-center gap-1 transition-colors" href="{{ route('matches') }}">
                    View All <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($suggestions as $index => $suggestion)
                <div class="group relative flex flex-col bg-surface-dark rounded-xl overflow-hidden shadow-lg border border-white/5 hover:border-primary/50 transition-all duration-300 hover:-translate-y-1">
                    <div class="relative aspect-[3/4] w-full overflow-hidden">
                        <div class="absolute top-3 right-3 z-10 bg-black/60 backdrop-blur px-2 py-1 rounded text-xs font-bold text-white border border-white/10">
                            {{ 95 - ($index * 2) }}% Match
                        </div>
                        <a href="{{ route('profile.view', $suggestion) }}">
                            <div class="w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-110" 
                                 style='background-image: url("{{ $suggestion->profile_image ? asset('storage/' . $suggestion->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($suggestion->full_name) . '&size=400&background=ec3713&color=fff' }}");'>
                            </div>
                        </a>
                        <div class="absolute inset-0 bg-gradient-to-t from-surface-dark via-transparent to-transparent opacity-80"></div>
                        <!-- Floating Action Button -->
                        <div class="absolute bottom-4 right-4 translate-y-10 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                            <form method="POST" action="{{ route('profile.send-interest', $suggestion) }}" class="inline">
                                @csrf
                                <button type="submit" class="size-10 rounded-full bg-primary text-white shadow-lg flex items-center justify-center hover:bg-primary-dark">
                                    <span class="material-symbols-outlined text-[20px]">favorite</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col gap-1">
                        <h3 class="text-xl font-bold text-white">{{ $suggestion->full_name }}, {{ $suggestion->age ?? 'N/A' }}</h3>
                        <p class="text-text-muted text-sm italic">
                            @if($suggestion->occupation){{ $suggestion->occupation }}@endif
                            @if($suggestion->occupation && $suggestion->city) • @endif
                            @if($suggestion->city){{ $suggestion->city }}@endif
                        </p>
                        <div class="flex gap-2 mt-2 text-xs text-gray-400">
                            @if($suggestion->caste)<span>#{{ $suggestion->caste }}</span>@endif
                            @if($suggestion->mother_tongue)<span>#{{ $suggestion->mother_tongue }}</span>@endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="text-center py-12">
            <p class="text-text-muted text-lg mb-4">No suggestions available at the moment.</p>
            @if(!$user->gender)
                <p class="text-text-muted mb-4">Please <a href="{{ route('profile.edit') }}" class="text-primary hover:text-white underline">complete your profile</a> by adding your gender to see match suggestions.</p>
            @endif
            <a href="{{ route('matches') }}" class="mt-4 inline-block text-primary hover:text-white transition-colors">Browse All Profiles</a>
        </div>
        @endif
    </main>

    <script>
        // Handle form submissions with loading states
        document.querySelectorAll('form[action*="send-interest"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                const button = this.querySelector('button[type="submit"]');
                if (button) {
                    button.disabled = true;
                    button.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span>';
                }
            });
        });
    </script>
            </div>
        </main>
    </div>
</body>
</html>
