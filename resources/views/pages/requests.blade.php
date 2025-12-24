<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Interest/Request Management</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
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
                        "surface-dark": "#2a1d1a",
                        "text-secondary": "#b9a19d",
                    },
                    fontFamily: {
                        "display": ["Spline Sans", "sans-serif"]
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
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #221310;
        }
        ::-webkit-scrollbar-thumb {
            background: #392b28;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #ec3713;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined.fill {
            font-variation-settings: 'FILL' 1;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-background-light dark:bg-background-dark text-black dark:text-white font-display overflow-hidden h-screen flex flex-col selection:bg-primary selection:text-white">
    <div class="flex flex-1 overflow-hidden">
        @include('partials.user-sidebar')

    <!-- Main Content Area -->
    <main class="flex-1 h-full overflow-y-auto relative flex flex-col lg:ml-80">
        <div class="flex-1 w-full max-w-[1200px] mx-auto p-4 md:p-8 lg:p-12">

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-green-500/20 border border-green-500 text-green-300 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Page Header -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6 mb-10">
                <div class="flex flex-col gap-2 max-w-2xl">
                    <h2 class="text-4xl md:text-5xl font-black tracking-tighter text-white">Connection Requests</h2>
                    <p class="text-text-secondary text-lg font-normal">
                        @if($type === 'received')
                            You have <span class="text-white font-bold">{{ $receivedCount }} {{ $receivedCount == 1 ? 'person' : 'people' }}</span> waiting for a response. Action these requests to start a conversation.
                        @else
                            You have sent <span class="text-white font-bold">{{ $sentCount }} {{ $sentCount == 1 ? 'request' : 'requests' }}</span> that are pending.
                        @endif
                    </p>
                </div>
                <!-- Action Buttons / Filters -->
                <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                    <div class="bg-surface-dark p-1 rounded-full flex w-full sm:w-auto shadow-inner">
                        <a href="{{ route('requests', ['type' => 'received']) }}" 
                           class="flex-1 sm:flex-none px-6 py-2 rounded-full {{ $type === 'received' ? 'bg-primary text-white' : 'text-text-secondary hover:text-white' }} text-sm font-bold shadow-lg transition-all transform hover:scale-105">
                            Received ({{ $receivedCount }})
                        </a>
                        <a href="{{ route('requests', ['type' => 'sent']) }}" 
                           class="flex-1 sm:flex-none px-6 py-2 rounded-full {{ $type === 'sent' ? 'bg-primary text-white' : 'text-text-secondary hover:text-white' }} text-sm font-medium transition-colors">
                            Sent ({{ $sentCount }})
                        </a>
                    </div>
                </div>
            </div>

            <!-- Filters & Sorting -->
            <div class="flex flex-wrap items-center gap-3 mb-8">
                <span class="text-text-secondary text-sm font-medium mr-2">Filter by:</span>
                <button class="flex items-center gap-2 px-4 py-2 rounded-full border border-[#392b28] hover:border-text-secondary hover:bg-surface-dark transition-all group">
                    <span class="text-white text-sm">Newest First</span>
                    <span class="material-symbols-outlined text-[18px] text-text-secondary group-hover:text-white">expand_more</span>
                </button>
            </div>

            <!-- Grid Content -->
            @if($type === 'received' && $receivedRequests->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-12">
                    @foreach($receivedRequests as $request)
                        <div class="group bg-surface-dark rounded-[2rem] p-6 hover:bg-[#322420] transition-all duration-300 relative border border-transparent hover:border-[#392b28]">
                            @if($loop->first)
                            <div class="absolute top-6 right-6 bg-[#392b28] text-primary text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span> New
                            </div>
                            @endif
                            <div class="flex flex-col gap-6">
                                <div class="flex items-start gap-4">
                                    <div class="relative">
                                        <div class="w-20 h-20 rounded-full bg-cover bg-center ring-4 ring-[#221310]" 
                                             style='background-image: url("{{ $request->profile_image ? asset('storage/' . $request->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($request->full_name) . '&size=400&background=ec3713&color=fff' }}");'></div>
                                        <div class="absolute -bottom-1 -right-1 bg-green-500 rounded-full p-1 border-4 border-surface-dark" title="Online">
                                            <div class="w-2 h-2 rounded-full bg-white"></div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col pt-1">
                                        <h3 class="text-white text-xl font-bold leading-tight group-hover:text-primary transition-colors">
                                            <a href="{{ route('profile.view', $request->id) }}">{{ $request->full_name }}</a>
                                        </h3>
                                        <p class="text-text-secondary text-sm mb-1">
                                            {{ $request->age ?? 'N/A' }} yrs
                                            @if($request->occupation) • {{ $request->occupation }}@endif
                                        </p>
                                        @if($request->location)
                                        <p class="text-text-secondary text-sm flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px]">location_on</span>
                                            {{ $request->location }}
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                @if($request->languages_known)
                                <div class="bg-[#221310] rounded-xl p-4">
                                    <p class="text-text-secondary text-sm italic line-clamp-2">"{{ \Illuminate\Support\Str::limit($request->languages_known, 100) }}"</p>
                                </div>
                                @endif
                                <div class="grid grid-cols-2 gap-3 mt-auto">
                                    <form action="{{ route('requests.accept', $request->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center justify-center h-12 rounded-full bg-primary text-white font-bold text-sm hover:bg-red-600 hover:shadow-[0_0_15px_rgba(236,55,19,0.4)] transition-all">
                                            Accept
                                        </button>
                                    </form>
                                    <form action="{{ route('requests.decline', $request->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center justify-center h-12 rounded-full bg-transparent border border-[#392b28] text-text-secondary font-bold text-sm hover:bg-[#221310] hover:text-white transition-all">
                                            Decline
                                        </button>
                                    </form>
                                </div>
                                <div class="text-center">
                                    <p class="text-[11px] text-[#5c4743] font-medium uppercase tracking-widest">
                                        Received {{ \Carbon\Carbon::parse($request->request_created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif($type === 'sent' && $sentRequests->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-12">
                    @foreach($sentRequests as $request)
                        <div class="group bg-surface-dark rounded-[2rem] p-6 hover:bg-[#322420] transition-all duration-300 relative border border-transparent hover:border-[#392b28]">
                            <div class="flex flex-col gap-6 h-full">
                                <div class="flex items-start gap-4">
                                    <div class="relative">
                                        <div class="w-20 h-20 rounded-full bg-cover bg-center ring-4 ring-[#221310]" 
                                             style='background-image: url("{{ $request->profile_image ? asset('storage/' . $request->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($request->full_name) . '&size=400&background=ec3713&color=fff' }}");'></div>
                                    </div>
                                    <div class="flex flex-col pt-1">
                                        <h3 class="text-white text-xl font-bold leading-tight group-hover:text-primary transition-colors">
                                            <a href="{{ route('profile.view', $request->id) }}">{{ $request->full_name }}</a>
                                        </h3>
                                        <p class="text-text-secondary text-sm mb-1">
                                            {{ $request->age ?? 'N/A' }} yrs
                                            @if($request->occupation) • {{ $request->occupation }}@endif
                                        </p>
                                        @if($request->location)
                                        <p class="text-text-secondary text-sm flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px]">location_on</span>
                                            {{ $request->location }}
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                @if($request->languages_known)
                                <div class="bg-[#221310] rounded-xl p-4">
                                    <p class="text-text-secondary text-sm italic line-clamp-2">"{{ \Illuminate\Support\Str::limit($request->languages_known, 100) }}"</p>
                                </div>
                                @endif
                                <div class="mt-auto text-center">
                                    <span class="inline-block px-4 py-2 bg-[#392b28] text-text-secondary text-sm font-medium rounded-full">
                                        Pending
                                    </span>
                                </div>
                                <div class="text-center">
                                    <p class="text-[11px] text-[#5c4743] font-medium uppercase tracking-widest">
                                        Sent {{ \Carbon\Carbon::parse($request->request_created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="w-24 h-24 bg-[#2a1d1a] rounded-full flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-4xl text-[#392b28]">inbox</span>
                    </div>
                    <h3 class="text-white text-xl font-bold mb-2">No pending requests</h3>
                    <p class="text-text-secondary max-w-md mb-8">
                        @if($type === 'received')
                            You're all caught up! Explore new matches to find your special someone.
                        @else
                            You haven't sent any requests yet. Start exploring matches to send interest.
                        @endif
                    </p>
                    <a href="{{ route('dashboard') }}" class="bg-primary text-white px-8 py-3 rounded-full font-bold hover:bg-red-600 transition-colors">Explore Matches</a>
                </div>
            @endif
        </div>
    </main>
    </div>
</body>
</html>

