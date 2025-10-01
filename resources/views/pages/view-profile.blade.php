@extends('layouts.app')

@section('title', $user->full_name . ' - ' . __('Profile'))

@section('content')
<div class="content-container max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Main User Profile -->
        <div class="lg:col-span-2">
            <div class="bg-white/70 p-6 rounded-lg shadow-md">
                <div class="flex flex-col sm:flex-row items-center">
                    <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://placehold.co/150x150/e2f0cb/702963?text=' . substr($user->full_name, 0, 1) }}" alt="Profile Picture" class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover">
                    <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left">
                        <h1 class="text-3xl font-bold text-gray-800">{{ $user->full_name }}</h1>
                        <p class="text-gray-600">{{ $user->age }} {{ __('Years') }}, {{ $user->height }}</p>
                        <p class="text-gray-500">{{ $user->city }}, {{ $user->country }}</p>
                    </div>
                </div>
                <hr class="my-6">
                <h3 class="text-xl font-bold text-gray-700 mb-4">{{ __('Profile Details') }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600">
                    <div><strong>{{ __('gender') }}:</strong> {{ $user->gender ? __(ucfirst($user->gender)) : __('N/A') }}</div>
                    <div><strong>{{ __('marital_status') }}:</strong> {{ $user->marital_status ? __($user->marital_status) : __('N/A') }}</div>
                    <div><strong>{{ __('mother_tongue') }}:</strong> {{ $user->mother_tongue ?: __('N/A') }}</div>
                    <div><strong>{{ __('diet') }}:</strong> {{ $user->diet ? __(ucfirst($user->diet)) : __('N/A') }}</div>
                    <div><strong>{{ __('highest_education') }}:</strong> {{ $user->highest_education ?: __('N/A') }}</div>
                    <div><strong>{{ __('occupation') }}:</strong> {{ $user->occupation ?: __('N/A') }}</div>
                </div>
            </div>
        </div>

        <!-- Right Column: Suggested Profiles -->
        <div class="lg:col-span-1">
             <div class="bg-white/70 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold text-gray-700 mb-4">{{ __('Suggested Profiles') }}</h3>
                <div class="space-y-4">
                    @forelse($suggestedUsers as $suggestion)
                    <div class="flex items-center">
                        <img src="{{ $suggestion->profile_image ? asset('storage/' . $suggestion->profile_image) : 'https://placehold.co/60x60/a2e4ff/702963?text=' . substr($suggestion->full_name, 0, 1) }}" class="w-16 h-16 rounded-full object-cover" alt="Suggested Profile">
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">{{ $suggestion->full_name }}</h4>
                            <p class="text-sm text-gray-500">
                                {{ $suggestion->dob ? \Carbon\Carbon::parse($suggestion->dob)->age : '' }} {{ __('Years') }}, {{ $suggestion->city }}
                            </p>
                            <a href="{{ route('profile.view', $suggestion->id) }}" class="text-sm text-indigo-600 hover:underline">{{__('View Profile')}}</a>
                        </div>
                    </div>
                    @empty
                        <p class="text-sm text-gray-500">{{ __('no_suggestions_available') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

