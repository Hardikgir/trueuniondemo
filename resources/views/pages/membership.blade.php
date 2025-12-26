<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Membership Plans & Comparison</title>
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
                        "background-dark": "#181211",
                        "surface-dark": "#271d1c",
                        "surface-darker": "#1f1615",
                        "border-dark": "#392b28",
                        "text-dim": "#b9a19d",
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-background-light dark:bg-background-dark font-display antialiased text-white selection:bg-primary selection:text-white">
    @if(Auth::check())
        <div class="flex flex-1 overflow-hidden">
            @include('partials.user-sidebar')
            <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden flex-1 overflow-y-auto lg:ml-80">
    @else
        <div class="flex flex-col min-h-screen">
            @include('partials.top-navbar')
            <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden flex-1 overflow-y-auto">
    @endif
                <!-- Main Content Wrapper -->
                <div class="layout-container flex h-full grow flex-col items-center">
                    <!-- Hero Heading -->
                    <div class="w-full max-w-[1200px] px-4 md:px-10 py-12 md:py-16 text-center">
                        <h1 class="text-white text-4xl md:text-6xl font-black leading-tight tracking-[-0.033em] mb-4">
                            Invest in your <span class="text-primary">future</span> together
                        </h1>
                        <p class="text-text-dim text-lg font-normal leading-normal max-w-2xl mx-auto">
                            Select a membership plan that suits your journey. Unlock premium features to find your perfect match faster and more securely.
                        </p>
                    </div>

                    <!-- Pricing Cards Grid -->
                    <div class="w-full max-w-[1200px] px-4 md:px-6 mb-16">
                        @php
                            $totalPlans = count($memberships) + 1; // +1 for Free plan
                            $gridClass = 'grid-cols-1';
                            if ($totalPlans == 2) $gridClass .= ' md:grid-cols-2';
                            elseif ($totalPlans == 3) $gridClass .= ' md:grid-cols-2 lg:grid-cols-3';
                            else $gridClass .= ' md:grid-cols-2 lg:grid-cols-4';
                        @endphp
                        <div class="grid {{ $gridClass }} gap-6">
                            <!-- Free Plan (Always shown) -->
                            <div class="flex flex-col gap-6 rounded-2xl border border-solid border-border-dark bg-surface-dark p-8 hover:border-text-dim transition-colors duration-300">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-white text-xl font-bold">Free</h3>
                                        <span class="text-text-dim text-xs font-bold uppercase tracking-wider border border-border-dark rounded-full px-3 py-1">Basic</span>
                                    </div>
                                    <div class="flex items-baseline gap-1 mt-2">
                                        <span class="text-white text-5xl font-black tracking-tighter">₹0</span>
                                    </div>
                                    <p class="text-text-dim text-sm">Forever free with basic access.</p>
                                </div>
                                <div class="h-px w-full bg-border-dark my-2"></div>
                                <div class="flex flex-col gap-4 flex-1">
                                    <div class="flex items-start gap-3 text-sm text-white">
                                        <span class="material-symbols-outlined text-primary">check_circle</span>
                                        <span>Browse Limited Profiles</span>
                                    </div>
                                    <div class="flex items-start gap-3 text-sm text-white">
                                        <span class="material-symbols-outlined text-primary">check_circle</span>
                                        <span>Send Interests</span>
                                    </div>
                                    <div class="flex items-start gap-3 text-sm text-text-dim opacity-50">
                                        <span class="material-symbols-outlined">cancel</span>
                                        <span>View Phone Numbers</span>
                                    </div>
                                    <div class="flex items-start gap-3 text-sm text-text-dim opacity-50">
                                        <span class="material-symbols-outlined">cancel</span>
                                        <span>Direct Chat</span>
                                    </div>
                                </div>
                                <button class="w-full h-12 rounded-full border border-border-dark bg-transparent text-white text-sm font-bold hover:bg-border-dark transition-colors {{ !$currentUserMembership ? 'bg-primary/10 border-primary text-primary' : '' }}">
                                    {{ !$currentUserMembership ? 'Current Plan' : 'Select Free' }}
                                </button>
                            </div>

                            <!-- Dynamic Plans from Database -->
                            @foreach($memberships as $plan)
                                <div class="relative flex flex-col gap-6 rounded-2xl {{ $plan->is_featured ? 'border-2 border-primary bg-surface-darker shadow-[0_0_30px_rgba(236,55,19,0.15)] transform md:-translate-y-4' : 'border border-solid border-border-dark bg-surface-dark hover:border-text-dim transition-colors duration-300' }} p-8">
                                    @if($plan->is_featured)
                                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-primary text-white text-xs font-bold px-4 py-1 rounded-full shadow-lg whitespace-nowrap">
                                            MOST POPULAR
                                        </div>
                                    @endif
                                    <div class="flex flex-col gap-2 {{ $plan->is_featured ? 'mt-2' : '' }}">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-white text-xl font-bold">{{ $plan->name }}</h3>
                                            @if($plan->badge)
                                                <span class="{{ $plan->is_featured ? 'bg-primary/20 text-primary' : 'text-text-dim border border-border-dark' }} text-xs font-bold uppercase tracking-wider rounded-full px-3 py-1">{{ $plan->badge }}</span>
                                            @endif
                                        </div>
                                        <div class="flex items-baseline gap-1 mt-2">
                                            <span class="text-white text-5xl font-black tracking-tighter">₹{{ number_format($plan->price) }}</span>
                                            <span class="text-text-dim text-base font-medium">/mo</span>
                                        </div>
                                        <p class="text-text-dim text-sm">{{ $plan->description ?? 'Billed monthly.' }}</p>
                                    </div>
                                    <div class="h-px w-full bg-border-dark my-2"></div>
                                    <div class="flex flex-col gap-4 flex-1">
                                        @if($plan->features)
                                            @foreach(explode("\n", $plan->features) as $feature)
                                                @if(trim($feature))
                                                    <div class="flex items-start gap-3 text-sm text-white">
                                                        <span class="material-symbols-outlined text-primary">check_circle</span>
                                                        <span>{{ trim($feature) }}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <!-- Default features if none specified -->
                                            <div class="flex items-start gap-3 text-sm text-white">
                                                <span class="material-symbols-outlined text-primary">check_circle</span>
                                                <span>View {{ $plan->visits_allowed }} Phone Numbers</span>
                                            </div>
                                            <div class="flex items-start gap-3 text-sm text-white">
                                                <span class="material-symbols-outlined text-primary">check_circle</span>
                                                <span>Unlimited Direct Chat</span>
                                            </div>
                                        @endif
                                    </div>
                                    @if($currentUserMembership && $currentUserMembership->id == $plan->id)
                                        <button class="w-full h-12 rounded-full bg-primary/20 border border-primary text-primary text-sm font-bold">
                                            Current Plan
                                        </button>
                                    @else
                                        @auth
                                        <form action="{{ route('subscribe', $plan->id) }}" method="POST" class="w-full">
                                            @csrf
                                            <input type="hidden" name="billing_period" value="monthly">
                                            <button type="submit" class="w-full h-12 rounded-full {{ $plan->is_featured ? 'bg-primary text-white hover:bg-red-600 shadow-lg shadow-red-900/20' : 'border border-border-dark bg-transparent text-white hover:bg-border-dark' }} text-sm font-bold transition-colors">
                                                {{ $plan->is_featured ? 'Upgrade to ' . $plan->name : 'Select ' . $plan->name }}
                                            </button>
                                        </form>
                                        @else
                                        <a href="{{ route('login') }}" class="block w-full h-12 rounded-full {{ $plan->is_featured ? 'bg-primary text-white hover:bg-red-600 shadow-lg shadow-red-900/20' : 'border border-border-dark bg-transparent text-white hover:bg-border-dark' }} text-sm font-bold transition-colors text-center leading-[48px]">
                                            {{ $plan->is_featured ? 'Upgrade to ' . $plan->name : 'Select ' . $plan->name }}
                                        </a>
                                        @endauth
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Detailed Feature Comparison -->
                    @if(count($memberships) > 0)
                    <div class="w-full max-w-[960px] px-4 md:px-6 mb-20">
                        <h2 class="text-white text-2xl md:text-3xl font-bold mb-8 text-center">Detailed Comparison</h2>
                        <div class="overflow-hidden rounded-2xl border border-border-dark bg-surface-dark">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-surface-darker border-b border-border-dark">
                                            <th class="p-4 md:p-6 text-sm font-bold text-text-dim uppercase tracking-wider" style="width: 30%;">Features</th>
                                            <th class="p-4 md:p-6 text-sm font-bold text-white text-center" style="width: {{ 70 / (count($memberships) + 1) }}%;">Free</th>
                                            @foreach($memberships as $plan)
                                                <th class="p-4 md:p-6 text-sm font-bold {{ $plan->is_featured ? 'text-primary' : 'text-white' }} text-center" style="width: {{ 70 / (count($memberships) + 1) }}%;">{{ $plan->name }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm">
                                        <tr class="border-b border-border-dark hover:bg-background-dark/50 transition-colors">
                                            <td class="p-4 md:px-6 md:py-4 font-medium text-white">Browse Profiles</td>
                                            <td class="p-4 text-center"><span class="material-symbols-outlined text-text-dim">check</span></td>
                                            @foreach($memberships as $plan)
                                                <td class="p-4 text-center"><span class="material-symbols-outlined text-primary">check_circle</span></td>
                                            @endforeach
                                        </tr>
                                        <tr class="border-b border-border-dark hover:bg-background-dark/50 transition-colors">
                                            <td class="p-4 md:px-6 md:py-4 font-medium text-white">Access Contact Details</td>
                                            <td class="p-4 text-center"><span class="material-symbols-outlined text-text-dim opacity-30">close</span></td>
                                            @foreach($memberships as $plan)
                                                <td class="p-4 text-center text-white">
                                                    @if($plan->visits_allowed >= 999)
                                                        Unlimited
                                                    @else
                                                        {{ $plan->visits_allowed }}/month
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        <tr class="border-b border-border-dark hover:bg-background-dark/50 transition-colors">
                                            <td class="p-4 md:px-6 md:py-4 font-medium text-white">Instant Chat</td>
                                            <td class="p-4 text-center"><span class="material-symbols-outlined text-text-dim opacity-30">close</span></td>
                                            @foreach($memberships as $plan)
                                                <td class="p-4 text-center"><span class="material-symbols-outlined text-primary">check_circle</span></td>
                                            @endforeach
                                        </tr>
                                        <tr class="border-b border-border-dark hover:bg-background-dark/50 transition-colors">
                                            <td class="p-4 md:px-6 md:py-4 font-medium text-white">Price (Monthly)</td>
                                            <td class="p-4 text-center text-white font-bold">₹0</td>
                                            @foreach($memberships as $plan)
                                                <td class="p-4 text-center text-white font-bold">₹{{ number_format($plan->price) }}</td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Secure Checkout Section -->
                    <div class="w-full bg-surface-dark border-t border-border-dark py-16">
                        <div class="max-w-[1200px] mx-auto px-4 md:px-6">
                            <div class="flex flex-col lg:flex-row gap-12">
                                <!-- Left: Trust & Security -->
                                <div class="flex-1 flex flex-col gap-6">
                                    <h2 class="text-3xl font-bold text-white">Secure Checkout</h2>
                                    <p class="text-text-dim max-w-md">Complete your payment securely. All transactions are encrypted with 256-bit SSL technology. Your financial information is never stored on our servers.</p>
                                    <div class="flex gap-4 mt-2">
                                        <div class="h-10 px-4 rounded bg-white flex items-center justify-center" data-alt="Visa Logo">
                                            <span class="text-black font-bold italic tracking-tighter text-lg">VISA</span>
                                        </div>
                                        <div class="h-10 px-4 rounded bg-white flex items-center justify-center" data-alt="Mastercard Logo">
                                            <div class="flex -space-x-2">
                                                <div class="w-6 h-6 rounded-full bg-red-500 opacity-80"></div>
                                                <div class="w-6 h-6 rounded-full bg-yellow-500 opacity-80"></div>
                                            </div>
                                        </div>
                                        <div class="h-10 px-4 rounded bg-white flex items-center justify-center text-black font-bold" data-alt="UPI Logo">
                                            UPI
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-4 mt-8 p-6 bg-background-dark rounded-xl border border-border-dark" id="checkout-summary">
                                        <div class="flex justify-between items-center text-sm">
                                            <span class="text-text-dim">Plan Selected</span>
                                            <span class="text-white font-medium" id="selected-plan">-</span>
                                        </div>
                                        <div class="flex justify-between items-center text-sm">
                                            <span class="text-text-dim">Subtotal</span>
                                            <span class="text-white font-medium" id="subtotal">-</span>
                                        </div>
                                        <div class="h-px bg-border-dark"></div>
                                        <div class="flex justify-between items-center text-lg font-bold">
                                            <span class="text-white">Total</span>
                                            <span class="text-white" id="total">-</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Right: Payment Methods -->
                                <div class="flex-[1.5] bg-background-dark rounded-2xl border border-border-dark p-6 md:p-8">
                                    <h3 class="text-xl font-bold text-white mb-6">Payment Method</h3>
                                    <!-- Payment Tabs -->
                                    <div class="flex gap-2 overflow-x-auto no-scrollbar mb-8 pb-2">
                                        <label class="cursor-pointer">
                                            <input checked="" class="peer hidden" name="payment_method" type="radio" value="card"/>
                                            <div class="flex items-center gap-2 px-6 py-3 rounded-full border border-border-dark bg-surface-dark text-text-dim peer-checked:bg-white peer-checked:text-black peer-checked:border-white transition-all whitespace-nowrap">
                                                <span class="material-symbols-outlined text-[20px]">credit_card</span>
                                                <span class="text-sm font-bold">Card</span>
                                            </div>
                                        </label>
                                        <label class="cursor-pointer">
                                            <input class="peer hidden" name="payment_method" type="radio" value="upi"/>
                                            <div class="flex items-center gap-2 px-6 py-3 rounded-full border border-border-dark bg-surface-dark text-text-dim peer-checked:bg-white peer-checked:text-black peer-checked:border-white transition-all whitespace-nowrap">
                                                <span class="material-symbols-outlined text-[20px]">qr_code_scanner</span>
                                                <span class="text-sm font-bold">UPI / QR</span>
                                            </div>
                                        </label>
                                        <label class="cursor-pointer">
                                            <input class="peer hidden" name="payment_method" type="radio" value="netbanking"/>
                                            <div class="flex items-center gap-2 px-6 py-3 rounded-full border border-border-dark bg-surface-dark text-text-dim peer-checked:bg-white peer-checked:text-black peer-checked:border-white transition-all whitespace-nowrap">
                                                <span class="material-symbols-outlined text-[20px]">account_balance</span>
                                                <span class="text-sm font-bold">Net Banking</span>
                                            </div>
                                        </label>
                                    </div>
                                    <!-- Form -->
                                    <form class="flex flex-col gap-5" id="payment-form">
                                        <div class="flex flex-col gap-2">
                                            <label class="text-xs font-bold text-text-dim uppercase tracking-wider">Card Number</label>
                                            <div class="relative">
                                                <input class="w-full bg-surface-dark border border-border-dark rounded-xl px-4 py-3 text-white placeholder-text-dim/50 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" placeholder="0000 0000 0000 0000" type="text" name="card_number"/>
                                                <span class="material-symbols-outlined absolute right-4 top-3 text-text-dim">credit_card</span>
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-5">
                                            <div class="flex-1 flex flex-col gap-2">
                                                <label class="text-xs font-bold text-text-dim uppercase tracking-wider">Expiry Date</label>
                                                <input class="w-full bg-surface-dark border border-border-dark rounded-xl px-4 py-3 text-white placeholder-text-dim/50 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" placeholder="MM / YY" type="text" name="expiry_date"/>
                                            </div>
                                            <div class="flex-1 flex flex-col gap-2">
                                                <label class="text-xs font-bold text-text-dim uppercase tracking-wider">CVV</label>
                                                <div class="relative">
                                                    <input class="w-full bg-surface-dark border border-border-dark rounded-xl px-4 py-3 text-white placeholder-text-dim/50 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" placeholder="123" type="text" name="cvv"/>
                                                    <span class="material-symbols-outlined absolute right-4 top-3 text-text-dim cursor-help text-[20px]">help</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label class="text-xs font-bold text-text-dim uppercase tracking-wider">Name on Card</label>
                                            <input class="w-full bg-surface-dark border border-border-dark rounded-xl px-4 py-3 text-white placeholder-text-dim/50 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" placeholder="John Doe" type="text" name="card_name"/>
                                        </div>
                                        <button class="mt-4 w-full h-14 rounded-full bg-primary text-white font-bold text-base hover:bg-red-600 transition-all flex items-center justify-center gap-2 shadow-lg shadow-primary/25" type="button" id="pay-button">
                                            <span class="material-symbols-outlined">lock</span>
                                            <span id="pay-button-text">Select a plan to continue</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Invoice History Footer -->
                    @auth
                    <div class="w-full py-10 bg-background-dark border-t border-border-dark">
                        <div class="max-w-[1200px] mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
                            <div class="flex flex-col gap-1">
                                <h4 class="text-white font-bold">Billing History</h4>
                                <p class="text-text-dim text-sm">View and download your past invoices.</p>
                            </div>
                            <div class="flex gap-4">
                                <a class="flex items-center gap-2 px-5 py-2 rounded-full border border-border-dark text-text-dim hover:text-white hover:border-white transition-colors text-sm font-medium" href="#">
                                    <span class="material-symbols-outlined text-[18px]">history</span>
                                    Past Transactions
                                </a>
                                <a class="flex items-center gap-2 px-5 py-2 rounded-full border border-border-dark text-text-dim hover:text-white hover:border-white transition-colors text-sm font-medium" href="#">
                                    <span class="material-symbols-outlined text-[18px]">download</span>
                                    Download Latest Invoice
                                </a>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Update checkout summary when plan is selected
            const planButtons = document.querySelectorAll('form[action*="subscribe"] button[type="submit"], a[href*="login"]');
            planButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const form = this.closest('form');
                    const card = this.closest('.rounded-2xl');
                    if (card) {
                        const planName = card.querySelector('h3').textContent.trim();
                        const priceElement = card.querySelector('.text-5xl');
                        
                        if (priceElement) {
                            const priceText = priceElement.textContent.replace('₹', '').replace(/,/g, '').replace('/mo', '').trim();
                            const price = parseFloat(priceText);
                            const subtotal = price;
                            const total = subtotal;
                            
                            document.getElementById('selected-plan').textContent = planName + ' - Monthly';
                            document.getElementById('subtotal').textContent = '₹' + subtotal.toLocaleString('en-IN');
                            document.getElementById('total').textContent = '₹' + total.toLocaleString('en-IN');
                            document.getElementById('pay-button-text').textContent = 'Pay ₹' + total.toLocaleString('en-IN') + ' Now';
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
