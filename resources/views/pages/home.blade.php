<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Matrimony - Find the Love You Deserve</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Theme Configuration -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ec3713",
                        "background-light": "#f8f6f6",
                        "background-dark": "#181211", 
                        "surface-dark": "#271d1c",
                        "border-dark": "#392b28",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"],
                        "body": ["Plus Jakarta Sans", "sans-serif"],
                    },
                    borderRadius: {"DEFAULT": "1rem", "lg": "1.5rem", "xl": "2rem", "2xl": "3rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        /* Custom scrollbar to keep it clean */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #181211; 
        }
        ::-webkit-scrollbar-thumb {
            background: #392b28; 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #ec3713; 
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-display overflow-x-hidden antialiased selection:bg-primary selection:text-white">
    <div class="flex flex-col min-h-screen">
        @include('partials.top-navbar')
        
        <!-- Main Content Wrapper -->
        <main class="flex-grow">
            <!-- Hero Section -->
            <section class="relative min-h-[90vh] flex items-center justify-center px-4 py-12 md:px-10 overflow-hidden">
                <!-- Background ambient glow -->
                <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-primary/10 rounded-full blur-[120px] pointer-events-none"></div>
                <div class="absolute bottom-[-10%] right-[-5%] w-[500px] h-[500px] bg-primary/5 rounded-full blur-[100px] pointer-events-none"></div>
                <div class="max-w-[1440px] w-full grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center z-10">
                    <!-- Left: Typography -->
                    <div class="flex flex-col gap-6 md:gap-8">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-primary/30 bg-primary/10 w-fit">
                            <span class="size-2 rounded-full bg-primary animate-pulse"></span>
                            <span class="text-xs font-bold text-primary uppercase tracking-wider">#1 Trusted Platform</span>
                        </div>
                        <h1 class="text-5xl md:text-7xl lg:text-[5.5rem] font-black leading-[0.9] tracking-tighter text-transparent bg-clip-text bg-gradient-to-br from-white via-white to-white/60">
                            Find the <br/>
                            <span class="text-primary">Love</span> You <br/>
                            Deserve.
                        </h1>
                        <p class="text-lg md:text-xl text-gray-400 max-w-md font-medium">
                            Curated connections for the modern soul. Join over 5 million verified families finding meaningful relationships.
                        </p>
                        <!-- Quick Search Capsule -->
                        <div class="mt-4 p-2 bg-surface-dark border border-border-dark rounded-full flex flex-col sm:flex-row items-center gap-2 max-w-xl shadow-2xl shadow-black/50">
                            <div class="flex-1 w-full sm:w-auto px-4 py-2 border-b sm:border-b-0 sm:border-r border-border-dark">
                                <label class="text-[10px] uppercase text-gray-500 font-bold tracking-wider block">Looking for</label>
                                <select class="bg-transparent border-none p-0 text-white font-semibold focus:ring-0 text-sm w-full cursor-pointer">
                                    <option class="bg-surface-dark">Woman</option>
                                    <option class="bg-surface-dark">Man</option>
                                </select>
                            </div>
                            <div class="flex-1 w-full sm:w-auto px-4 py-2 border-b sm:border-b-0 sm:border-r border-border-dark">
                                <label class="text-[10px] uppercase text-gray-500 font-bold tracking-wider block">Age</label>
                                <select class="bg-transparent border-none p-0 text-white font-semibold focus:ring-0 text-sm w-full cursor-pointer">
                                    <option class="bg-surface-dark">20 - 25</option>
                                    <option class="bg-surface-dark">26 - 30</option>
                                    <option class="bg-surface-dark">31 - 35</option>
                                    <option class="bg-surface-dark">36 - 40</option>
                                </select>
                            </div>
                            <div class="flex-1 w-full sm:w-auto px-4 py-2">
                                <label class="text-[10px] uppercase text-gray-500 font-bold tracking-wider block">Religion</label>
                                <select class="bg-transparent border-none p-0 text-white font-semibold focus:ring-0 text-sm w-full cursor-pointer">
                                    <option class="bg-surface-dark">Any</option>
                                    <option class="bg-surface-dark">Hindu</option>
                                    <option class="bg-surface-dark">Muslim</option>
                                    <option class="bg-surface-dark">Christian</option>
                                    <option class="bg-surface-dark">Sikh</option>
                                </select>
                            </div>
                            <a href="{{ route('matches') }}" class="w-full sm:w-auto size-12 bg-primary rounded-full flex items-center justify-center text-white hover:bg-red-600 transition-colors shrink-0">
                                <span class="material-symbols-outlined">search</span>
                            </a>
                        </div>
                    </div>
                    <!-- Right: Visual Collage -->
                    <div class="relative h-[500px] w-full hidden md:block">
                        <!-- Card 1 -->
                        <div class="absolute top-10 right-0 w-64 aspect-[3/4] rounded-2xl overflow-hidden border-4 border-surface-dark shadow-2xl rotate-3 z-10 hover:rotate-0 transition-transform duration-500 hover:z-30 group">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent z-10"></div>
                            <div class="absolute bottom-4 left-4 z-20">
                                <p class="text-white font-bold">Priya &amp; Rahul</p>
                                <p class="text-xs text-gray-300">Matched 2 months ago</p>
                            </div>
                            <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-700" data-alt="Happy couple smiling at each other during sunset" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCNLNgfmrWJMiaHQPbdXwZzcfsTDZ4262DjTsPmW0ZiKJDEBLmGWhsda_vj5zeSevKMNDyIMNHmgSnkIo8Ttpt_U1uOvPs0gupysON7tiYmHgNqbdgY5MYPUVSDWtd4pbjiKlHp8cDsv1vNF512Bj1_t7suv_uAVIm3YQ81GpgTN3HfL1QyINp9dSNGZSYL5f9eoHCmSRZ6eK9NKjaR0oMN9y-rJSlsN7ELuaZWfot23Yx-zsy4UJeL39AOetajVSj-Lkrmy3qmlK4');"></div>
                        </div>
                        <!-- Card 2 -->
                        <div class="absolute bottom-10 left-10 w-60 aspect-[3/4] rounded-2xl overflow-hidden border-4 border-surface-dark shadow-2xl -rotate-6 z-20 hover:rotate-0 transition-transform duration-500 hover:z-30 group">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent z-10"></div>
                            <div class="absolute bottom-4 left-4 z-20">
                                <p class="text-white font-bold">Sarah &amp; David</p>
                                <p class="text-xs text-gray-300">Engaged</p>
                            </div>
                            <div class="w-full h-full bg-cover bg-center group-hover:scale-110 transition-transform duration-700" data-alt="Couple laughing together in a park setting" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD205P98dwRffJUh0zZMks-rWSJ2CkspeNDOMn9wrk3zomyIxJd8KSFUszxpmUgKE59NIqCPA0DgbdDeytuFIhlD2Cg9IOZlKLIPq-12M400F_Z76sX5NgHSV0T7IZqmqVlJwufjggpXSZ42gXqi2PyDaNUASBxpuFnSbN2b3UVi5_UFYiod57u6i0OV3OXp-k-y03eAdoYuKYypHuh0f0Ul8cLqEFPcAlzaYRRUutAOb7lsq002y_nzNNW9CqwLO4eJunuw-7-mko');"></div>
                        </div>
                        <!-- Decorative Elements -->
                        <div class="absolute top-[40%] left-[20%] z-30 bg-surface-dark/90 backdrop-blur-sm p-4 rounded-xl border border-border-dark shadow-lg animate-bounce duration-[3000ms]">
                            <div class="flex items-center gap-3">
                                <div class="size-10 rounded-full bg-primary/20 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined">favorite</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-white">New Match!</p>
                                    <p class="text-xs text-gray-400">Just now</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Stats Section -->
            <section class="border-y border-border-dark bg-surface-dark/30 py-10">
                <div class="max-w-[1440px] mx-auto px-4 md:px-10">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div class="flex flex-col gap-1 items-start md:items-center">
                            <h3 class="text-4xl font-black text-white">5M+</h3>
                            <p class="text-sm text-gray-400 uppercase tracking-widest font-bold">Verified Families</p>
                        </div>
                        <div class="flex flex-col gap-1 items-start md:items-center">
                            <h3 class="text-4xl font-black text-white">2M+</h3>
                            <p class="text-sm text-gray-400 uppercase tracking-widest font-bold">Matches Made</p>
                        </div>
                        <div class="flex flex-col gap-1 items-start md:items-center">
                            <h3 class="text-4xl font-black text-white">15</h3>
                            <p class="text-sm text-gray-400 uppercase tracking-widest font-bold">Years of Trust</p>
                        </div>
                        <div class="flex flex-col gap-1 items-start md:items-center">
                            <h3 class="text-4xl font-black text-white">100%</h3>
                            <p class="text-sm text-gray-400 uppercase tracking-widest font-bold">Privacy Secure</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Feature Section -->
            <section class="py-20 md:py-32 px-4 md:px-10">
                <div class="max-w-[1200px] mx-auto flex flex-col gap-16">
                    <div class="flex flex-col md:flex-row justify-between items-end gap-6">
                        <div class="max-w-2xl">
                            <h2 class="text-4xl md:text-5xl font-black tracking-tight text-white mb-6">
                                Experience <span class="text-primary">Modern</span> Connection
                            </h2>
                            <p class="text-lg text-gray-400 leading-relaxed">
                                We've reimagined the matchmaking experience. Designed for privacy, security, and genuine relationships, moving away from endless swiping to meaningful conversations.
                            </p>
                        </div>
                        <a class="text-white font-bold border-b border-primary pb-1 hover:text-primary transition-colors flex items-center gap-2 group" href="#">
                            Learn more about safety
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform text-sm">arrow_forward</span>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Feature 1 -->
                        <div class="bg-surface-dark border border-border-dark p-8 rounded-2xl hover:border-primary/50 transition-colors group">
                            <div class="size-14 rounded-full bg-background-dark border border-border-dark flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-primary text-2xl">verified_user</span>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-3">Verified Profiles</h3>
                            <p class="text-gray-400 text-sm leading-relaxed">
                                Strict ID verification ensuring real people only. We manually vet profiles to maintain a high-quality community.
                            </p>
                        </div>
                        <!-- Feature 2 -->
                        <div class="bg-surface-dark border border-border-dark p-8 rounded-2xl hover:border-primary/50 transition-colors group">
                            <div class="size-14 rounded-full bg-background-dark border border-border-dark flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-primary text-2xl">lock</span>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-3">Secure Chat</h3>
                            <p class="text-gray-400 text-sm leading-relaxed">
                                End-to-end encrypted conversations. Your first hello stays between you two until you decide to take it further.
                            </p>
                        </div>
                        <!-- Feature 3 -->
                        <div class="bg-surface-dark border border-border-dark p-8 rounded-2xl hover:border-primary/50 transition-colors group">
                            <div class="size-14 rounded-full bg-background-dark border border-border-dark flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-primary text-2xl">visibility_off</span>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-3">Privacy First</h3>
                            <p class="text-gray-400 text-sm leading-relaxed">
                                Granular controls on who sees your photos and data. You control your visibility settings completely.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Success Stories (Visual Grid) -->
            <section class="py-20 bg-surface-dark/20 border-t border-border-dark">
                <div class="max-w-[1440px] mx-auto px-4 md:px-10">
                    <div class="flex flex-col items-center text-center mb-16">
                        <span class="text-primary font-bold tracking-widest uppercase text-sm mb-4">Real Stories</span>
                        <h2 class="text-4xl md:text-5xl font-black text-white mb-6">From First Hello to Forever</h2>
                        <p class="text-gray-400 max-w-2xl mx-auto">See how thousands of couples found their perfect match on our platform.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 h-auto md:h-[500px]">
                        <!-- Story 1 - Large -->
                        <div class="col-span-1 md:col-span-2 row-span-2 rounded-2xl overflow-hidden relative group cursor-pointer">
                            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors z-10"></div>
                            <div class="absolute bottom-0 left-0 p-8 z-20 translate-y-4 group-hover:translate-y-0 transition-transform">
                                <h3 class="text-2xl font-bold text-white mb-2">Ananya &amp; Vikram</h3>
                                <p class="text-gray-200 text-sm line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity">"We met through the app and instantly connected over our love for travel. Two years later, we are exploring the world together."</p>
                            </div>
                            <div class="w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-105" data-alt="Close up of a couple holding hands showing engagement rings" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBJJvuOTZf0SBMNuQ8wPWA8AwwQkPOti4dSPedA2MsZzkDoCReP684HdvKtDtfUgaqJW8omJfOZnd3FIUxDogRmu0tFbcCKCzScO7_31rmcW_t7DaBRnuKrb7s1y7gK9Ku3kJ994v9Tj6wLgMgUo8JK26NvXXrNiVu9bbo7hyNU2TbtUFtx9WXLEXMv7XrV-wsQbj8e2HX5TmZj45orQ21YXd-GiegPOFcsNSD0e7vYhB2XXthaQyRk57367s7I9oNNNh4uqbfIb6E');"></div>
                        </div>
                        <!-- Story 2 -->
                        <div class="col-span-1 rounded-2xl overflow-hidden relative group cursor-pointer min-h-[240px]">
                            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors z-10"></div>
                            <div class="absolute bottom-6 left-6 z-20">
                                <h3 class="text-lg font-bold text-white">Rohan &amp; Meera</h3>
                            </div>
                            <div class="w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-105" data-alt="Couple sitting in a cafe talking and smiling" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCJFthQNMRzj9vur8utuLaXGYZ137aRoNA5n48u84xXyEuTHnL7iWx_x1N62TnEFc8XHgb50rmbehGUeUTdf4wCizPobZbqjLXZ8QDov1Vnmfs0CbNsSUikk77ufixkXM5-78gmjNt1cBKdQ87eDi5Ih3gg8hp85lW4TRjYwaJZ97MlgMivZYyRAMu576Bw2pM0-O4WIgJoy56lYEjnPCXiU3EsXofwDFSnf6ysUSOD98QuwoIj3b-1F1ym88nH5hD2tUYZlDmjF5k');"></div>
                        </div>
                        <!-- Story 3 -->
                        <div class="col-span-1 rounded-2xl overflow-hidden relative group cursor-pointer min-h-[240px]">
                            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors z-10"></div>
                            <div class="absolute bottom-6 left-6 z-20">
                                <h3 class="text-lg font-bold text-white">Aditya &amp; Sneha</h3>
                            </div>
                            <div class="w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-105" data-alt="Couple walking on a beach during sunset" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCNDaAhbCNg6XXsv3CiarvGn2nw9yZQZtwu8Tww_NVMjIPA2opT8HAQPF8lP9BL0YD7NJCnA-jLpkjqTVvubAV7SiVYwKAEzjniH3qmt3SVsQjY2f8aAOClCTmZQpy7kGXh1bjupAozaN_Yr4qP3MQpkVw8KqefcWgkuesnaseRUTHXOgNB_SzPZw5EqB2QwswsEE_7_MGtuN-M2PCmmvMoVwUgZX1YzvDsv_oI7ZX9u94xq3AIkDlQKmbcZcpRq_rb--eqjpbFMpU');"></div>
                        </div>
                        <!-- Story 4 (Wide) -->
                        <div class="col-span-1 md:col-span-2 lg:col-span-2 rounded-2xl overflow-hidden relative group cursor-pointer min-h-[240px]">
                            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors z-10"></div>
                            <div class="absolute bottom-6 left-6 z-20">
                                <h3 class="text-xl font-bold text-white">The Kapoor Wedding</h3>
                            </div>
                            <div class="w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-105" data-alt="Large traditional Indian wedding ceremony" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC3fjUk6kjKGLdj2cQJPIP8GNAwR5WYdEHC6geOCrUWjlofzuuzFKWpAOSZOQd19QtlSIEb-Yus7SJ_-Q55PKgyP6zaRVMq0soVQHmKTtqqMeHPm7VFLRx355Pe9c30Pkw1Wm49YSb_quLenKlDfHvuWSeorkJZbjJ9KU45u09PpTXcMooRh4B_i2EgV1ggQT0Wb2qiol3XS-HUfRuXJQM0bbqxVp7OEYA14NvfGUH1Xmvd4OdMEcbMCrU8ZqVbc3mJ1FmMXcc3-DY');"></div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- How It Works -->
            <section class="py-20 md:py-32 px-4 md:px-10">
                <div class="max-w-[1000px] mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        <div class="order-2 md:order-1 relative">
                            <!-- Phone Mockup Abstract -->
                            <div class="relative w-full aspect-[3/4] bg-surface-dark border border-border-dark rounded-3xl overflow-hidden shadow-2xl">
                                <div class="absolute top-4 left-1/2 -translate-x-1/2 w-20 h-6 bg-black rounded-full z-20"></div>
                                <div class="w-full h-full bg-cover bg-center opacity-60 mix-blend-overlay" data-alt="Abstract gradient mesh representing app interface" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDa69j0owwWyXhENMsawLt1Jqc0i4iJECyzrtcCRIfZmVN2J8fFRS2UPFklN0F9TV-OvnSHqbVyZbHHkTpylFosOrZKhNgd6JivYhBLoLDrMCJJdfYFJXgeYXaLKwRHlKaVN_613OhEpB6yayKHRL2--oCjQqPNoPUQ7NvpZz-YHYvQuRWWDj0y5lN_-Nel28kxFrNRRSuq-CcF4xgBrKKpUCO3vPr5ya9IABLW8u37VG-HEhihSdUMseugWR6VeNpRwrztqZ3ZaiA');"></div>
                                <div class="absolute bottom-10 left-6 right-6 p-4 bg-background-dark/90 backdrop-blur-md rounded-xl border border-border-dark">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="size-8 rounded-full bg-gray-600"></div>
                                        <div class="h-2 w-20 bg-gray-600 rounded"></div>
                                    </div>
                                    <div class="h-2 w-full bg-gray-700 rounded mb-2"></div>
                                    <div class="h-2 w-2/3 bg-gray-700 rounded"></div>
                                    <div class="mt-4 w-full h-8 bg-primary rounded-lg flex items-center justify-center text-xs font-bold text-white">Connect</div>
                                </div>
                            </div>
                        </div>
                        <div class="order-1 md:order-2 flex flex-col gap-10">
                            <div>
                                <h2 class="text-4xl font-black text-white mb-4">Simple Steps to <br/>Your Soulmate</h2>
                                <p class="text-gray-400">Our intelligent algorithm does the heavy lifting, so you can focus on what matters.</p>
                            </div>
                            <div class="flex flex-col gap-8">
                                <div class="flex gap-6 group">
                                    <div class="flex flex-col items-center">
                                        <div class="size-10 rounded-full bg-surface-dark border border-border-dark text-white font-bold flex items-center justify-center group-hover:bg-primary group-hover:border-primary transition-colors">1</div>
                                        <div class="w-px h-full bg-border-dark my-2 group-last:hidden"></div>
                                    </div>
                                    <div class="pb-8">
                                        <h4 class="text-xl font-bold text-white mb-2">Create Profile</h4>
                                        <p class="text-sm text-gray-400">Sign up for free and tell us about yourself and what you are looking for.</p>
                                    </div>
                                </div>
                                <div class="flex gap-6 group">
                                    <div class="flex flex-col items-center">
                                        <div class="size-10 rounded-full bg-surface-dark border border-border-dark text-white font-bold flex items-center justify-center group-hover:bg-primary group-hover:border-primary transition-colors">2</div>
                                        <div class="w-px h-full bg-border-dark my-2 group-last:hidden"></div>
                                    </div>
                                    <div class="pb-8">
                                        <h4 class="text-xl font-bold text-white mb-2">Get Matches</h4>
                                        <p class="text-sm text-gray-400">Receive daily curated matches based on your preferences and compatibility.</p>
                                    </div>
                                </div>
                                <div class="flex gap-6 group">
                                    <div class="flex flex-col items-center">
                                        <div class="size-10 rounded-full bg-surface-dark border border-border-dark text-white font-bold flex items-center justify-center group-hover:bg-primary group-hover:border-primary transition-colors">3</div>
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold text-white mb-2">Start Connecting</h4>
                                        <p class="text-sm text-gray-400">Chat securely and get to know your potential partner at your own pace.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- CTA Section -->
            <section class="py-24 px-4 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-primary/10"></div>
                <div class="relative max-w-4xl mx-auto text-center flex flex-col items-center gap-8">
                    <h2 class="text-5xl md:text-7xl font-black text-white leading-tight">
                        Ready to write your <br/> own <span class="text-primary italic">story?</span>
                    </h2>
                    <p class="text-xl text-gray-400 max-w-xl">
                        Join the community of millions who believe in love. Your journey begins with a single click.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-primary hover:bg-red-600 text-white text-lg px-8 py-4 rounded-full font-bold transition-all hover:shadow-[0_0_40px_-10px_rgba(236,55,19,0.5)]">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('signup') }}" class="bg-primary hover:bg-red-600 text-white text-lg px-8 py-4 rounded-full font-bold transition-all hover:shadow-[0_0_40px_-10px_rgba(236,55,19,0.5)]">
                                Begin Your Journey
                            </a>
                        @endauth
                        <a href="{{ route('success-stories') }}" class="bg-transparent border border-gray-600 hover:border-white text-white text-lg px-8 py-4 rounded-full font-bold transition-colors">
                            View Success Stories
                        </a>
                    </div>
                </div>
            </section>
        </main>
        
        <!-- Footer -->
        <footer class="bg-surface-dark border-t border-border-dark pt-16 pb-8 px-4 md:px-10">
            <div class="max-w-[1440px] mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                    <div class="flex flex-col gap-6">
                        <div class="flex items-center gap-3">
                            <div class="size-6 text-primary">
                                <svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                    <path clip-rule="evenodd" d="M24 4C12.9543 4 4 12.9543 4 24C4 35.0457 12.9543 44 24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4ZM16.2 34.6L16.2 13.4L18.6 13.4L24 26.8L29.4 13.4L31.8 13.4L31.8 34.6L29.4 34.6L29.4 18.2L25 29H23L18.6 18.2V34.6H16.2Z" fill="currentColor" fill-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-extrabold text-white tracking-tight">TrueUnion</span>
                        </div>
                        <p class="text-gray-400 text-sm">
                            The most trusted platform for finding genuine life partners. Safe, secure, and designed for you.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-6">Company</h4>
                        <ul class="flex flex-col gap-3 text-sm text-gray-400">
                            <li><a class="hover:text-primary transition-colors" href="{{ route('about') }}">About Us</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">Careers</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">Blog</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-6">Support</h4>
                        <ul class="flex flex-col gap-3 text-sm text-gray-400">
                            <li><a class="hover:text-primary transition-colors" href="#">Help Center</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">Safety Tips</a></li>
                            <li><a class="hover:text-primary transition-colors" href="{{ route('terms') }}">Terms of Service</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-6">Get the App</h4>
                        <div class="flex flex-col gap-3">
                            <button class="flex items-center gap-3 bg-background-dark border border-border-dark hover:border-white/40 p-3 rounded-xl transition-colors group text-left w-fit">
                                <span class="material-symbols-outlined text-white text-3xl">android</span>
                                <div>
                                    <p class="text-[10px] text-gray-400 uppercase font-bold">Get it on</p>
                                    <p class="text-sm text-white font-bold">Google Play</p>
                                </div>
                            </button>
                            <button class="flex items-center gap-3 bg-background-dark border border-border-dark hover:border-white/40 p-3 rounded-xl transition-colors group text-left w-fit">
                                <span class="material-symbols-outlined text-white text-3xl">phone_iphone</span>
                                <div>
                                    <p class="text-[10px] text-gray-400 uppercase font-bold">Download on the</p>
                                    <p class="text-sm text-white font-bold">App Store</p>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="pt-8 border-t border-border-dark flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500 font-medium">
                    <p>© 2024 Matrimony Inc. All rights reserved.</p>
                    <div class="flex gap-6">
                        <a class="hover:text-white transition-colors" href="#">Instagram</a>
                        <a class="hover:text-white transition-colors" href="#">Twitter</a>
                        <a class="hover:text-white transition-colors" href="#">Facebook</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
