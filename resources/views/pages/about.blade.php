@extends('layouts.app')

@section('title', __('About Us'))

@section('content')
<div class="content-container max-w-6xl mx-auto p-0 overflow-hidden">

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-indigo-500 to-purple-600 text-white py-16 px-6 rounded-lg">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold mb-4">{{ __('about_title') }}</h1>
            <p class="text-lg sm:text-xl text-indigo-100">
                {{ __('about_subtitle') }}
            </p>
        </div>
    </section>

    <!-- Mission & Values -->
    <section class="py-16 px-6">
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ __('mission_values_title') }}</h2>
            <p class="text-gray-600">
                {{ __('mission_values_desc') }}
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <div class="p-6 bg-white rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold mb-2 text-indigo-600">{{ __('value_trust') }}</h3>
                <p class="text-gray-600">{{ __('value_trust_desc') }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold mb-2 text-indigo-600">{{ __('value_innovation') }}</h3>
                <p class="text-gray-600">{{ __('value_innovation_desc') }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold mb-2 text-indigo-600">{{ __('value_community') }}</h3>
                <p class="text-gray-600">{{ __('value_community_desc') }}</p>
            </div>
        </div>
    </section>

    <!-- Company Details -->
    <section class="bg-gray-50 py-16 px-6 rounded-lg">
        <div class="max-w-5xl mx-auto text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ __('who_we_are_title') }}</h2>
            <p class="text-gray-600">
                {{ __('who_we_are_desc') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto text-center">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-indigo-600 mb-2">{{ __('our_story_title') }}</h3>
                <p class="text-gray-600">
                    {{ __('our_story_desc') }}
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-indigo-600 mb-2">{{ __('our_impact_title') }}</h3>
                <p class="text-gray-600">
                    {{ __('our_impact_desc') }}
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-indigo-600 mb-2">{{ __('our_vision_title') }}</h3>
                <p class="text-gray-600">
                    {{ __('our_vision_desc') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 px-6 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ __('cta_title') }}</h2>
        <p class="text-gray-600 mb-6">{{ __('cta_desc') }}</p>
        <a href="{{ route('contact') }}" class="select-btn max-w-xs mx-auto block">{{ __('Contact Us') }}</a>
    </section>

</div>
@endsection
