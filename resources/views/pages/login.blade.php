<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - Matrimony</title>
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700&family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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
                        "display": ["Spline Sans", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"],
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
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
        
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-display overflow-x-hidden transition-colors duration-300">
    @include('partials.top-navbar')
    
    <main class="flex flex-col min-h-screen items-center justify-center py-10 px-4 md:px-0 bg-[url('https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=2564&auto=format&fit=crop')] bg-cover bg-center bg-no-repeat bg-fixed relative">
        <!-- Overlay for better readability on bg image -->
        <div class="absolute inset-0 bg-background-light/95 dark:bg-background-dark/95 backdrop-blur-sm z-0"></div>
        
        <div class="relative z-10 w-full max-w-[500px] flex flex-col gap-8 fade-in-up">
            <!-- Header -->
            <div class="text-center mb-4">
                <h1 class="text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white mb-3">
                    Welcome <span class="text-primary">Back!</span>
                </h1>
                <p class="text-slate-600 dark:text-gray-300 text-lg">
                    Login to find your perfect match
                </p>
            </div>
            
            <!-- Login Card -->
            <div class="bg-surface-light dark:bg-surface-dark rounded-2xl p-8 lg:p-10 shadow-2xl border border-gray-200 dark:border-[#392b28]">
                <!-- Social Login Options -->
                <div class="mb-6">
                    <div class="space-y-3">
                        <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-3 py-3 px-4 border-2 border-gray-200 dark:border-[#543f3b] rounded-lg font-semibold text-slate-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-[#392b28] transition-colors duration-300">
                            <svg class="w-5 h-5" viewBox="0 0 48 48">
                                <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                                <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                                <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.222,0-9.519-3.487-11.187-8.264l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                                <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.574l6.19,5.238C41.38,36.783,44,30.817,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                            </svg>
                            <span>Sign in with Google</span>
                        </a>
                        <a href="#" class="w-full flex items-center justify-center gap-3 py-3 px-4 bg-indigo-50 dark:bg-indigo-900/20 border-2 border-indigo-100 dark:border-indigo-800 text-indigo-600 dark:text-indigo-400 rounded-lg font-semibold hover:bg-indigo-100 dark:hover:bg-indigo-900/30 transition-colors duration-300">
                            <span class="material-symbols-outlined">phone</span>
                            <span>Sign in with Mobile OTP</span>
                        </a>
                    </div>
                    <div class="my-6 flex items-center gap-4">
                        <div class="flex-1 h-px bg-gray-200 dark:bg-[#392b28]"></div>
                        <span class="text-sm text-slate-500 dark:text-gray-400 font-medium">OR</span>
                        <div class="flex-1 h-px bg-gray-200 dark:bg-[#392b28]"></div>
                    </div>
                </div>
                
                <!-- Login Form -->
                <form action="{{ route('login.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                            <div class="flex items-center gap-2 text-red-800 dark:text-red-400">
                                <span class="material-symbols-outlined text-sm">error</span>
                                <span class="text-sm font-medium">Please correct the following errors:</span>
                            </div>
                            <ul class="mt-2 list-disc list-inside text-sm text-red-700 dark:text-red-300">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">
                            Email Address <span class="text-primary">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-[#543f3b] bg-white dark:bg-[#181211] text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                            placeholder="your.email@example.com" 
                            required
                            autofocus
                        >
                    </div>
                    
                    <!-- Password Field -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-gray-300">
                                Password <span class="text-primary">*</span>
                            </label>
                            <a href="#" class="text-sm font-medium text-primary hover:underline">
                                Forgot password?
                            </a>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-[#543f3b] bg-white dark:bg-[#181211] text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                            placeholder="Enter your password" 
                            required
                        >
                    </div>
                    
                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="remember" 
                            name="remember" 
                            class="h-4 w-4 rounded border-gray-300 dark:border-[#543f3b] bg-gray-50 dark:bg-[#181211] text-primary focus:ring-primary cursor-pointer"
                        >
                        <label for="remember" class="ml-2 text-sm text-slate-600 dark:text-gray-400 font-medium cursor-pointer">
                            Remember me
                        </label>
                    </div>
                    
                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full flex items-center justify-center gap-2 py-3.5 px-6 bg-primary hover:bg-red-600 text-white text-base font-bold rounded-lg transition-all transform hover:scale-[1.02] shadow-lg shadow-primary/25 active:scale-[0.98]"
                    >
                        <span>Login Now</span>
                        <span class="material-symbols-outlined text-xl">arrow_forward</span>
                    </button>
                </form>
                
                <!-- Sign Up Link -->
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-[#392b28] text-center">
                    <p class="text-sm text-slate-600 dark:text-gray-400">
                        Don't have an account? 
                        <a href="{{ route('signup') }}" class="text-primary font-semibold hover:underline">
                            Sign up here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
