<!DOCTYPE html>
<html lang="en" dir="ltr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $landingSetting->meta_title }}</title>
    <meta name="description" content="{{ $landingSetting->meta_description }}">
    <link rel="canonical" href="{{ url('/') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Get Web Arab">
    <meta property="og:title" content="{{ $landingSetting->meta_title }}">
    <meta property="og:description" content="{{ $landingSetting->meta_description }}">
    <meta property="og:url" content="{{ url('/') }}">
    @if ($landingSetting->og_image_url)
        <meta property="og:image" content="{{ $landingSetting->og_image_url }}">
    @endif

    <!-- Twitter Card -->
    <meta name="twitter:card" content="{{ $landingSetting->og_image_url ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{ $landingSetting->meta_title }}">
    <meta name="twitter:description" content="{{ $landingSetting->meta_description }}">
    @if ($landingSetting->og_image_url)
        <meta name="twitter:image" content="{{ $landingSetting->og_image_url }}">
    @endif

    <!-- Structured Data -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => 'Get Web Arab',
        'description' => $landingSetting->meta_description,
        'url' => url('/'),
        'telephone' => '+'.$landingSetting->whatsapp_number,
        'areaServed' => 'AE',
        'address' => [
            '@type' => 'PostalAddress',
            'addressCountry' => 'AE',
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@500;600;700&family=Inter:wght@300;400;500;600;700;800&family=Saira+Extra+Condensed:wght@500;600;700;800&family=Tajawal:wght@500;700;800&family=Cairo:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        obsidian: {
                            950: '#000000',
                            900: '#0A0A0A',
                            800: '#141414',
                            700: '#1F1F1F',
                        },
                        navy: {
                            900: '#0B132C',
                            800: '#141E36',
                        },
                        gold: {
                            400: '#FBBF24',
                            500: '#F59E0B',
                        }
                    },
                    fontFamily: {
                        heading: ['Saira Extra Condensed', 'sans-serif'],
                        arabicHeading: ['Tajawal', 'Cairo', 'sans-serif'],
                        sans: ['Inter', 'sans-serif'],
                        mono: ['IBM Plex Mono', 'monospace'],
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            background-color: #FFFFFF;
            color: #0F172A;
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, .font-heading {
            font-family: 'Saira Extra Condensed', sans-serif;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        [dir="rtl"] h1, 
        [dir="rtl"] h2, 
        [dir="rtl"] h3, 
        [dir="rtl"] h4, 
        [dir="rtl"] .font-heading {
            font-family: 'Tajawal', 'Cairo', sans-serif;
            letter-spacing: normal;
            text-transform: none;
        }

        .font-mono-tag {
            font-family: 'IBM Plex Mono', monospace;
        }

        /* Glass Panel Light & Dark */
        .glass-panel-light {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }

        .glass-panel-pureblack {
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        /* Physical Module-Stack Block Animations */
        .module-block {
            transition: all 0.3s ease;
            border-left: 5px solid #000000;
        }

        [dir="rtl"] .module-block {
            border-left: none;
            border-right: 5px solid #000000;
        }

        .module-block.optional {
            border-left: 5px solid #64748B;
        }

        [dir="rtl"] .module-block.optional {
            border-left: none;
            border-right: 5px solid #64748B;
        }

        /* Scroll Reveal Animations */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal-active {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }
        .delay-400 { transition-delay: 400ms; }
        .delay-500 { transition-delay: 500ms; }
    </style>
</head>
<body class="antialiased selection:bg-slate-900 selection:text-white">

    <!-- Navigation Header (LIGHT MODE) -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200 px-10 py-5 transition-all shadow-sm">
        <div class="max-w-[1320px] mx-auto flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="#" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-lg bg-black text-white font-heading text-2xl font-bold tracking-tight shadow-md group-hover:scale-105 transition-transform flex items-center justify-center">
                    G
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-heading font-extrabold tracking-wider text-slate-950">GET WEB ARAB</span>
                        <span class="font-mono-tag px-2 py-0.5 text-[10px] font-bold bg-slate-100 text-slate-900 border border-slate-300 rounded uppercase">UAE</span>
                    </div>
                    <p class="text-[11px] text-slate-500 font-medium" data-i18n="tagline">{{ $i18n['en']['tagline'] ?? 'Digital Growth Agency' }}</p>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden md:flex items-center gap-10 text-xs font-mono-tag font-bold tracking-wide text-slate-700">
                <a href="#offer-stack" class="hover:text-black transition-colors" data-i18n="nav_stack">{{ $i18n['en']['nav_stack'] ?? 'Pricing & Calculator' }}</a>
                <a href="#pillars" class="hover:text-black transition-colors" data-i18n="nav_pillars">{{ $i18n['en']['nav_pillars'] ?? 'How We Grow Your Biz' }}</a>
                <a href="#team" class="hover:text-black transition-colors" data-i18n="nav_team">{{ $i18n['en']['nav_team'] ?? 'Our Team' }}</a>
                <a href="#faq" class="hover:text-black transition-colors" data-i18n="nav_faq">{{ $i18n['en']['nav_faq'] ?? 'FAQ' }}</a>
                <a href="{{ route('blog.index') }}" class="hover:text-black transition-colors" data-i18n="nav_blog">{{ $i18n['en']['nav_blog'] ?? 'Blog' }}</a>
            </nav>

            <!-- Language Switcher & Calm CTA -->
            <div class="flex items-center gap-4">
                <button id="langToggleBtn" onclick="toggleLanguage()" class="font-mono-tag px-4 py-2 rounded border border-slate-300 text-xs font-bold text-slate-800 hover:bg-slate-100 transition-all bg-white flex items-center gap-2 hover:scale-105 active:scale-95 shadow-sm">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path></svg>
                    <span id="langBtnText">العربية</span>
                </button>

                <a href="#offer-stack" class="hidden sm:inline-flex bg-black hover:bg-slate-800 text-white font-mono-tag text-xs font-bold px-6 py-2.5 rounded transition-all hover:scale-105 shadow-md">
                    <span data-i18n="btn_view_pricing">{{ $i18n['en']['btn_view_pricing'] ?? 'See What You\'ll Pay' }}</span>
                </a>
            </div>
        </div>
    </header>

    <!-- DARK SECTION #1: HERO SECTION (FULL BLACK #000000) -->
    <section class="bg-[#000000] text-white py-28 sm:py-36 px-10 relative overflow-hidden">
        <div class="max-w-[1320px] mx-auto">
            <div class="max-w-4xl">
                <!-- Architectural Eyebrow -->
                <div class="reveal inline-flex items-center gap-2 font-mono-tag text-xs font-semibold text-amber-400 uppercase tracking-widest mb-8">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-pulse"></span>
                    <span data-i18n="hero_eyebrow">{{ $i18n['en']['hero_eyebrow'] ?? 'MORE LOCAL LEADS. ZERO TECH HEADACHES. ONE FIXED AED PRICE.' }}</span>
                </div>

                <!-- Architectural Heading (Saira ExtraCondensed) -->
                <h1 class="reveal delay-100 text-6xl sm:text-8xl font-extrabold text-white leading-none mb-8">
                    <span data-i18n="hero_title">{{ $i18n['en']['hero_title'] ?? 'Turn your website into a 24/7 customer magnet in the UAE.' }}</span>
                </h1>

                <!-- Calm Reassuring Subtitle -->
                <p class="reveal delay-200 text-lg sm:text-xl text-slate-300 font-normal max-w-3xl leading-relaxed mb-10" data-i18n="hero_subtitle">{{ $i18n['en']['hero_subtitle'] ?? 'We build bilingual websites that turn local searchers into paying customers — then keep them coming with SEO and ads, all for one clear monthly price. No retainers, no surprise invoices, no chasing four different vendors.' }}</p>

                <!-- Single Primary CTA -->
                <div class="reveal delay-300 flex flex-col sm:flex-row items-stretch sm:items-start gap-4">
                    <div class="flex flex-col">
                        <a href="#offer-stack" class="bg-white hover:bg-slate-200 text-black font-mono-tag font-extrabold text-xs px-10 py-5 rounded text-center tracking-wider transition-all shadow-xl hover:scale-105">
                            <span data-i18n="hero_cta_1">{{ $i18n['en']['hero_cta_1'] ?? 'Build My Package →' }}</span>
                        </a>
                        <span class="text-xs text-slate-400 mt-3 font-mono-tag" data-i18n="hero_note">{{ $i18n['en']['hero_note'] ?? 'Built for UAE local businesses · Takes about 60 seconds' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Bar (LIGHT MODE SECTION) -->
    <section class="py-14 px-10 border-y border-slate-200 bg-slate-100 text-slate-900">
        <div class="max-w-[1320px] mx-auto flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
            <div class="reveal">
                <span class="font-mono-tag text-xs text-slate-600 font-bold uppercase tracking-wider block mb-1" data-i18n="trust_eyebrow">{{ $i18n['en']['trust_eyebrow'] ?? 'YOUR BUSINESS GROWTH PARTNER' }}</span>
                <p class="text-base font-bold text-slate-950" data-i18n="trust_headline">{{ $i18n['en']['trust_headline'] ?? 'Built on Measurable Return & Absolute Reliability' }}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 text-xs text-slate-700 font-mono-tag">
                <div class="reveal delay-100 flex items-center gap-4">
                    <div class="w-10 h-10 rounded bg-white border border-slate-300 flex items-center justify-center text-black font-bold text-sm shadow-sm">1</div>
                    <span data-i18n="t_p1">{{ $i18n['en']['t_p1'] ?? 'Zero Surprise Fees or Hidden AED Costs' }}</span>
                </div>
                <div class="reveal delay-200 flex items-center gap-4">
                    <div class="w-10 h-10 rounded bg-white border border-slate-300 flex items-center justify-center text-black font-bold text-sm shadow-sm">2</div>
                    <span data-i18n="t_p2">{{ $i18n['en']['t_p2'] ?? 'Direct 1-on-1 Business Owner Accountability' }}</span>
                </div>
                <div class="reveal delay-300 flex items-center gap-4">
                    <div class="w-10 h-10 rounded bg-white border border-slate-300 flex items-center justify-center text-black font-bold text-sm shadow-sm">3</div>
                    <span data-i18n="t_p3">{{ $i18n['en']['t_p3'] ?? 'Measurable Local UAE Leads & Inquiries' }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Problem Section (LIGHT MODE SECTION) -->
    <section class="bg-slate-50 text-slate-900 py-28 sm:py-36 px-10 border-b border-slate-200">
        <div class="max-w-[1320px] mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="reveal">
                    <span class="font-mono-tag text-xs text-black font-bold uppercase tracking-widest block mb-3" data-i18n="prob_eyebrow">{{ $i18n['en']['prob_eyebrow'] ?? 'WHY UAE BUSINESS OWNERS SWITCH TO US' }}</span>
                    <h2 class="text-5xl sm:text-6xl font-extrabold text-slate-950 leading-tight mb-8" data-i18n="prob_title">{{ $i18n['en']['prob_title'] ?? 'Stop wasting money on websites that don\'t generate revenue' }}</h2>
                    <p class="text-slate-700 text-base leading-relaxed" data-i18n="prob_desc">{{ $i18n['en']['prob_desc'] ?? 'You didn\'t start your business to babysit a website — or to chase a designer, a host, and an ads guy who never talk to each other. That\'s where most UAE owners lose money and hours, with no clear line back to a single new customer. We flip it: one team, one price, one job — turning your site into a steady source of local leads while you get back to running the business.' }}</p>
                </div>

                <div class="space-y-5">
                    <div class="reveal delay-100 glass-panel-light p-6 rounded-2xl flex items-start gap-5 hover:shadow-md transition-all">
                        <span class="text-rose-600 font-mono-tag font-bold text-lg">✕</span>
                        <div>
                            <div class="text-base font-bold text-slate-950" data-i18n="f1_title">{{ $i18n['en']['f1_title'] ?? 'The Traditional Agency' }}</div>
                            <div class="text-sm text-slate-600 mt-1" data-i18n="f1_desc">{{ $i18n['en']['f1_desc'] ?? '5,000+ AED upfront just for the site, a 12-month lock-in, and no promise your revenue actually moves.' }}</div>
                        </div>
                    </div>
                    <div class="reveal delay-200 glass-panel-light p-6 rounded-2xl flex items-start gap-5 hover:shadow-md transition-all">
                        <span class="text-rose-600 font-mono-tag font-bold text-lg">✕</span>
                        <div>
                            <div class="text-base font-bold text-slate-950" data-i18n="f2_title">{{ $i18n['en']['f2_title'] ?? 'The Solo Freelancer' }}</div>
                            <div class="text-sm text-slate-600 mt-1" data-i18n="f2_desc">{{ $i18n['en']['f2_desc'] ?? 'Cheap to start, but gone the moment your site breaks or the leads dry up.' }}</div>
                        </div>
                    </div>
                    <div class="reveal delay-300 p-6 rounded-2xl bg-black text-white shadow-xl flex items-start gap-5 hover:scale-[1.02] transition-all">
                        <span class="text-emerald-400 font-mono-tag font-bold text-lg">✓</span>
                        <div>
                            <div class="text-base font-bold text-white" data-i18n="f3_title">{{ $i18n['en']['f3_title'] ?? 'Get Web Arab' }}</div>
                            <div class="text-sm text-slate-200 mt-1" data-i18n="f3_desc">{{ $i18n['en']['f3_desc'] ?? '800 AED to start, one team accountable for uptime and growth, and results you can count in the inquiries you receive.' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- DARK SECTION #2: FOUR PILLARS / DELIVERABLES (FULL BLACK #000000) -->
    <section id="pillars" class="bg-[#000000] text-white py-28 sm:py-36 px-10 border-b border-obsidian-800">
        <div class="max-w-[1320px] mx-auto">
            <div class="reveal text-center max-w-3xl mx-auto mb-20">
                <span class="font-mono-tag text-xs text-amber-400 font-bold uppercase tracking-widest block mb-3" data-i18n="pil_eyebrow">{{ $i18n['en']['pil_eyebrow'] ?? 'WHAT YOU GET' }}</span>
                <h2 class="text-5xl sm:text-6xl font-extrabold text-white" data-i18n="pil_title">{{ $i18n['en']['pil_title'] ?? 'Everything Your Business Needs Online' }}</h2>
                <p class="text-slate-300 text-base mt-4" data-i18n="pil_sub">{{ $i18n['en']['pil_sub'] ?? 'Start with the website. Add the growth pieces whenever you\'re ready — each one is a fixed monthly service, no surprises.' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Pillar 1 -->
                <div class="reveal delay-100 glass-panel-pureblack p-10 rounded-2xl hover:border-slate-400 hover:-translate-y-1 transition-all duration-300">
                    <span class="font-mono-tag text-xs text-slate-400 font-bold uppercase tracking-wider block mb-3">01 / FOUNDATION</span>
                    <h3 class="text-3xl font-bold text-white mb-4" data-i18n="p1_title">{{ $i18n['en']['p1_title'] ?? 'A website that works' }}</h3>
                    <p class="text-slate-300 text-base leading-relaxed" data-i18n="p1_desc">{{ $i18n['en']['p1_desc'] ?? 'Fast, mobile-first, and built to turn visitors into calls and bookings — not just look pretty. We host it and keep it running.' }}</p>
                </div>

                <!-- Pillar 2 -->
                <div class="reveal delay-200 glass-panel-pureblack p-10 rounded-2xl hover:border-slate-400 hover:-translate-y-1 transition-all duration-300">
                    <span class="font-mono-tag text-xs text-amber-400 font-bold uppercase tracking-wider block mb-3">02 / ACQUISITION</span>
                    <h3 class="text-3xl font-bold text-white mb-4" data-i18n="p2_title">{{ $i18n['en']['p2_title'] ?? 'SEO' }}</h3>
                    <p class="text-slate-300 text-base leading-relaxed" data-i18n="p2_desc">{{ $i18n['en']['p2_desc'] ?? 'Show up when people in your area search for what you sell. Ongoing work to climb Google, not a one-time fix.' }}</p>
                </div>

                <!-- Pillar 3 -->
                <div class="reveal delay-300 glass-panel-pureblack p-10 rounded-2xl hover:border-slate-400 hover:-translate-y-1 transition-all duration-300">
                    <span class="font-mono-tag text-xs text-slate-400 font-bold uppercase tracking-wider block mb-3">03 / ACCELERATED GROWTH</span>
                    <h3 class="text-3xl font-bold text-white mb-4" data-i18n="p3_title">{{ $i18n['en']['p3_title'] ?? 'Ads' }}</h3>
                    <p class="text-slate-300 text-base leading-relaxed" data-i18n="p3_desc">{{ $i18n['en']['p3_desc'] ?? 'Google and Meta campaigns that put you in front of ready-to-buy customers. We manage them; your ad budget stays yours, billed separately.' }}</p>
                </div>

                <!-- Pillar 4 -->
                <div class="reveal delay-400 glass-panel-pureblack p-10 rounded-2xl hover:border-slate-400 hover:-translate-y-1 transition-all duration-300">
                    <span class="font-mono-tag text-xs text-slate-400 font-bold uppercase tracking-wider block mb-3">04 / CUSTOMER RETENTION</span>
                    <h3 class="text-3xl font-bold text-white mb-4" data-i18n="p4_title">{{ $i18n['en']['p4_title'] ?? 'Email' }}</h3>
                    <p class="text-slate-300 text-base leading-relaxed" data-i18n="p4_desc">{{ $i18n['en']['p4_desc'] ?? 'Stay in front of past customers with offers and updates that bring them back — set up and sent for you every month.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- COMBINED SECTION: THE MODULAR OFFER STACK & PRICING CALCULATOR (LIGHT MODE SECTION) -->
    <section id="offer-stack" class="bg-white text-slate-900 py-28 sm:py-36 px-10 border-b border-slate-200">
        <div class="max-w-[1320px] mx-auto">
            
            <!-- Section Header -->
            <div class="reveal text-center max-w-3xl mx-auto mb-16">
                <span class="font-mono-tag text-xs text-slate-900 font-bold uppercase tracking-widest block mb-3" data-i18n="stack_eyebrow">{{ $i18n['en']['stack_eyebrow'] ?? 'ONE CLEAR PRICE. NOTHING HIDDEN.' }}</span>
                <h2 class="text-5xl sm:text-6xl font-extrabold text-slate-950" data-i18n="stack_title">{{ $i18n['en']['stack_title'] ?? 'Build your growth engine — and see the exact AED before you commit' }}</h2>
                <p class="text-slate-600 text-base mt-4" data-i18n="stack_desc">{{ $i18n['en']['stack_desc'] ?? 'Pick only what you need. The total updates as you go, so there are no surprises and nothing to negotiate later.' }}</p>
            </div>

            <!-- Combined Interactive Stack & Calculator Container -->
            <div class="max-w-4xl mx-auto space-y-6">
                
                <!-- Block 1: Mandatory Setup -->
                <div class="reveal delay-100 module-block p-8 rounded-2xl bg-slate-50 border border-slate-300 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 shadow-sm hover:shadow-md transition-all">
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="font-mono-tag text-xs font-bold bg-black text-white px-3 py-1 rounded uppercase">THE FOUNDATION</span>
                            <span class="text-xs text-slate-500 font-mono-tag font-bold">STEP 1</span>
                        </div>
                        <h3 class="text-3xl font-bold text-slate-950 mt-2" data-i18n="st1_title">{{ $i18n['en']['st1_title'] ?? 'Website Setup & Build' }}</h3>
                        <p class="text-sm text-slate-600 mt-1" data-i18n="st1_desc">{{ $i18n['en']['st1_desc'] ?? 'A high-speed bilingual site engineered to turn UAE visitors into buyers.' }}</p>
                    </div>
                    <div class="font-mono-tag text-2xl font-bold text-slate-950 whitespace-nowrap">
                        <span id="setupPriceDisplay">800 AED</span> <span class="text-xs text-slate-500 font-normal">one-time</span>
                    </div>
                </div>

                <!-- Block 2: Mandatory Care Anchor -->
                <div class="reveal delay-200 module-block p-8 rounded-2xl bg-slate-50 border-2 border-black flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 shadow-md hover:shadow-lg transition-all">
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="font-mono-tag text-xs font-bold bg-amber-500 text-slate-950 px-3 py-1 rounded uppercase">ALWAYS-ON PROTECTION</span>
                            <span class="text-xs text-slate-500 font-mono-tag font-bold">STEP 2</span>
                        </div>
                        <h3 class="text-3xl font-bold text-slate-950 mt-2" data-i18n="st2_title">{{ $i18n['en']['st2_title'] ?? '24/7 Care & Hosting' }}</h3>
                        <p class="text-sm text-slate-600 mt-1" data-i18n="st2_desc">{{ $i18n['en']['st2_desc'] ?? 'Hosting, security, daily backups, guaranteed uptime, and ongoing edits — so your site never costs you a sale.' }}</p>
                    </div>
                    <div class="font-mono-tag text-2xl font-bold text-black whitespace-nowrap">
                        <span id="carePriceDisplay">150 AED/mo</span>
                    </div>
                </div>

                <!-- Block 3: Interactive Growth Modules with Bundle Discount Rules -->
                <div class="reveal delay-300 module-block optional p-8 rounded-2xl bg-slate-100 border border-slate-300">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-6">
                        <div class="flex items-center gap-3">
                            <span class="font-mono-tag text-xs font-bold bg-slate-800 text-white px-3 py-1 rounded uppercase">GROWTH ACCELERATORS</span>
                            <span class="text-xs text-slate-500 font-mono-tag font-bold">STEP 3</span>
                        </div>
                        <div class="font-mono-tag text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-full" data-i18n="bundle_rule_tag">{{ $i18n['en']['bundle_rule_tag'] ?? '⚡ Add 2 and save 10% · Add all 3 and save 20%' }}</div>
                    </div>
                    
                    <div class="space-y-4 font-mono-tag">
                        <!-- SEO Check -->
                        <div onclick="toggleModule('modSeo')" class="p-5 rounded-xl bg-white border border-slate-300 hover:border-black cursor-pointer flex items-center justify-between transition-all shadow-sm hover:scale-[1.01]">
                            <div class="flex items-center gap-4">
                                <input type="checkbox" id="modSeo" onchange="calculatePrice()" class="w-5 h-5 text-black rounded border-slate-400">
                                <div>
                                    <div class="text-sm font-bold text-slate-950" data-i18n="c_seo_t">{{ $i18n['en']['c_seo_t'] ?? 'Local SEO' }}</div>
                                    <div class="text-xs text-slate-500 mt-0.5" data-i18n="c_seo_d">{{ $i18n['en']['c_seo_d'] ?? 'Rank #1 on Google Maps and pull in local buyers searching right now' }}</div>
                                </div>
                            </div>
                            <div class="text-sm font-bold text-emerald-600">+350 AED/mo</div>
                        </div>

                        <!-- Ads Check -->
                        <div onclick="toggleModule('modAds')" class="p-5 rounded-xl bg-white border border-slate-300 hover:border-black cursor-pointer flex items-center justify-between transition-all shadow-sm hover:scale-[1.01]">
                            <div class="flex items-center gap-4">
                                <input type="checkbox" id="modAds" onchange="calculatePrice()" class="w-5 h-5 text-black rounded border-slate-400">
                                <div>
                                    <div class="text-sm font-bold text-slate-950" data-i18n="c_ads_t">{{ $i18n['en']['c_ads_t'] ?? 'Google & Meta Ads' }}</div>
                                    <div class="text-xs text-slate-500 mt-0.5" data-i18n="c_ads_d">{{ $i18n['en']['c_ads_d'] ?? 'High-ROI campaigns; ad spend billed straight to your card' }}</div>
                                </div>
                            </div>
                            <div class="text-sm font-bold text-emerald-600">+350 AED/mo</div>
                        </div>

                        <!-- Email Check -->
                        <div onclick="toggleModule('modEmail')" class="p-5 rounded-xl bg-white border border-slate-300 hover:border-black cursor-pointer flex items-center justify-between transition-all shadow-sm hover:scale-[1.01]">
                            <div class="flex items-center gap-4">
                                <input type="checkbox" id="modEmail" onchange="calculatePrice()" class="w-5 h-5 text-black rounded border-slate-400">
                                <div>
                                    <div class="text-sm font-bold text-slate-950" data-i18n="c_email_t">{{ $i18n['en']['c_email_t'] ?? 'Lead Nurturing' }}</div>
                                    <div class="text-xs text-slate-500 mt-0.5" data-i18n="c_email_d">{{ $i18n['en']['c_email_d'] ?? 'Turn cold inquiries into repeat, paying customers automatically' }}</div>
                                </div>
                            </div>
                            <div class="text-sm font-bold text-emerald-600">+350 AED/mo</div>
                        </div>
                    </div>
                </div>

                <!-- Final Price Summary Box (PURE BLACK #000000) -->
                <div class="reveal delay-400 p-8 rounded-2xl bg-[#000000] text-white border border-obsidian-800 flex flex-col lg:flex-row items-center justify-between gap-8 shadow-2xl">
                    <div class="font-mono-tag">
                        <div class="flex items-center gap-3">
                            <span class="text-xs uppercase text-amber-400 font-bold tracking-wider" data-i18n="calc_final_price_title">{{ $i18n['en']['calc_final_price_title'] ?? 'YOUR GUARANTEED AED PRICE' }}</span>
                            <span id="bundleDiscountBadge" class="hidden text-[10px] font-bold uppercase bg-emerald-500 text-slate-950 px-2.5 py-0.5 rounded-full animate-bounce"></span>
                        </div>
                        <div class="flex items-baseline gap-8 mt-3">
                            <div>
                                <span class="text-xs text-slate-400 block font-normal" data-i18n="calc_one_time">{{ $i18n['en']['calc_one_time'] ?? 'One-time:' }}</span>
                                <span id="finalSetupTotal" class="text-3xl font-bold text-white">800 AED</span>
                            </div>
                            <div>
                                <span class="text-xs text-slate-400 block font-normal" data-i18n="calc_monthly">{{ $i18n['en']['calc_monthly'] ?? 'Monthly care & growth:' }}</span>
                                <span id="finalMonthlyTotal" class="text-4xl font-bold text-amber-400">150 AED<span class="text-xs text-slate-400 font-normal">/mo</span></span>
                            </div>
                        </div>
                    </div>

                    <button onclick="submitCalculatedPlan()" class="w-full lg:w-auto bg-white text-black hover:bg-slate-200 font-mono-tag text-xs font-extrabold px-10 py-5 rounded uppercase tracking-wider transition-all shadow-xl hover:scale-105">
                        <span data-i18n="btn_confirm_plan">{{ $i18n['en']['btn_confirm_plan'] ?? 'Lock In This Price' }}</span>
                    </button>
                </div>

            </div>
        </div>
    </section>

    <!-- Team Section (LIGHT MODE SECTION) -->
    <section id="team" class="bg-slate-50 text-slate-900 py-28 sm:py-36 px-10 border-b border-slate-200">
        <div class="max-w-[1320px] mx-auto">
            <div class="reveal text-center max-w-3xl mx-auto mb-20">
                <span class="font-mono-tag text-xs text-black font-bold uppercase tracking-widest block mb-3" data-i18n="team_eyebrow">{{ $i18n['en']['team_eyebrow'] ?? 'THE PEOPLE BEHIND YOUR RESULTS' }}</span>
                <h2 class="text-5xl sm:text-6xl font-extrabold text-slate-950" data-i18n="team_title">{{ $i18n['en']['team_title'] ?? 'A full growth team, without agency overhead' }}</h2>
                <p class="text-slate-600 text-base mt-4" data-i18n="team_subtitle">{{ $i18n['en']['team_subtitle'] ?? 'You get a designer, engineers, and marketers focused on one thing — your leads — for a fraction of what an in-house team costs.' }}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Joy Chowdhury -->
                <div class="reveal delay-100 group relative rounded-2xl overflow-hidden aspect-[4/5] border border-slate-300 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-black via-obsidian-900 to-slate-900 group-hover:scale-110 transition-transform duration-700 flex items-center justify-center">
                        <span class="text-white/20 font-mono-tag text-7xl font-bold tracking-widest select-none">JC</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent p-8 flex flex-col justify-end text-white">
                        <span class="font-mono-tag text-xs font-bold text-amber-400 uppercase tracking-widest mb-1" data-i18n="m1_role">{{ $i18n['en']['m1_role'] ?? 'Founder & Head of Product' }}</span>
                        <h3 class="text-3xl font-bold text-white" data-i18n="m1_name">{{ $i18n['en']['m1_name'] ?? 'Joy Chowdhury' }}</h3>
                        <p class="text-slate-300 text-xs mt-2 leading-relaxed" data-i18n="m1_bio">{{ $i18n['en']['m1_bio'] ?? 'Owns your strategy and build, and stays accountable to you directly.' }}</p>
                    </div>
                </div>

                <!-- Tariq Al-Mansoor -->
                <div class="reveal delay-200 group relative rounded-2xl overflow-hidden aspect-[4/5] border border-slate-300 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-950 via-slate-900 to-black group-hover:scale-110 transition-transform duration-700 flex items-center justify-center">
                        <span class="text-white/20 font-mono-tag text-7xl font-bold tracking-widest select-none">TM</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent p-8 flex flex-col justify-end text-white">
                        <span class="font-mono-tag text-xs font-bold text-amber-400 uppercase tracking-widest mb-1" data-i18n="m2_role">{{ $i18n['en']['m2_role'] ?? 'UAE Growth & Client Partner' }}</span>
                        <h3 class="text-3xl font-bold text-white" data-i18n="m2_name">{{ $i18n['en']['m2_name'] ?? 'Tariq Al-Mansoor' }}</h3>
                        <p class="text-slate-300 text-xs mt-2 leading-relaxed" data-i18n="m2_bio">{{ $i18n['en']['m2_bio'] ?? 'Your local point of contact for onboarding and growth.' }}</p>
                    </div>
                </div>

                <!-- Arifur Rahman -->
                <div class="reveal delay-300 group relative rounded-2xl overflow-hidden aspect-[4/5] border border-slate-300 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-950 via-slate-900 to-black group-hover:scale-110 transition-transform duration-700 flex items-center justify-center">
                        <span class="text-white/20 font-mono-tag text-7xl font-bold tracking-widest select-none">AR</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent p-8 flex flex-col justify-end text-white">
                        <span class="font-mono-tag text-xs font-bold text-amber-400 uppercase tracking-widest mb-1" data-i18n="m3_role">{{ $i18n['en']['m3_role'] ?? 'Lead UI/UX Designer' }}</span>
                        <h3 class="text-3xl font-bold text-white" data-i18n="m3_name">{{ $i18n['en']['m3_name'] ?? 'Arifur Rahman' }}</h3>
                        <p class="text-slate-300 text-xs mt-2 leading-relaxed" data-i18n="m3_bio">{{ $i18n['en']['m3_bio'] ?? 'Designs bilingual pages built to convert, not just to look good.' }}</p>
                    </div>
                </div>

                <!-- Nusrat Jahan -->
                <div class="reveal delay-100 group relative rounded-2xl overflow-hidden aspect-[4/5] border border-slate-300 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-950 via-slate-900 to-black group-hover:scale-110 transition-transform duration-700 flex items-center justify-center">
                        <span class="text-white/20 font-mono-tag text-7xl font-bold tracking-widest select-none">NJ</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent p-8 flex flex-col justify-end text-white">
                        <span class="font-mono-tag text-xs font-bold text-amber-400 uppercase tracking-widest mb-1" data-i18n="m4_role">{{ $i18n['en']['m4_role'] ?? 'Senior Full-Stack Engineer' }}</span>
                        <h3 class="text-3xl font-bold text-white" data-i18n="m4_name">{{ $i18n['en']['m4_name'] ?? 'Nusrat Jahan' }}</h3>
                        <p class="text-slate-300 text-xs mt-2 leading-relaxed" data-i18n="m4_bio">{{ $i18n['en']['m4_bio'] ?? 'Keeps your site fast, secure, and always online.' }}</p>
                    </div>
                </div>

                <!-- Mahmudul Hasan -->
                <div class="reveal delay-200 group relative rounded-2xl overflow-hidden aspect-[4/5] border border-slate-300 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-rose-950 via-slate-900 to-black group-hover:scale-110 transition-transform duration-700 flex items-center justify-center">
                        <span class="text-white/20 font-mono-tag text-7xl font-bold tracking-widest select-none">MH</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent p-8 flex flex-col justify-end text-white">
                        <span class="font-mono-tag text-xs font-bold text-amber-400 uppercase tracking-widest mb-1" data-i18n="m5_role">{{ $i18n['en']['m5_role'] ?? 'Performance Marketing & Ads Lead' }}</span>
                        <h3 class="text-3xl font-bold text-white" data-i18n="m5_name">{{ $i18n['en']['m5_name'] ?? 'Mahmudul Hasan' }}</h3>
                        <p class="text-slate-300 text-xs mt-2 leading-relaxed" data-i18n="m5_bio">{{ $i18n['en']['m5_bio'] ?? 'Runs ad campaigns tuned for UAE buyers and real ROI.' }}</p>
                    </div>
                </div>

                <!-- Farhana Akter -->
                <div class="reveal delay-300 group relative rounded-2xl overflow-hidden aspect-[4/5] border border-slate-300 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-950 via-slate-900 to-black group-hover:scale-110 transition-transform duration-700 flex items-center justify-center">
                        <span class="text-white/20 font-mono-tag text-7xl font-bold tracking-widest select-none">FA</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent p-8 flex flex-col justify-end text-white">
                        <span class="font-mono-tag text-xs font-bold text-amber-400 uppercase tracking-widest mb-1" data-i18n="m6_role">{{ $i18n['en']['m6_role'] ?? 'Technical SEO & Growth Strategist' }}</span>
                        <h3 class="text-3xl font-bold text-white" data-i18n="m6_name">{{ $i18n['en']['m6_name'] ?? 'Farhana Akter' }}</h3>
                        <p class="text-slate-300 text-xs mt-2 leading-relaxed" data-i18n="m6_bio">{{ $i18n['en']['m6_bio'] ?? 'Gets you ranking on Google Maps and local search.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section (LIGHT MODE SECTION) -->
    <section id="faq" class="bg-white py-28 sm:py-36 px-10 border-b border-slate-200 text-slate-900">
        <div class="max-w-[1320px] mx-auto">
            <div class="reveal text-center max-w-3xl mx-auto mb-16">
                <span class="font-mono-tag text-xs text-black font-bold uppercase tracking-widest block mb-3" data-i18n="faq_eyebrow">{{ $i18n['en']['faq_eyebrow'] ?? 'REASSURANCE & CLARITY' }}</span>
                <h2 class="text-5xl sm:text-6xl font-extrabold text-slate-950" data-i18n="faq_title">{{ $i18n['en']['faq_title'] ?? 'Frequently Asked Questions' }}</h2>
            </div>

            <div class="max-w-4xl mx-auto space-y-5">
                <div class="reveal delay-100 glass-panel-light p-8 rounded-2xl hover:border-black cursor-pointer transition-all" onclick="toggleFaq(this)">
                    <h3 class="text-xl font-bold text-slate-950 flex justify-between items-center">
                        <span data-i18n="faq1_q">{{ $i18n['en']['faq1_q'] ?? 'Do I own my website and code 100%?' }}</span>
                        <span class="text-black font-mono-tag font-bold">+</span>
                    </h3>
                    <p class="text-slate-600 text-base mt-4 hidden leading-relaxed" data-i18n="faq1_a">{{ $i18n['en']['faq1_a'] ?? 'Completely — the site, the code, and every ad and email account are in your name from day one. You\'re never held hostage by a vendor: your digital asset keeps working for you whether you stay with us or not.' }}</p>
                </div>

                <div class="reveal delay-200 glass-panel-light p-8 rounded-2xl hover:border-black cursor-pointer transition-all" onclick="toggleFaq(this)">
                    <h3 class="text-xl font-bold text-slate-950 flex justify-between items-center">
                        <span data-i18n="faq2_q">{{ $i18n['en']['faq2_q'] ?? 'Are there long-term retainers or cancellation penalties?' }}</span>
                        <span class="text-black font-mono-tag font-bold">+</span>
                    </h3>
                    <p class="text-slate-600 text-base mt-4 hidden leading-relaxed" data-i18n="faq2_a">{{ $i18n['en']['faq2_a'] ?? 'None. Everything runs month to month, so we have to earn your business every month instead of trapping you in a 12-month contract. You stay because the leads keep coming — not because a penalty clause makes you.' }}</p>
                </div>

                <div class="reveal delay-300 glass-panel-light p-8 rounded-2xl hover:border-black cursor-pointer transition-all" onclick="toggleFaq(this)">
                    <h3 class="text-xl font-bold text-slate-950 flex justify-between items-center">
                        <span data-i18n="faq3_q">{{ $i18n['en']['faq3_q'] ?? 'How is Google & Meta ad spend managed?' }}</span>
                        <span class="text-black font-mono-tag font-bold">+</span>
                    </h3>
                    <p class="text-slate-600 text-base mt-4 hidden leading-relaxed" data-i18n="faq3_a">{{ $i18n['en']['faq3_a'] ?? 'Your budget is billed straight to your own card — we never mark it up or route it through us. You see exactly what\'s spent and what it returns, and every dirham goes to reaching customers, not hidden agency fees.' }}</p>
                </div>

                <div class="reveal delay-400 glass-panel-light p-8 rounded-2xl hover:border-black cursor-pointer transition-all" onclick="toggleFaq(this)">
                    <h3 class="text-xl font-bold text-slate-950 flex justify-between items-center">
                        <span data-i18n="faq4_q">{{ $i18n['en']['faq4_q'] ?? 'How fast is the website live?' }}</span>
                        <span class="text-black font-mono-tag font-bold">+</span>
                    </h3>
                    <p class="text-slate-600 text-base mt-4 hidden leading-relaxed" data-i18n="faq4_a">{{ $i18n['en']['faq4_a'] ?? 'In 3–5 days — not the months agencies usually take. The sooner it launches, the sooner it starts capturing local searchers, so you\'re getting inquiries while competitors are still reviewing a proposal.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER & FINAL CTA (FULL BLACK #000000) -->
    <footer class="bg-[#000000] text-white py-24 sm:py-32 px-10 border-t border-obsidian-800">
        <div class="max-w-[1320px] mx-auto">
            <div class="reveal flex flex-col lg:flex-row items-center justify-between gap-10 mb-16">
                <div>
                    <span class="font-mono-tag text-xs text-amber-400 uppercase font-bold tracking-widest block mb-2">READY WHEN YOU ARE</span>
                    <h3 class="text-4xl sm:text-5xl font-extrabold text-white" data-i18n="footer_title">{{ $i18n['en']['footer_title'] ?? 'Ready to generate predictable UAE leads?' }}</h3>
                    <p class="text-sm text-slate-300 mt-2" data-i18n="footer_sub">{{ $i18n['en']['footer_sub'] ?? 'One message and we will take it from there — no obligation.' }}</p>
                </div>
                
                <a href="#offer-stack" class="bg-white text-black hover:bg-slate-200 font-mono-tag text-xs font-extrabold px-10 py-5 rounded uppercase tracking-wider transition-all whitespace-nowrap shadow-xl hover:scale-105">
                    <span data-i18n="footer_btn">{{ $i18n['en']['footer_btn'] ?? 'Lock In Your AED Rate' }}</span>
                </a>
            </div>

            <div class="pt-10 border-t border-obsidian-800 flex flex-col sm:flex-row items-center justify-between gap-6 text-xs font-mono-tag text-slate-400">
                <p data-i18n="footer_copy">{{ $i18n['en']['footer_copy'] ?? '© 2026 Get Web Arab. Digital Growth Engine for UAE Local Businesses.' }}</p>
                <div class="flex items-center gap-8">
                    <a href="/admin" class="hover:text-amber-400 transition-colors">Admin Portal</a>
                    <a href="/partner" class="hover:text-amber-400 transition-colors">Partner Portal</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Proposal Modal -->
    <div id="bookingModal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-md flex items-center justify-center p-4 hidden">
        <div class="glass-panel-pureblack max-w-lg w-full rounded-2xl p-8 sm:p-10 border border-obsidian-700 relative shadow-2xl animate-in fade-in zoom-in-95 duration-200">
            <button onclick="closeBookingModal()" class="absolute top-5 right-5 text-slate-400 hover:text-white font-mono-tag font-bold text-xl">✕</button>
            
            <h3 class="text-3xl font-extrabold text-white mb-2" data-i18n="modal_title">{{ $i18n['en']['modal_title'] ?? 'Confirm Your Package' }}</h3>
            <p class="text-xs font-mono-tag text-slate-300 mb-8" data-i18n="modal_desc">{{ $i18n['en']['modal_desc'] ?? 'Enter your details and we\'ll message you on WhatsApp to lock in this exact AED price — no obligation.' }}</p>

            <form id="quoteForm" onsubmit="handleFormSubmit(event)" class="space-y-5 font-mono-tag">
                <div>
                    <label class="text-xs text-slate-300 block mb-2 font-bold" data-i18n="label_name">{{ $i18n['en']['label_name'] ?? 'Your Full Name *' }}</label>
                    <input type="text" id="custName" required class="w-full px-4 py-3.5 rounded-xl bg-obsidian-900 border border-obsidian-700 text-white text-xs focus:border-slate-500 focus:outline-none">
                </div>

                <div>
                    <label class="text-xs text-slate-300 block mb-2 font-bold" data-i18n="label_biz">{{ $i18n['en']['label_biz'] ?? 'Business Name *' }}</label>
                    <input type="text" id="custBusiness" required class="w-full px-4 py-3.5 rounded-xl bg-obsidian-900 border border-obsidian-700 text-white text-xs focus:border-slate-500 focus:outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs text-slate-300 block mb-2 font-bold" data-i18n="label_phone">{{ $i18n['en']['label_phone'] ?? 'Phone / WhatsApp *' }}</label>
                        <input type="tel" id="custPhone" placeholder="+971 -- --- ----" required class="w-full px-4 py-3.5 rounded-xl bg-obsidian-900 border border-obsidian-700 text-white text-xs focus:border-slate-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="text-xs text-slate-300 block mb-2 font-bold" data-i18n="label_email">{{ $i18n['en']['label_email'] ?? 'Email Address *' }}</label>
                        <input type="email" id="custEmail" required class="w-full px-4 py-3.5 rounded-xl bg-obsidian-900 border border-obsidian-700 text-white text-xs focus:border-slate-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="text-xs text-slate-300 block mb-2 font-bold" data-i18n="label_plan">{{ $i18n['en']['label_plan'] ?? 'Your Package (Final Price)' }}</label>
                    <input type="text" id="selectedPlanInput" readonly class="w-full px-4 py-3.5 rounded-xl bg-obsidian-900 border border-obsidian-700 text-amber-400 font-bold text-xs">
                </div>

                <button type="submit" class="w-full py-4 bg-white text-black font-bold text-xs uppercase tracking-wider rounded-xl hover:bg-slate-200 transition-all shadow-lg mt-4 hover:scale-[1.02]">
                    <span data-i18n="btn_modal_submit">{{ $i18n['en']['btn_modal_submit'] ?? 'Confirm & Connect on WhatsApp' }}</span>
                </button>
            </form>
        </div>
    </div>

    <!-- JavaScript Dictionary Engine & Scroll Observer -->
    <script>
        const i18n = {!! json_encode($i18n, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE) !!};

        let currentLang = 'en';

        function applyTranslations(lang) {
            document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
            document.documentElement.lang = lang;
            document.getElementById('langToggleBtn').innerText = lang === 'ar' ? 'English' : 'العربية';

            const elements = document.querySelectorAll('[data-i18n]');
            elements.forEach(el => {
                const key = el.getAttribute('data-i18n');
                if (i18n[lang] && i18n[lang][key]) {
                    el.innerText = i18n[lang][key];
                }
            });
        }

        function toggleLanguage() {
            currentLang = currentLang === 'en' ? 'ar' : 'en';
            applyTranslations(currentLang);
            calculatePrice();
        }

        function toggleModule(modId) {
            const chk = document.getElementById(modId);
            chk.checked = !chk.checked;
            calculatePrice();
        }

        function calculatePrice() {
            const hasSeo = document.getElementById('modSeo').checked;
            const hasAds = document.getElementById('modAds').checked;
            const hasEmail = document.getElementById('modEmail').checked;

            let baseSetup = 800;
            let baseCare = 150;
            let moduleFee = 350;

            let numModules = (hasSeo ? 1 : 0) + (hasAds ? 1 : 0) + (hasEmail ? 1 : 0);
            let rawMonthly = baseCare + (numModules * moduleFee);
            let totalMonthly = rawMonthly;
            let discountPct = 0;

            if (numModules === 2) {
                discountPct = 10;
                totalMonthly = Math.round(rawMonthly * 0.90);
            } else if (numModules === 3) {
                discountPct = 20;
                totalMonthly = Math.round(rawMonthly * 0.80);
            }

            let totalSetup = baseSetup;

            document.getElementById('setupPriceDisplay').innerText = `${totalSetup} AED`;
            document.getElementById('carePriceDisplay').innerText = `${baseCare} AED/mo`;

            document.getElementById('finalSetupTotal').innerText = `${totalSetup} AED`;
            document.getElementById('finalMonthlyTotal').innerText = `${totalMonthly} AED/mo`;

            const badgeEl = document.getElementById('bundleDiscountBadge');
            if (badgeEl) {
                if (discountPct > 0) {
                    badgeEl.innerText = currentLang === 'ar' 
                        ? `🎉 تم تطبيق خصم الباقة ${discountPct}%`
                        : `🎉 ${discountPct}% BUNDLE DISCOUNT APPLIED`;
                    badgeEl.classList.remove('hidden');
                } else {
                    badgeEl.classList.add('hidden');
                }
            }
        }

        function openBookingModal(planName) {
            if (!planName) {
                const setup = document.getElementById('finalSetupTotal').innerText;
                const monthly = document.getElementById('finalMonthlyTotal').innerText;
                planName = `Custom Package (Setup: ${setup}, Monthly: ${monthly})`;
            }
            document.getElementById('selectedPlanInput').value = planName;
            document.getElementById('bookingModal').classList.remove('hidden');
        }

        function closeBookingModal() {
            document.getElementById('bookingModal').classList.add('hidden');
        }

        function submitCalculatedPlan() {
            const setup = document.getElementById('finalSetupTotal').innerText;
            const monthly = document.getElementById('finalMonthlyTotal').innerText;
            openBookingModal(`Setup: ${setup} · Monthly: ${monthly}`);
        }

        function handleFormSubmit(e) {
            e.preventDefault();
            const name = document.getElementById('custName').value;
            const biz = document.getElementById('custBusiness').value;
            const phone = document.getElementById('custPhone').value;
            const email = document.getElementById('custEmail').value;
            const plan = document.getElementById('selectedPlanInput').value;

            const text = `Hello Get Web Arab!%0A%0AI would like to confirm my proposal.%0A*Name:* ${encodeURIComponent(name)}%0A*Business:* ${encodeURIComponent(biz)}%0A*Phone:* ${encodeURIComponent(phone)}%0A*Email:* ${encodeURIComponent(email)}%0A*Final AED Price Plan:* ${encodeURIComponent(plan)}`;

            window.open(`https://wa.me/{{ $landingSetting->whatsapp_number }}?text=${text}`, '_blank');
            closeBookingModal();
        }

        function toggleFaq(cardEl) {
            const p = cardEl.querySelector('p');
            const icon = cardEl.querySelector('span:last-child');
            if (p.classList.contains('hidden')) {
                p.classList.remove('hidden');
                icon.innerText = '−';
            } else {
                p.classList.add('hidden');
                icon.innerText = '+';
            }
        }

        // Scroll Intersection Observer for Smooth Animations
        document.addEventListener("DOMContentLoaded", function() {
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -50px 0px',
                threshold: 0.15
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('reveal-active');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
        });

        applyTranslations(currentLang);
        calculatePrice();
    </script>
</body>
</html>
