@extends('layouts.app')

@section('title', __('Membership Plans'))

@section('content')
<div class="content-container">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800">{{ __('membership_plans_title') }}</h1>
        <p class="text-gray-600 mt-3 max-w-2xl mx-auto">{{ __('membership_plans_subtitle') }}</p>
        @if(session('status'))
            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">{{ __('Notice') }}:</strong>
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($memberships as $plan)
            <div class="pricing-card text-center">
                <h2 class="text-2xl font-bold text-gray-800">{{ $plan->name }}</h2>
                <p class="text-4xl font-extrabold text-indigo-600 my-4">₹{{ $plan->price }}</p>
                <p class="text-gray-500 mb-6">{{ __('view_up_to') }} {{ $plan->visits_allowed }} {{ __('profiles') }}</p>

                @if($plan->features)
                <ul class="text-left space-y-2 text-gray-600 mb-6">
                    @foreach(explode("\n", $plan->features) as $feature)
                        @if(trim($feature))
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            {{ trim($feature) }}
                        </li>
                        @endif
                    @endforeach
                </ul>
                @endif

                <form action="{{ route('subscribe', $plan->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="select-btn">{{ __('Choose Plan') }}</button>
                </form>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">{{ __('no_plans_available') }}</p>
        @endforelse
    </div>
</div>
@endsection

