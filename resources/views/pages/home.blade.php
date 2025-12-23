<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - TrueUnion</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Theme Config -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ec3713",
                        "background-light": "#f8f6f6",
                        "background-dark": "#221310",
                        "surface-dark": "#2e1a17",
                        "accent-gold": "#d4af37", 
                    },
                    fontFamily: {
                        "display": ["Newsreader", "serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    backgroundImage: {
                        'texture': "url('https://www.transparenttextures.com/patterns/cubes.png')", 
                    }
                },
            },
        }
    </script>
    <style>
        /* Custom scrollbar for better aesthetic */
        ::-webkit-scrollbar {
            width: 8px
        }
        ::-webkit-scrollbar-track {
            background: #221310
        }
        ::-webkit-scrollbar-thumb {
            background: #392b28;
            border-radius: 4px
        }
        .text-shadow-sm {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3)
        }
        /* Subtle grain texture overlay */
        .grain-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 50;
            opacity: 0.05;
            background-image: url(https://lh3.googleusercontent.com/aida-public/AB6AXuCPOjlxYoitkkyxSmB6qumNf2SgUrTeTq-WJ57gP4pqf6xtovP0vex9L57jmlR6NRNjsB-s-9Dsda4Vq1rQD68La9Jacc23jkZayaKmXinzTd1g4cE0Pdji-fRfROflf48rpRlJDvTpW3zf1LnSdKDw3gOy5HoKvleL2MsnHgQdp3esNgRgs2QLuQqwPhwlAg4WvGnEu6A61uP3TTG9Uo_6_Lm7qdvIoVzJI_HFZ6dx51JjHgHZEun6rKmG7PxwoZLSlh4GzQ4Zx-E)
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display antialiased overflow-x-hidden selection:bg-primary selection:text-white">
    <!-- Texture Overlay -->
    <div class="grain-overlay"></div>
    <div class="relative flex min-h-screen w-full flex-col">
        <!-- Navbar -->
        <header class="fixed top-0 z-40 w-full border-b border-[#392b28] bg-background-dark/90 backdrop-blur-md px-6 py-4 lg:px-10">
            <div class="mx-auto flex max-w-7xl items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 text-white transition-opacity hover:opacity-80 cursor-pointer">
                    <div class="flex size-8 items-center justify-center rounded-full bg-primary/20 text-primary">
                        <span class="material-symbols-outlined" style="font-size: 20px;">diversity_3</span>
                    </div>
                    <h2 class="text-2xl font-bold tracking-tight">TrueUnion</h2>
                </a>
                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center gap-10">
                    <a class="text-white/80 text-lg font-medium hover:text-primary transition-colors italic" href="#stories">Stories</a>
                    <a class="text-white/80 text-lg font-medium hover:text-primary transition-colors italic" href="{{ route('membership') }}">Membership</a>
                    <a class="text-white/80 text-lg font-medium hover:text-primary transition-colors italic" href="#gifts">Gifts</a>
                </nav>
                <!-- Actions -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="hidden md:flex text-white font-medium hover:text-primary transition-colors">
                            Dashboard
                        </a>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="hidden md:flex text-white font-medium hover:text-primary transition-colors">
                                Admin Panel
                            </a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="hidden md:flex text-white font-medium hover:text-primary transition-colors">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hidden md:flex text-white font-medium hover:text-primary transition-colors">
                            Log In
                        </a>
                        <a href="{{ route('signup') }}" class="flex items-center justify-center rounded-lg bg-primary px-5 py-2 text-white text-base font-bold shadow-lg shadow-primary/20 hover:bg-red-600 hover:scale-105 transition-all duration-300">
                            Join Now
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Main Content (Split Layout) -->
        <main class="flex flex-1 flex-col lg:flex-row pt-[72px]">
            <!-- Left Panel: Editorial Visual -->
            <div class="relative w-full lg:w-1/2 min-h-[400px] lg:min-h-screen flex items-end justify-start p-8 lg:p-16 overflow-hidden group">
                <!-- Background Image -->
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[2s] group-hover:scale-105" data-alt="Abstract artistic representation of connection, featuring two interlocking gold rings on textured dark red silk" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDmNny5whchnLyCKzVM_lCRgHGzXcilMdLKjOxpQ_A0r1Evk7BCWLgCsbyqFvTVKaP6csCK1tbudFWOYYpIqJNWR4-xS133zC2Dwc_k4V652FkAx-MKAu0tWcNuoFx-qz7suTHLd7czH71IDtohZgExgeQe6aHHdVcFmgm-7JDuJn4x66EOwn5ATrDYR2_Ztgn-0CAvzy8zX8I_eBi08X1aaIF7Rl72ylfgRBs_pLsO-Q8d-Sg5YC20onu_tYnsKOvdKYw651rGRqs");'>
                </div>
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-background-dark/50 to-transparent lg:bg-gradient-to-r lg:via-background-dark/30 lg:to-transparent"></div>
                <!-- Text Content Over Image -->
                <div class="relative z-10 max-w-lg mb-8 lg:mb-20">
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-black/30 px-3 py-1 text-xs font-medium text-white backdrop-blur-sm mb-6">
                        <span class="size-2 rounded-full bg-primary animate-pulse"></span>
                        <span class="tracking-wide uppercase">Matches Curated Daily</span>
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-black text-white leading-[0.9] tracking-tighter drop-shadow-lg mb-6">
                        The Art of <br/>
                        <span class="italic text-primary font-normal">Connection.</span>
                    </h1>
                    <p class="text-lg lg:text-xl text-white/90 font-light leading-relaxed max-w-md drop-shadow-md">
                        Curated matches for a lifetime of stories. Experience a union designed with intention, transcending the ordinary.
                    </p>
                </div>
            </div>

            <!-- Right Panel: Registration Form -->
            <div class="relative w-full lg:w-1/2 flex flex-col items-center justify-center p-6 lg:p-16 bg-background-dark z-20">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 p-10 opacity-20 pointer-events-none">
                    <span class="material-symbols-outlined text-9xl text-primary rotate-12">favorite</span>
                </div>
                <div class="w-full max-w-md flex flex-col gap-8 relative">
                    <!-- Form Header -->
                    <div class="text-center lg:text-left space-y-2">
                        <h2 class="text-3xl text-white font-bold tracking-tight">Welcome back</h2>
                        <p class="text-white/60 text-base">Sign in to continue your journey.</p>
                    </div>

                    <!-- Auth Card -->
                    <div class="bg-surface-dark border border-[#392b28] rounded-xl shadow-2xl overflow-hidden backdrop-blur-sm">
                        <!-- Tabs -->
                        <div class="grid grid-cols-2 border-b border-[#392b28]">
                            <a href="{{ route('signup') }}" class="py-4 text-center text-white/50 font-medium text-base hover:text-white hover:bg-white/5 transition-colors">
                                Register
                            </a>
                            <div class="relative py-4 text-center text-primary font-bold text-base bg-white/5">
                                Login
                                <div class="absolute bottom-0 left-0 w-full h-1 bg-primary"></div>
                            </div>
                        </div>

                        <!-- Login Form Content -->
                        <div id="login-form" class="p-6 lg:p-8 flex flex-col gap-6">
                            <form action="{{ route('login.store') }}" method="POST">
                                @csrf
                                
                                @if($errors->any())
                                    <div class="bg-red-500/10 border border-red-500/50 rounded-lg p-4">
                                        <ul class="text-red-400 text-sm space-y-1">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Email Input -->
                                <div class="space-y-2">
                                    <label class="text-white text-sm font-semibold tracking-wide flex items-center gap-2" for="login_email">
                                        <span class="material-symbols-outlined text-[18px] text-primary">mail</span>
                                        Email
                                    </label>
                                    <input class="w-full bg-[#1c1210] border border-[#543f3b] text-white text-lg px-4 py-3 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary placeholder:text-white/20 transition-all outline-none" 
                                           id="login_email" 
                                           name="email" 
                                           type="email" 
                                           placeholder="your@email.com"
                                           required/>
                                </div>

                                <!-- Password Input -->
                                <div class="space-y-2">
                                    <label class="text-white text-sm font-semibold tracking-wide flex items-center gap-2" for="login_password">
                                        <span class="material-symbols-outlined text-[18px] text-primary">lock</span>
                                        Password
                                    </label>
                                    <input class="w-full bg-[#1c1210] border border-[#543f3b] text-white text-lg px-4 py-3 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary placeholder:text-white/20 transition-all outline-none" 
                                           id="login_password" 
                                           name="password" 
                                           type="password" 
                                           placeholder="••••••••"
                                           required/>
                                </div>

                                <!-- Remember Me -->
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="remember" name="remember" class="rounded border-[#543f3b] bg-[#1c1210] text-primary focus:ring-primary">
                                    <label for="remember" class="text-white/70 text-sm">Remember me</label>
                                </div>

                                <!-- Login Button -->
                                <button type="submit" class="group relative w-full overflow-hidden rounded-lg bg-primary py-3.5 text-white shadow-md transition-all hover:bg-red-600 hover:shadow-lg hover:shadow-primary/25">
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity group-hover:opacity-100 bg-red-700">
                                        <span class="material-symbols-outlined animate-bounce">arrow_forward</span>
                                    </div>
                                    <span class="relative flex items-center justify-center gap-2 text-base font-bold tracking-wide transition-transform group-hover:-translate-y-full">
                                        Sign In
                                    </span>
                                </button>
                            </form>

                            <!-- Divider -->
                            <div class="relative flex py-2 items-center">
                                <div class="flex-grow border-t border-[#392b28]"></div>
                                <span class="flex-shrink-0 mx-4 text-white/30 text-xs uppercase tracking-widest font-semibold">Or connect with</span>
                                <div class="flex-grow border-t border-[#392b28]"></div>
                            </div>

                            <!-- Social Buttons -->
                            <div class="grid grid-cols-2 gap-4">
                                <a href="{{ route('google.login') }}" class="flex items-center justify-center gap-3 rounded-lg border border-[#392b28] bg-white/5 px-4 py-3 text-white transition-all hover:bg-white/10 hover:border-white/20">
                                    <svg class="h-5 w-5" fill="none" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.26.81-.58z" fill="#FBBC05"></path>
                                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
                                    </svg>
                                    <span class="text-sm font-semibold">Google</span>
                                </a>
                                <button class="flex items-center justify-center gap-3 rounded-lg border border-[#392b28] bg-white/5 px-4 py-3 text-white transition-all hover:bg-white/10 hover:border-white/20" disabled>
                                    <svg class="h-5 w-5 text-white" fill="currentColor" viewbox="0 0 24 24">
                                        <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.74 3.4 1.86-2.93 1.76-2.46 5.23.51 6.54-.61 1.54-1.39 3.06-2.56 4.61zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"></path>
                                    </svg>
                                    <span class="text-sm font-semibold">Apple</span>
                                </button>
                            </div>
                        </div>

                        <!-- Footer Area -->
                        <div class="bg-[#241614] px-6 py-4 border-t border-[#392b28] text-center">
                            <p class="text-white/40 text-sm">
                                By continuing, you agree to our 
                                <a class="text-white/60 underline hover:text-primary decoration-primary/50 hover:decoration-primary transition-all" href="#">Terms</a> 
                                and 
                                <a class="text-white/60 underline hover:text-primary decoration-primary/50 hover:decoration-primary transition-all" href="#">Privacy Policy</a>.
                            </p>
                        </div>
                    </div>

                    <!-- Help Link & Sign Up Link -->
                    <div class="text-center space-y-3">
                        <a class="text-white/50 text-sm font-medium hover:text-primary transition-colors flex items-center justify-center gap-1 group/link" href="#">
                            Forgot Password?
                            <span class="material-symbols-outlined text-[16px] transition-transform group-hover/link:translate-x-1">arrow_right_alt</span>
                        </a>
                        <div class="text-white/60 text-sm">
                            Don't have an account? 
                            <a href="{{ route('signup') }}" class="text-primary font-semibold hover:text-red-400 transition-colors">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Auto-focus email input on page load
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('login_email');
            if (emailInput) {
                emailInput.focus();
            }
        });
    </script>
</body>
</html>
