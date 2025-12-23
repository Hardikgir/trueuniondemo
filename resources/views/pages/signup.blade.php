<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Matrimony Profile Creation - TrueUnion</title>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
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
                        "surface-dark": "#2c1c19",
                        "surface-light": "#ffffff",
                    },
                    fontFamily: {
                        "display": ["Newsreader", "serif"],
                        "body": ["Noto Sans", "sans-serif"],
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        /* Custom scrollbar for better aesthetic in dark mode */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #221310;
        }
        ::-webkit-scrollbar-thumb {
            background: #543f3b;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #ec3713;
        }
        
        /* Subtle entrance animation */
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
</style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-display overflow-x-hidden transition-colors duration-300">
    <!-- Top Navigation Bar -->
    <header class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-gray-200 dark:border-[#392b28] bg-white/90 dark:bg-[#181211]/90 backdrop-blur-md px-10 py-4 shadow-sm">
        <div class="flex items-center gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-4">
                <div class="size-8 text-primary">
                    <svg fill="currentColor" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" d="M39.475 21.6262C40.358 21.4363 40.6863 21.5589 40.7581 21.5934C40.7876 21.655 40.8547 21.857 40.8082 22.3336C40.7408 23.0255 40.4502 24.0046 39.8572 25.2301C38.6799 27.6631 36.5085 30.6631 33.5858 33.5858C30.6631 36.5085 27.6632 38.6799 25.2301 39.8572C24.0046 40.4502 23.0255 40.7407 22.3336 40.8082C21.8571 40.8547 21.6551 40.7875 21.5934 40.7581C21.5589 40.6863 21.4363 40.358 21.6262 39.475C21.8562 38.4054 22.4689 36.9657 23.5038 35.2817C24.7575 33.2417 26.5497 30.9744 28.7621 28.762C30.9744 26.5497 33.2417 24.7574 35.2817 23.5037C36.9657 22.4689 38.4054 21.8562 39.475 21.6262ZM4.41189 29.2403L18.7597 43.5881C19.8813 44.7097 21.4027 44.9179 22.7217 44.7893C24.0585 44.659 25.5148 44.1631 26.9723 43.4579C29.9052 42.0387 33.2618 39.5667 36.4142 36.4142C39.5667 33.2618 42.0387 29.9052 43.4579 26.9723C44.1631 25.5148 44.659 24.0585 44.7893 22.7217C44.9179 21.4027 44.7097 19.8813 43.5881 18.7597L29.2403 4.41187C27.8527 3.02428 25.8765 3.02573 24.2861 3.36776C22.6081 3.72863 20.7334 4.58419 18.8396 5.74801C16.4978 7.18716 13.9881 9.18353 11.5858 11.5858C9.18354 13.988 7.18717 16.4978 5.74802 18.8396C4.58421 20.7334 3.72865 22.6081 3.36778 24.2861C3.02574 25.8765 3.02429 27.8527 4.41189 29.2403Z" fill="currentColor" fill-rule="evenodd"></path>
                    </svg>
                </div>
                <h2 class="text-slate-900 dark:text-white text-2xl font-bold tracking-tight italic">TrueUnion</h2>
            </a>
        </div>
        <div class="flex items-center gap-8 hidden md:flex">
            <div class="flex items-center gap-6">
                <a class="text-slate-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-colors text-base font-medium" href="{{ route('home') }}">Home</a>
                <a class="text-slate-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-colors text-base font-medium" href="{{ route('search') }}">Search</a>
                <a class="text-slate-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-colors text-base font-medium" href="#">Matches</a>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('login') }}" class="flex cursor-pointer items-center justify-center rounded-full h-10 px-6 bg-transparent border border-gray-300 dark:border-[#543f3b] text-slate-900 dark:text-white text-sm font-bold hover:bg-gray-100 dark:hover:bg-[#392b28] transition-colors">
                    Login
                </a>
    </div>
        </div>
    </header>

    <main class="flex flex-col min-h-screen items-center py-10 px-4 md:px-0 bg-[url('https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=2564&auto=format&fit=crop')] bg-cover bg-center bg-no-repeat bg-fixed relative">
        <!-- Overlay for better readability on bg image -->
        <div class="absolute inset-0 bg-background-light/95 dark:bg-background-dark/95 backdrop-blur-sm z-0"></div>
        
        <div class="relative z-10 w-full max-w-[800px] flex flex-col gap-8 fade-in-up">
            <!-- Progress Bar -->
            <div class="w-full">
                <div class="flex flex-col gap-3">
                    <div class="flex gap-6 justify-between items-end">
                        <div class="flex flex-col">
                            <span class="text-primary text-sm font-bold tracking-widest uppercase mb-1">Step 1 of 2</span>
                            <h2 class="text-slate-900 dark:text-white text-3xl md:text-4xl font-bold font-display italic">Create Your Profile</h2>
                        </div>
                        <p class="text-slate-500 dark:text-[#b9a19d] text-lg font-medium font-display">50%</p>
                    </div>
                    <div class="rounded-full bg-gray-200 dark:bg-[#392b28] h-1.5 overflow-hidden">
                        <div class="h-full rounded-full bg-primary shadow-[0_0_10px_rgba(236,55,19,0.5)]" style="width: 50%;"></div>
                    </div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="bg-white dark:bg-surface-dark border border-gray-100 dark:border-[#392b28] rounded-2xl p-8 md:p-10 shadow-xl fade-in-up delay-100">
                <div class="mb-8 text-center md:text-left">
                    <p class="text-slate-600 dark:text-gray-300 text-lg font-normal leading-relaxed">
                        Help us find your perfect match by sharing your cultural and professional background. Accuracy here leads to better compatibility.
                    </p>
                </div>

                @if($errors->any())
                    <div class="mb-6 bg-red-500/10 border border-red-500/50 rounded-lg p-4">
                        <ul class="text-red-400 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-6 bg-green-500/10 border border-green-500/50 rounded-lg p-4">
                        <p class="text-green-400 text-sm">{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('signup.store') }}" method="POST" class="flex flex-col gap-10" id="registration-form" enctype="multipart/form-data">
                    @csrf

                    <!-- Section 0: Basic Information -->
                    <section class="flex flex-col gap-6">
                        <div class="border-b border-gray-100 dark:border-[#392b28] pb-4 flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">person</span>
                            <h3 class="text-slate-900 dark:text-white text-xl font-bold leading-tight">Basic Information</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Profile Picture</label>
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        <img id="profile-preview" src="https://placehold.co/120x120/e2f0cb/702963?text=Preview" alt="Profile Preview" class="w-24 h-24 rounded-full border-2 border-gray-300 dark:border-[#543f3b] object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" 
                                               id="profile_image_input" 
                                               name="profile_image_input" 
                                               accept="image/*"
                                               class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 py-2 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body text-sm"
                                               onchange="previewProfileImage(this)"/>
                                        <input type="hidden" name="profile_image" id="profile_image_data">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Upload your profile picture (optional)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Full Name <span class="text-primary">*</span></label>
                                <input type="text" 
                                       name="full_name" 
                                       value="{{ old('full_name') }}"
                                       class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-gray-400 dark:placeholder-gray-600 font-body" 
                                       placeholder="Enter your full name"
                                       required/>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Gender <span class="text-primary">*</span></label>
                                <div class="relative">
                                    <select name="gender" 
                                            class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none appearance-none transition-all cursor-pointer font-body" 
                                            required>
                                        <option disabled selected value="">Select Gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-3 text-gray-400 pointer-events-none">expand_more</span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Email <span class="text-primary">*</span></label>
                                <input type="email" 
                                       name="email" 
                                       value="{{ old('email') }}"
                                       class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-gray-400 dark:placeholder-gray-600 font-body" 
                                       placeholder="your@email.com"
                                       required/>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Mobile Number <span class="text-primary">*</span></label>
                                <input type="tel" 
                                       name="mobile_number" 
                                       value="{{ old('mobile_number') }}"
                                       class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-gray-400 dark:placeholder-gray-600 font-body" 
                                       placeholder="+91 9876543210"
                                       required/>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Password <span class="text-primary">*</span></label>
                                <input type="password" 
                                       name="password" 
                                       class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-gray-400 dark:placeholder-gray-600 font-body" 
                                       placeholder="Minimum 8 characters"
                                       required/>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Confirm Password <span class="text-primary">*</span></label>
                                <input type="password" 
                                       name="password_confirmation" 
                                       class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-gray-400 dark:placeholder-gray-600 font-body" 
                                       placeholder="Confirm your password"
                                       required/>
                            </div>
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Date of Birth <span class="text-primary">*</span></label>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="flex flex-col gap-2">
                                        <label class="text-xs text-gray-500 dark:text-gray-400">Day</label>
                                        <select name="birth_day" 
                                                class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none appearance-none transition-all cursor-pointer font-body" 
                                                required>
                                            <option disabled selected value="">Day</option>
                                            @for($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}" {{ old('birth_day') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label class="text-xs text-gray-500 dark:text-gray-400">Month</label>
                                        <select name="birth_month" 
                                                class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none appearance-none transition-all cursor-pointer font-body" 
                                                required>
                                            <option disabled selected value="">Month</option>
                                            @for($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ old('birth_month') == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label class="text-xs text-gray-500 dark:text-gray-400">Year</label>
                                        <select name="birth_year" 
                                                class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none appearance-none transition-all cursor-pointer font-body" 
                                                required>
                                            <option disabled selected value="">Year</option>
                                            @for($i = date('Y') - 18; $i >= date('Y') - 80; $i--)
                                                <option value="{{ $i }}" {{ old('birth_year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Section 1: Cultural Roots -->
                    <section class="flex flex-col gap-6">
                        <div class="border-b border-gray-100 dark:border-[#392b28] pb-4 flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">temple_hindu</span>
                            <h3 class="text-slate-900 dark:text-white text-xl font-bold leading-tight">Cultural Roots</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Caste <span class="text-primary">*</span></label>
                                <div class="relative">
                                    <select name="caste" 
                                            class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none appearance-none transition-all cursor-pointer font-body" 
                                            required>
                                        <option disabled selected value="">Select Caste</option>
                                        @foreach($castes as $caste)
                                            <option value="{{ $caste->title }}" {{ old('caste') == $caste->title ? 'selected' : '' }}>{{ $caste->title }}</option>
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-3 text-gray-400 pointer-events-none">expand_more</span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Mother Tongue <span class="text-primary">*</span></label>
                                <div class="relative">
                                    <select name="mother_tongue" 
                                            class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none appearance-none transition-all cursor-pointer font-body" 
                                            required>
                                        <option disabled selected value="">Select Mother Tongue</option>
                                        @foreach($motherTongues as $tongue)
                                            <option value="{{ $tongue->title }}" {{ old('mother_tongue') == $tongue->title ? 'selected' : '' }}>{{ $tongue->title }}</option>
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-3 text-gray-400 pointer-events-none">expand_more</span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <div class="flex justify-between">
                                    <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Raashi</label>
                                    <span class="text-xs text-gray-400 italic">Optional</span>
                                </div>
                                <div class="relative">
                                    <select name="raashi" 
                                            class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none appearance-none transition-all cursor-pointer font-body">
                                        <option value="">Select Raashi</option>
                                        @foreach($raashis as $raashi)
                                            <option value="{{ $raashi->name }}" {{ old('raashi') == $raashi->name ? 'selected' : '' }}>{{ $raashi->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-3 text-gray-400 pointer-events-none">expand_more</span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Nakshatra</label>
                                <div class="relative">
                                    <select name="nakshtra" 
                                            class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none appearance-none transition-all cursor-pointer font-body">
                                        <option value="">Select Nakshatra</option>
                                        @foreach($nakshatras as $nakshatra)
                                            <option value="{{ $nakshatra->name }}" {{ old('nakshtra') == $nakshatra->name ? 'selected' : '' }}>{{ $nakshatra->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-3 text-gray-400 pointer-events-none">expand_more</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Section 2: Education & Career -->
                    <section class="flex flex-col gap-6 fade-in-up delay-200">
                        <div class="border-b border-gray-100 dark:border-[#392b28] pb-4 flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">school</span>
                            <h3 class="text-slate-900 dark:text-white text-xl font-bold leading-tight">Education & Career</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Highest Education <span class="text-primary">*</span></label>
                                <div class="relative">
                                    <select name="highest_education_id" 
                                            id="highest_education_id"
                                            class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none appearance-none transition-all cursor-pointer font-body" 
                                            required>
                                        <option disabled selected value="">Select Degree</option>
                                        @foreach($highest_qualifications as $qualification)
                                            <option value="{{ $qualification->id }}" {{ old('highest_education_id') == $qualification->id ? 'selected' : '' }}>{{ $qualification->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-3 text-gray-400 pointer-events-none">expand_more</span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Education Details</label>
                                <div class="relative">
                                    <select name="education_id" 
                                            id="education_id"
                                            class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none appearance-none transition-all cursor-pointer font-body">
                                        <option value="">Select Education Details</option>
                                        @if(old('education_id'))
                                            @php
                                                $selectedEducation = \Illuminate\Support\Facades\DB::table('education_master')->where('id', old('education_id'))->first();
                                            @endphp
                                            @if($selectedEducation)
                                                <option value="{{ $selectedEducation->id }}" selected>{{ $selectedEducation->name }}</option>
                                            @endif
                                        @endif
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-3 text-gray-400 pointer-events-none">expand_more</span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Occupation <span class="text-primary">*</span></label>
                                <div class="relative">
                                    <select name="occupation_id" 
                                            class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none appearance-none transition-all cursor-pointer font-body" 
                                            required>
                                        <option disabled selected value="">Select Occupation</option>
                                        @foreach($occupations as $occupation)
                                            <option value="{{ $occupation->id }}" {{ old('occupation_id') == $occupation->id ? 'selected' : '' }}>{{ $occupation->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-3 text-gray-400 pointer-events-none">expand_more</span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Employed In</label>
                                <div class="relative">
                                    <select name="employed_in" 
                                            class="w-full h-12 rounded-lg bg-gray-50 dark:bg-[#181211] border border-gray-200 dark:border-[#543f3b] px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none appearance-none transition-all cursor-pointer font-body">
                                        <option value="">Select Employment Type</option>
                                        <option value="Business" {{ old('employed_in') == 'Business' ? 'selected' : '' }}>Business</option>
                                        <option value="Defence" {{ old('employed_in') == 'Defence' ? 'selected' : '' }}>Defence</option>
                                        <option value="Government" {{ old('employed_in') == 'Government' ? 'selected' : '' }}>Government</option>
                                        <option value="Private" {{ old('employed_in') == 'Private' ? 'selected' : '' }}>Private</option>
                                        <option value="Not Employed" {{ old('employed_in') == 'Not Employed' ? 'selected' : '' }}>Not Employed</option>
                                        <option value="Others" {{ old('employed_in') == 'Others' ? 'selected' : '' }}>Others</option>
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-3 text-gray-400 pointer-events-none">expand_more</span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="text-slate-700 dark:text-gray-200 text-sm font-medium">Annual Income <span class="text-primary">*</span></label>
                                <div class="p-6 bg-gray-50 dark:bg-[#181211] rounded-lg border border-gray-200 dark:border-[#543f3b]">
                                    <input type="range" 
                                           id="annual_income"
                                           class="w-full h-2 bg-gray-300 dark:bg-[#392b28] rounded-lg appearance-none cursor-pointer accent-primary" 
                                           min="0" 
                                           max="5000000" 
                                           step="50000"
                                           value="{{ old('annual_income', 500000) }}"
                                           oninput="updateIncomeDisplay(this.value)"/>
                                    <div class="flex justify-between mt-2 text-xs text-gray-500 dark:text-gray-400 font-body">
                                        <span>₹0</span>
                                        <span id="income-display" class="text-primary font-bold text-sm">₹{{ number_format(old('annual_income', 500000)) }}</span>
                                        <span>₹50L+</span>
                                    </div>
                                    <input type="hidden" name="annual_income" id="annual_income_hidden" value="{{ old('annual_income', 500000) }}">
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Terms and Conditions -->
                    <div class="flex items-start gap-3 pt-4 border-t border-gray-100 dark:border-[#392b28]">
                        <input type="checkbox" 
                               id="terms" 
                               name="terms" 
                               class="mt-1 h-4 w-4 rounded border-gray-300 dark:border-[#543f3b] bg-gray-50 dark:bg-[#181211] text-primary focus:ring-primary cursor-pointer" 
                               required/>
                        <label for="terms" class="text-sm text-slate-600 dark:text-gray-300 font-body">
                            I agree to the <a href="#" class="text-primary hover:underline">Terms and Conditions</a> and <a href="#" class="text-primary hover:underline">Privacy Policy</a> <span class="text-primary">*</span>
                        </label>
            </div>

                    <!-- Navigation Actions -->
                    <div class="flex items-center justify-between pt-6 mt-2 border-t border-gray-100 dark:border-[#392b28] fade-in-up delay-300">
                        <a href="{{ route('home') }}" class="group flex items-center gap-2 px-6 py-3 rounded-lg text-slate-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-colors font-medium text-sm">
                            <span class="material-symbols-outlined text-[20px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
                            Back
                        </a>
                        <button type="submit" class="flex items-center gap-2 px-8 py-3 rounded-lg bg-primary hover:bg-[#d42e0f] text-white shadow-lg shadow-primary/20 hover:shadow-primary/40 transition-all font-bold text-sm tracking-wide">
                            Create Account
                            <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                        </button>
        </div>
    </form>
</div>

            <!-- Security Badge/Trust Indicator -->
            <div class="flex justify-center items-center gap-2 text-slate-500 dark:text-[#b9a19d] text-xs pb-10 fade-in-up delay-300">
                <span class="material-symbols-outlined text-[16px]">lock</span>
                <p>Your information is securely encrypted and never shared without permission.</p>
        </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
        // Profile image preview and cropping
        let cropperInstance = null;
        
        function previewProfileImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('profile-preview');
                    preview.src = e.target.result;
                    
                    // Destroy existing cropper if any
                    if (cropperInstance) {
                        cropperInstance.destroy();
                        cropperInstance = null;
                    }
                    
                    // Initialize cropper
                    cropperInstance = new Cropper(preview, {
                        aspectRatio: 1,
                        viewMode: 1,
                        guides: true,
                        background: false,
                        autoCropArea: 0.8,
                        responsive: true,
                        cropBoxResizable: true,
                        ready: function() {
                            // Get cropped canvas when ready
                            updateCroppedImage();
                        }
                    });
                    
                    // Update hidden input when crop changes
                    preview.addEventListener('crop', function() {
                        updateCroppedImage();
                    });
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function updateCroppedImage() {
            if (cropperInstance) {
                const canvas = cropperInstance.getCroppedCanvas({
                    width: 400,
                    height: 400,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high'
                });
                if (canvas) {
                    canvas.toBlob(function(blob) {
                        const reader = new FileReader();
                        reader.onload = function() {
                            const base64 = reader.result;
                            document.getElementById('profile_image_data').value = base64;
                        };
                        reader.readAsDataURL(blob);
                    }, 'image/jpeg', 0.9);
                }
            }
        }

        // Update income display
        function updateIncomeDisplay(value) {
            const formatted = new Intl.NumberFormat('en-IN').format(value);
            document.getElementById('income-display').textContent = '₹' + formatted;
            document.getElementById('annual_income_hidden').value = value;
        }


        // Wait for jQuery and DOM to be ready
        $(document).ready(function() {
            // Load education details when highest education is selected
            $('#highest_education_id').on('change', function() {
                const qualificationId = $(this).val();
                const educationSelect = $('#education_id');
                
                console.log('Highest education changed:', qualificationId);
                
                educationSelect.html('<option value="">Loading...</option>');
                educationSelect.prop('disabled', true);
                
                if (qualificationId) {
                    const url = '/get-educations/' + qualificationId;
                    console.log('Fetching education details from:', url);
                    
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log('Education details received:', data);
                            educationSelect.html('<option value="">Select Education Details</option>');
                            if (data && data.length > 0) {
                                $.each(data, function(index, education) {
                                    educationSelect.append('<option value="' + education.id + '">' + education.name + '</option>');
                                });
                            } else {
                                educationSelect.append('<option value="">No education details available</option>');
                            }
                            educationSelect.prop('disabled', false);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error loading education details:', error);
                            console.error('Status:', status);
                            console.error('Response:', xhr.responseText);
                            console.error('Status Code:', xhr.status);
                            educationSelect.html('<option value="">Error loading education details. Please try again.</option>');
                            educationSelect.prop('disabled', false);
                        }
                    });
                } else {
                    educationSelect.html('<option value="">Select Education Details</option>');
                    educationSelect.prop('disabled', false);
                }
            });

            // Initialize income display on page load
            const incomeValue = document.getElementById('annual_income').value;
            if (incomeValue) {
                updateIncomeDisplay(incomeValue);
            }
        });
</script>
</body>
</html>
