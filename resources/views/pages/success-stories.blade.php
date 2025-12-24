<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Success Stories - Matrimony</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700&family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ec3713",
                        "background-light": "#f8f6f6",
                        "background-dark": "#221310",
                        "surface-dark": "#2F1B18",
                    },
                    fontFamily: {
                        "display": ["Spline Sans", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"],
                    },
                    borderRadius: {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-900 dark:text-white antialiased overflow-x-hidden selection:bg-primary selection:text-white">
    <div class="relative flex h-auto min-h-screen w-full flex-col">
        @include('partials.top-navbar')
        
        <!-- Hero Section -->
        <div class="px-6 lg:px-40 flex flex-1 justify-center py-12 lg:py-20 relative overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/10 rounded-full blur-[100px] pointer-events-none translate-x-1/3 -translate-y-1/3"></div>
            <div class="layout-content-container flex flex-col max-w-[1200px] flex-1 z-10">
                <div class="@container">
                    <div class="flex flex-col gap-12 lg:gap-20">
                        <!-- Typography Heavy Intro -->
                        <div class="flex flex-col gap-6 max-w-4xl">
                            <h1 class="text-white text-5xl lg:text-7xl font-black leading-[1.1] tracking-[-0.033em]">
                                From First Click <br/>
                                <span class="text-primary">To Forever.</span>
                            </h1>
                            <p class="text-white/70 text-lg lg:text-2xl font-normal leading-relaxed max-w-2xl">
                                Real people. Real emotions. Discover how thousands of couples found their perfect match and started their journey of a lifetime with us.
                            </p>
                        </div>
                        <!-- Hero Video/Image Hybrid -->
                        <div class="relative w-full aspect-[4/3] lg:aspect-[21/9] rounded-xl overflow-hidden group cursor-pointer shadow-2xl shadow-black/50">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent z-10"></div>
                            <div class="w-full h-full bg-center bg-no-repeat bg-cover transform transition-transform duration-700 group-hover:scale-105" data-alt="Candid shot of a couple laughing together at sunset on a beach" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCOW4IDDQNq9vpoQ5_N3y7fAJHvYhmrNwH656y34D3QOOaAKz-r0nKKTC14q0Y5cNFRWsyDVO0C-o-Tly3yRzG2ypV3VSgeEx73Mbp0yDllMV6YoD_ug_oEncTcJP9GgY3hYJr-av-7peZ0qvo7ju0824hxeJFE0bGGRq1giG_nPPavfiIfS9Y_Ly4YBXlMSs8SgJlSJLSCk3m5lvxTpVLgseM9fWMU0tmp4i1aRKPXa0AoPmIX8beIopYeop7u_TKyiASNqr70y-s");'>
                            </div>
                            <div class="absolute bottom-0 left-0 p-8 lg:p-12 z-20 flex flex-col gap-4 items-start">
                                <span class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-4 py-1.5 rounded-full text-sm font-bold uppercase tracking-wider flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                    Latest Feature
                                </span>
                                <h2 class="text-3xl lg:text-4xl font-bold text-white max-w-lg leading-tight">
                                    "We knew it was meant to be when we both ordered the same coffee."
                                </h2>
                                <button class="mt-2 flex items-center gap-2 text-white font-bold hover:text-primary transition-colors group/btn">
                                    Watch Their Film
                                    <span class="material-symbols-outlined text-2xl transition-transform group-hover/btn:translate-x-1">play_circle</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Stats Section (Ticker Style) -->
        <div class="w-full border-y border-[#392b28] bg-background-dark overflow-hidden py-8">
            <div class="layout-container px-6 lg:px-40 flex justify-center">
                <div class="layout-content-container flex flex-wrap justify-between w-full max-w-[1200px] gap-8">
                    <div class="flex flex-col gap-1 items-start">
                        <span class="text-4xl lg:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-primary to-orange-400">12k+</span>
                        <span class="text-white/60 font-medium uppercase tracking-widest text-xs">Happy Marriages</span>
                    </div>
                    <div class="w-px h-16 bg-[#392b28] hidden md:block"></div>
                    <div class="flex flex-col gap-1 items-start">
                        <span class="text-4xl lg:text-5xl font-black text-white">500k+</span>
                        <span class="text-white/60 font-medium uppercase tracking-widest text-xs">Active Profiles</span>
                    </div>
                    <div class="w-px h-16 bg-[#392b28] hidden md:block"></div>
                    <div class="flex flex-col gap-1 items-start">
                        <span class="text-4xl lg:text-5xl font-black text-white">100%</span>
                        <span class="text-white/60 font-medium uppercase tracking-widest text-xs">Verified Users</span>
                    </div>
                    <div class="w-px h-16 bg-[#392b28] hidden md:block"></div>
                    <div class="flex flex-col gap-1 items-start">
                        <span class="text-4xl lg:text-5xl font-black text-white">15</span>
                        <span class="text-white/60 font-medium uppercase tracking-widest text-xs">Years of Trust</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Featured Stories Section -->
        <div class="px-6 lg:px-40 flex flex-1 justify-center py-20 bg-background-dark">
            <div class="layout-content-container flex flex-col max-w-[1200px] flex-1 gap-24">
                <div class="flex flex-col gap-4 text-center items-center">
                    <span class="text-primary font-bold tracking-widest uppercase text-sm">Editor's Picks</span>
                    <h2 class="text-white text-4xl lg:text-5xl font-bold leading-tight tracking-[-0.015em]">Love in the Digital Age</h2>
                </div>
                
                <!-- Story 1: Text Right -->
                <div class="group relative grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7 relative z-10">
                        <div class="relative aspect-[4/3] w-full rounded-xl overflow-hidden rounded-tr-[100px] rounded-bl-[100px]">
                            <div class="w-full h-full bg-center bg-no-repeat bg-cover transition-transform duration-700 group-hover:scale-105" data-alt="Couple sitting on steps in traditional Indian wedding attire smiling at each other" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC1Bg1LLTs_EjvjMMDZUw86XAyHtSXwXWEuH4e1xf5uMzUGHPhWhpl93nG88ASZCnE7EX7eBkvga4W_TSgF3evbf0C3qcWDQDwlE-IjB6nSA1nKEvEjg1yNMTkUWLa0bM8Ojyvn2hvBZ0s4cXnpne2NuH5xRDFrD93QTU2nZgWSoPVBXGC1gXzqONjvtvQzuQR7gfDT4mp94-LIPhe1Efo-MQzsgyS5oykyL77vk15LKX918ChuMKETjMas8_fCEWzz_JYnCWdcIlA");'></div>
                            <!-- Verified Badge Overlay -->
                            <div class="absolute top-6 left-6 bg-white/10 backdrop-blur text-white px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1 border border-white/20">
                                <span class="material-symbols-outlined text-sm text-blue-400 filled">verified</span> Verified Match
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-5 flex flex-col gap-6 lg:-ml-12 z-20">
                        <div class="bg-surface-dark border border-[#392b28] p-8 lg:p-10 rounded-xl shadow-xl">
                            <div class="flex items-center gap-2 mb-4 text-primary">
                                <span class="material-symbols-outlined">favorite</span>
                                <span class="text-sm font-bold uppercase tracking-wider text-white/50">Married Nov 2023</span>
                            </div>
                            <h3 class="text-white text-3xl font-bold leading-tight mb-4">Rohan &amp; Priya</h3>
                            <div class="relative">
                                <span class="absolute -top-4 -left-2 text-6xl text-white/5 font-serif">"</span>
                                <p class="text-[#b9a19d] text-lg leading-relaxed relative z-10">
                                    We matched on a Tuesday and met for coffee on Saturday. I knew within 10 minutes that he was the one. The algorithm got it right, but our hearts did the rest.
                                </p>
                            </div>
                            <div class="mt-8 pt-6 border-t border-[#392b28] flex justify-between items-center">
                                <div class="flex flex-col">
                                    <span class="text-xs text-white/40 uppercase tracking-widest">Location</span>
                                    <span class="text-white font-medium">Mumbai, India</span>
                                </div>
                                <button class="rounded-full w-12 h-12 flex items-center justify-center bg-primary text-white hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined">arrow_forward</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Story 2: Text Left (Reversed) -->
                <div class="group relative grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="order-2 lg:order-1 lg:col-span-5 flex flex-col gap-6 lg:-mr-12 z-20">
                        <div class="bg-surface-dark border border-[#392b28] p-8 lg:p-10 rounded-xl shadow-xl">
                            <div class="flex items-center gap-2 mb-4 text-primary">
                                <span class="material-symbols-outlined">favorite</span>
                                <span class="text-sm font-bold uppercase tracking-wider text-white/50">Married Jan 2024</span>
                            </div>
                            <h3 class="text-white text-3xl font-bold leading-tight mb-4">Sarah &amp; David</h3>
                            <div class="relative">
                                <span class="absolute -top-4 -left-2 text-6xl text-white/5 font-serif">"</span>
                                <p class="text-[#b9a19d] text-lg leading-relaxed relative z-10">
                                    Living in different cities, we thought it would never work. But the long chats turned into flights, and flights turned into moving vans. Best decision ever.
                                </p>
                            </div>
                            <div class="mt-8 pt-6 border-t border-[#392b28] flex justify-between items-center">
                                <div class="flex flex-col">
                                    <span class="text-xs text-white/40 uppercase tracking-widest">Location</span>
                                    <span class="text-white font-medium">London, UK</span>
                                </div>
                                <button class="rounded-full w-12 h-12 flex items-center justify-center bg-white text-black hover:bg-primary hover:text-white transition-colors">
                                    <span class="material-symbols-outlined">arrow_forward</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2 lg:col-span-7 relative z-10">
                        <div class="relative aspect-[4/3] w-full rounded-xl overflow-hidden rounded-tl-[100px] rounded-br-[100px]">
                            <div class="w-full h-full bg-center bg-no-repeat bg-cover transition-transform duration-700 group-hover:scale-105" data-alt="Couple walking hand in hand in a park during autumn" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBRlpV70a6Z54l5Lv7a6NzU2zUOJk9I1pF5nvXuaGf8pVJBPPYfwa33_r22nEXvYOlRhPrc7BacpEjxkUs2N9D3OE9ujMWB_QBg5HhzexpTAk-USmbgLSavE75D44wWHjQVqkYcjIzhVyJCgwq55AfZLw3X6hltKj2PERBlKwGAjp7vuI9UTLRuNY4IP4RGE4BUMIaKcvB8nvZdvHOiHNeYnBmS3-QCfcEBXlRSCRPT9GXoLLCZxAA6vffd8VVfqXY7gIKA6DM7t8k");'></div>
                            <!-- Verified Badge Overlay -->
                            <div class="absolute bottom-6 right-6 bg-white/10 backdrop-blur text-white px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1 border border-white/20">
                                <span class="material-symbols-outlined text-sm text-blue-400 filled">verified</span> Verified Match
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Story 3: Horizontal Feature -->
                <div class="relative w-full rounded-xl overflow-hidden bg-surface-dark border border-[#392b28] group">
                    <div class="grid lg:grid-cols-2">
                        <div class="h-64 lg:h-auto bg-cover bg-center" data-alt="Close up of two hands holding rings" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuByRc8T30AegX1f1rw4uvWLRNkF47LNZhlZlVHlLR4dd8WtsEL_-BDzkoz2_9EJx346lH-uWjbdSTnFgshGdkw_csqwBzCRn-mg-2D4XHL0Gv8RweFLLMah8N7PGyD5o5SDb_PUIuJiL5FtA-SW3cXbaZk1nBFDECnqY3M8OHoIMifP_qrU1KQwPazKtTq8c11v-wYUT6zbbcte0l4LkYCBn5NXvwDGbMURN5oDUBEuYlh3mYGd-zAdoj1G0RJ2V7lGAoxGKLko37o");'>
                            <div class="w-full h-full bg-primary/20 mix-blend-overlay"></div>
                        </div>
                        <div class="p-8 lg:p-16 flex flex-col justify-center gap-6">
                            <span class="w-12 h-1 bg-primary mb-2"></span>
                            <h3 class="text-white text-2xl lg:text-3xl font-bold">
                                "We were looking for something serious, not just a swipe."
                            </h3>
                            <p class="text-white/60">
                                Amit and Neha found shared values and family goals on their profiles before they even met. Read how deep compatibility led to a beautiful wedding in Jaipur.
                            </p>
                            <a class="inline-flex items-center gap-2 text-primary font-bold hover:underline underline-offset-4 decoration-2" href="#">
                                Read Full Story <span class="material-symbols-outlined text-sm">arrow_outward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quote Carousel / Minimal Testimonials -->
        <div class="py-20 bg-[#1a100e] overflow-hidden">
            <div class="layout-container px-6 lg:px-40">
                <div class="flex flex-col gap-10">
                    <div class="flex justify-between items-end">
                        <h2 class="text-white text-3xl font-bold">Whispers of Love</h2>
                        <div class="flex gap-2">
                            <button class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-black transition-colors">
                                <span class="material-symbols-outlined">arrow_back</span>
                            </button>
                            <button class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-black transition-colors">
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex gap-6 overflow-x-auto pb-8 snap-x no-scrollbar">
                        <!-- Quote Card 1 -->
                        <div class="min-w-[300px] md:min-w-[400px] snap-center bg-background-dark p-8 rounded-lg border border-[#392b28] flex flex-col gap-6 relative">
                            <span class="material-symbols-outlined text-4xl text-[#392b28] absolute top-6 right-6">format_quote</span>
                            <p class="text-white text-lg font-medium italic">"I never believed in online matchmaking until I saw her profile. It was instant magic."</p>
                            <div class="flex items-center gap-4 mt-auto">
                                <div class="w-10 h-10 rounded-full bg-cover bg-center" data-alt="Small avatar of a man" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAT7MLJA1u3__N1D1AfCDsL7SNsnarjoEK3D9_ySLa1iRCL7XvVEJAbtoHg5MKD_27Hhbi2-kYRi8k66HRdxPhOHs1FpZR3T9PvOkGW1oCQ1ymKyc2tKnknQz6FQXN8wpyuTNkgukfafos-V02RF1a0gPOsZzItdObKu3efSeIEjqGY2vAtdaddSEe8JpeIeFKkdhSNF82hQ-pliSghuBbe2nedopLdoK3BgcJxmIrrJzDt0agkSJ_bqPzx2ASVpOTDqYn2GF-L3Q8");'></div>
                                <div>
                                    <p class="text-white text-sm font-bold">Arjun K.</p>
                                    <p class="text-white/40 text-xs">Bangalore</p>
                                </div>
                            </div>
                        </div>
                        <!-- Quote Card 2 -->
                        <div class="min-w-[300px] md:min-w-[400px] snap-center bg-background-dark p-8 rounded-lg border border-[#392b28] flex flex-col gap-6 relative">
                            <span class="material-symbols-outlined text-4xl text-[#392b28] absolute top-6 right-6">format_quote</span>
                            <p class="text-white text-lg font-medium italic">"The verified profiles gave my parents peace of mind, and his humor gave me butterflies."</p>
                            <div class="flex items-center gap-4 mt-auto">
                                <div class="w-10 h-10 rounded-full bg-cover bg-center" data-alt="Small avatar of a woman" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA2Y7GW9db65-mGJ9X2xvIvXXTDJO34fcP3mk4dX4AEMnMI0xgAI1XzACZP1NjMEPFw6MMTlvzg40-2F4_S3_RO5RaHFo-9kpbZU1L7m2tbx8s7ziWtcFG2KORVkZYSjuZpuGgs7IL4baRWbOfM2KLbnAlBk-iYsUC8vtrfwZ8ncpl3io4LPQVEet_exvHR7pFzo6-pKy6VNZTLJUkT1aXd3Yb5D8pU4dFStTSqaobsLB52JbGsvIsq-RXx6jI0asvzMzAtP3WHV-E");'></div>
                                <div>
                                    <p class="text-white text-sm font-bold">Meera S.</p>
                                    <p class="text-white/40 text-xs">Delhi</p>
                                </div>
                            </div>
                        </div>
                        <!-- Quote Card 3 -->
                        <div class="min-w-[300px] md:min-w-[400px] snap-center bg-background-dark p-8 rounded-lg border border-[#392b28] flex flex-col gap-6 relative">
                            <span class="material-symbols-outlined text-4xl text-[#392b28] absolute top-6 right-6">format_quote</span>
                            <p class="text-white text-lg font-medium italic">"Best platform for serious relationships. We found our forever in just 3 months."</p>
                            <div class="flex items-center gap-4 mt-auto">
                                <div class="w-10 h-10 rounded-full bg-cover bg-center" data-alt="Small avatar of a man" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDInbHdNZemSd1tVnUPaWk0kIUUoPS_29LD8xMkpBDtBCkhMPKYpIb9hLsSi3eeB0VxKOg_s650F6cHEM98QruDIJw7k7-_nUjjyGkh5zySJ1CvZwKfbIS9lnUUXl9H3D-UgowHq-tS4xEQVQRwbSanQ-R8GwGulWMOAdvn1Hpy9muxxlQGnWqW3l6S5aWVq2vh6Ra0O1QUpc0Co0QfFIioUImd-UrbZsSg9tVEEzJVdjUKY9Zl7GEkJgH_icLSOloFqYes9RHEtZk");'></div>
                                <div>
                                    <p class="text-white text-sm font-bold">Rahul V.</p>
                                    <p class="text-white/40 text-xs">Mumbai</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div class="px-6 lg:px-40 py-24 flex justify-center bg-background-dark relative overflow-hidden">
            <!-- Decorative gradient -->
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-primary/5 pointer-events-none"></div>
            <div class="layout-content-container flex flex-col items-center max-w-[800px] text-center gap-8 relative z-10">
                <div class="w-20 h-20 rounded-full bg-surface-dark border border-[#392b28] flex items-center justify-center mb-4 animate-bounce shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined text-4xl text-primary">favorite</span>
                </div>
                <h2 class="text-white text-5xl lg:text-7xl font-black tracking-tight leading-none">
                    Are you <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-orange-500">next?</span>
                </h2>
                <p class="text-white/60 text-xl max-w-xl">
                    Your story could be the one inspiring others tomorrow. Join millions of verified members finding real love today.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 w-full justify-center mt-6">
                    @auth
                        <a href="{{ route('dashboard') }}" class="flex items-center justify-center rounded-full h-14 px-8 bg-primary hover:bg-red-600 text-white text-lg font-bold leading-normal tracking-[0.015em] transition-all transform hover:scale-105 shadow-xl shadow-primary/30">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('signup') }}" class="flex items-center justify-center rounded-full h-14 px-8 bg-primary hover:bg-red-600 text-white text-lg font-bold leading-normal tracking-[0.015em] transition-all transform hover:scale-105 shadow-xl shadow-primary/30">
                            Start Your Journey
                        </a>
                    @endauth
                    @auth
                        <a href="{{ route('membership') }}" class="flex items-center justify-center rounded-full h-14 px-8 bg-transparent border border-[#392b28] hover:bg-white/5 text-white text-lg font-bold leading-normal transition-colors">
                            View Plans
                        </a>
                    @else
                        <a href="{{ route('membership') }}" class="flex items-center justify-center rounded-full h-14 px-8 bg-transparent border border-[#392b28] hover:bg-white/5 text-white text-lg font-bold leading-normal transition-colors">
                            View Plans
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        
        <!-- Footer Simple -->
        <footer class="border-t border-[#392b28] bg-background-dark py-8">
            <div class="px-6 lg:px-40 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-white/40 text-sm">© 2024 Matrimony Inc. All rights reserved.</p>
                <div class="flex gap-6">
                    <a class="text-white/40 hover:text-white text-sm transition-colors" href="#">Privacy Policy</a>
                    <a class="text-white/40 hover:text-white text-sm transition-colors" href="{{ route('terms') }}">Terms of Service</a>
                    <a class="text-white/40 hover:text-white text-sm transition-colors" href="#">Help Center</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
