<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>View Profile - {{ $user->full_name }} - Matrimony</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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
                        "card-dark": "#2f1f1c",
                        "card-border": "#392b28",
                        "text-secondary": "#b9a19d"
                    },
                    fontFamily: {
                        "display": ["Spline Sans", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "1rem", "lg": "2rem", "xl": "3rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        .watermark-overlay {
            background-image: repeating-linear-gradient(45deg, transparent, transparent 20px, rgba(255, 255, 255, 0.05) 20px, rgba(255, 255, 255, 0.05) 40px);
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .material-symbols-outlined.filled {
            font-variation-settings: 'FILL' 1;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-white overflow-x-hidden min-h-screen flex flex-col">
    <div class="flex flex-1 overflow-hidden">
        @include('partials.user-sidebar')
        
        <!-- Main Content -->
        <main class="flex-grow w-full px-4 lg:px-10 py-8 mx-auto max-w-[1400px] overflow-y-auto lg:ml-80">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 relative">
            <!-- Left Sidebar (Sticky Profile Card) -->
            <div class="lg:col-span-4 xl:col-span-3">
                <div class="sticky top-0">
                    <!-- Profile Card -->
                    <div class="bg-card-dark rounded-[2rem] p-4 border border-card-border shadow-2xl relative overflow-hidden group">
                        <!-- Main Image -->
                        <div class="relative w-full aspect-[3/4] rounded-2xl overflow-hidden mb-5">
                            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" 
                                 style="background-image: url('{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&size=800&background=ec3713&color=fff' }}');"></div>
                            <!-- Watermark Overlay -->
                            <div class="absolute inset-0 watermark-overlay opacity-30 pointer-events-none"></div>
                            <div class="absolute bottom-4 left-0 w-full text-center opacity-30 font-bold text-white text-xs tracking-widest uppercase pointer-events-none -rotate-12">Matrimony ID: {{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}</div>
                            <!-- Online Status Badge -->
                            <div class="absolute top-4 left-4 bg-black/40 backdrop-blur-md px-3 py-1 rounded-full flex items-center gap-2 border border-white/10">
                                <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                                <span class="text-xs font-medium">Online Now</span>
                            </div>
                        </div>
                        
                        <!-- Basic Info -->
                        <div class="px-2 pb-2">
                            <h1 class="text-3xl font-bold text-white mb-1">{{ $user->full_name }}, {{ $user->age ?? 'N/A' }}</h1>
                            <p class="text-text-secondary text-sm font-medium mb-4 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">location_on</span> {{ $user->location ?? 'Location not specified' }}
                            </p>
                            
                            <!-- Verification Chips -->
                            <div class="flex gap-2 flex-wrap mb-6">
                                @if($user->email_verified_at)
                                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-[#392b28]/50 border border-[#392b28]">
                                    <span class="material-symbols-outlined text-primary text-[16px] filled">verified_user</span>
                                    <span class="text-xs font-medium text-white/90">ID Verified</span>
                                </div>
                                @endif
                                @if($user->mobile_number)
                                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-[#392b28]/50 border border-[#392b28]">
                                    <span class="material-symbols-outlined text-blue-400 text-[16px]">phonelink_ring</span>
                                    <span class="text-xs font-medium text-white/90">Mobile</span>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Match Score -->
                            <div class="mb-6 p-4 rounded-xl bg-background-dark border border-card-border">
                                <div class="flex gap-6 justify-between items-end mb-2">
                                    <div class="flex flex-col">
                                        <p class="text-text-secondary text-xs font-medium uppercase tracking-wider">Compatibility</p>
                                        <p class="text-white text-xl font-bold leading-normal">{{ $matchPercentage }}% Match</p>
                                    </div>
                                    <span class="material-symbols-outlined text-primary text-3xl">favorite</span>
                                </div>
                                <div class="rounded-full bg-[#543f3b] h-1.5 overflow-hidden">
                                    <div class="h-full rounded-full bg-primary" style="width: {{ $matchPercentage }}%;"></div>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="grid {{ $canChat ? 'grid-cols-2' : 'grid-cols-1' }} gap-3 mb-4">
                                <form action="{{ route('profile.toggle-shortlist', $user) }}" method="POST" class="{{ $canChat ? 'col-span-1' : 'col-span-1' }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 h-12 rounded-full {{ $isShortlisted ? 'bg-primary text-white' : 'bg-white text-background-dark' }} font-bold text-sm hover:bg-gray-100 hover:bg-primary-dark transition-colors">
                                        <span class="material-symbols-outlined text-[20px] {{ $isShortlisted ? 'filled' : '' }}">star</span>
                                        {{ $isShortlisted ? 'Shortlisted' : 'Shortlist' }}
                                    </button>
                                </form>
                                @if($canChat)
                                <button class="col-span-1 flex items-center justify-center gap-2 h-12 rounded-full bg-transparent border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">chat_bubble</span>
                                    Chat
                                </button>
                                @endif
                                @if(!$interestSent)
                                <form action="{{ route('profile.send-interest', $user) }}" method="POST" class="col-span-2">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 h-14 rounded-full bg-primary text-white font-bold text-base shadow-lg shadow-primary/25 hover:bg-red-600 transition-all hover:scale-[1.02]">
                                        <span class="material-symbols-outlined text-[22px]">favorite</span>
                                        Send Interest
                                    </button>
                                </form>
                                @else
                                <div class="col-span-2 flex items-center justify-center gap-2 h-14 rounded-full bg-green-500/20 border border-green-500/50 text-green-400 font-bold text-base">
                                    <span class="material-symbols-outlined text-[22px]">check_circle</span>
                                    Interest Sent
                                </div>
                                @endif
                            </div>
                            
                            <!-- Safety -->
                            <div class="flex justify-center gap-6 pt-2 border-t border-white/5">
                                <button class="text-text-secondary hover:text-white text-xs flex items-center gap-1 transition-colors">
                                    <span class="material-symbols-outlined text-[14px]">block</span> Block
                                </button>
                                <a href="{{ route('report.create', $user->id) }}" class="text-text-secondary hover:text-white text-xs flex items-center gap-1 transition-colors">
                                    <span class="material-symbols-outlined text-[14px]">flag</span> Report
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Content (Scrollable Details) -->
            <div class="lg:col-span-8 xl:col-span-9 space-y-8">
                <!-- Headline Section -->
                <div class="p-6 md:p-10 rounded-[2rem] bg-gradient-to-br from-card-dark to-background-dark border border-card-border relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-10 opacity-10">
                        <span class="material-symbols-outlined text-[120px]">format_quote</span>
                    </div>
                    <h2 class="text-white text-2xl md:text-4xl font-bold leading-tight relative z-10 max-w-2xl">
                        @if($user->languages_known)
                            "{{ $user->languages_known }}"
                        @else
                            "Looking for a life partner who shares similar values and interests."
                        @endif
                    </h2>
                    <div class="mt-6 flex flex-wrap gap-3 relative z-10">
                        @if($user->marital_status)
                        <span class="px-4 py-2 bg-white/5 rounded-full text-sm font-medium text-white border border-white/10">{{ $user->marital_status }}</span>
                        @endif
                        @if($user->occupation)
                        <span class="px-4 py-2 bg-white/5 rounded-full text-sm font-medium text-white border border-white/10">{{ $user->occupation }}</span>
                        @endif
                        @if($user->age && $user->height)
                        <span class="px-4 py-2 bg-white/5 rounded-full text-sm font-medium text-white border border-white/10">{{ $user->age }} Yrs, {{ $user->height }}</span>
                        @endif
            </div>
        </div>

                <!-- About Me -->
                @if($user->languages_known)
                <div class="space-y-4">
                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                        <span class="w-1 h-6 bg-primary rounded-full"></span>
                        About {{ explode(' ', $user->full_name)[0] }}
                    </h3>
                    <p class="text-text-secondary text-lg leading-relaxed font-light">
                        {{ $user->languages_known }}
                    </p>
                </div>
                @endif
                
                <!-- Photo Gallery (Grid) -->
                @if($user->profile_image)
                <div class="space-y-4">
                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                        <span class="w-1 h-6 bg-primary rounded-full"></span>
                        Photos
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="aspect-square rounded-2xl bg-card-dark border border-card-border overflow-hidden cursor-pointer hover:opacity-90 transition-opacity">
                            <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $user->profile_image) }}');"></div>
                        </div>
                        <!-- Placeholder for additional photos -->
                        <div class="aspect-square rounded-2xl bg-card-dark border border-card-border overflow-hidden flex items-center justify-center cursor-pointer hover:bg-white/5 transition-colors group relative">
                            <span class="relative text-white font-medium z-10">+ More</span>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Detailed Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Details -->
                    <div class="bg-card-dark rounded-3xl p-6 border border-card-border">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2.5 bg-background-dark rounded-xl text-primary">
                                <span class="material-symbols-outlined">person</span>
                            </div>
                            <h4 class="text-lg font-bold text-white">Basic Details</h4>
                        </div>
                        <div class="space-y-4">
                            @if($user->age || $user->height)
                            <div class="flex justify-between border-b border-white/5 pb-2">
                                <span class="text-text-secondary text-sm">Age / Height</span>
                                <span class="text-white font-medium text-sm">{{ $user->age ?? 'N/A' }} Yrs{{ $user->height ? ', ' . $user->height : '' }}</span>
                            </div>
                            @endif
                            @if($user->marital_status)
                            <div class="flex justify-between border-b border-white/5 pb-2">
                                <span class="text-text-secondary text-sm">Marital Status</span>
                                <span class="text-white font-medium text-sm">{{ $user->marital_status }}</span>
                            </div>
                            @endif
                            @if($user->mother_tongue)
                            <div class="flex justify-between border-b border-white/5 pb-2">
                                <span class="text-text-secondary text-sm">Mother Tongue</span>
                                <span class="text-white font-medium text-sm">{{ $user->mother_tongue }}</span>
                            </div>
                            @endif
                            @if($user->diet)
                            <div class="flex justify-between border-b border-white/5 pb-2">
                                <span class="text-text-secondary text-sm">Diet</span>
                                <span class="text-white font-medium text-sm">{{ $user->diet }}</span>
                            </div>
                            @endif
                            @if($user->dob)
                            <div class="flex justify-between border-b border-white/5 pb-2">
                                <span class="text-text-secondary text-sm">Date of Birth</span>
                                <span class="text-white font-medium text-sm">{{ $user->dobFormatted ?? Carbon\Carbon::parse($user->dob)->format('d M Y') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Professional Info -->
                    <div class="bg-card-dark rounded-3xl p-6 border border-card-border">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2.5 bg-background-dark rounded-xl text-primary">
                                <span class="material-symbols-outlined">work</span>
                            </div>
                            <h4 class="text-lg font-bold text-white">Career &amp; Education</h4>
                        </div>
                        <div class="space-y-4">
                            @if($user->occupation)
                            <div class="flex flex-col gap-1 border-b border-white/5 pb-3">
                                <span class="text-text-secondary text-sm">Profession</span>
                                <span class="text-white font-medium text-base">{{ $user->occupation }}</span>
                            </div>
                            @endif
                            @if($user->highest_education || $user->education_details)
                            <div class="flex flex-col gap-1 border-b border-white/5 pb-3">
                                <span class="text-text-secondary text-sm">Education</span>
                                <span class="text-white font-medium text-base">
                                    @if($user->education_details){{ $user->education_details }}@endif
                                    @if($user->highest_education && $user->education_details) - @endif
                                    @if($user->highest_education){{ $user->highest_education }}@endif
                                </span>
                            </div>
                            @endif
                            @if($user->annual_income)
                            <div class="flex flex-col gap-1 pb-1">
                                <span class="text-text-secondary text-sm">Annual Income</span>
                                <span class="text-white font-medium text-base">{{ $user->annual_income }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Family Details -->
                    <div class="bg-card-dark rounded-3xl p-6 border border-card-border">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2.5 bg-background-dark rounded-xl text-primary">
                                <span class="material-symbols-outlined">family_restroom</span>
                            </div>
                            <h4 class="text-lg font-bold text-white">Family Background</h4>
                        </div>
                        <div class="space-y-4">
                            @if($user->caste)
                            <div class="flex justify-between items-center border-b border-white/5 pb-2">
                                <span class="text-text-secondary text-sm">Caste</span>
                                <span class="text-white font-medium text-sm">{{ $user->caste }}</span>
                            </div>
                            @endif
                            @if($user->location)
                            <div class="flex justify-between items-center pb-2">
                                <span class="text-text-secondary text-sm">Family Location</span>
                                <span class="text-white font-medium text-sm">{{ $user->location }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Lifestyle & Hobbies -->
                    <div class="bg-card-dark rounded-3xl p-6 border border-card-border">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2.5 bg-background-dark rounded-xl text-primary">
                                <span class="material-symbols-outlined">local_activity</span>
                            </div>
                            <h4 class="text-lg font-bold text-white">Lifestyle &amp; Interests</h4>
                        </div>
                        <div class="space-y-5">
                            <div>
                                <p class="text-text-secondary text-xs font-medium uppercase tracking-wider mb-3">Habits</p>
                                <div class="flex gap-2 flex-wrap">
                                    <div class="px-3 py-1.5 rounded-lg bg-background-dark border border-white/5 text-sm text-white flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm text-green-400">smoke_free</span> Non-Smoker
                                    </div>
                                    <div class="px-3 py-1.5 rounded-lg bg-background-dark border border-white/5 text-sm text-white flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm text-yellow-400">no_drinks</span> Non-Drinker
                                    </div>
                                </div>
                            </div>
                            @if($user->languages_known)
                            <div>
                                <p class="text-text-secondary text-xs font-medium uppercase tracking-wider mb-3">Interests</p>
                                <div class="flex gap-2 flex-wrap">
                                    @php
                                        $interests = explode(',', $user->languages_known);
                                    @endphp
                                    @foreach(array_slice($interests, 0, 5) as $interest)
                                        <span class="px-3 py-1 rounded-full bg-white/5 hover:bg-white/10 text-sm text-white cursor-default transition-colors border border-white/5">{{ trim($interest) }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Horoscope (Full Width) -->
                @if($user->raashi || $user->nakshtra)
                <div class="bg-card-dark rounded-3xl p-6 md:p-8 border border-card-border">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="p-2.5 bg-background-dark rounded-xl text-primary">
                                <span class="material-symbols-outlined">auto_awesome</span>
                            </div>
                            <h4 class="text-lg font-bold text-white">Horoscope Details</h4>
                        </div>
                        <span class="text-xs px-2 py-1 bg-background-dark rounded border border-white/10 text-text-secondary">Optional</span>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @if($user->raashi)
                        <div class="p-4 bg-background-dark rounded-2xl text-center">
                            <p class="text-text-secondary text-xs uppercase tracking-wide mb-1">Raasi / Moon Sign</p>
                            <p class="text-white font-bold text-lg">{{ $user->raashi }}</p>
                        </div>
                        @endif
                        @if($user->nakshtra)
                        <div class="p-4 bg-background-dark rounded-2xl text-center">
                            <p class="text-text-secondary text-xs uppercase tracking-wide mb-1">Star / Nakshatra</p>
                            <p class="text-white font-bold text-lg">{{ $user->nakshtra }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                
                <!-- Contact Unlock Section (Upsell) -->
                <div class="relative rounded-3xl overflow-hidden border border-card-border">
                    <!-- Blurred Content Background -->
                    <div class="absolute inset-0 bg-card-dark blur-sm scale-110 z-0"></div>
                    <div class="relative z-10 p-8 flex flex-col md:flex-row items-center justify-between gap-6 bg-gradient-to-r from-card-dark/95 to-background-dark/90 backdrop-blur-md">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center text-primary shrink-0">
                                <span class="material-symbols-outlined text-2xl">lock</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-white mb-1">Contact Details Locked</h4>
                                <p class="text-text-secondary text-sm">Upgrade to Premium to view phone number and email.</p>
                            </div>
                        </div>
                        <a href="{{ route('membership') }}" class="px-8 py-3 rounded-full bg-gradient-to-r from-yellow-600 to-yellow-500 text-white font-bold text-sm shadow-lg hover:shadow-yellow-500/20 transition-all transform hover:scale-105 whitespace-nowrap">
                            Unlock Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>
</body>
</html>
