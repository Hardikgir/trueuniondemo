@extends('layouts.app')

@section('title', __('Search Profiles'))

@section('content')
<div class="w-full max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col lg:flex-row gap-8">

        <!-- Filters Sidebar -->
        {{-- UPDATED: Changed lg:w-1/4 to lg:w-1/5 to make the sidebar smaller --}}
        <aside class="lg:w-1/5 lg:sticky top-28 self-start">
            <div class="form-container p-6">
                <h3 class="text-xl font-bold mb-4">{{ __('Find Your Match') }}</h3>
                
                <form action="{{ route('search') }}" method="GET">
                    <div class="space-y-4">
                        <div>
                            <label for="age_from" class="form-label text-sm">{{ __('Age From') }}</label>
                            <select id="age_from" name="age_from" class="form-select">
                                @for ($i = 18; $i <= 70; $i++)
                                    <option value="{{ $i }}" {{ (request('age_from') ?? 18) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label for="age_to" class="form-label text-sm">{{ __('Age To') }}</label>
                            <select id="age_to" name="age_to" class="form-select">
                                @for ($i = 18; $i <= 70; $i++)
                                     <option value="{{ $i }}" {{ (request('age_to') ?? 30) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label for="religion" class="form-label text-sm">{{ __('Religion') }}</label>
                            <select id="religion" name="religion" class="form-select">
                                <option {{ (request('religion') ?? '') == 'Any' ? 'selected' : '' }}>{{ __('Any') }}</option>
                                <option {{ (request('religion') ?? '') == 'Hindu' ? 'selected' : '' }}>{{ __('Hindu') }}</option>
                                <option {{ (request('religion') ?? '') == 'Muslim' ? 'selected' : '' }}>{{ __('Muslim') }}</option>
                                <option {{ (request('religion') ?? '') == 'Christian' ? 'selected' : '' }}>{{ __('Christian') }}</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="submit-btn w-full mt-2">{{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </aside>

        <!-- Profiles Grid -->
        <main class="flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @forelse ($users as $user)
                    <div class="pricing-card text-center transform hover:-translate-y-1 transition-transform duration-300">
                        <a href="{{ auth()->check() ? route('profile.view', $user->id) : route('login') }}">
                            <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://placehold.co/150x150/a2e4ff/702963?text=' . substr($user->full_name, 0, 1) }}" alt="Profile Picture" class="w-28 h-28 rounded-full mx-auto border-4 border-white shadow-md object-cover">
                        </a>
                        <h3 class="text-xl font-bold mt-4 text-gray-800">{{ $user->full_name }}</h3>
                        <p class="text-gray-600">{{ $user->age }} {{ __('Years') }}, {{ Str::limit($user->height, 7) }}</p>
                        <p class="text-gray-500 text-sm mt-1">{{ $user->city }}, {{ $user->country }}</p>
                        
                        @auth
                            <a href="{{ route('profile.view', $user->id) }}" class="select-btn mt-4 text-sm block">{{ __('View Profile') }}</a>
                        @else
                            <a href="{{ route('login') }}" class="select-btn mt-4 text-sm block">{{ __('Login to View') }}</a>
                        @endauth
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white/70 rounded-lg shadow-md">
                         <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="mt-2 text-xl font-semibold text-gray-700">{{ __('no_profiles_found_title') }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ __('no_profiles_found_desc') }}</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
</div>
@endsection

