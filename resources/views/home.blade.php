{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('head')
    <style>
        /* ---------------------------
           Brand colors & variables
           --------------------------- */
        :root{
            --joya-green: #375523;
            --joya-green-2: #4b7a3a;
            --joya-green-3: #9cc68a;
            --glass-border: rgba(255,255,255,0.06);
        }

        /* Direction aware small tweaks */
        [dir="rtl"] .hero-content { text-align: right; }
        [dir="rtl"] .programs-grid { direction: rtl; }
        [dir="rtl"] .where-map { margin-left: 0; margin-right: auto; }

        /* ---------------------------
           Fonts (Pashto / Persian)
           ---------------------------
           NOTE: Replace the font files with preferred Pashto/Persian webfonts
           placed in /public/assets/fonts/ if you have them.
           If you add fonts, adjust the font-family names below.
        */
        @font-face {
            font-family: 'JoyaSans';
            src: local('Inter'), local('System'), local('Arial');
            font-weight: 100 900;
            font-style: normal;
            font-display: swap;
        }

        /* Example Pashto/Persian font fallback - add actual file to /public/assets/fonts/ if available */
        @font-face{
            font-family: 'JoyaPashto';
            src: url('/assets/fonts/Vazirmatn-Regular.woff2') format('woff2'),
                 url('/assets/fonts/Vazirmatn-Regular.woff') format('woff');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }

        html[data-lang="fa"], html[data-lang="ps"] {
            /* Prefer Persian/Pashto font when page language switches */
            font-family: "JoyaPashto", "JoyaSans", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        /* ---------------------------
           HERO: improved morphing backgrounds
           --------------------------- */
        .hero {
            position: relative;
            overflow: hidden;
        }

        /* base hero gradient (light) */
        .hero-inner {
            background: linear-gradient(180deg, rgba(55,85,35,0.10), rgba(255,255,255,0.02));
        }

        /* dark-mode hero: more subtle, toned-down green */
        .dark .hero-inner,
        [data-theme="dark"] .hero-inner {
            background: linear-gradient(180deg, rgba(10,18,12,0.65), rgba(6,12,8,0.7));
            /* soft green wash on top but low opacity */
            background-blend-mode: overlay;
        }

        /* Hero blobs - refined for dark mode */
        .hero-blob {
            position: absolute;
            filter: blur(36px);
            opacity: 0.8;
            mix-blend-mode: screen;
            animation: float 12s ease-in-out infinite;
            border-radius: 44% 56% 60% 40% / 45% 40% 60% 55%;
            pointer-events: none;
        }

        .hero-blob.one {
            width: 520px;
            height: 420px;
            left: -80px;
            top: -40px;
            background: radial-gradient(circle at 20% 30%, rgba(156,198,138,0.95), rgba(75,122,58,0.12) 60%);
            mix-blend-mode: screen;
            opacity: 0.95;
        }
        .hero-blob.two {
            width: 420px;
            height: 360px;
            right: -60px;
            top: 40px;
            background: radial-gradient(circle at 80% 20%, rgba(57,117,34,0.9), rgba(57,117,34,0.08) 60%);
            opacity: 0.9;
            animation-duration: 11s;
            animation-direction: reverse;
        }
        .hero-blob.three {
            width: 260px;
            height: 260px;
            left: 8%;
            bottom: -40px;
            background: radial-gradient(circle at 30% 20%, rgba(255,255,255,0.06), rgba(0,0,0,0));
            opacity: 0.55;
        }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg) }
            50% { transform: translateY(-18px) rotate(6deg) }
            100% { transform: translateY(0) rotate(0deg) }
        }

        /* ---------------------------
           Glass / neumorphism refinements
           --------------------------- */
        .glass {
            background: linear-gradient(180deg, rgba(255,255,255,0.6), rgba(255,255,255,0.12));
            border: 1px solid rgba(255,255,255,0.35);
            backdrop-filter: blur(8px) saturate(110%);
            -webkit-backdrop-filter: blur(8px) saturate(110%);
        }

        /* Dark glass variation */
        .dark .glass,
        [data-theme="dark"] .glass {
            background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
            border: 1px solid rgba(255,255,255,0.04);
            box-shadow: 0 8px 30px rgba(3,6,4,0.5);
        }

        .soft-shadow { box-shadow: 0 10px 30px rgba(0,0,0,0.06); }

        /* Slightly heavier glass for important cards */
        .glass-strong {
            backdrop-filter: blur(10px) saturate(120%);
            -webkit-backdrop-filter: blur(10px) saturate(120%);
        }

        /* ---------------------------
           Logo swap / Header scroll fix
           --------------------------- */
        .logo-light { display: inline-block; }
        .logo-dark { display: none; }

        /* When body/html has .dark class, show the white logo */
        .dark .logo-light, [data-theme="dark"] .logo-light { display: none; }
        .dark .logo-dark, [data-theme="dark"] .logo-dark { display: inline-block; }

        /* header scroll background (applies to header in layout) */
        .scrolled-header {
            background: linear-gradient(180deg, rgba(255,255,255,0.88), rgba(255,255,255,0.80));
            box-shadow: 0 6px 18px rgba(16,24,16,0.06);
            backdrop-filter: blur(6px);
            transition: background .22s ease, box-shadow .22s ease, transform .22s ease;
        }
        .dark .scrolled-header, [data-theme="dark"] .scrolled-header {
            background: linear-gradient(180deg, rgba(6,12,8,0.6), rgba(6,12,8,0.45));
            box-shadow: 0 6px 24px rgba(0,0,0,0.6);
        }

        /* make header sticky look smoother */
        .scrolled-header .nav-link { color: inherit !important; }

        /* ---------------------------
           Counters & numbers
           --------------------------- */
        .counter-number { font-weight: 800; font-variant-numeric: tabular-nums; }

        /* ---------------------------
           UX / small responsive tweaks
           --------------------------- */
        @media (max-width: 768px) {
            .hero-blob.one { display: none; }
            .hero-blob.three { display: none; }
            .glass { border-radius: 16px; }
        }

        /* focus styles */
        .cta-btn:focus { outline: 3px solid rgba(55,85,35,0.12); outline-offset: 2px; }

        /* small helper to keep logos perfectly sized */
        .logo-img { width: 140px; height: auto; object-fit: contain; }

    </style>
