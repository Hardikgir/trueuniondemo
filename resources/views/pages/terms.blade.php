<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Terms and Conditions - Matrimony</title>
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
                                Terms and <br/>
                                <span class="text-primary">Conditions</span>
                            </h1>
                            <p class="text-white/70 text-lg lg:text-2xl font-normal leading-relaxed max-w-2xl">
                                Please read these terms carefully before using our matrimonial services. By accessing or using our platform, you agree to be bound by these terms.
                            </p>
                            <p class="text-white/50 text-sm">
                                Last updated: {{ date('F d, Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Terms Content Section -->
        <div class="px-6 lg:px-40 flex flex-1 justify-center py-12 bg-background-dark">
            <div class="layout-content-container flex flex-col max-w-[1200px] flex-1 gap-12">
                <!-- Section 1: Acceptance of Terms -->
                <div class="bg-surface-dark border border-[#392b28] p-8 lg:p-10 rounded-xl shadow-xl">
                    <h2 class="text-white text-3xl font-bold mb-6 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">gavel</span>
                        1. Acceptance of Terms
                    </h2>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mb-4">
                        By accessing and using this matrimonial website, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.
                    </p>
                    <p class="text-[#b9a19d] text-lg leading-relaxed">
                        These Terms and Conditions ("Terms") govern your access to and use of our matrimonial services, including our website, mobile applications, and related services (collectively, the "Service").
                    </p>
                </div>
                
                <!-- Section 2: Eligibility -->
                <div class="bg-surface-dark border border-[#392b28] p-8 lg:p-10 rounded-xl shadow-xl">
                    <h2 class="text-white text-3xl font-bold mb-6 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">verified_user</span>
                        2. Eligibility
                    </h2>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mb-4">
                        You must be at least 18 years of age to use this Service. By using this Service, you represent and warrant that:
                    </p>
                    <ul class="list-disc list-inside text-[#b9a19d] text-lg leading-relaxed space-y-2 ml-4">
                        <li>You are of legal age to form a binding contract in your jurisdiction</li>
                        <li>You are not prohibited from using the Service under applicable laws</li>
                        <li>You have the right, authority, and capacity to enter into this agreement</li>
                        <li>You will comply with all applicable laws and regulations</li>
                        <li>All information you provide is accurate, current, and complete</li>
                    </ul>
                </div>
                
                <!-- Section 3: User Accounts -->
                <div class="bg-surface-dark border border-[#392b28] p-8 lg:p-10 rounded-xl shadow-xl">
                    <h2 class="text-white text-3xl font-bold mb-6 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">account_circle</span>
                        3. User Accounts and Registration
                    </h2>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mb-4">
                        To access certain features of the Service, you must register for an account. When you register, you agree to:
                    </p>
                    <ul class="list-disc list-inside text-[#b9a19d] text-lg leading-relaxed space-y-2 ml-4">
                        <li>Provide accurate, current, and complete information during registration</li>
                        <li>Maintain and promptly update your account information</li>
                        <li>Maintain the security of your password and identification</li>
                        <li>Accept all responsibility for all activities that occur under your account</li>
                        <li>Notify us immediately of any unauthorized use of your account</li>
                    </ul>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mt-4">
                        You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.
                    </p>
                </div>
                
                <!-- Section 4: User Conduct -->
                <div class="bg-surface-dark border border-[#392b28] p-8 lg:p-10 rounded-xl shadow-xl">
                    <h2 class="text-white text-3xl font-bold mb-6 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">shield</span>
                        4. User Conduct and Prohibited Activities
                    </h2>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mb-4">
                        You agree not to use the Service to:
                    </p>
                    <ul class="list-disc list-inside text-[#b9a19d] text-lg leading-relaxed space-y-2 ml-4">
                        <li>Post false, inaccurate, misleading, or fraudulent information</li>
                        <li>Impersonate any person or entity or misrepresent your affiliation with any person or entity</li>
                        <li>Harass, abuse, or harm another person</li>
                        <li>Engage in any illegal activity or solicit others to perform illegal acts</li>
                        <li>Violate any applicable local, state, national, or international law</li>
                        <li>Transmit any viruses, malware, or other harmful code</li>
                        <li>Collect or store personal data about other users without their permission</li>
                        <li>Use automated systems to access the Service without our express written permission</li>
                    </ul>
                </div>
                
                <!-- Section 5: Content and Intellectual Property -->
                <div class="bg-surface-dark border border-[#392b28] p-8 lg:p-10 rounded-xl shadow-xl">
                    <h2 class="text-white text-3xl font-bold mb-6 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">copyright</span>
                        5. Content and Intellectual Property
                    </h2>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mb-4">
                        All content on the Service, including text, graphics, logos, images, and software, is the property of Matrimony or its content suppliers and is protected by copyright, trademark, and other intellectual property laws.
                    </p>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mb-4">
                        You retain ownership of any content you post on the Service. However, by posting content, you grant us a worldwide, non-exclusive, royalty-free license to use, reproduce, modify, and distribute your content for the purpose of operating and promoting the Service.
                    </p>
                    <p class="text-[#b9a19d] text-lg leading-relaxed">
                        You may not reproduce, distribute, modify, create derivative works of, publicly display, or otherwise exploit any content from the Service without our prior written permission.
                    </p>
                </div>
                
                <!-- Section 6: Privacy -->
                <div class="bg-surface-dark border border-[#392b28] p-8 lg:p-10 rounded-xl shadow-xl">
                    <h2 class="text-white text-3xl font-bold mb-6 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">lock</span>
                        6. Privacy and Data Protection
                    </h2>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mb-4">
                        Your privacy is important to us. Our collection and use of personal information is governed by our Privacy Policy, which is incorporated into these Terms by reference.
                    </p>
                    <p class="text-[#b9a19d] text-lg leading-relaxed">
                        By using the Service, you consent to the collection, use, and disclosure of your information as described in our Privacy Policy. We take reasonable measures to protect your personal information, but we cannot guarantee absolute security.
                    </p>
                </div>
                
                <!-- Section 7: Membership and Payments -->
                <div class="bg-surface-dark border border-[#392b28] p-8 lg:p-10 rounded-xl shadow-xl">
                    <h2 class="text-white text-3xl font-bold mb-6 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">payments</span>
                        7. Membership Plans and Payments
                    </h2>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mb-4">
                        We offer various membership plans with different features and pricing. By subscribing to a paid membership plan, you agree to:
                    </p>
                    <ul class="list-disc list-inside text-[#b9a19d] text-lg leading-relaxed space-y-2 ml-4">
                        <li>Pay all fees associated with your chosen membership plan</li>
                        <li>Provide accurate payment information</li>
                        <li>Authorize us to charge your payment method for recurring subscription fees</li>
                        <li>Understand that subscription fees are non-refundable except as required by law</li>
                        <li>Accept that membership plans may change, and we will notify you of any changes</li>
                    </ul>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mt-4">
                        All fees are in the currency specified at the time of purchase. Prices are subject to change, but we will notify you in advance of any price changes affecting your subscription.
                    </p>
                </div>
                
                <!-- Section 8: Termination -->
                <div class="bg-surface-dark border border-[#392b28] p-8 lg:p-10 rounded-xl shadow-xl">
                    <h2 class="text-white text-3xl font-bold mb-6 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">block</span>
                        8. Termination
                    </h2>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mb-4">
                        You may terminate your account at any time by contacting us or using the account deletion feature in your account settings.
                    </p>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mb-4">
                        We reserve the right to suspend or terminate your account and access to the Service immediately, without prior notice, if you:
                    </p>
                    <ul class="list-disc list-inside text-[#b9a19d] text-lg leading-relaxed space-y-2 ml-4">
                        <li>Violate these Terms or any applicable laws</li>
                        <li>Engage in fraudulent, abusive, or illegal activity</li>
                        <li>Fail to pay any fees owed to us</li>
                        <li>Provide false or misleading information</li>
                    </ul>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mt-4">
                        Upon termination, your right to use the Service will immediately cease. We may delete your account and all associated data, subject to our Privacy Policy and applicable law.
                    </p>
                </div>
                
                <!-- Section 9: Disclaimers -->
                <div class="bg-surface-dark border border-[#392b28] p-8 lg:p-10 rounded-xl shadow-xl">
                    <h2 class="text-white text-3xl font-bold mb-6 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">info</span>
                        9. Disclaimers
                    </h2>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mb-4">
                        THE SERVICE IS PROVIDED "AS IS" AND "AS AVAILABLE" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED. WE DO NOT WARRANT THAT:
                    </p>
                    <ul class="list-disc list-inside text-[#b9a19d] text-lg leading-relaxed space-y-2 ml-4">
                        <li>The Service will be uninterrupted, secure, or error-free</li>
                        <li>Any defects or errors will be corrected</li>
                        <li>The Service is free of viruses or other harmful components</li>
                        <li>The results obtained from using the Service will be accurate or reliable</li>
                    </ul>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mt-4">
                        We do not verify the accuracy of information provided by users. You are solely responsible for verifying the information of other users before engaging with them.
                    </p>
                </div>
                
                <!-- Section 10: Limitation of Liability -->
                <div class="bg-surface-dark border border-[#392b28] p-8 lg:p-10 rounded-xl shadow-xl">
                    <h2 class="text-white text-3xl font-bold mb-6 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">warning</span>
                        10. Limitation of Liability
                    </h2>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mb-4">
                        TO THE MAXIMUM EXTENT PERMITTED BY LAW, WE SHALL NOT BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES, OR ANY LOSS OF PROFITS OR REVENUES, WHETHER INCURRED DIRECTLY OR INDIRECTLY, OR ANY LOSS OF DATA, USE, GOODWILL, OR OTHER INTANGIBLE LOSSES.
                    </p>
                    <p class="text-[#b9a19d] text-lg leading-relaxed">
                        Our total liability for any claims arising from or related to the Service shall not exceed the amount you paid us in the twelve (12) months preceding the claim.
                    </p>
                </div>
                
                <!-- Section 11: Changes to Terms -->
                <div class="bg-surface-dark border border-[#392b28] p-8 lg:p-10 rounded-xl shadow-xl">
                    <h2 class="text-white text-3xl font-bold mb-6 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">edit</span>
                        11. Changes to Terms
                    </h2>
                    <p class="text-[#b9a19d] text-lg leading-relaxed">
                        We reserve the right to modify these Terms at any time. We will notify you of any material changes by posting the new Terms on this page and updating the "Last updated" date. Your continued use of the Service after such changes constitutes your acceptance of the new Terms.
                    </p>
                </div>
                
                <!-- Section 12: Contact Information -->
                <div class="bg-surface-dark border border-[#392b28] p-8 lg:p-10 rounded-xl shadow-xl">
                    <h2 class="text-white text-3xl font-bold mb-6 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">contact_support</span>
                        12. Contact Information
                    </h2>
                    <p class="text-[#b9a19d] text-lg leading-relaxed mb-4">
                        If you have any questions about these Terms, please contact us:
                    </p>
                    <div class="text-[#b9a19d] text-lg leading-relaxed space-y-2">
                        <p><strong class="text-white">Email:</strong> support@matrimony.com</p>
                        <p><strong class="text-white">Phone:</strong> +1 (555) 123-4567</p>
                        <p><strong class="text-white">Address:</strong> 123 Matrimony Street, City, State, ZIP Code</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div class="px-6 lg:px-40 py-24 flex justify-center bg-background-dark relative overflow-hidden">
            <!-- Decorative gradient -->
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-primary/5 pointer-events-none"></div>
            <div class="layout-content-container flex flex-col items-center max-w-[800px] text-center gap-8 relative z-10">
                <div class="w-20 h-20 rounded-full bg-surface-dark border border-[#392b28] flex items-center justify-center mb-4 shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined text-4xl text-primary">description</span>
                </div>
                <h2 class="text-white text-5xl lg:text-7xl font-black tracking-tight leading-none">
                    Questions? <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-orange-500">We're Here</span>
                </h2>
                <p class="text-white/60 text-xl max-w-xl">
                    If you have any questions about these Terms and Conditions, please don't hesitate to reach out to our support team.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 w-full justify-center mt-6">
                    @auth
                        <a href="{{ route('dashboard') }}" class="flex items-center justify-center rounded-full h-14 px-8 bg-primary hover:bg-red-600 text-white text-lg font-bold leading-normal tracking-[0.015em] transition-all transform hover:scale-105 shadow-xl shadow-primary/30">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('signup') }}" class="flex items-center justify-center rounded-full h-14 px-8 bg-primary hover:bg-red-600 text-white text-lg font-bold leading-normal tracking-[0.015em] transition-all transform hover:scale-105 shadow-xl shadow-primary/30">
                            Get Started
                        </a>
                    @endauth
                    <a href="{{ route('home') }}" class="flex items-center justify-center rounded-full h-14 px-8 bg-transparent border border-[#392b28] hover:bg-white/5 text-white text-lg font-bold leading-normal transition-colors">
                        Back to Home
                    </a>
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

