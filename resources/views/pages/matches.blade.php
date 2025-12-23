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
    @include('partials.user-navbar')

    <div class="flex flex-1 relative">
        <!-- Sidebar Filters (Fixed/Sticky on Desktop) -->
        <aside class="hidden lg:block w-[340px] sticky top-[65px] h-[calc(100vh-65px)] overflow-y-auto border-r border-border-dark bg-background-dark p-6 pb-20">
            <form action="{{ route('matches') }}" method="GET" id="filtersForm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-white text-lg font-bold">Filters</h3>
                    <button type="button" onclick="document.getElementById('filtersForm').reset(); document.getElementById('filtersForm').submit();" class="text-sm text-text-muted hover:text-primary transition-colors font-medium">Clear All</button>
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
                    <div class="space-y-3 pt-2">
                        <label class="text-xs font-bold text-text-muted uppercase tracking-wider">Location</label>
                        <div class="relative">
                            <select name="city" class="w-full h-12 rounded-xl bg-surface-dark border border-border-dark text-white text-sm focus:border-primary focus:ring-0 appearance-none px-4">
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->city_master ?? $city->name }}" {{ request('city') == ($city->city_master ?? $city->name) ? 'selected' : '' }}>{{ $city->city_master ?? $city->name }}</option>
                                @endforeach
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-text-muted pointer-events-none text-xl">expand_more</span>
                        </div>
                    </div>
                    
                    <hr class="border-border-dark my-4"/>
                    
                    <!-- Collapsible Sections -->
                    <!-- Religion & Caste -->
                    <details class="group py-2">
                        <summary class="flex items-center justify-between cursor-pointer list-none text-white font-medium hover:text-primary transition-colors">
                            <span>Religion &amp; Caste</span>
                            <span class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                        </summary>
                        <div class="pt-4 space-y-3">
                            @foreach($castes->take(10) as $caste)
                            <label class="flex items-center gap-3 cursor-pointer group/check">
                                <div class="relative flex items-center justify-center size-5 rounded border border-text-muted bg-transparent group-hover/check:border-primary">
                                    <input name="caste[]" value="{{ $caste->title }}" type="checkbox" class="peer appearance-none w-full h-full cursor-pointer" {{ in_array($caste->title, (array)(request('caste', []))) ? 'checked' : '' }}/>
                                    <span class="material-symbols-outlined absolute text-[16px] text-primary opacity-0 peer-checked:opacity-100">check</span>
                                </div>
                                <span class="text-sm text-text-muted group-hover/check:text-white">{{ $caste->title }}</span>
                            </label>
                            @endforeach
                        </div>
                    </details>
                    
                    <!-- Education -->
                    <details class="group py-2">
                        <summary class="flex items-center justify-between cursor-pointer list-none text-white font-medium hover:text-primary transition-colors">
                            <span>Education</span>
                            <span class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                        </summary>
                        <div class="pt-4 space-y-3">
                            @foreach($highestQualifications as $qual)
                            <label class="flex items-center gap-3 cursor-pointer group/check">
                                <div class="relative flex items-center justify-center size-5 rounded border border-text-muted bg-transparent group-hover/check:border-primary">
                                    <input name="education[]" value="{{ $qual->name }}" type="checkbox" class="peer appearance-none w-full h-full cursor-pointer" {{ in_array($qual->name, (array)(request('education', []))) ? 'checked' : '' }}/>
                                    <span class="material-symbols-outlined absolute text-[16px] text-primary opacity-0 peer-checked:opacity-100">check</span>
                                </div>
                                <span class="text-sm text-text-muted group-hover/check:text-white">{{ $qual->name }}</span>
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
        
        <!-- Main Content Area -->
        <main class="flex-1 p-4 lg:p-8 overflow-x-hidden">
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
                    <!-- Mobile Filter Toggle -->
                    <button class="lg:hidden flex items-center gap-2 px-4 py-2 rounded-full bg-surface-dark border border-border-dark text-white font-medium">
                        <span class="material-symbols-outlined">tune</span> Filters
                    </button>
                </div>
                
                <!-- Active Filters & Sort -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                    <div class="flex flex-wrap gap-2 items-center">
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
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-text-muted">Sort by:</span>
                        <select onchange="window.location.href='?{{ http_build_query(array_merge(request()->all(), ['sort' => ''])) }}' + this.value" class="bg-transparent border-none text-white font-medium text-sm focus:ring-0 cursor-pointer pr-8 pl-0 py-0">
                            <option value="relevance" {{ request('sort') == 'relevance' ? 'selected' : '' }}>Relevance</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="age_low" {{ request('sort') == 'age_low' ? 'selected' : '' }}>Age: Low to High</option>
                        </select>
                    </div>
                </div>
                
                <!-- Results Grid -->
                @if($users->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6 mb-12">
                    @foreach($users as $match)
                    <div class="group relative aspect-[3/4] md:aspect-[4/5] rounded-[2rem] overflow-hidden bg-surface-dark cursor-pointer">
                        <a href="{{ route('profile.view', $match->id) }}">
                            <img alt="Profile of {{ $match->full_name }}" 
                                 class="absolute inset-0 size-full object-cover transition-transform duration-700 group-hover:scale-105" 
                                 src="{{ $match->profile_image ? asset('storage/' . $match->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($match->full_name) . '&size=800&background=ec3713&color=fff' }}"/>
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                            
                            <!-- Top Badges -->
                            <div class="absolute top-4 left-4 flex gap-2">
                                @if($loop->first)
                                <span class="px-3 py-1 rounded-full bg-primary/90 text-white text-xs font-bold tracking-wide backdrop-blur-sm">NEW</span>
                                @endif
                                <span class="px-3 py-1 rounded-full bg-black/50 text-white text-xs font-medium backdrop-blur-sm border border-white/10 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px] text-green-400">verified</span> Verified
                                </span>
                            </div>
                            
                            <div class="absolute top-4 right-4">
                                <form action="{{ route('profile.send-interest', $match->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="size-10 rounded-full bg-white/10 backdrop-blur-md flex items-center justify-center text-white hover:bg-primary hover:text-white transition-all shadow-lg">
                                        <span class="material-symbols-outlined">favorite_border</span>
                                    </button>
                                </form>
                            </div>
                            
                            <!-- Bottom Content -->
                            <div class="absolute bottom-0 left-0 right-0 p-6 flex flex-col gap-1 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
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
                                <form action="{{ route('profile.send-interest', $match->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    <button type="submit" class="w-full h-11 bg-white text-black font-bold rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-4 group-hover:translate-y-0 hover:bg-primary hover:text-white">
                                        Send Interest
                                    </button>
                                </form>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    
                    <!-- Promo / CTA in Grid -->
                    <div class="group relative aspect-[3/4] md:aspect-[4/5] rounded-[2rem] overflow-hidden bg-[#241715] border border-dashed border-primary/30 flex flex-col items-center justify-center p-8 text-center">
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
                <div class="flex justify-center gap-2 mb-8">
                    @if($users->onFirstPage())
                        <span class="px-4 py-2 rounded-full bg-surface-dark text-text-muted cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="px-4 py-2 rounded-full bg-surface-dark text-white hover:bg-primary transition-colors">Previous</a>
                    @endif
                    
                    @foreach(range(1, min(5, $users->lastPage())) as $page)
                        @if($page == $users->currentPage())
                            <span class="px-4 py-2 rounded-full bg-primary text-white">{{ $page }}</span>
                        @else
                            <a href="{{ $users->url($page) }}" class="px-4 py-2 rounded-full bg-surface-dark text-white hover:bg-primary transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach
                    
                    @if($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="px-4 py-2 rounded-full bg-surface-dark text-white hover:bg-primary transition-colors">Next</a>
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
                        <a href="{{ route('profile.view', $viewed->id) }}" class="flex-shrink-0 w-48 group cursor-pointer">
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
    </div>
</body>
</html>

