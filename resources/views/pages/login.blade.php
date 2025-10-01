@extends('layouts.app')

@section('title', 'Login - TrueUnion')

@section('content')
<div class="form-container" style="max-width: 400px;">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Welcome Back!</h1>
        <p class="text-gray-600 mt-2">Login to find your soulmate.</p>
    </div>

    <!-- Social and OTP Login -->
    <div class="mb-6">
        <div class="space-y-4">
            <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-3 py-3 px-4 border-2 border-gray-200 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition-colors duration-300">
                <svg class="w-5 h-5" viewBox="0 0 48 48"><path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.222,0-9.519-3.487-11.187-8.264l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.574l6.19,5.238C41.38,36.783,44,30.817,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path></svg>
                <span>Sign in with Google</span>
            </a>
            <a href="#" class="w-full flex items-center justify-center gap-3 py-3 px-4 bg-indigo-50 border-2 border-indigo-100 text-indigo-600 rounded-lg font-semibold hover:bg-indigo-100 transition-colors duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                <span>Sign in with Mobile OTP</span>
            </a>
        </div>
        <div class="my-6 text-center text-gray-500">OR</div>
    </div>

    <!-- Login Form -->
    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="Your E-mail" required>
            </div>
            <div>
                <div class="flex justify-between items-center">
                    <label for="password" class="form-label">Password</label>
                    <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                </div>
                <input type="password" id="password" name="password" class="form-input" placeholder="Enter your password" required>
            </div>
        </div>
        <div class="mt-8">
            <button type="submit" class="submit-btn">Login Now</button>
        </div>
    </form>
</div>
@endsection
