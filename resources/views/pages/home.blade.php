@extends('layouts.app')

@section('title', __('home.title'))

@section('content')
<div class="w-full">
    <!-- Hero Section -->
    <section class="text-center py-20 bg-gradient-to-br from-indigo-50 to-purple-50 px-4">
        <div class="bg-white/80 backdrop-blur-sm py-12 px-4 rounded-lg inline-block">
            <h1 class="text-5xl font-extrabold text-gray-800 tracking-tight">{{ __('home.hero_title') }}</h1>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-600">{{ __('home.hero_subtitle') }}</p>
            <div class="mt-8 flex justify-center space-x-4">
                <a href="{{ route('signup') }}" class="submit-btn px-8 py-3 text-lg">{{ __('home.get_started') }}</a>
                <a href="{{ route('search') }}" class="select-btn px-8 py-3 text-lg">{{ __('home.browse_profiles') }}</a>
            </div>
        </div>
    </section>

    <!-- Featured Profiles Section -->
    <section class="py-16 px-4">
        <h2 class="text-3xl font-bold text-gray-800 text-center">{{ __('home.featured_profiles') }}</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
            <!-- Profile 1 -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <img class="w-32 h-32 rounded-full mx-auto" src="https://placehold.co/200x200/A8D5E2/333333?text=Priya" alt="Profile Photo of Priya">
                <h3 class="mt-4 text-xl font-semibold text-gray-700">{{ __('home.featured_profiles.profile1.name_age') }}</h3>
                <p class="text-gray-500">{{ __('home.featured_profiles.profile1.occupation_location') }}</p>
                <p class="mt-2 text-gray-600 text-sm">"{{ __('home.profile_1_bio') }}"</p>
            </div>
            <!-- Profile 2 -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <img class="w-32 h-32 rounded-full mx-auto" src="https://placehold.co/200x200/F9A826/333333?text=Rohan" alt="Profile Photo of Rohan">
                <h3 class="mt-4 text-xl font-semibold text-gray-700">{{ __('home.featured_profiles.profile2.name_age') }}</h3>
                <p class="text-gray-500">{{ __('home.featured_profiles.profile2.occupation_location') }}</p>
                <p class="mt-2 text-gray-600 text-sm">"{{ __('home.profile_2_bio') }}"</p>
            </div>
            <!-- Profile 3 -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <img class="w-32 h-32 rounded-full mx-auto" src="https://placehold.co/200x200/FFD1DC/333333?text=Anjali" alt="Profile Photo of Anjali">
                <h3 class="mt-4 text-xl font-semibold text-gray-700">{{ __('home.featured_profiles.profile3.name_age') }}</h3>
                <p class="text-gray-500">{{ __('home.featured_profiles.profile3.occupation_location') }}</p>
                <p class="mt-2 text-gray-600 text-sm">"{{ __('home.profile_3_bio') }}"</p>
            </div>
            <!-- Profile 4 -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <img class="w-32 h-32 rounded-full mx-auto" src="https://placehold.co/200x200/C8E6C9/333333?text=Vikram" alt="Profile Photo of Vikram">
                <h3 class="mt-4 text-xl font-semibold text-gray-700">{{ __('home.featured_profiles.profile4.name_age') }}</h3>
                <p class="text-gray-500">{{ __('home.featured_profiles.profile4.occupation_location') }}</p>
                <p class="mt-2 text-gray-600 text-sm">"{{ __('home.profile_4_bio') }}"</p>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-16 border-t-2 border-gray-100 bg-gray-50 px-4">
         <h2 class="text-3xl font-bold text-gray-800 text-center">{{ __('home.how_it_works') }}</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-12 max-w-6xl mx-auto">
            <!-- Step 1 -->
            <div class="text-center">
                <div class="flex items-center justify-center h-20 w-20 rounded-full bg-white mx-auto shadow-md">
                    <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <h3 class="mt-4 text-xl font-semibold text-gray-700">{{ __('home.step_1_title') }}</h3>
                <p class="mt-2 text-gray-600">{{ __('home.step_1_desc') }}</p>
            </div>
            <!-- Step 2 -->
            <div class="text-center">
                <div class="flex items-center justify-center h-20 w-20 rounded-full bg-white mx-auto shadow-md">
                    <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="mt-4 text-xl font-semibold text-gray-700">{{ __('home.step_2_title') }}</h3>
                <p class="mt-2 text-gray-600">{{ __('home.step_2_desc') }}</p>
            </div>
            <!-- Step 3 -->
            <div class="text-center">
                <div class="flex items-center justify-center h-20 w-20 rounded-full bg-white mx-auto shadow-md">
                     <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <h3 class="mt-4 text-xl font-semibold text-gray-700">{{ __('home.step_3_title') }}</h3>
                <p class="mt-2 text-gray-600">{{ __('home.step_3_desc') }}</p>
            </div>
        </div>
    </section>

    <!-- Success Stories Section -->
    <section class="py-16 px-4">
        <h2 class="text-3xl font-bold text-gray-800 text-center">{{ __('home.success_stories') }}</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-12 max-w-4xl mx-auto">
            <!-- Story 1 -->
            <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
                <img class="w-24 h-24 rounded-full flex-shrink-0 object-cover" src="https://placehold.co/200x200/FFE0B2/333333?text=A%26R" alt="Couple Photo">
                <div class="ml-6 text-left">
                    <p class="text-gray-600">"{{ __('home.story_1_text') }}"</p>
                    <p class="mt-2 font-semibold text-gray-700">- {{ __('home.story_1_author') }}</p>
                </div>
            </div>
            <!-- Story 2 -->
            <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
                <img class="w-24 h-24 rounded-full flex-shrink-0 object-cover" src="https://placehold.co/200x200/B2DFDB/333333?text=S%26P" alt="Couple Photo">
                <div class="ml-6 text-left">
                    <p class="text-gray-600">"{{ __('home.story_2_text') }}"</p>
                    <p class="mt-2 font-semibold text-gray-700">- {{ __('home.story_2_author') }}</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
