@extends('layouts.app')

@section('title', __('My Dashboard'))

@section('content')
<div class="content-container max-w-7xl mx-auto">
    
    @if(session('status'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">{{ __('Success!') }}</strong>
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: User Profile -->
        <div class="lg:col-span-2">
            <div class="bg-white/70 p-6 rounded-lg shadow-md">
                <div class="flex flex-col sm:flex-row items-center">
                    <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://placehold.co/150x150/e2f0cb/702963?text=' . substr($user->full_name, 0, 1) }}" alt="Profile Picture" class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover">
                    <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left">
                        <h1 class="text-3xl font-bold text-gray-800">{{ $user->full_name }}</h1>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        <a href="{{ route('profile.edit') }}" class="mt-2 inline-block text-indigo-600 hover:underline">{{ __('Edit My Profile') }}</a>
                    </div>
                </div>
                <hr class="my-6">
                <h3 class="text-xl font-bold text-gray-700 mb-4">{{ __('Profile Details') }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600">
                    <div><strong>{{ __('gender') }}:</strong> {{ $user->gender ? __(ucfirst($user->gender)) : __('N/A') }}</div>
                    <div><strong>{{ __('height') }}:</strong> {{ $user->height ?: __('N/A') }}</div>
                    <div><strong>{{ __('date_of_birth') }}:</strong> {{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('d M, Y') : __('N/A') }}</div>
                    <div><strong>{{ __('marital_status') }}:</strong> {{ $user->marital_status ? __($user->marital_status) : __('N/A') }}</div>
                    <div><strong>{{ __('occupation') }}:</strong> {{ $user->occupation ?: __('N/A') }}</div>
                    <div><strong>{{ __('Location') }}:</strong> {{ $user->city ? $user->city . ', ' . $user->country : __('N/A') }}</div>
                </div>
            </div>
        </div>

        <!-- Right Column: Membership & Activity -->
        <div>
            <!-- Membership Card -->
            <div class="bg-white/70 p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-xl font-bold text-gray-700 mb-4">{{ __('My Membership') }}</h3>
                @if($membership)
                    <p class="text-lg font-semibold text-indigo-600">{{ $membership->name }} {{ __('Plan') }}</p>
                    <p class="text-gray-600">
                        {{ __('Visits Used') }}: {{ $membership->visits_used }} / {{ $membership->visits_allowed }}
                    </p>
                @else
                    <p class="text-gray-600">{{ __('no_active_membership') }}</p>
                @endif
                <a href="{{ route('membership') }}" class="mt-2 inline-block text-indigo-600 hover:underline">{{ __('upgrade_plan') }}</a>
            </div>
            
            <!-- Recent Activity Card -->
            <div class="bg-white/70 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold text-gray-700 mb-4">{{ __('Recent Activity') }}</h3>
                <ul class="space-y-3 text-gray-600">
                    @forelse($activityHistory as $activity)
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <p>{{ __($activity->activity) }}</p>
                                <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</p>
                            </div>
                        </li>
                    @empty
                        <li class="text-gray-500">{{ __('no_recent_activity') }}</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

