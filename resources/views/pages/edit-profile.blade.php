<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>My Profile Overview - Matrimony</title>
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700&family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ec3713",
                        "background-light": "#f8f6f6",
                        "background-dark": "#181211",
                        "surface-dark": "#221a18",
                        "surface-light": "#ffffff",
                    },
                    fontFamily: {
                        "display": ["Spline Sans", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"],
                    },
                    borderRadius: {"DEFAULT": "1rem", "lg": "1.5rem", "xl": "2rem", "2xl": "3rem", "full": "9999px"},
                },
            },
        }
    </script>
<style>
        body { font-family: 'Spline Sans', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .material-symbols-outlined.filled { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
</head>
<body class="bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100 min-h-screen flex flex-col overflow-x-hidden transition-colors duration-300">
    @include('partials.user-navbar')

    <div class="flex flex-1 layout-container w-full max-w-[1440px] mx-auto">
        <!-- Sidebar Navigation -->
        <aside class="hidden lg:flex w-72 flex-col gap-6 py-8 px-6 sticky top-24 h-[calc(100vh-6rem)] overflow-y-auto border-r border-gray-200 dark:border-[#392b28]">
            <div class="flex items-center gap-4 mb-6">
                <div class="bg-center bg-no-repeat bg-cover rounded-full size-12 ring-2 ring-primary" 
                     style='background-image: url("{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&background=ec3713&color=fff' }}");'></div>
                <div class="flex flex-col">
                    <h1 class="text-gray-900 dark:text-white text-lg font-bold">{{ $user->full_name }}</h1>
                    <p class="text-gray-500 dark:text-[#b9a19d] text-xs font-mono">ID: M-{{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
            <nav class="flex flex-col gap-2">
                <a class="flex items-center gap-4 px-4 py-3 rounded-full bg-primary text-white shadow-lg shadow-primary/20 group" href="#overview">
                    <span class="material-symbols-outlined filled text-[20px]">person</span>
                    <span class="text-sm font-bold tracking-wide">Overview</span>
                </a>
                <a class="flex items-center gap-4 px-4 py-3 rounded-full text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-surface-dark hover:text-gray-900 dark:hover:text-white transition-all group" href="#basic-info">
                    <span class="material-symbols-outlined text-[20px] group-hover:text-primary transition-colors">badge</span>
                    <span class="text-sm font-medium">Basic Info</span>
                </a>
                <a class="flex items-center gap-4 px-4 py-3 rounded-full text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-surface-dark hover:text-gray-900 dark:hover:text-white transition-all group" href="#career">
                    <span class="material-symbols-outlined text-[20px] group-hover:text-primary transition-colors">work</span>
                    <span class="text-sm font-medium">Career &amp; Education</span>
                </a>
                <a class="flex items-center gap-4 px-4 py-3 rounded-full text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-surface-dark hover:text-gray-900 dark:hover:text-white transition-all group" href="#family">
                    <span class="material-symbols-outlined text-[20px] group-hover:text-primary transition-colors">diversity_3</span>
                    <span class="text-sm font-medium">Family Background</span>
                </a>
                <a class="flex items-center gap-4 px-4 py-3 rounded-full text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-surface-dark hover:text-gray-900 dark:hover:text-white transition-all group" href="#lifestyle">
                    <span class="material-symbols-outlined text-[20px] group-hover:text-primary transition-colors">local_cafe</span>
                    <span class="text-sm font-medium">Lifestyle</span>
                </a>
                <a class="flex items-center gap-4 px-4 py-3 rounded-full text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-surface-dark hover:text-gray-900 dark:hover:text-white transition-all group" href="#photos">
                    <span class="material-symbols-outlined text-[20px] group-hover:text-primary transition-colors">photo_library</span>
                    <span class="text-sm font-medium">Photos</span>
                </a>
            </nav>
            <div class="mt-auto">
                <div class="rounded-xl bg-gradient-to-br from-gray-800 to-black p-4 border border-gray-700">
                    <div class="flex items-center gap-2 mb-2 text-white/80 text-xs uppercase tracking-widest font-bold">
                        <span class="material-symbols-outlined text-primary text-sm">verified_user</span>
                        Security
                    </div>
                    <p class="text-xs text-gray-400 mb-3">Your profile is visible only to verified members.</p>
                    <a class="text-primary text-xs font-bold hover:underline" href="#">Privacy Settings</a>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col gap-8 p-6 lg:p-10 max-w-[1120px] mx-auto w-full">
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-500/20 border border-green-500 text-green-300 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b border-gray-200 dark:border-white/5 pb-6">
                <div>
                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 dark:text-white tracking-tight mb-2">My Profile Overview</h1>
                    <p class="text-gray-500 dark:text-[#b9a19d] font-medium flex items-center gap-2">
                        <span class="inline-block size-2 rounded-full bg-green-500"></span>
                        Last login: {{ $user->updated_at ? $user->updated_at->diffForHumans() : 'Recently' }}
                    </p>
                </div>
                <a href="{{ route('profile.view', $user->id) }}" class="hidden md:flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-lg">visibility</span>
                    Preview Public View
                </a>
            </div>

            <!-- Form -->
            <form action="{{ route('profile.update') }}" method="POST" id="profileForm">
        @csrf
        @method('PATCH')

                <!-- Completeness Gauge & Hero -->
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch mb-6" id="overview">
                    <!-- Hero Identity Card -->
                    <div class="lg:col-span-2 relative bg-surface-light dark:bg-surface-dark rounded-xl p-6 md:p-8 flex flex-col sm:flex-row gap-6 items-center sm:items-start shadow-xl dark:shadow-none border border-gray-200 dark:border-white/5 overflow-hidden group h-full">
                        <div class="absolute top-0 right-0 p-4">
                            <div class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full uppercase tracking-widest border border-primary/20 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">verified</span> Verified
                            </div>
                        </div>
                        <div class="relative">
                            <div class="size-32 rounded-full p-1 bg-gradient-to-tr from-primary to-orange-400">
                                <div class="size-full rounded-full bg-cover bg-center border-4 border-surface-light dark:border-surface-dark" 
                                     id="profile-image-preview"
                                     style='background-image: url("{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&size=400&background=ec3713&color=fff' }}");'></div>
                            </div>
                            <button type="button" id="changePhotoBtn" class="absolute bottom-0 right-0 bg-primary text-white p-2 rounded-full shadow-lg hover:scale-110 transition-transform" title="Change Photo">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </button>
                            <input type="file" id="profile_image_input" class="hidden" accept="image/*">
            <input type="hidden" name="profile_image" id="profile_image_data">
        </div>
                        <div class="flex flex-col text-center sm:text-left flex-1 justify-center h-full pt-2">
                            <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}" 
                                   class="text-3xl font-bold text-gray-900 dark:text-white mb-1 bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full" 
                                   placeholder="Your Name">
                            <p class="text-gray-500 dark:text-[#b9a19d] text-lg mb-4">
                                <span id="age-display">{{ $user->dob ? Carbon\Carbon::parse($user->dob)->age : '' }}</span>
                                @if($user->occupation)
                                    <span> • {{ $user->occupation }}</span>
                                @endif
                            </p>
                            <div class="flex flex-wrap justify-center sm:justify-start gap-3 mt-auto">
                                @if($user->height)
                                <span class="bg-gray-100 dark:bg-white/5 text-gray-700 dark:text-gray-300 px-3 py-1.5 rounded-full text-sm font-medium border border-gray-200 dark:border-white/5">{{ $user->height }}</span>
                                @endif
                                @if($user->marital_status)
                                <span class="bg-gray-100 dark:bg-white/5 text-gray-700 dark:text-gray-300 px-3 py-1.5 rounded-full text-sm font-medium border border-gray-200 dark:border-white/5">{{ $user->marital_status }}</span>
                                @endif
                                @if($user->caste || $user->mother_tongue)
                                <span class="bg-gray-100 dark:bg-white/5 text-gray-700 dark:text-gray-300 px-3 py-1.5 rounded-full text-sm font-medium border border-gray-200 dark:border-white/5">
                                    {{ $user->caste }}{{ $user->caste && $user->mother_tongue ? ', ' : '' }}{{ $user->mother_tongue }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Completeness Gauge -->
                    <div class="bg-surface-light dark:bg-surface-dark rounded-xl p-4 md:p-5 flex flex-col justify-between shadow-xl dark:shadow-none border border-gray-200 dark:border-white/5 relative overflow-hidden h-full">
                        <div class="flex justify-between items-center mb-3 z-10">
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">Profile Strength</h3>
                            <span class="text-primary font-black text-xl">{{ $completeness }}%</span>
                        </div>
                        <div class="relative h-3 bg-gray-200 dark:bg-white/10 rounded-full overflow-hidden mb-3 z-10">
                            <div class="absolute top-0 left-0 h-full bg-gradient-to-r from-primary to-orange-500 rounded-full shadow-[0_0_15px_rgba(236,55,19,0.5)]" style="width: {{ $completeness }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-4 z-10 leading-relaxed">
                            Great job! Verify your ID to reach <strong class="text-gray-900 dark:text-white">100%</strong> and get <span class="text-primary font-bold">3x more views</span>.
                        </p>
                        <button type="button" class="w-full py-2 bg-gray-900 dark:bg-white text-white dark:text-black font-bold rounded-full hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white transition-all z-10 flex items-center justify-center gap-2 text-sm">
                            Verify ID Now
                            <span class="material-symbols-outlined text-xs">arrow_forward</span>
                        </button>
                        <div class="absolute -bottom-10 -right-10 size-40 bg-primary/10 rounded-full blur-3xl z-0"></div>
                    </div>
                </section>

                <!-- Grid Layout for Details -->
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                    <!-- Basic Info -->
                    <section class="group bg-surface-light dark:bg-surface-dark rounded-xl border border-gray-200 dark:border-white/5 p-6 md:p-8 transition-all hover:shadow-2xl hover:border-primary/30 relative" id="basic-info">
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-gray-100 dark:bg-white/5 rounded-full text-primary">
                                    <span class="material-symbols-outlined">badge</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Basic Information</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-4">
                            <div class="sm:col-span-2">
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-2">Date of Birth</p>
                                <div class="flex gap-2 flex-wrap">
                                    <select name="birth_day" class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none flex-1 min-w-[80px]">
                                        <option value="">Day</option>
                                        @for($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}" {{ old('birth_day', $birthDay) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <select name="birth_month" class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none flex-1 min-w-[100px]">
                                        <option value="">Month</option>
                                        @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ old('birth_month', $birthMonth) == $i ? 'selected' : '' }}>{{ date('M', mktime(0,0,0,$i,1)) }}</option>
                                        @endfor
                                    </select>
                                    <select name="birth_year" class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none flex-1 min-w-[100px]">
                                        <option value="">Year</option>
                                        @for($i = date('Y'); $i >= 1950; $i--)
                                            <option value="{{ $i }}" {{ old('birth_year', $birthYear) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-2">Gender</p>
                                <select name="gender" class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full">
                                    <option value="">Select</option>
                                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Mother Tongue</p>
                                <select name="mother_tongue" class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full">
                                    <option value="">Select</option>
                                    @foreach($motherTongues as $mt)
                                        <option value="{{ $mt->title }}" {{ old('mother_tongue', $user->mother_tongue) == $mt->title ? 'selected' : '' }}>{{ $mt->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Marital Status</p>
                                <select name="marital_status" class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full">
                                    <option value="">Select</option>
                                    <option value="Never Married" {{ old('marital_status', $user->marital_status) == 'Never Married' ? 'selected' : '' }}>Never Married</option>
                                    <option value="Divorced" {{ old('marital_status', $user->marital_status) == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                    <option value="Widowed" {{ old('marital_status', $user->marital_status) == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                </select>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Caste / Sect</p>
                                <select name="caste" class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full">
                                    <option value="">Select</option>
                                    @foreach($castes as $caste)
                                        <option value="{{ $caste->title }}" {{ old('caste', $user->caste) == $caste->title ? 'selected' : '' }}>{{ $caste->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Height</p>
                                <input type="text" name="height" value="{{ old('height', $user->height) }}" 
                                       class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full" 
                                       placeholder="e.g., 5' 10&quot;">
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Raashi</p>
                                <select name="raashi" class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full">
                                    <option value="">Select</option>
                                    @foreach($raashis as $raashi)
                                        <option value="{{ $raashi->name }}" {{ old('raashi', $user->raashi) == $raashi->name ? 'selected' : '' }}>{{ $raashi->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Nakshatra</p>
                                <select name="nakshtra" class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full">
                                    <option value="">Select</option>
                                    @foreach($nakshatras as $nakshatra)
                                        <option value="{{ $nakshatra->name }}" {{ old('nakshtra', $user->nakshtra) == $nakshatra->name ? 'selected' : '' }}>{{ $nakshatra->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="sm:col-span-2">
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-2">Bio / About Me</p>
                                <textarea name="languages_known" rows="3" 
                                          class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed w-full bg-transparent border border-gray-200 dark:border-white/5 rounded-xl px-4 py-3 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 resize-none transition-colors"
                                          placeholder="Tell us about yourself...">{{ old('languages_known', $user->languages_known) }}</textarea>
                            </div>
                        </div>
                    </section>

                    <!-- Career & Education -->
                    <section class="group bg-surface-light dark:bg-surface-dark rounded-xl border border-gray-200 dark:border-white/5 p-6 md:p-8 transition-all hover:shadow-2xl hover:border-primary/30 relative" id="career">
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-gray-100 dark:bg-white/5 rounded-full text-primary">
                                    <span class="material-symbols-outlined">school</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Career &amp; Education</h3>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Highest Education</p>
                                <select name="highest_education_id" id="highest_education_id" class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full">
                                    <option value="">Select</option>
                                    @foreach($highestQualifications as $qual)
                                        <option value="{{ $qual->id }}" {{ old('highest_education_id') == $qual->id || ($user->highest_education && $user->highest_education == $qual->name) ? 'selected' : '' }}>{{ $qual->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Education Details</p>
                                <select name="education_id" id="education_id" class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full">
                                    <option value="">Select</option>
                                    @foreach($educations as $edu)
                                        <option value="{{ $edu->id }}" {{ old('education_id') == $edu->id || ($user->education_details && $user->education_details == $edu->name) ? 'selected' : '' }}>{{ $edu->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Occupation</p>
                                <select name="occupation_id" class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full">
                                    <option value="">Select</option>
                                    @foreach($occupations as $occ)
                                        <option value="{{ $occ->id }}" {{ old('occupation_id') == $occ->id || ($user->occupation && $user->occupation == $occ->name) ? 'selected' : '' }}>{{ $occ->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="pt-4 border-t border-gray-200 dark:border-white/5 grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Annual Income</p>
                                    <input type="text" name="annual_income" value="{{ old('annual_income', $user->annual_income) }}" 
                                           class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full" 
                                           placeholder="e.g., ₹ 35L - 50L">
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Employed In</p>
                                    <select name="employed_in" class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full">
                                        <option value="">Select</option>
                                        <option value="Business" {{ old('employed_in', $user->employed_in) == 'Business' ? 'selected' : '' }}>Business</option>
                                        <option value="Defence" {{ old('employed_in', $user->employed_in) == 'Defence' ? 'selected' : '' }}>Defence</option>
                                        <option value="Government" {{ old('employed_in', $user->employed_in) == 'Government' ? 'selected' : '' }}>Government</option>
                                        <option value="Private" {{ old('employed_in', $user->employed_in) == 'Private' ? 'selected' : '' }}>Private</option>
                                        <option value="Not Employed" {{ old('employed_in', $user->employed_in) == 'Not Employed' ? 'selected' : '' }}>Not Employed</option>
                                        <option value="Others" {{ old('employed_in', $user->employed_in) == 'Others' ? 'selected' : '' }}>Others</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Family Details -->
                    <section class="group bg-surface-light dark:bg-surface-dark rounded-xl border border-gray-200 dark:border-white/5 p-6 md:p-8 transition-all hover:shadow-2xl hover:border-primary/30 relative" id="family">
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-gray-100 dark:bg-white/5 rounded-full text-primary">
                                    <span class="material-symbols-outlined">diversity_3</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Location</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-4">
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Country</p>
                                <input type="text" name="country" value="{{ old('country', $user->country) }}" 
                                       class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full" 
                                       placeholder="Country">
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">State</p>
                                <input type="text" name="state" value="{{ old('state', $user->state) }}" 
                                       class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full" 
                                       placeholder="State">
                            </div>
                            <div class="sm:col-span-2">
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">City</p>
                                <input type="text" name="city" value="{{ old('city', $user->city) }}" 
                                       class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full" 
                                       placeholder="City">
                            </div>
                        </div>
                    </section>

                    <!-- Lifestyle & Interests -->
                    <section class="group bg-surface-light dark:bg-surface-dark rounded-xl border border-gray-200 dark:border-white/5 p-6 md:p-8 transition-all hover:shadow-2xl hover:border-primary/30 relative" id="lifestyle">
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-gray-100 dark:bg-white/5 rounded-full text-primary">
                                    <span class="material-symbols-outlined">local_cafe</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Lifestyle &amp; Interests</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Diet</p>
                                <select name="diet" class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full">
                                    <option value="">Select</option>
                                    <option value="Vegetarian" {{ old('diet', $user->diet) == 'Vegetarian' ? 'selected' : '' }}>Vegetarian</option>
                                    <option value="Non-Vegetarian" {{ old('diet', $user->diet) == 'Non-Vegetarian' ? 'selected' : '' }}>Non-Vegetarian</option>
                                    <option value="Vegan" {{ old('diet', $user->diet) == 'Vegan' ? 'selected' : '' }}>Vegan</option>
                                </select>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Weight (kg)</p>
                                <input type="number" name="weight" value="{{ old('weight', $user->weight) }}" 
                                       class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full" 
                                       placeholder="Weight">
                            </div>
                        </div>
                    </section>

                    <!-- Contact Section -->
                    <section class="xl:col-span-2 group bg-surface-light dark:bg-surface-dark rounded-xl border border-gray-200 dark:border-white/5 p-6 md:p-8 transition-all hover:shadow-2xl hover:border-primary/30 relative" id="contact">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-gray-100 dark:bg-white/5 rounded-full text-primary">
                                    <span class="material-symbols-outlined">home_pin</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Contact &amp; Location</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Phone Number</p>
                                <input type="text" name="mobile_number" value="{{ old('mobile_number', $user->mobile_number) }}" 
                                       class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full" 
                                       placeholder="Mobile Number">
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-1">Email</p>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                       class="text-base font-semibold text-gray-900 dark:text-white bg-transparent border-b-2 border-transparent focus:border-primary outline-none w-full" 
                                       placeholder="Email">
                                @if($user->email_verified_at)
                                <span class="material-symbols-outlined text-xs text-green-500" title="Verified">check_circle</span>
                                @endif
            </div>
                        </div>
                    </section>
                </div>

                <!-- Photos Section -->
                <section class="xl:col-span-2 group bg-surface-light dark:bg-surface-dark rounded-xl border border-gray-200 dark:border-white/5 p-6 md:p-8 transition-all hover:shadow-2xl hover:border-primary/30 relative" id="photos">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-gray-100 dark:bg-white/5 rounded-full text-primary">
                                <span class="material-symbols-outlined">photo_library</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Photos</h3>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <!-- Existing Photos -->
                        @if($user->profile_image)
                        <div class="relative group aspect-square rounded-xl overflow-hidden border-2 border-gray-200 dark:border-white/5">
                            <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $user->profile_image) }}');"></div>
                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                <button type="button" class="p-2 bg-white/20 backdrop-blur-sm rounded-full hover:bg-white/30 transition-colors" title="Set as Profile Photo">
                                    <span class="material-symbols-outlined text-white text-sm">star</span>
                                </button>
                                <button type="button" class="p-2 bg-white/20 backdrop-blur-sm rounded-full hover:bg-white/30 transition-colors delete-photo-btn" data-photo-id="profile" title="Delete">
                                    <span class="material-symbols-outlined text-white text-sm">delete</span>
                                </button>
                            </div>
                            <div class="absolute top-2 left-2 px-2 py-1 bg-primary text-white text-xs font-bold rounded">Profile</div>
                        </div>
                        @endif
                        
                        <!-- Placeholder for additional photos -->
                        @for($i = 0; $i < 7; $i++)
                        <div class="relative aspect-square rounded-xl border-2 border-dashed border-gray-300 dark:border-white/10 flex items-center justify-center cursor-pointer hover:border-primary transition-colors bg-gray-50 dark:bg-white/5 upload-photo-area group">
                            <input type="file" class="hidden photo-upload-input" accept="image/*" data-index="{{ $i }}">
                            <div class="text-center p-4">
                                <span class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-4xl mb-2 group-hover:text-primary transition-colors">add_photo_alternate</span>
                                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium group-hover:text-primary transition-colors">Add Photo</p>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">info</span>
                        You can upload up to 8 additional photos. Your profile photo is displayed first.
                    </p>
                </section>

                <!-- Submit Button -->
                <div class="flex justify-end gap-4 mt-8">
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-gray-200 dark:bg-surface-dark text-gray-700 dark:text-white rounded-full font-bold hover:bg-gray-300 dark:hover:bg-surface-border transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="px-8 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-dark transition-colors shadow-lg shadow-primary/20">
                        Save Changes
                    </button>
        </div>
    </form>

            <!-- Footer -->
            <footer class="flex flex-col md:flex-row justify-between items-center gap-4 py-8 mt-4 border-t border-gray-200 dark:border-white/5 text-sm text-gray-500 dark:text-gray-400">
                <div class="flex gap-6">
                    <a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
                    <a class="hover:text-primary transition-colors" href="#">Terms of Use</a>
                    <a class="hover:text-primary transition-colors" href="#">Help Center</a>
                </div>
                <button type="button" class="text-red-500 hover:text-red-400 font-medium transition-colors">Deactivate Profile</button>
            </footer>
        </main>
</div>

<!-- Cropper Modal -->
<div id="cropModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center p-4 z-50 hidden">
        <div class="bg-white dark:bg-surface-dark p-6 rounded-lg shadow-xl max-w-lg w-full relative">
            <button type="button" id="closeCropModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 text-2xl leading-none">&times;</button>
            <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Crop Your Image</h3>
        <div><img id="imageToCrop" src=""></div>
        <div class="mt-4 flex justify-end space-x-2">
                <button type="button" id="cancelCrop" class="bg-gray-200 dark:bg-surface-border text-gray-700 dark:text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-surface-dark transition">Cancel</button>
                <button type="button" id="cropButton" class="bg-primary text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-dark transition">Crop and Save</button>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('profile_image_input');
            const changePhotoBtn = document.getElementById('changePhotoBtn');
        const modal = document.getElementById('cropModal');
        const imageToCrop = document.getElementById('imageToCrop');
        const cropButton = document.getElementById('cropButton');
        const hiddenImageDataInput = document.getElementById('profile_image_data');
            const profileImagePreview = document.getElementById('profile-image-preview');
        let cropper;

            changePhotoBtn.addEventListener('click', () => {
                imageInput.click();
            });

        function closeModal() {
            modal.classList.add('hidden');
            if (cropper) {
                cropper.destroy();
                    cropper = null;
            }
        }
        
        document.getElementById('cancelCrop').addEventListener('click', () => {
            closeModal();
                imageInput.value = '';
        });
            
        document.getElementById('closeCropModal').addEventListener('click', () => {
            closeModal();
                imageInput.value = '';
    });

        imageInput.addEventListener('change', function (e) {
            const files = e.target.files;
            if (files && files.length > 0) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    imageToCrop.src = event.target.result;
                    modal.classList.remove('hidden');
                        if (cropper) {
                            cropper.destroy();
                        }
                    cropper = new Cropper(imageToCrop, {
                        aspectRatio: 1,
                        viewMode: 1,
                        dragMode: 'move',
                        background: false,
                    });
                };
                reader.readAsDataURL(files[0]);
            }
        });

        cropButton.addEventListener('click', function () {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({ width: 400, height: 400 });
                const croppedImageDataURL = canvas.toDataURL('image/jpeg');
                
                hiddenImageDataInput.value = croppedImageDataURL;
                    profileImagePreview.style.backgroundImage = 'url(' + croppedImageDataURL + ')';
                    
                    closeModal();
                }
            });

            // Update age display when DOB changes
            const birthDay = document.querySelector('select[name="birth_day"]');
            const birthMonth = document.querySelector('select[name="birth_month"]');
            const birthYear = document.querySelector('select[name="birth_year"]');
            const ageDisplay = document.getElementById('age-display');

            function updateAge() {
                const day = birthDay.value;
                const month = birthMonth.value;
                const year = birthYear.value;
                
                if (day && month && year) {
                    const dob = new Date(year, month - 1, day);
                    const today = new Date();
                    let age = today.getFullYear() - dob.getFullYear();
                    const monthDiff = today.getMonth() - dob.getMonth();
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                        age--;
                    }
                    ageDisplay.textContent = age;
            } else {
                    ageDisplay.textContent = '';
                }
            }

            birthDay.addEventListener('change', updateAge);
            birthMonth.addEventListener('change', updateAge);
            birthYear.addEventListener('change', updateAge);

            // Load education details when highest education changes
            const highestEducationSelect = document.getElementById('highest_education_id');
            const educationSelect = document.getElementById('education_id');

            if (highestEducationSelect) {
                highestEducationSelect.addEventListener('change', function() {
                    const qualificationId = this.value;
                    educationSelect.innerHTML = '<option value="">Loading...</option>';
                    educationSelect.disabled = true;
                    
                    if (qualificationId) {
                        fetch('/get-educations/' + qualificationId)
                            .then(response => response.json())
                            .then(data => {
                                educationSelect.innerHTML = '<option value="">Select</option>';
                                data.forEach(education => {
                                    const option = document.createElement('option');
                                    option.value = education.id;
                                    option.textContent = education.name;
                                    educationSelect.appendChild(option);
                                });
                                educationSelect.disabled = false;
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                educationSelect.innerHTML = '<option value="">Error loading</option>';
                                educationSelect.disabled = false;
                            });
                    } else {
                        educationSelect.innerHTML = '<option value="">Select</option>';
                        educationSelect.disabled = false;
                    }
                });
            }

            // Photo upload functionality
            const uploadAreas = document.querySelectorAll('.upload-photo-area');
            const photoInputs = document.querySelectorAll('.photo-upload-input');

            uploadAreas.forEach((area, index) => {
                const input = photoInputs[index];
                
                area.addEventListener('click', () => {
                    input.click();
                });

                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        // Check file size (max 5MB)
                        if (file.size > 5 * 1024 * 1024) {
                            alert('File size must be less than 5MB');
                            input.value = '';
                            return;
                        }
                        
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            // Replace the upload area with the uploaded photo
                            area.innerHTML = `
                                <div class="w-full h-full bg-cover bg-center rounded-xl" style="background-image: url('${event.target.result}');"></div>
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2 rounded-xl">
                                    <button type="button" class="p-2 bg-white/20 backdrop-blur-sm rounded-full hover:bg-white/30 transition-colors delete-uploaded-photo" title="Remove">
                                        <span class="material-symbols-outlined text-white text-sm">delete</span>
                                    </button>
                                </div>
                            `;
                            area.classList.remove('border-dashed', 'border-gray-300', 'dark:border-white/10', 'bg-gray-50', 'dark:bg-white/5');
                            area.classList.add('border-solid', 'border-gray-200', 'dark:border-white/5', 'group');
                            
                            // Store the image data
                            area.dataset.imageData = event.target.result;
                            
                            // Add delete functionality
                            const deleteBtn = area.querySelector('.delete-uploaded-photo');
                            deleteBtn.addEventListener('click', function(e) {
                                e.stopPropagation();
                                area.innerHTML = `
                                    <div class="text-center p-4">
                                        <span class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-4xl mb-2">add_photo_alternate</span>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Add Photo</p>
                                    </div>
                                `;
                                area.classList.add('border-dashed', 'border-gray-300', 'dark:border-white/10', 'bg-gray-50', 'dark:bg-white/5');
                                area.classList.remove('border-solid', 'border-gray-200', 'dark:border-white/5', 'group');
                                input.value = '';
                                delete area.dataset.imageData;
                            });
                        };
                        reader.readAsDataURL(file);
            }
        });
    });

            // Collect all uploaded photos before form submission
            const profileForm = document.getElementById('profileForm');
            profileForm.addEventListener('submit', function(e) {
                const uploadedPhotos = [];
                uploadAreas.forEach((area, index) => {
                    if (area.dataset.imageData) {
                        uploadedPhotos.push({
                            index: index,
                            data: area.dataset.imageData
                        });
                    }
                });
                
                // Store photos data in a hidden input
                if (uploadedPhotos.length > 0) {
                    let photosInput = document.getElementById('additional_photos_data');
                    if (!photosInput) {
                        photosInput = document.createElement('input');
                        photosInput.type = 'hidden';
                        photosInput.name = 'additional_photos';
                        photosInput.id = 'additional_photos_data';
                        profileForm.appendChild(photosInput);
                    }
                    photosInput.value = JSON.stringify(uploadedPhotos);
                }
            });
        });
</script>
</body>
</html>
