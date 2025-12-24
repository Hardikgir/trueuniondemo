<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Notifications Center - Matrimony</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
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
                        "primary-hover": "#c92e10",
                        "background-light": "#f8f6f6",
                        "background-dark": "#221310",
                        "surface-dark": "#2f1a16",
                        "surface-light": "#ffffff",
                        "border-dark": "#482923",
                    },
                    fontFamily: {
                        "display": ["Spline Sans", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"],
                    },
                    borderRadius: {"DEFAULT": "1rem", "lg": "2rem", "xl": "3rem", "full": "9999px"},
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
            background: #482923;
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
<body class="bg-background-light dark:bg-background-dark font-display min-h-screen flex flex-col overflow-x-hidden text-slate-900 dark:text-white selection:bg-primary selection:text-white">
    @include('partials.user-sidebar')
    
    <!-- Main Content Layout -->
    <main class="flex-1 lg:ml-80 w-full px-4 md:px-10 py-8">
        <div class="max-w-[1176px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
            <!-- Left Column: Notification Feed -->
            <div class="lg:col-span-8 flex flex-col gap-6 order-2 lg:order-1">
                <!-- Page Header -->
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <h1 class="text-slate-900 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Notifications</h1>
                    <button onclick="markAllAsRead()" class="group flex items-center gap-2 cursor-pointer text-sm font-bold text-primary hover:text-primary-hover transition-colors">
                        <span class="material-symbols-outlined text-[20px]">done_all</span>
                        <span>Mark all as read</span>
                    </button>
                </div>
                
                <!-- Filters -->
                <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide">
                    <button onclick="filterNotifications('all')" class="filter-btn flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-full bg-primary text-white px-5 transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-primary/20" data-filter="all">
                        <p class="text-sm font-bold leading-normal">All</p>
                    </button>
                    <button onclick="filterNotifications('matches')" class="filter-btn flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-full bg-white dark:bg-surface-dark border border-gray-200 dark:border-border-dark text-slate-600 dark:text-gray-300 px-5 hover:bg-gray-100 dark:hover:bg-[#3a221d] hover:text-primary dark:hover:text-white transition-all" data-filter="matches">
                        <p class="text-sm font-medium leading-normal">Matches</p>
                    </button>
                    <button onclick="filterNotifications('interests')" class="filter-btn flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-full bg-white dark:bg-surface-dark border border-gray-200 dark:border-border-dark text-slate-600 dark:text-gray-300 px-5 hover:bg-gray-100 dark:hover:bg-[#3a221d] hover:text-primary dark:hover:text-white transition-all" data-filter="interests">
                        <p class="text-sm font-medium leading-normal">Interests</p>
                    </button>
                    <button onclick="filterNotifications('messages')" class="filter-btn flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-full bg-white dark:bg-surface-dark border border-gray-200 dark:border-border-dark text-slate-600 dark:text-gray-300 px-5 hover:bg-gray-100 dark:hover:bg-[#3a221d] hover:text-primary dark:hover:text-white transition-all" data-filter="messages">
                        <p class="text-sm font-medium leading-normal">Messages</p>
                    </button>
                    <button onclick="filterNotifications('views')" class="filter-btn flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-full bg-white dark:bg-surface-dark border border-gray-200 dark:border-border-dark text-slate-600 dark:text-gray-300 px-5 hover:bg-gray-100 dark:hover:bg-[#3a221d] hover:text-primary dark:hover:text-white transition-all" data-filter="views">
                        <p class="text-sm font-medium leading-normal">Views</p>
                    </button>
                </div>
                
                <!-- Feed List -->
                <div id="notificationsList" class="flex flex-col gap-4">
                    @forelse($notifications as $notification)
                        <div class="notification-item group relative flex flex-col md:flex-row md:items-center gap-4 {{ $notification->is_read ? 'bg-transparent border-b border-gray-100 dark:border-border-dark/50 opacity-80 hover:opacity-100' : 'bg-white dark:bg-surface-dark border-l-4 border-primary' }} p-5 rounded-r-2xl shadow-sm hover:shadow-md transition-all" data-notification-id="{{ $notification->id }}" data-type="{{ $notification->type }}">
                            <div class="flex items-center gap-4 flex-1">
                                <div class="relative shrink-0">
                                    @if($notification->relatedUser && $notification->relatedUser->profile_image)
                                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full h-14 w-14 ring-2 ring-primary/20 group-hover:ring-primary transition-all" style="background-image: url('{{ asset('storage/' . $notification->relatedUser->profile_image) }}');"></div>
                                    @else
                                        <div class="bg-gray-200 dark:bg-[#3a221d] rounded-full h-14 w-14 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-gray-400 dark:text-gray-600">person</span>
                                        </div>
                                    @endif
                                    @if($notification->icon)
                                        @php
                                            $iconColorClass = match($notification->icon_color) {
                                                'primary' => 'bg-primary',
                                                'blue-500' => 'bg-blue-500',
                                                'green-500' => 'bg-green-500',
                                                'gray-500' => 'bg-gray-500',
                                                default => 'bg-primary',
                                            };
                                        @endphp
                                        <div class="absolute -bottom-1 -right-1 {{ $iconColorClass }} text-white rounded-full p-1 border-2 border-white dark:border-surface-dark">
                                            <span class="material-symbols-outlined text-[14px] font-bold block">{{ $notification->icon }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-col justify-center">
                                    <p class="text-slate-900 dark:text-white text-base font-bold leading-normal">{{ $notification->message }}</p>
                                    <p class="text-slate-500 dark:text-[#c99b92] text-sm font-normal leading-normal">
                                        {{ $notification->created_at->diffForHumans() }}
                                        @if(!$notification->is_read)
                                            • <span class="text-primary font-medium">Unread</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 shrink-0 ml-16 md:ml-0">
                                @if($notification->type === 'interest' && !$notification->is_read)
                                    <a href="{{ route('requests') }}" class="flex-1 md:flex-none h-9 px-6 bg-primary hover:bg-primary-hover text-white text-sm font-bold rounded-full transition-transform active:scale-95 shadow-lg shadow-primary/20">
                                        View Request
                                    </a>
                                @elseif($notification->type === 'message')
                                    <a href="{{ route('messages') }}" class="flex-1 md:flex-none h-9 px-6 bg-slate-900 dark:bg-[#482923] hover:bg-slate-700 dark:hover:bg-[#5e352d] text-white text-sm font-medium rounded-full transition-colors border border-transparent hover:border-primary">
                                        View Message
                                    </a>
                                @elseif($notification->type === 'match' || $notification->type === 'interest_accepted')
                                    @if($notification->relatedUser)
                                        <a href="{{ route('profile.view', $notification->relatedUser) }}" class="flex-1 md:flex-none h-9 px-6 bg-slate-900 dark:bg-[#482923] hover:bg-slate-700 dark:hover:bg-[#5e352d] text-white text-sm font-medium rounded-full transition-colors border border-transparent hover:border-primary">
                                            View Profile
                                        </a>
                                    @endif
                                @endif
                                <button onclick="markAsRead({{ $notification->id }})" class="size-9 flex items-center justify-center rounded-full bg-gray-100 dark:bg-[#3a221d] text-slate-600 dark:text-white hover:bg-gray-200 dark:hover:bg-[#4d2d26] transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">close</span>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-20 text-center">
                            <div class="bg-surface-dark rounded-full p-8 mb-6">
                                <span class="material-symbols-outlined text-6xl text-primary/50">notifications_off</span>
                            </div>
                            <h3 class="text-white text-xl font-bold mb-2">No new updates</h3>
                            <p class="text-[#c99b92]">We'll notify you when something exciting happens.</p>
                        </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                @if($notifications->hasPages())
                    <div class="mt-6">
                        {{ $notifications->links() }}
                    </div>
                @endif
            </div>
            
            <!-- Right Column: Preferences (Sticky) -->
            <div class="lg:col-span-4 order-1 lg:order-2 min-w-0">
                <div class="sticky top-24 space-y-6">
                    <!-- Settings Card -->
                    <div class="bg-white dark:bg-surface-dark rounded-3xl p-6 md:p-8 shadow-xl shadow-black/5 border border-gray-100 dark:border-border-dark overflow-hidden">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="bg-primary/10 dark:bg-primary/20 p-2 rounded-full text-primary">
                                <span class="material-symbols-outlined">tune</span>
                            </div>
                            <h3 class="text-slate-900 dark:text-white text-xl font-bold tracking-tight">Alert Settings</h3>
                        </div>
                        <!-- Email Section -->
                        <div class="mb-8">
                            <p class="text-xs font-bold text-slate-400 dark:text-[#c99b92] uppercase tracking-wider mb-4">Notify me via Email</p>
                            <div class="space-y-5">
                                <label class="flex items-center justify-between cursor-pointer group gap-4">
                                    <span class="text-slate-700 dark:text-gray-200 font-medium group-hover:text-primary transition-colors flex-1 min-w-0">New Matches</span>
                                    <div class="relative inline-flex items-center cursor-pointer shrink-0">
                                        <input checked class="sr-only peer" type="checkbox" value=""/>
                                        <div class="w-11 h-6 bg-gray-200 dark:bg-[#482923] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                    </div>
                                </label>
                                <label class="flex items-center justify-between cursor-pointer group gap-4">
                                    <span class="text-slate-700 dark:text-gray-200 font-medium group-hover:text-primary transition-colors flex-1 min-w-0">Messages</span>
                                    <div class="relative inline-flex items-center cursor-pointer shrink-0">
                                        <input checked class="sr-only peer" type="checkbox" value=""/>
                                        <div class="w-11 h-6 bg-gray-200 dark:bg-[#482923] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                    </div>
                                </label>
                                <label class="flex items-center justify-between cursor-pointer group gap-4">
                                    <span class="text-slate-700 dark:text-gray-200 font-medium group-hover:text-primary transition-colors flex-1 min-w-0">Profile Views</span>
                                    <div class="relative inline-flex items-center cursor-pointer shrink-0">
                                        <input class="sr-only peer" type="checkbox" value=""/>
                                        <div class="w-11 h-6 bg-gray-200 dark:bg-[#482923] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="w-full h-px bg-gray-100 dark:bg-border-dark mb-8"></div>
                        <!-- SMS Section -->
                        <div class="mb-8">
                            <p class="text-xs font-bold text-slate-400 dark:text-[#c99b92] uppercase tracking-wider mb-4">Notify me via SMS</p>
                            <div class="space-y-5">
                                <label class="flex items-center justify-between cursor-pointer group gap-4">
                                    <span class="text-slate-700 dark:text-gray-200 font-medium group-hover:text-primary transition-colors flex-1 min-w-0">Received Interest</span>
                                    <div class="relative inline-flex items-center cursor-pointer shrink-0">
                                        <input class="sr-only peer" type="checkbox" value=""/>
                                        <div class="w-11 h-6 bg-gray-200 dark:bg-[#482923] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                    </div>
                                </label>
                                <label class="flex items-center justify-between cursor-pointer group gap-4">
                                    <span class="text-slate-700 dark:text-gray-200 font-medium group-hover:text-primary transition-colors flex-1 min-w-0">Security Alerts</span>
                                    <div class="relative inline-flex items-center cursor-pointer shrink-0">
                                        <input checked class="sr-only peer" type="checkbox" value=""/>
                                        <div class="w-11 h-6 bg-gray-200 dark:bg-[#482923] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <!-- Frequency Slider -->
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <p class="text-xs font-bold text-slate-400 dark:text-[#c99b92] uppercase tracking-wider">Digest Frequency</p>
                                <span class="text-primary text-xs font-bold bg-primary/10 px-2 py-1 rounded">Daily</span>
                            </div>
                            <input class="w-full h-2 bg-gray-200 dark:bg-[#482923] rounded-lg appearance-none cursor-pointer accent-primary" max="2" min="0" step="1" type="range"/>
                            <div class="flex justify-between text-[10px] text-slate-400 dark:text-gray-500 font-bold uppercase mt-2">
                                <span>Instant</span>
                                <span>Daily</span>
                                <span>Weekly</span>
                            </div>
                        </div>
                    </div>
                    <!-- Promo Card -->
                    <div class="bg-gradient-to-br from-primary to-[#ff6b4a] rounded-3xl p-6 text-white relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl"></div>
                        <h4 class="text-lg font-bold mb-2 relative z-10">Go Premium</h4>
                        <p class="text-white/90 text-sm mb-4 relative z-10">See exactly who liked you without waiting.</p>
                        <a href="{{ route('membership') }}" class="block w-full bg-white text-primary text-sm font-bold py-3 rounded-xl hover:bg-gray-100 transition-colors relative z-10 text-center">Upgrade Now</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        let currentFilter = '{{ $filter }}';
        let lastNotificationId = {{ $notifications->isNotEmpty() ? $notifications->first()->id : 0 }};
        let pollingInterval;
        
        // Filter notifications
        function filterNotifications(filter) {
            currentFilter = filter;
            window.location.href = '/notifications?filter=' + filter;
        }
        
        // Mark notification as read
        function markAsRead(id) {
            fetch(`/notifications/${id}/mark-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const item = document.querySelector(`[data-notification-id="${id}"]`);
                    if (item) {
                        item.classList.remove('bg-white', 'dark:bg-surface-dark', 'border-l-4', 'border-primary');
                        item.classList.add('bg-transparent', 'border-b', 'border-gray-100', 'dark:border-border-dark/50', 'opacity-80');
                        const unreadBadge = item.querySelector('.text-primary');
                        if (unreadBadge) {
                            unreadBadge.remove();
                        }
                    }
                }
            });
        }
        
        // Mark all as read
        function markAllAsRead() {
            fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }
        
        // Real-time polling for new notifications
        function pollNotifications() {
            fetch(`/notifications/get?filter=${currentFilter}&last_notification_id=${lastNotificationId}`, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.notifications && data.notifications.length > 0) {
                    // Update last notification ID
                    lastNotificationId = Math.max(...data.notifications.map(n => n.id));
                    
                    // Prepend new notifications to the list
                    const list = document.getElementById('notificationsList');
                    data.notifications.forEach(notification => {
                        const item = createNotificationItem(notification);
                        list.insertBefore(item, list.firstChild);
                    });
                }
            })
            .catch(error => console.error('Error polling notifications:', error));
        }
        
        // Create notification item HTML
        function createNotificationItem(notification) {
            const div = document.createElement('div');
            div.className = `notification-item group relative flex flex-col md:flex-row md:items-center gap-4 bg-white dark:bg-surface-dark border-l-4 border-primary p-5 rounded-r-2xl shadow-sm hover:shadow-md transition-all`;
            div.setAttribute('data-notification-id', notification.id);
            div.setAttribute('data-type', notification.type);
            
            const timeAgo = new Date(notification.created_at).toLocaleString();
            const profileImage = notification.related_user?.profile_image 
                ? `{{ asset('storage/') }}/${notification.related_user.profile_image}`
                : '';
            
            // Map icon colors to Tailwind classes
            const iconColorMap = {
                'primary': 'bg-primary',
                'blue-500': 'bg-blue-500',
                'green-500': 'bg-green-500',
                'gray-500': 'bg-gray-500',
            };
            const iconColorClass = iconColorMap[notification.icon_color] || 'bg-primary';
            
            div.innerHTML = `
                <div class="flex items-center gap-4 flex-1">
                    <div class="relative shrink-0">
                        ${profileImage ? `<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full h-14 w-14 ring-2 ring-primary/20 group-hover:ring-primary transition-all" style="background-image: url('${profileImage}');"></div>` : `<div class="bg-gray-200 dark:bg-[#3a221d] rounded-full h-14 w-14 flex items-center justify-center"><span class="material-symbols-outlined text-gray-400 dark:text-gray-600">person</span></div>`}
                        ${notification.icon ? `<div class="absolute -bottom-1 -right-1 ${iconColorClass} text-white rounded-full p-1 border-2 border-white dark:border-surface-dark"><span class="material-symbols-outlined text-[14px] font-bold block">${notification.icon}</span></div>` : ''}
                    </div>
                    <div class="flex flex-col justify-center">
                        <p class="text-slate-900 dark:text-white text-base font-bold leading-normal">${notification.message}</p>
                        <p class="text-slate-500 dark:text-[#c99b92] text-sm font-normal leading-normal">${timeAgo} • <span class="text-primary font-medium">Unread</span></p>
                    </div>
                </div>
                <div class="flex items-center gap-3 shrink-0 ml-16 md:ml-0">
                    <button onclick="markAsRead(${notification.id})" class="size-9 flex items-center justify-center rounded-full bg-gray-100 dark:bg-[#3a221d] text-slate-600 dark:text-white hover:bg-gray-200 dark:hover:bg-[#4d2d26] transition-colors">
                        <span class="material-symbols-outlined text-[20px]">close</span>
                    </button>
                </div>
            `;
            
            return div;
        }
        
        // Start polling every 5 seconds
        pollingInterval = setInterval(pollNotifications, 5000);
        
        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            if (pollingInterval) {
                clearInterval(pollingInterval);
            }
        });
    </script>
</body>
</html>

