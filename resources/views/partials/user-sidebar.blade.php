<!-- Common User Sidebar -->
<nav class="hidden lg:flex flex-col w-80 h-screen border-r border-[#392b28] bg-background-dark shrink-0 fixed top-0 left-0">
    <div class="flex flex-col h-full p-6 overflow-y-auto">
        <!-- Branding / Logo -->
        <div class="flex items-center gap-3 mb-8 pb-6 border-b border-[#392b28]">
            <div class="size-10 text-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-3xl">diversity_1</span>
            </div>
            <h2 class="text-white text-xl font-bold leading-tight tracking-tight">Matrimony</h2>
        </div>
        
        @auth
        <!-- User Profile -->
        <div class="flex items-center gap-4 mb-6 pb-6 border-b border-[#392b28]">
            <div class="bg-center bg-no-repeat bg-cover rounded-full h-12 w-12 border-2 border-[#392b28] relative" 
                 style='background-image: url("{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->full_name ?? 'User') . '&background=ec3713&color=fff' }}");'>
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-background-dark"></div>
            </div>
            <div class="flex-1 min-w-0">
                <h1 class="text-white text-lg font-bold leading-tight truncate">{{ Auth::user()->full_name ?? 'User' }}</h1>
                <p class="text-text-secondary text-sm">
                    @php
                        $membership = DB::table('user_memberships')
                            ->join('memberships', 'user_memberships.membership_id', '=', 'memberships.id')
                            ->where('user_memberships.user_id', Auth::id())
                            ->where('user_memberships.is_active', 1)
                            ->select('memberships.name')
                            ->first();
                    @endphp
                    {{ $membership ? $membership->name . ' Member' : 'Free Member' }}
                </p>
            </div>
        </div>
        
        <!-- Navigation Links -->
        <div class="flex flex-col gap-2 flex-1">
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-[#392b28] text-white' : 'hover:bg-[#392b28] text-text-secondary hover:text-white' }} transition-colors group" href="{{ route('dashboard') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('dashboard') ? 'text-primary fill' : 'group-hover:text-primary' }} transition-colors">dashboard</span>
                <p class="text-sm font-medium">Dashboard</p>
            </a>
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl {{ request()->routeIs('matches') ? 'bg-[#392b28] text-white' : 'hover:bg-[#392b28] text-text-secondary hover:text-white' }} transition-colors group" href="{{ route('matches') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('matches') ? 'text-primary fill' : 'group-hover:text-primary' }} transition-colors">favorite</span>
                <p class="text-sm font-medium">Matches</p>
            </a>
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl {{ request()->routeIs('shortlist') ? 'bg-[#392b28] text-white' : 'hover:bg-[#392b28] text-text-secondary hover:text-white' }} transition-colors group" href="{{ route('shortlist') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('shortlist') ? 'text-primary fill' : 'group-hover:text-primary' }} transition-colors">star</span>
                <p class="text-sm font-medium">Shortlist</p>
            </a>
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl {{ request()->routeIs('requests') ? 'bg-[#392b28] text-white' : 'hover:bg-[#392b28] text-text-secondary hover:text-white' }} transition-colors group" href="{{ route('requests') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('requests') ? 'text-primary fill' : 'group-hover:text-primary' }} transition-colors">mark_email_unread</span>
                <p class="text-sm font-medium">Requests</p>
                @php
                    $receivedCount = 0;
                    try {
                        $receivedCount = DB::table('user_interests')
                            ->where('receiver_id', Auth::id())
                            ->where('status', 'pending')
                            ->count();
                    } catch (\Exception $e) {
                        // Table might not exist
                    }
                @endphp
                @if($receivedCount > 0)
                <span class="ml-auto bg-primary text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $receivedCount }}</span>
                @endif
            </a>
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl {{ request()->routeIs('messages') ? 'bg-[#392b28] text-white' : 'hover:bg-[#392b28] text-text-secondary hover:text-white' }} transition-colors group" href="{{ route('messages') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('messages') ? 'text-primary fill' : 'group-hover:text-primary' }} transition-colors">chat_bubble</span>
                <p class="text-sm font-medium">Messages</p>
                <span id="messageCount" class="ml-auto bg-primary text-white text-[10px] font-bold px-2 py-0.5 rounded-full hidden">0</span>
            </a>
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl {{ request()->routeIs('notifications') ? 'bg-[#392b28] text-white' : 'hover:bg-[#392b28] text-text-secondary hover:text-white' }} transition-colors group" href="{{ route('notifications') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('notifications') ? 'text-primary fill' : 'group-hover:text-primary' }} transition-colors">notifications</span>
                <p class="text-sm font-medium">Notifications</p>
                <span id="notificationCount" class="ml-auto bg-primary text-white text-[10px] font-bold px-2 py-0.5 rounded-full hidden">0</span>
            </a>
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl {{ request()->routeIs('profile.edit') || request()->routeIs('profile.view') ? 'bg-[#392b28] text-white' : 'hover:bg-[#392b28] text-text-secondary hover:text-white' }} transition-colors group" href="{{ route('profile.edit') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('profile.edit') || request()->routeIs('profile.view') ? 'text-primary fill' : 'group-hover:text-primary' }} transition-colors">person</span>
                <p class="text-sm font-medium">Profile</p>
            </a>
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl {{ request()->routeIs('membership') ? 'bg-[#392b28] text-white' : 'hover:bg-[#392b28] text-text-secondary hover:text-white' }} transition-colors group" href="{{ route('membership') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('membership') ? 'text-primary fill' : 'group-hover:text-primary' }} transition-colors">workspace_premium</span>
                <p class="text-sm font-medium">Upgrade</p>
            </a>
        </div>
        
        <!-- Footer Section -->
        <div class="mt-auto pt-6 border-t border-[#392b28] space-y-4">
            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-[#392b28] text-text-secondary hover:text-white transition-colors group">
                    <span class="material-symbols-outlined group-hover:text-primary transition-colors">logout</span>
                    <p class="text-sm font-medium">Logout</p>
                </button>
            </form>
            <!-- Footer Links -->
            <div class="flex flex-wrap gap-4 text-xs text-text-secondary">
                <a class="hover:text-white transition-colors" href="#">Privacy</a>
                <a class="hover:text-white transition-colors" href="#">Help</a>
                <a class="hover:text-white transition-colors" href="{{ route('terms') }}">Terms</a>
            </div>
        </div>
        @else
        <!-- Guest Navigation -->
        <div class="flex flex-col gap-2 flex-1">
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl {{ request()->routeIs('home') ? 'bg-[#392b28] text-white' : 'hover:bg-[#392b28] text-text-secondary hover:text-white' }} transition-colors group" href="{{ route('home') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('home') ? 'text-primary fill' : 'group-hover:text-primary' }} transition-colors">home</span>
                <p class="text-sm font-medium">Home</p>
            </a>
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl {{ request()->routeIs('about') ? 'bg-[#392b28] text-white' : 'hover:bg-[#392b28] text-text-secondary hover:text-white' }} transition-colors group" href="{{ route('about') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('about') ? 'text-primary fill' : 'group-hover:text-primary' }} transition-colors">info</span>
                <p class="text-sm font-medium">About Us</p>
            </a>
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl {{ request()->routeIs('success-stories') ? 'bg-[#392b28] text-white' : 'hover:bg-[#392b28] text-text-secondary hover:text-white' }} transition-colors group" href="{{ route('success-stories') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('success-stories') ? 'text-primary fill' : 'group-hover:text-primary' }} transition-colors">favorite</span>
                <p class="text-sm font-medium">Success Stories</p>
            </a>
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl {{ request()->routeIs('membership') ? 'bg-[#392b28] text-white' : 'hover:bg-[#392b28] text-text-secondary hover:text-white' }} transition-colors group" href="{{ route('membership') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('membership') ? 'text-primary fill' : 'group-hover:text-primary' }} transition-colors">workspace_premium</span>
                <p class="text-sm font-medium">Membership</p>
            </a>
        </div>
        
        <!-- Footer Section -->
        <div class="mt-auto pt-6 border-t border-[#392b28] space-y-4">
            <!-- Login Button -->
            <a href="{{ route('login') }}" class="w-full flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-[#392b28] text-text-secondary hover:text-white transition-colors group">
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">login</span>
                <p class="text-sm font-medium">Login</p>
            </a>
            <!-- Footer Links -->
            <div class="flex flex-wrap gap-4 text-xs text-text-secondary">
                <a class="hover:text-white transition-colors" href="#">Privacy</a>
                <a class="hover:text-white transition-colors" href="#">Help</a>
                <a class="hover:text-white transition-colors" href="{{ route('terms') }}">Terms</a>
            </div>
        </div>
        @endauth
    </div>
</nav>

@auth
<script>
    // Real-time polling for unread counts
    function updateUnreadCounts() {
        fetch('/notifications/unread-count', {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => response.json())
        .then(data => {
            // Update message count
            const messageCountEl = document.getElementById('messageCount');
            if (messageCountEl) {
                if (data.messages > 0) {
                    messageCountEl.textContent = data.messages;
                    messageCountEl.classList.remove('hidden');
                } else {
                    messageCountEl.classList.add('hidden');
                }
            }
            
            // Update notification count
            const notificationCountEl = document.getElementById('notificationCount');
            if (notificationCountEl) {
                if (data.notifications > 0) {
                    notificationCountEl.textContent = data.notifications;
                    notificationCountEl.classList.remove('hidden');
                } else {
                    notificationCountEl.classList.add('hidden');
                }
            }
        })
        .catch(error => console.error('Error updating unread counts:', error));
    }
    
    // Update counts on page load
    updateUnreadCounts();
    
    // Poll every 5 seconds
    setInterval(updateUnreadCounts, 5000);
</script>
@endauth