@endsection

@section('content')
    <main class="relative w-full overflow-hidden">

        {{-- HERO --}}
        <section class="hero relative">
            <div class="hero-inner relative z-0">
                <!-- Blobs -->
                <div class="hero-blob one" aria-hidden="true"></div>
                <div class="hero-blob two" aria-hidden="true"></div>
                <div class="hero-blob three" aria-hidden="true"></div>

                <div class="max-w-7xl mx-auto px-6 py-20 lg:py-28 relative z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                        <div class="hero-content">
                            <div class="glass glass-strong p-6 md:p-10 rounded-2xl">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-3">
                                        <!-- Light logo shown in light mode -->
                                        <img src="{{ asset('assets/logo/joya-logo-green.svg') }}" alt="JOYA" class="logo-img logo-light" />
                                        <!-- White logo shown in dark mode -->
                                        <img src="{{ asset('assets/logo/joya-logo-white.svg') }}" alt="JOYA" class="logo-img logo-dark" />
                                    </div>
                                    <div class="text-xs text-gray-700 dark:text-gray-300" data-i18n="hero.suptag">Community • Learning • Impact</div>
                                </div>

                                <h1 class="mt-6 text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight text-gray-900 dark:text-white" data-i18n="hero.title">
                                    JOYA — Empowering Youth, Building Futures
                                </h1>

                                <p class="mt-4 text-lg sm:text-xl text-gray-700 dark:text-gray-200" data-i18n="hero.subtitle">
                                    We provide education, livelihoods, and community health support across Afghanistan.
                                </p>

                                <div class="mt-6 flex flex-wrap items-center gap-4">
                                    <a href="#programs" class="cta-btn inline-flex items-center gap-3 bg-[var(--joya-green)] text-white font-semibold py-3 px-5 rounded-lg shadow-sm hover:opacity-95 transition"
                                       data-i18n="hero.button" role="button">
                                        Learn More
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>

                                    <div class="text-sm text-gray-600 dark:text-gray-300">
                                        <span data-i18n="hero.small_note">Support our programs — join as a volunteer or donor.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex flex-wrap gap-4 text-sm">
                                <div class="flex items-center gap-3 text-gray-700 dark:text-gray-300">
                                    <span class="w-2 h-2 rounded-full" style="background: var(--joya-green-3)"></span>
                                    <span data-i18n="hero.point_1">Community-driven</span>
                                </div>
                                <div class="flex items-center gap-3 text-gray-700 dark:text-gray-300">
                                    <span class="w-2 h-2 rounded-full" style="background: var(--joya-green)"></span>
                                    <span data-i18n="hero.point_2">Impact-led</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center lg:justify-end">
                            <div class="glass p-6 rounded-2xl soft-shadow max-w-md w-full">
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-16 h-16 rounded-lg bg-[var(--joya-green)]/10 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[var(--joya-green)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                                <path d="M12 2l1.5 4.5L18 8l-3 2 1 4.5L12 12l-4 2 1-4.5L6 8l4.5-1.5L12 2z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white" data-i18n="hero.card_title">Our Mission</h3>
                                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-200" data-i18n="hero.card_desc">
                                            To empower youth through skills, opportunities and inclusive community programs.
                                        </p>

                                        <div class="mt-4 flex gap-3">
                                            <span class="inline-flex items-center gap-2 text-sm bg-gray-100 dark:bg-gray-800 rounded-full px-3 py-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18z"/>
                                                </svg>
                                                <span data-i18n="hero.card_since">Since 2018</span>
                                            </span>
                                            <span class="inline-flex items-center gap-2 text-sm bg-gray-100 dark:bg-gray-800 rounded-full px-3 py-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a1 1 0 001 1h16a1 1 0 001-1V7" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 3v4M8 3v4" />
                                                </svg>
                                                <span data-i18n="hero.card_team">Local teams</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- grid -->
                </div><!-- container -->
            </div><!-- hero-inner -->
        </section>

        {{-- STATISTICS / COUNTERS --}}
        <section id="stats" class="bg-white dark:bg-transparent">
            <div class="max-w-7xl mx-auto px-6 py-16">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="glass p-6 rounded-2xl soft-shadow text-center">
                        <div class="text-4xl md:text-5xl text-[var(--joya-green)] counter-number" data-target="124" id="projects-counter">0</div>
                        <div class="mt-3 text-sm font-medium text-gray-700 dark:text-gray-200" data-i18n="counter.projects">Projects Completed</div>
                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-300" data-i18n="counter.projects_note">Sustainable projects across sectors.</div>
                    </div>

                    <div class="glass p-6 rounded-2xl soft-shadow text-center">
                        <div class="text-4xl md:text-5xl text-[var(--joya-green-2)] counter-number" data-target="50800" id="beneficiaries-counter">0</div>
                        <div class="mt-3 text-sm font-medium text-gray-700 dark:text-gray-200" data-i18n="counter.beneficiaries">Beneficiaries Reached</div>
                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-300" data-i18n="counter.beneficiaries_note">Individuals reached through programs.</div>
                    </div>

                    <div class="glass p-6 rounded-2xl soft-shadow text-center">
                        <div class="text-4xl md:text-5xl text-[var(--joya-green-3)] counter-number" data-target="24" id="provinces-counter">0</div>
                        <div class="mt-3 text-sm font-medium text-gray-700 dark:text-gray-200" data-i18n="counter.provinces">Provinces Covered</div>
                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-300" data-i18n="counter.provinces_note">Working in urban & rural areas.</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- PROGRAM PREVIEW --}}
        <section id="programs" class="bg-gray-50 dark:bg-transparent">
            <div class="max-w-7xl mx-auto px-6 py-16">
                <div class="text-center mb-10">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white" data-i18n="programs.title">Our Core Programs</h2>
                    <p class="mt-3 text-sm md:text-base text-gray-600 dark:text-gray-300" data-i18n="programs.subtitle">
                        Programs tailored to local needs — education, livelihoods, and health.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 programs-grid">
                    {{-- Education & TVET --}}
                    <article class="program-card glass rounded-2xl p-6 soft-shadow">
                        <div class="flex items-start gap-4">
                            <div class="program-icon p-3 rounded-lg bg-white/5 border border-white/6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[var(--joya-green)]" viewBox="0 0 256 256" fill="none">
                                    <path d="M128 24L24 76l104 52 104-52L128 24z" stroke="currentColor" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M32 96v48a96 96 0 0096 16 96 96 0 0096-16V96" stroke="currentColor" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white" data-i18n="program.title_1">Education & TVET</h3>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300" data-i18n="program.desc_1">
                                    Skills training, vocational education, and teacher support to prepare youth for work.
                                </p>
                            </div>
                        </div>
                    </article>

                    {{-- Livelihood & Entrepreneurship --}}
                    <article class="program-card glass rounded-2xl p-6 soft-shadow">
                        <div class="flex items-start gap-4">
                            <div class="program-icon p-3 rounded-lg bg-white/5 border border-white/6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[var(--joya-green-2)]" viewBox="0 0 256 256" fill="none">
                                    <rect x="32" y="72" width="192" height="120" rx="8" stroke="currentColor" stroke-width="12" />
                                    <path d="M168 72v-16a16 16 0 00-16-16h-48a16 16 0 00-16 16v16" stroke="currentColor" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white" data-i18n="program.title_2">Livelihood & Entrepreneurship</h3>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300" data-i18n="program.desc_2">
                                    Micro-enterprise support, business skills, and market linkages for youth-led initiatives.
                                </p>
                            </div>
                        </div>
                    </article>

                    {{-- Health & Community Development --}}
                    <article class="program-card glass rounded-2xl p-6 soft-shadow">
                        <div class="flex items-start gap-4">
                            <div class="program-icon p-3 rounded-lg bg-white/5 border border-white/6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[var(--joya-green-3)]" viewBox="0 0 256 256" fill="none">
                                    <path d="M128 216s-70-44-96-84a56 56 0 0196-64 56 56 0 0196 64c-26 40-96 84-96 84z" stroke="currentColor" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white" data-i18n="program.title_3">Health & Community Development</h3>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300" data-i18n="program.desc_3">
                                    Community health outreach, psychosocial support, and local infrastructure projects.
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- WHERE WE WORK --}}
        <section id="where" class="bg-white dark:bg-transparent">
            <div class="max-w-7xl mx-auto px-6 py-16">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white" data-i18n="where.title">Where We Work</h2>
                        <p class="mt-4 text-gray-600 dark:text-gray-300" data-i18n="where.desc">
                            JOYA operates across multiple provinces, focusing on areas with the greatest need and potential for impact.
                        </p>

                        <ul class="mt-6 space-y-3 text-sm text-gray-700 dark:text-gray-300">
                            <li class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[var(--joya-green)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 2l3 7h7l-5.5 4 2 7L12 17l-6.5 3 2-7L2 9h7l3-7z"/>
                                </svg>
                                <span data-i18n="where.point_1">Partnerships with local organizations</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[var(--joya-green-2)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 12h18"/>
                                    <path d="M12 3v18"/>
                                </svg>
                                <span data-i18n="where.point_2">Accessible, community-led programming</span>
                            </li>
                        </ul>
                    </div>

                    <div class="where-map flex justify-center lg:justify-end">
                        <div class="glass p-6 rounded-2xl soft-shadow max-w-md w-full">
                            <svg class="af-map" viewBox="0 0 800 600" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M95 260c20-30 45-50 90-60 22-5 48-8 70-18 28-13 62-18 95-14 18 2 38 6 54 0 18-7 34-24 58-26 24-2 46 8 66 18 22 11 44 22 70 22 18 0 36-6 52-14 20-10 40-24 66-20 18 3 34 16 46 30v180c-20 12-44 16-68 22-38 9-78 12-116 22-36 9-76 24-114 26-38 2-78-2-114-14-24-8-44-22-66-34-30-16-62-28-88-48-18-14-32-34-42-56 6-8 10-16 14-26z" fill="url(#g1)" opacity="0.95"/>
                                <defs>
                                    <linearGradient id="g1" x1="0" x2="1">
                                        <stop offset="0" stop-color="#9cc68a" />
                                        <stop offset="1" stop-color="#375523" />
                                    </linearGradient>
                                </defs>
                            </svg>

                            <div class="mt-4 text-sm text-gray-700 dark:text-gray-200" data-i18n="where.map_note">
                                Map shows provinces where JOYA has active programs and partners.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- MISSION / FAQ (small) --}}
        <section id="mission" class="bg-gray-50 dark:bg-transparent">
            <div class="max-w-7xl mx-auto px-6 py-16">
                <div class="text-center mb-10">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white" data-i18n="mission.title">Our Mission</h2>
                    <p class="mt-3 text-sm md:text-base text-gray-600 dark:text-gray-300" data-i18n="mission.subtitle">
                        We believe in locally-led solutions and long-term impact.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 glass rounded-2xl soft-shadow">
                        <div class="flex items-start gap-4">
                            <div class="mission-icon w-14 h-14 flex items-center justify-center rounded-lg bg-[var(--joya-green)]/8">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[var(--joya-green)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M12 2l1.5 4.5L18 8l-3 2 1 4.5L12 12l-4 2 1-4.5L6 8l4.5-1.5L12 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white" data-i18n="mission.item_1.title">Protect & Educate</h4>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300" data-i18n="mission.item_1">
                                    Support education access for marginalized youth and strengthen local schools.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 glass rounded-2xl soft-shadow">
                        <div class="flex items-start gap-4">
                            <div class="mission-icon w-14 h-14 flex items-center justify-center rounded-lg bg-[var(--joya-green-2)]/8">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[var(--joya-green-2)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M3 12h18M12 3v18" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white" data-i18n="mission.item_2.title">Create Opportunities</h4>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300" data-i18n="mission.item_2">
                                    Build livelihood pathways and entrepreneurship opportunities for young people.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 glass rounded-2xl soft-shadow">
                        <div class="flex items-start gap-4">
                            <div class="mission-icon w-14 h-14 flex items-center justify-center rounded-lg bg-[var(--joya-green-3)]/8">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[var(--joya-green-3)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M12 21V3M5 12h14" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white" data-i18n="mission.item_3.title">Strengthen Communities</h4>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300" data-i18n="mission.item_3">
                                    Support health, protection, and community development that lasts.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>
@endsection

@section('scripts')
    <script>
        // Add home page translations directly to the main translations object
        document.addEventListener('DOMContentLoaded', function() {
            // Define home translations
            const homeTranslations = {
                en: {
                    // Hero section
                    'hero.suptag': 'Community • Learning • Impact',
                    'hero.title': 'JOYA — Empowering Youth, Building Futures',
                    'hero.subtitle': 'We provide education, livelihoods, and community health support across Afghanistan.',
                    'hero.button': 'Learn More',
                    'hero.small_note': 'Support our programs — join as a volunteer or donor.',
                    'hero.point_1': 'Community-driven',
                    'hero.point_2': 'Impact-led',
                    'hero.card_title': 'Our Mission',
                    'hero.card_desc': 'To empower youth through skills, opportunities and inclusive community programs.',
                    'hero.card_since': 'Since 2018',
                    'hero.card_team': 'Local teams',

                    // Counter section
                    'counter.projects': 'Projects Completed',
                    'counter.projects_note': 'Sustainable projects across sectors.',
                    'counter.beneficiaries': 'Beneficiaries Reached',
                    'counter.beneficiaries_note': 'Individuals reached through programs.',
                    'counter.provinces': 'Provinces Covered',
                    'counter.provinces_note': 'Working in urban & rural areas.',

                    // Programs section
                    'programs.title': 'Our Core Programs',
                    'programs.subtitle': 'Programs tailored to local needs — education, livelihoods, and health.',
                    'program.title_1': 'Education & TVET',
                    'program.desc_1': 'Skills training, vocational education, and teacher support to prepare youth for work.',
                    'program.title_2': 'Livelihood & Entrepreneurship',
                    'program.desc_2': 'Micro-enterprise support, business skills, and market linkages for youth-led initiatives.',
                    'program.title_3': 'Health & Community Development',
                    'program.desc_3': 'Community health outreach, psychosocial support, and local infrastructure projects.',

                    // Where we work section
                    'where.title': 'Where We Work',
                    'where.desc': 'JOYA operates across multiple provinces, focusing on areas with the greatest need and potential for impact.',
                    'where.point_1': 'Partnerships with local organizations',
                    'where.point_2': 'Accessible, community-led programming',
                    'where.map_note': 'Map shows provinces where JOYA has active programs and partners.',

                    // Mission section
                    'mission.title': 'Our Mission',
                    'mission.subtitle': 'We believe in locally-led solutions and long-term impact.',
                    'mission.item_1.title': 'Protect & Educate',
                    'mission.item_1': 'Support education access for marginalized youth and strengthen local schools.',
                    'mission.item_2.title': 'Create Opportunities',
                    'mission.item_2': 'Build livelihood pathways and entrepreneurship opportunities for young people.',
                    'mission.item_3.title': 'Strengthen Communities',
                    'mission.item_3': 'Support health, protection, and community development that lasts.'
                },
                fa: {
                    // Hero section
                    'hero.suptag': 'اجتماع • یادگیری • تأثیر',
                    'hero.title': 'جویا — توانمندسازی جوانان، ساختن آینده',
                    'hero.subtitle': 'ما آموزش، معیشت و حمایت از سلامت جامعه را در سراسر افغانستان ارائه می‌دهیم.',
                    'hero.button': 'بیشتر بدانید',
                    'hero.small_note': 'از برنامه‌های ما حمایت کنید — به عنوان داوطلب یا اهداکننده بپیوندید.',
                    'hero.point_1': 'محرک جامعه',
                    'hero.point_2': 'رهبری تأثیر',
                    'hero.card_title': 'ماموریت ما',
                    'hero.card_desc': 'توانمندسازی جوانان از طریق مهارت‌ها، فرصت‌ها و برنامه‌های جامع جامعه.',
                    'hero.card_since': 'از سال ۲۰۱۸',
                    'hero.card_team': 'تیم‌های محلی',

                    // Counter section
                    'counter.projects': 'پروژه‌های تکمیل شده',
                    'counter.projects_note': 'پروژه‌های پایدار در بخش‌های مختلف.',
                    'counter.beneficiaries': 'مستفید شونده‌ها',
                    'counter.beneficiaries_note': 'افراد از طریق برنامه‌ها دسترسی پیدا کردند.',
                    'counter.provinces': 'ولایت‌های تحت پوشش',
                    'counter.provinces_note': 'فعال در مناطق شهری و روستایی.',

                    // Programs section
                    'programs.title': 'برنامه‌های اصلی ما',
                    'programs.subtitle': 'برنامه‌های متناسب با نیازهای محلی — آموزش، معیشت و سلامت.',
                    'program.title_1': 'آموزش و آموزش فنی و حرفه‌ای',
                    'program.desc_1': 'آموزش مهارت‌ها، آموزش حرفه‌ای و حمایت از معلمان برای آماده‌سازی جوانان برای کار.',
                    'program.title_2': 'معیشت و کارآفرینی',
                    'program.desc_2': 'حمایت از کسب‌وکارهای کوچک، مهارت‌های تجاری و ارتباطات بازار برای ابتکارات جوانان.',
                    'program.title_3': 'سلامت و توسعه جامعه',
                    'program.desc_3': 'خدمات سلامت جامعه، حمایت روانی-اجتماعی و پروژه‌های زیرساخت محلی.',

                    // Where we work section
                    'where.title': 'جایی که ما کار می‌کنیم',
                    'where.desc': 'جویا در چندین ولایت فعالیت می‌کند و بر مناطقی با بیشترین نیاز و پتانسیل تأثیر متمرکز است.',
                    'where.point_1': 'همکاری با سازمان‌های محلی',
                    'where.point_2': 'برنامه‌ریزی قابل دسترس و جامعه‌محور',
                    'where.map_note': 'نقشه ولایت‌هایی را نشان می‌دهد که جویا در آن‌ها برنامه و شریک فعال دارد.',

                    // Mission section
                    'mission.title': 'ماموریت ما',
                    'mission.subtitle': 'ما به راه‌حل‌های محلی و تأثیر بلندمدت اعتقاد داریم.',
                    'mission.item_1.title': 'حفاظت و آموزش',
                    'mission.item_1': 'حمایت از دسترسی به آموزش برای جوانان محروم و تقویت مدارس محلی.',
                    'mission.item_2.title': 'ایجاد فرصت‌ها',
                    'mission.item_2': 'ساخت مسیرهای معیشتی و فرصت‌های کارآفرینی برای جوانان.',
                    'mission.item_3.title': 'تقویت جوامع',
                    'mission.item_3': 'حمایت از سلامت، حفاظت و توسعه جامعه که پایدار باشد.'
                },
                ps: {
                    // Hero section
                    'hero.suptag': 'ټولنه • زده کړه • اغیزه',
                    'hero.title': 'جویا — د ځوانانو توانمندول، راتلونکی جوړول',
                    'hero.subtitle': 'موږ د افغانستان په ټول کې د زده کړې، ژوندۍ او د ټولنې د روغتیا ملاتړ چمتو کوو.',
                    'hero.button': 'نور زده کړئ',
                    'hero.small_note': 'زموږ د پروګرامونو ملاتړ وکړئ — د رضاکار یا مرستندوی په توګه ورسره یوځای شئ.',
                    'hero.point_1': 'ټولنیز محرک',
                    'hero.point_2': 'د اغیزې مشري',
                    'hero.card_title': 'زموږ ماموریت',
                    'hero.card_desc': 'د ځوانانو توانمندول د مهارتونو، فرصتونو او ټولنیزو پروګرامونو له لارې.',
                    'hero.card_since': 'له ۲۰۱۸ کال راهیسې',
                    'hero.card_team': 'سیمه‌ایزې ټیمونه',

                    // Counter section
                    'counter.projects': 'پای ته رسیدلې پروژې',
                    'counter.projects_note': 'پایدارې پروژې په بېلابېلو برخو کې.',
                    'counter.beneficiaries': 'ګټمن شوي کسان',
                    'counter.beneficiaries_note': 'کسان چې د پروګرامونو له لارې لاسرسی شوي.',
                    'counter.provinces': 'پوښل شوي ولایتونه',
                    'counter.provinces_note': 'په ښاري او کلیوالو سیمو کې کار.',

                    // Programs section
                    'programs.title': 'زموږ اصلي پروګرامونه',
                    'programs.subtitle': 'په سیمه‌ایزو اړتیاو پورې اړوند پروګرامونه — زده کړه، ژوندۍ او روغتیا.',
                    'program.title_1': 'زده کړه او مسلکي روزنه',
                    'program.desc_1': 'د مهارت روزنه، مسلکي زده کړه او د ښوونکو ملاتړ د ځوانانو د کار لپاره چمتو کول.',
                    'program.title_2': 'ژوندۍ او کارپیلنه',
                    'program.desc_2': 'د کوچنیو سوداګریو ملاتړ، سوداګریز مهارتونه او د بازار اړیکې د ځوانانو لپاره.',
                    'program.title_3': 'روغتیا او ټولنیز پرمختګ',
                    'program.desc_3': 'د ټولنې روغتیا خدمت، د رواني-ټولنیز ملاتړ او سیمه‌ایز زیربنا پروژې.',

                    // Where we work section
                    'where.title': 'چیرته چې موږ کار کوو',
                    'where.desc': 'جویا په څو ولایتونو کې فعالیت لري، په هغو سیمو تمرکز لري چې ترټولو زیاتې اړتیاوې او د اغیزې وړتیا لري.',
                    'where.point_1': 'د سیمه‌ایزو سازمانونو سره شراکت',
                    'where.point_2': 'د لاسرسي وړ، د ټولنې مشري شوې پروګرامونه',
                    'where.map_note': 'نقشه هغه ولایتونه ښیي چې جویا پکې فعاله پروګرامونه او شریکان لري.',

                    // Mission section
                    'mission.title': 'زموږ ماموریت',
                    'mission.subtitle': 'موږ په سیمه‌ایزو حلونو او اوږد مهاله اغیزو باور لرو.',
                    'mission.item_1.title': 'ژغورنه او زده کړه',
                    'mission.item_1': 'د غوره‌ځای شویو ځوانانو لپاره د زده کړې لاسرسی ملاتړ او سیمه‌ایز ښوونځي څخه.',
                    'mission.item_2.title': 'فرصتونه رامنځته کول',
                    'mission.item_2': 'د ژوندۍ مسیرونه او د کارپیلنې فرصتونه د ځوانانو لپاره جوړول.',
                    'mission.item_3.title': 'ټولنې تقویت کول',
                    'mission.item_3': 'د روغتیا، ژغورنې او ټولنیز پرمختګ ملاتړ چې پاتې کیږي.'
                }
            };

            // Function to apply translations
            function applyHomeTranslations(lang) {
                const dict = homeTranslations[lang] || homeTranslations.en;
                document.querySelectorAll('[data-i18n]').forEach(el => {
                    const key = el.getAttribute('data-i18n');
                    if (key && dict[key] !== undefined) {
                        el.innerText = dict[key];
                    }
                });
            }

            // Apply translations when page loads
            const currentLang = document.body.dataset.lang || 'en';
            applyHomeTranslations(currentLang);

            // Listen for language changes
            window.addEventListener('site:langchange', function(e) {
                applyHomeTranslations(e.detail.lang);
            });

            // Also apply translations when language is changed via the layout's setLanguage function
            const originalSetLanguage = window.setLanguage;
            if (originalSetLanguage) {
                window.setLanguage = function(lang) {
                    originalSetLanguage(lang);
                    setTimeout(() => applyHomeTranslations(lang), 50);
                };
            }
        });

        // Keep your existing counter and scroll functionality below...
        /* ---------------------------
           Header scroll background + logo switch
           --------------------------- */
        (function () {
            const header = document.querySelector('header') || document.querySelector('.site-header');
            if (!header) return;

            let lastScroll = 0;
            const SCROLL_THRESHOLD = 12;

            function onScroll() {
                const sc = window.scrollY || window.pageYOffset;
                if (sc > SCROLL_THRESHOLD) {
                    if(!header.classList.contains('scrolled-header')) header.classList.add('scrolled-header');
                } else {
                    header.classList.remove('scrolled-header');
                }
                lastScroll = sc;
            }

            window.addEventListener('scroll', onScroll, { passive: true });
            onScroll();
        })();

        /* ---------------------------
           COUNTER ANIMATION
           --------------------------- */
        (function () {
            const counters = [
                { el: document.getElementById('projects-counter'), target: parseInt(document.getElementById('projects-counter').dataset.target || 0, 10) },
                { el: document.getElementById('beneficiaries-counter'), target: parseInt(document.getElementById('beneficiaries-counter').dataset.target || 0, 10) },
                { el: document.getElementById('provinces-counter'), target: parseInt(document.getElementById('provinces-counter').dataset.target || 0, 10) }
            ];

            const easeOutExpo = (t) => t === 1 ? 1 : 1 - Math.pow(2, -10 * t);

            function animateCounter(el, start, end, duration) {
                if(!el) return;
                let startTime = null;
                function step(timestamp) {
                    if (!startTime) startTime = timestamp;
                    const progress = Math.min((timestamp - startTime) / duration, 1);
                    const eased = easeOutExpo(progress);
                    const value = Math.floor(start + (end - start) * eased);
                    el.textContent = value.toLocaleString();
                    if (progress < 1) {
                        requestAnimationFrame(step);
                    } else {
                        el.textContent = end.toLocaleString();
                    }
                }
                requestAnimationFrame(step);
            }

            const statsSection = document.getElementById('stats');
            let started = false;
            if (statsSection && 'IntersectionObserver' in window) {
                const observer = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !started) {
                            started = true;
                            counters.forEach(c => {
                                const baseDuration = 2000;
                                const duration = Math.min(baseDuration + Math.log(Math.max(c.target,1)) * 900, 4200);
                                animateCounter(c.el, 0, c.target, duration);
                            });
                        }
                    });
                }, { threshold: 0.3 });
                observer.observe(statsSection);
            } else {
                counters.forEach(c => animateCounter(c.el, 0, c.target, 2000));
            }
        })();

        /* Accessibility: keyboard activation for CTA buttons */
        document.querySelectorAll('a.cta-btn').forEach(function(btn){
            btn.addEventListener('keyup', function(e){
                if(e.key === 'Enter' || e.key === ' ') {
                    btn.click();
                }
            });
        });
    </script>
@endsection