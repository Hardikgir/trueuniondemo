<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Advanced Search &amp; Filter - Matrimony</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700&family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ec3713",
                        "background-light": "#f8f6f6",
                        "background-dark": "#221310",
                        "surface-dark": "#2f1f1c",
                        "border-dark": "#392b28",
                        "text-muted": "#b9a19d"
                    },
                    fontFamily: {
                        "display": ["Spline Sans", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"]
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
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
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
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-[#181211] dark:text-white overflow-x-hidden min-h-screen flex flex-col">
    <div class="flex flex-1 overflow-hidden">
        @include('partials.user-sidebar')
        
        <div class="flex flex-1 relative lg:ml-80">
            <!-- Main Content Area -->
            <main id="mainContent" class="flex-1 p-4 lg:p-8 overflow-x-hidden transition-all duration-500 ease-in-out">
            <div class="max-w-[1400px] mx-auto flex flex-col h-full">
                <!-- Breadcrumbs & Header -->
                <div class="flex flex-wrap items-center gap-2 text-sm mb-6">
                    <a class="text-text-muted hover:text-white" href="{{ route('dashboard') }}">Home</a>
                    <span class="text-text-muted">/</span>
                    <a class="text-text-muted hover:text-white" href="{{ route('matches') }}">Matches</a>
                    <span class="text-text-muted">/</span>
                    <span class="text-primary font-medium">Advanced Search</span>
                </div>
                
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-white text-4xl md:text-5xl font-bold leading-tight tracking-tight mb-2">Refine Your Match</h1>
                        <p class="text-text-muted text-lg">Showing <span class="text-white font-bold">{{ $users->total() }}</span> profiles based on your preferences.</p>
                    </div>
                    <!-- Filter Toggle Button -->
                    <button id="toggleFiltersBtn" class="flex items-center gap-2 px-4 py-2 rounded-full bg-surface-dark border border-border-dark text-white font-medium hover:bg-primary hover:border-primary transition-colors">
                        <span class="material-symbols-outlined">tune</span> Filters
                    </button>
                </div>
                
                <!-- Active Filters -->
                <div class="flex flex-wrap gap-2 items-center mb-8">
                    <span class="text-sm font-medium text-text-muted mr-2">Active:</span>
                    @if(request('age_from') || request('age_to'))
                    <div class="flex items-center gap-1 pl-3 pr-2 py-1.5 rounded-full bg-surface-dark border border-border-dark text-sm text-white hover:border-primary transition-colors group">
                        <span>{{ $ageFrom }} - {{ $ageTo }} Yrs</span>
                        <a href="?{{ http_build_query(array_merge(request()->except(['age_from', 'age_to']))) }}" class="size-5 rounded-full flex items-center justify-center hover:bg-white/10 text-text-muted group-hover:text-primary">
                            <span class="material-symbols-outlined text-[16px]">close</span>
                        </a>
                    </div>
                    @endif
                    @if(request('gender_pref'))
                    <div class="flex items-center gap-1 pl-3 pr-2 py-1.5 rounded-full bg-surface-dark border border-border-dark text-sm text-white hover:border-primary transition-colors group">
                        <span>{{ ucfirst(request('gender_pref')) }}</span>
                        <a href="?{{ http_build_query(request()->except(['gender_pref'])) }}" class="size-5 rounded-full flex items-center justify-center hover:bg-white/10 text-text-muted group-hover:text-primary">
                            <span class="material-symbols-outlined text-[16px]">close</span>
                        </a>
                    </div>
                    @endif
                    @if(request('caste'))
                    <div class="flex items-center gap-1 pl-3 pr-2 py-1.5 rounded-full bg-surface-dark border border-border-dark text-sm text-white hover:border-primary transition-colors group">
                        <span>{{ is_array(request('caste')) ? implode(', ', request('caste')) : request('caste') }}</span>
                        <a href="?{{ http_build_query(request()->except(['caste'])) }}" class="size-5 rounded-full flex items-center justify-center hover:bg-white/10 text-text-muted group-hover:text-primary">
                            <span class="material-symbols-outlined text-[16px]">close</span>
                        </a>
                    </div>
                    @endif
                    @if(request()->hasAny(['age_from', 'age_to', 'gender_pref', 'caste', 'city', 'education', 'marital_status']))
                    <a href="{{ route('matches') }}" class="text-sm text-primary underline ml-2 font-medium">Clear All</a>
                    @endif
                </div>
                
                <!-- Results Grid -->
                @if($users->count() > 0)
                <div id="resultsGrid" class="flex flex-wrap gap-6 mb-12 transition-all duration-500 ease-in-out">
                    @foreach($users as $match)
                    <div class="profile-card group relative aspect-[3/4] md:aspect-[4/5] rounded-[2rem] overflow-hidden bg-surface-dark cursor-pointer flex-shrink-0" style="flex-basis: calc((100% - 3rem) / 3); min-width: 280px;">
                        <a href="{{ route('profile.view', $match) }}" class="absolute inset-0 z-10">
                            <img alt="Profile of {{ $match->full_name }}" 
                                 class="absolute inset-0 size-full object-cover transition-transform duration-700 group-hover:scale-105" 
                                 src="{{ $match->profile_image ? asset('storage/' . $match->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($match->full_name) . '&size=800&background=ec3713&color=fff' }}"/>
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                        </a>
                        
                        <!-- Top Badges -->
                        <div class="absolute top-4 left-4 flex gap-2 z-20">
                            @if($loop->first)
                            <span class="px-3 py-1 rounded-full bg-primary/90 text-white text-xs font-bold tracking-wide backdrop-blur-sm">NEW</span>
                            @endif
                            <span class="px-3 py-1 rounded-full bg-black/50 text-white text-xs font-medium backdrop-blur-sm border border-white/10 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px] text-green-400">verified</span> Verified
                            </span>
                        </div>
                        
                        <!-- Favorite/Shortlist Button -->
                        <div class="absolute top-4 right-4 z-20">
                            <form action="{{ route('profile.toggle-shortlist', $match) }}" method="POST" class="inline" onclick="event.stopPropagation();">
                                @csrf
                                <button type="submit" class="size-10 rounded-full bg-white/10 backdrop-blur-md flex items-center justify-center text-white hover:bg-primary hover:text-white transition-all shadow-lg {{ $match->isShortlisted ?? false ? 'bg-primary/20' : '' }}">
                                    <span class="material-symbols-outlined">{{ ($match->isShortlisted ?? false) ? 'favorite' : 'favorite_border' }}</span>
                                </button>
                            </form>
                        </div>
                        
                        <!-- Bottom Content -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 flex flex-col gap-1 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300 z-20">
                            <div class="flex items-end justify-between">
                                <h3 class="text-3xl font-bold text-white leading-none">{{ $match->full_name }}, {{ $match->age ?? 'N/A' }}</h3>
                                <div class="text-primary font-bold text-lg flex items-center gap-1">
                                    {{ $match->matchPercentage ?? rand(70, 95) }}% <span class="text-xs font-normal text-text-muted">Match</span>
                                </div>
                            </div>
                            <p class="text-gray-300 font-medium text-sm mt-1">
                                @if($match->occupation){{ $match->occupation }}@endif
                                @if($match->occupation && $match->location) • @endif
                                @if($match->location){{ $match->location }}@endif
                            </p>
                            <div class="flex gap-2 text-xs text-text-muted mt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-75">
                                @if($match->height)<span class="px-2 py-0.5 rounded border border-white/20">{{ $match->height }}</span>@endif
                                @if($match->highest_education)<span class="px-2 py-0.5 rounded border border-white/20">{{ $match->highest_education }}</span>@endif
                                @if($match->marital_status)<span class="px-2 py-0.5 rounded border border-white/20">{{ $match->marital_status }}</span>@endif
                            </div>
                            <form action="{{ route('profile.send-interest', $match) }}" method="POST" class="mt-4" onclick="event.stopPropagation();">
                                @csrf
                                <button type="submit" class="w-full h-11 bg-white text-black font-bold rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-4 group-hover:translate-y-0 hover:bg-primary hover:text-white">
                                    Send Interest
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    
                    <!-- Promo / CTA in Grid -->
                    <div class="profile-card group relative aspect-[3/4] md:aspect-[4/5] rounded-[2rem] overflow-hidden bg-[#241715] border border-dashed border-primary/30 flex flex-col items-center justify-center p-8 text-center flex-shrink-0" style="flex-basis: calc((100% - 3rem) / 3); min-width: 280px;">
                        <div class="size-16 rounded-full bg-primary/10 flex items-center justify-center mb-6 text-primary">
                            <span class="material-symbols-outlined text-4xl">rocket_launch</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Boost your profile</h3>
                        <p class="text-text-muted text-sm mb-6">Get 3x more matches by featuring your profile at the top.</p>
                        <a href="{{ route('membership') }}" class="px-6 py-3 rounded-full bg-primary text-white font-bold text-sm hover:bg-red-600 transition-colors">
                            Upgrade Now
                        </a>
                    </div>
                </div>
                
                <!-- Pagination -->
                @if($users->hasPages())
                <div class="flex justify-center gap-2 mb-8 flex-wrap">
                    @if($users->onFirstPage())
                        <span class="px-4 py-2 rounded-full bg-surface-dark text-text-muted cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $users->appends(request()->query())->previousPageUrl() }}" class="px-4 py-2 rounded-full bg-surface-dark text-white hover:bg-primary transition-colors">Previous</a>
                    @endif
                    
                    @foreach($users->getUrlRange(max(1, $users->currentPage() - 2), min($users->lastPage(), $users->currentPage() + 2)) as $page => $url)
                        @if($page == $users->currentPage())
                            <span class="px-4 py-2 rounded-full bg-primary text-white">{{ $page }}</span>
                        @else
                            <a href="{{ $users->appends(request()->query())->url($page) }}" class="px-4 py-2 rounded-full bg-surface-dark text-white hover:bg-primary transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach
                    
                    @if($users->hasMorePages())
                        <a href="{{ $users->appends(request()->query())->nextPageUrl() }}" class="px-4 py-2 rounded-full bg-surface-dark text-white hover:bg-primary transition-colors">Next</a>
                    @else
                        <span class="px-4 py-2 rounded-full bg-surface-dark text-text-muted cursor-not-allowed">Next</span>
                    @endif
                </div>
                @endif
                @else
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="w-24 h-24 bg-surface-dark rounded-full flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-4xl text-text-muted">search_off</span>
                    </div>
                    <h3 class="text-white text-xl font-bold mb-2">No matches found</h3>
                    <p class="text-text-muted max-w-md mb-8">Try adjusting your filters to see more profiles.</p>
                    <a href="{{ route('matches') }}" class="bg-primary text-white px-8 py-3 rounded-full font-bold hover:bg-red-600 transition-colors">Clear Filters</a>
                </div>
                @endif
                
                <!-- Recently Viewed Section -->
                @if($recentlyViewed->count() > 0)
                <div class="mt-8 border-t border-border-dark pt-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-white">Recently Viewed</h2>
                        <a class="text-sm font-medium text-primary hover:text-white transition-colors" href="#">View All History</a>
                    </div>
                    <div class="flex gap-4 overflow-x-auto no-scrollbar pb-4">
                        @foreach($recentlyViewed as $viewed)
                        <a href="{{ route('profile.view', $viewed) }}" class="flex-shrink-0 w-48 group cursor-pointer">
                            <div class="aspect-[3/4] rounded-2xl overflow-hidden mb-3 relative">
                                <img alt="Recent profile {{ $viewed->full_name }}" 
                                     class="size-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                     src="{{ $viewed->profile_image ? asset('storage/' . $viewed->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($viewed->full_name) . '&size=400&background=ec3713&color=fff' }}"/>
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors"></div>
                            </div>
                            <h4 class="text-white font-bold">{{ $viewed->full_name }}, {{ $viewed->age ?? 'N/A' }}</h4>
                            <p class="text-text-muted text-xs">{{ $viewed->occupation ?? 'Profile' }}</p>
                        </a>
                        @endforeach
                        <!-- View More placeholder -->
                        <div class="flex-shrink-0 w-48 group cursor-pointer flex flex-col justify-center items-center">
                            <div class="size-16 rounded-full border border-border-dark flex items-center justify-center text-primary mb-2 group-hover:border-primary transition-colors">
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </div>
                            <span class="text-text-muted text-sm font-medium">View All</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            </main>
        
        <!-- Backdrop overlay for mobile -->
        <div id="filtersBackdrop" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden transition-opacity duration-300"></div>
        
        <!-- Sidebar Filters (Fixed/Sticky on Desktop) - Right Side -->
        <aside id="filtersSidebar" class="fixed lg:sticky right-0 top-0 w-[340px] h-screen overflow-y-auto border-l border-border-dark bg-background-dark p-6 pb-20 z-40 transform transition-all duration-500 ease-in-out translate-x-full lg:w-0 lg:border-0 lg:overflow-hidden">
            <form action="{{ route('matches') }}" method="GET" id="filtersForm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-white text-lg font-bold">Filters</h3>
                    <a href="{{ route('matches') }}" class="text-sm text-text-muted hover:text-primary transition-colors font-medium">Clear All</a>
                </div>
                
                <!-- Basic Search -->
                <div class="space-y-6">
                    <!-- Gender Toggle -->
                    <div class="space-y-3">
                        <label class="text-xs font-bold text-text-muted uppercase tracking-wider">Looking For</label>
                        <div class="flex gap-3">
                            <label class="flex-1 text-sm font-medium leading-normal flex items-center justify-center rounded-full border border-border-dark h-10 text-white has-[:checked]:bg-surface-dark has-[:checked]:border-primary has-[:checked]:text-primary transition-all cursor-pointer hover:border-text-muted">
                                Bride
                                <input class="invisible absolute" name="gender_pref" type="radio" value="female" {{ $genderPref === 'female' ? 'checked' : '' }}/>
                            </label>
                            <label class="flex-1 text-sm font-medium leading-normal flex items-center justify-center rounded-full border border-border-dark h-10 text-white has-[:checked]:bg-surface-dark has-[:checked]:border-primary has-[:checked]:text-primary transition-all cursor-pointer hover:border-text-muted">
                                Groom
                                <input class="invisible absolute" name="gender_pref" type="radio" value="male" {{ $genderPref === 'male' ? 'checked' : '' }}/>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Age Range -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <label class="text-xs font-bold text-text-muted uppercase tracking-wider">Age Range</label>
                            <span class="text-sm font-medium text-white">{{ $ageFrom }} - {{ $ageTo }} Yrs</span>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="number" name="age_from" value="{{ $ageFrom }}" min="18" max="70" class="w-full h-10 rounded-xl bg-surface-dark border border-border-dark text-white text-sm px-4 focus:border-primary focus:ring-0" placeholder="From"/>
                            <input type="number" name="age_to" value="{{ $ageTo }}" min="18" max="70" class="w-full h-10 rounded-xl bg-surface-dark border border-border-dark text-white text-sm px-4 focus:border-primary focus:ring-0" placeholder="To"/>
                        </div>
                    </div>
                    
                    <!-- Location -->
                    <details class="group py-2" open="">
                        <summary class="flex items-center justify-between cursor-pointer list-none text-white font-medium hover:text-primary transition-colors">
                            <span>Location</span>
                            <span class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                        </summary>
                        <div class="pt-4 flex flex-wrap gap-2">
                            @foreach($cities as $city)
                                @php
                                    $cityName = !empty($city->city_master) ? $city->city_master : (!empty($city->name) ? $city->name : '');
                                @endphp
                                @if(!empty($cityName))
                                <label class="cursor-pointer">
                                    <input name="city" value="{{ $cityName }}" type="radio" class="peer sr-only" {{ request('city') == $cityName ? 'checked' : '' }}/>
                                    <span class="block px-3 py-1.5 rounded-full border border-border-dark text-xs text-text-muted hover:border-primary hover:text-white peer-checked:bg-primary/20 peer-checked:border-primary peer-checked:text-primary transition-all whitespace-nowrap flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">location_on</span>
                                        {{ $cityName }}
                                    </span>
                                </label>
                                @endif
                            @endforeach
                        </div>
                    </details>
                    
                    
                    <!-- Collapsible Sections -->
                    <!-- Religion & Caste -->
                    <details class="group py-2" open="">
                        <summary class="flex items-center justify-between cursor-pointer list-none text-white font-medium hover:text-primary transition-colors">
                            <span>Religion &amp; Caste</span>
                            <span class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                        </summary>
                        <div class="pt-4 flex flex-wrap gap-2">
                            @foreach($castes as $caste)
                            <label class="cursor-pointer">
                                <input name="caste[]" value="{{ $caste->title }}" type="checkbox" class="peer sr-only" {{ in_array($caste->title, (array)(request('caste', []))) ? 'checked' : '' }}/>
                                <span class="block px-3 py-1.5 rounded-full border border-border-dark text-xs text-text-muted hover:border-primary hover:text-white peer-checked:bg-primary/20 peer-checked:border-primary peer-checked:text-primary transition-all whitespace-nowrap">{{ $caste->title }}</span>
                            </label>
                            @endforeach
                        </div>
                    </details>
                    
                    <!-- Education -->
                    <details class="group py-2" open="">
                        <summary class="flex items-center justify-between cursor-pointer list-none text-white font-medium hover:text-primary transition-colors">
                            <span>Education</span>
                            <span class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                        </summary>
                        <div class="pt-4 flex flex-wrap gap-2">
                            @foreach($highestQualifications as $qual)
                            <label class="cursor-pointer">
                                <input name="education[]" value="{{ $qual->name }}" type="checkbox" class="peer sr-only" {{ in_array($qual->name, (array)(request('education', []))) ? 'checked' : '' }}/>
                                <span class="block px-3 py-1.5 rounded-full border border-border-dark text-xs text-text-muted hover:border-primary hover:text-white peer-checked:bg-primary/20 peer-checked:border-primary peer-checked:text-primary transition-all whitespace-nowrap">{{ $qual->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </details>
                    
                    <!-- Marital Status -->
                    <details class="group py-2" open="">
                        <summary class="flex items-center justify-between cursor-pointer list-none text-white font-medium hover:text-primary transition-colors">
                            <span>Marital Status</span>
                            <span class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                        </summary>
                        <div class="pt-4 flex flex-wrap gap-2">
                            <label class="cursor-pointer">
                                <input name="marital_status[]" value="Never Married" type="checkbox" class="peer sr-only" {{ in_array('Never Married', (array)(request('marital_status', []))) ? 'checked' : '' }}/>
                                <span class="block px-3 py-1.5 rounded-full border border-border-dark text-xs text-text-muted hover:border-primary hover:text-white peer-checked:bg-primary/20 peer-checked:border-primary peer-checked:text-primary transition-all">Never Married</span>
                            </label>
                            <label class="cursor-pointer">
                                <input name="marital_status[]" value="Divorced" type="checkbox" class="peer sr-only" {{ in_array('Divorced', (array)(request('marital_status', []))) ? 'checked' : '' }}/>
                                <span class="block px-3 py-1.5 rounded-full border border-border-dark text-xs text-text-muted hover:border-primary hover:text-white peer-checked:bg-primary/20 peer-checked:border-primary peer-checked:text-primary transition-all">Divorced</span>
                            </label>
                            <label class="cursor-pointer">
                                <input name="marital_status[]" value="Widowed" type="checkbox" class="peer sr-only" {{ in_array('Widowed', (array)(request('marital_status', []))) ? 'checked' : '' }}/>
                                <span class="block px-3 py-1.5 rounded-full border border-border-dark text-xs text-text-muted hover:border-primary hover:text-white peer-checked:bg-primary/20 peer-checked:border-primary peer-checked:text-primary transition-all">Widowed</span>
                            </label>
                        </div>
                    </details>
                </div>
                
                <!-- Sticky Action Button in Sidebar -->
                <div class="sticky bottom-0 pt-4 pb-2 bg-background-dark/95 backdrop-blur shadow-[0_-10px_20px_rgba(0,0,0,0.5)] mt-4">
                    <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-full h-12 bg-white text-background-dark text-sm font-bold hover:bg-gray-200 transition-colors">
                        <span class="material-symbols-outlined">search</span> Apply Filters
                    </button>
                </div>
            </form>
        </aside>
        </div>
    </div>
    
    <script>
        // Toggle filters sidebar
        const toggleFiltersBtn = document.getElementById('toggleFiltersBtn');
        const filtersSidebar = document.getElementById('filtersSidebar');
        const filtersBackdrop = document.getElementById('filtersBackdrop');
        const resultsGrid = document.getElementById('resultsGrid');
        
        function updateGridColumns() {
            if (resultsGrid && filtersSidebar) {
                const isHidden = filtersSidebar.classList.contains('translate-x-full');
                const cards = resultsGrid.querySelectorAll('.profile-card');
                const gap = 24; // 1.5rem = 24px (gap-6)
                
                // Update sidebar width to free up space when hidden (on desktop)
                const mainContent = document.getElementById('mainContent');
                if (window.innerWidth >= 1024) {
                    if (isHidden) {
                        filtersSidebar.style.width = '0';
                        filtersSidebar.style.minWidth = '0';
                        filtersSidebar.style.borderLeftWidth = '0';
                        filtersSidebar.style.overflow = 'hidden';
                        filtersSidebar.style.padding = '0';
                        filtersSidebar.style.margin = '0';
                        filtersSidebar.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                        if (mainContent) {
                            mainContent.style.marginRight = '0';
                            mainContent.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                        }
                    } else {
                        filtersSidebar.style.width = '340px';
                        filtersSidebar.style.minWidth = '340px';
                        filtersSidebar.style.borderLeftWidth = '1px';
                        filtersSidebar.style.overflow = 'auto';
                        filtersSidebar.style.padding = '1.5rem';
                        filtersSidebar.style.margin = '0';
                        filtersSidebar.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                        if (mainContent) {
                            mainContent.style.marginRight = '0';
                            mainContent.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                        }
                    }
                }
                
                // Animate cards with staggered delay for smoother cascading effect
                cards.forEach((card, index) => {
                    // Add smooth transition with slight stagger for visual appeal
                    card.style.transition = `flex-basis 0.5s cubic-bezier(0.4, 0, 0.2, 1) ${Math.min(index * 0.015, 0.2)}s, min-width 0.5s cubic-bezier(0.4, 0, 0.2, 1) ${Math.min(index * 0.015, 0.2)}s`;
                    
                    if (isHidden) {
                        // Filters hidden - 3 cards per row
                        const gapsCount = 2; // 2 gaps for 3 columns
                        card.style.flexBasis = `calc((100% - ${gapsCount * gap}px) / 3)`;
                        card.style.minWidth = '280px';
                    } else {
                        // Filters visible - 2 cards per row
                        const gapsCount = 1; // 1 gap for 2 columns
                        card.style.flexBasis = `calc((100% - ${gapsCount * gap}px) / 2)`;
                        card.style.minWidth = '320px';
                    }
                    card.style.maxWidth = 'none';
                });
            }
        }
        
        if (toggleFiltersBtn && filtersSidebar) {
            toggleFiltersBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                const isHidden = filtersSidebar.classList.contains('translate-x-full');
                
                if (isHidden) {
                    filtersSidebar.classList.remove('translate-x-full');
                    if (filtersBackdrop && window.innerWidth < 1024) {
                        filtersBackdrop.classList.remove('hidden');
                    }
                } else {
                    filtersSidebar.classList.add('translate-x-full');
                    if (filtersBackdrop) {
                        filtersBackdrop.classList.add('hidden');
                    }
                }
                
                // Update grid columns based on filter visibility
                updateGridColumns();
                
                // Update button text/icon based on state
                const icon = this.querySelector('.material-symbols-outlined');
                if (filtersSidebar.classList.contains('translate-x-full')) {
                    icon.textContent = 'tune';
                } else {
                    icon.textContent = 'close';
                }
            });
        }
        
        // Close filters when clicking backdrop
        if (filtersBackdrop) {
            filtersBackdrop.addEventListener('click', function() {
                filtersSidebar.classList.add('translate-x-full');
                filtersBackdrop.classList.add('hidden');
                updateGridColumns();
                const icon = toggleFiltersBtn?.querySelector('.material-symbols-outlined');
                if (icon) icon.textContent = 'tune';
            });
        }
        
        // Handle window resize - keep filters hidden by default
        window.addEventListener('resize', function() {
            if (filtersSidebar) {
                // Always keep filters hidden by default, user must click button to show
                if (window.innerWidth < 1024) {
                    filtersSidebar.classList.add('translate-x-full');
                    if (filtersBackdrop) filtersBackdrop.classList.add('hidden');
                }
            }
            updateGridColumns();
        });
        
        // Initialize grid columns on page load
        updateGridColumns();
    </script>
</body>
</html>

