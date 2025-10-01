@extends('layouts.app')

@section('title', __('Contact Us'))

@section('content')
<div class="form-container" style="max-width: 900px; padding: 0; overflow: hidden;">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <!-- Left Side: Contact Info -->
        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 text-white p-8">
            <h2 class="text-3xl font-bold mb-4">{{ __('contact_info_title') }}</h2>
            <p class="mb-6">{{ __('contact_info_desc') }}</p>
            
            <div class="space-y-4">
                <p class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ __('contact_address') }}
                </p>
                <p class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    +91 12345 67890
                </p>
                <p class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    contact@trueunion.com
                </p>
            </div>
        </div>

        <!-- Right Side: Contact Form -->
        <div class="p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">{{ __('send_us_message') }}</h2>
            <form action="#" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="name" class="form-label">{{ __('Your Name') }}</label>
                        <input type="text" id="name" name="name" class="form-input" placeholder="{{ __('enter_your_name') }}" required>
                    </div>
                    <div>
                        <label for="email" class="form-label">{{ __('Your Email') }}</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="{{ __('enter_your_email') }}" required>
                    </div>
                    <div>
                        <label for="message" class="form-label">{{ __('Message') }}</label>
                        <textarea id="message" name="message" rows="4" class="form-input" placeholder="{{ __('write_your_message') }}" required></textarea>
                    </div>
                </div>
                <div class="mt-8">
                    <button type="submit" class="submit-btn">{{ __('send_message') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
