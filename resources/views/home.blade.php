{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('head')
    <style>
        /* Brand colors */
        :root {
            --joya-green: #375523;
            --joya-green-2: #4b7a3a;
            --joya-green-3: #9cc68a;
            --glass-bg: rgba(255, 255, 255, 0.06);
            --glass-border: rgba(255, 255, 255, 0.08);
        }

        /* Hero blobs */
        .hero-blob {
            position: absolute;
            filter: blur(36px);
            opacity: 0.85;
            mix-blend-mode: multiply;
            animation: float 12s ease-in-out infinite;
            border-radius: 48% 52% 60% 40% / 45% 40% 60% 55%;
        }

        .hero-blob.one {
            width: 520px;
            height: 420px;
            background: linear-gradient(135deg, var(--joya-green) 0%, var(--joya-green-2) 100%);
            top: -60px;
            left: -60px;
            animation-duration: 14s;
        }

        .hero-blob.two {
            width: 420px;
            height: 360px;
            background: linear-gradient(135deg, rgba(156,198,138,0.9) 0%, rgba(75,122,58,0.85) 100%);
            right: -80px;
            top: 40px;
            animation-duration: 11s;
            animation-direction: reverse;
        }

        .hero-blob.three {
            width: 260px;
            height: 260px;
            background: radial-gradient(circle at 30% 20%, rgba(255,255,255,0.06), rgba(0,0,0,0));
            bottom: -40px;
            left: 10%;
            opacity: 0.55;
            animation-duration: 16s;
        }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg) }
            50% { transform: translateY(-18px) rotate(6deg) }
            100% { transform: translateY(0) rotate(0deg) }
        }

        /* Glass card in hero */
        .glass {
            background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02));
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
        }

        /* Counters */
        .counter-number {
            font-weight: 700;
            font-variant-numeric: tabular-nums;
        }

        /* Subtle soft shadow */
        .soft-shadow {
            box-shadow: 0 6px 22px rgba(55,85,35,0.12);
        }

        /* Direction aware tweaks */
        [dir="rtl"] .hero-content { text-align: right; }
        [dir="rtl"] .programs-grid { direction: rtl; }
        [dir="rtl"] .where-map { margin-left: 0; margin-right: auto; }

        /* Ensure SVG map scales well */
        .af-map {
            max-width: 100%;
            height: auto;
        }

        /* Responsive fine-tuning */
        @media (max-width: 768px) {
            .hero-blob.one { display: none; }
            .hero-blob.two { opacity: 0.6; }
            .hero-blob.three { display: none; }
        }

        /* Accessibility focus */
        .cta-btn:focus {
            outline: 3px solid rgba(57, 101, 40, 0.18);
            outline-offset: 2px;
        }

        /* Minor animation for program cards */
        .program-card { transition: transform .28s ease, box-shadow .28s ease; }
        .program-card:hover { transform: translateY(-6px); box-shadow: 0 14px 36px rgba(55,85,35,0.12); }

        /* FAQ/Mission icons container */
        .mission-icon {
            width: 56px;
            height: 56px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: linear-gradient(180deg, rgba(59,93,43,0.06), rgba(59,93,43,0.03));
            border: 1px solid rgba(59,93,43,0.06);
        }
    </style>
@endsection

@section('content')
    <main class="relative w-full overflow-hidden">
        {{-- HERO --}}
        <section class="relative bg-gradient-to-b from-[#356f1d] via-[#3a7323] to-[#2f5a1a] text-white">
            <div class="hero-blob one"></div>
            <div class="hero-blob two"></div>
            <div class="hero-blob three"></div>

            <div class="max-w-7xl mx-auto px-6 py-24 lg:py-32">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                    <div class="hero-content relative z-10">
                        <div class="glass soft-shadow p-6 md:p-10 rounded-2xl max-w-xl">
                            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight" data-i18n="hero.title">
                                JOYA — Empowering Youth, Building Futures
                            </h1>
                            <p class="mt-4 text-lg sm:text-xl text-white/90" data-i18n="hero.subtitle">
                                We provide education, livelihoods, and community health support across Afghanistan.
                            </p>

                            <div class="mt-6 flex items-center gap-4">
                                <a href="#programs" class="cta-btn inline-flex items-center gap-3 bg-white text-[var(--joya-green)] font-semibold py-3 px-5 rounded-lg shadow-sm hover:shadow-md transition"
                                   data-i18n="hero.button" role="button">
                                    Learn More
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>

                                <div class="text-sm text-white/80">
                                    <span data-i18n="hero.small_note">Support our programs — join as a volunteer or donor.</span>
                                </div>
                            </div>
                        </div>

                        {{-- secondary small points under hero glass --}}
                        <div class="mt-6 flex flex-wrap gap-4 text-sm text-white/80">
                            <div class="flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full" style="background: var(--joya-green-3)"></span>
                                <span data-i18n="hero.point_1">Community-driven</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full" style="background: var(--joya-green)"></span>
                                <span data-i18n="hero.point_2">Impact-led</span>
                            </div>
                        </div>
                    </div>

                    <div class="relative z-10 flex justify-center lg:justify-end">
                        {{-- decorative card showing quick mission summary --}}
                        <div class="glass p-6 rounded-2xl max-w-md w-full soft-shadow">
                            <div class="flex items-start gap-4">
                                <img src="{{ asset('assets/logo/joya-logo-white.svg') }}" alt="JOYA" class="w-20 h-20"/>
                                <div>
                                    <h3 class="text-xl font-semibold" data-i18n="hero.card_title">Our Mission</h3>
                                    <p class="mt-2 text-sm text-white/90" data-i18n="hero.card_desc">
                                        To empower youth through skills, opportunities and inclusive community programs.
                                    </p>

                                    <div class="mt-4 flex gap-3">
                                        <span class="inline-flex items-center gap-2 text-sm bg-white/5 rounded-full px-3 py-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18z"/>
                                            </svg>
                                            <span data-i18n="hero.card_since">Since 2012</span>
                                        </span>
                                        <span class="inline-flex items-center gap-2 text-sm bg-white/5 rounded-full px-3 py-1">
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
                </div>
            </div>
        </section>

        {{-- STATISTICS / COUNTERS --}}
        <section id="stats" class="bg-white dark:bg-[#07160a]">
            <div class="max-w-7xl mx-auto px-6 py-16">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="glass p-6 rounded-2xl soft-shadow text-center">
                        <div class="text-4xl md:text-5xl text-[var(--joya-green)] counter-number" data-target="124" id="projects-counter">0</div>
                        <div class="mt-3 text-sm font-medium" data-i18n="counter.projects">Projects Completed</div>
                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-300" data-i18n="counter.projects_note">Sustainable projects across sectors.</div>
                    </div>

                    <div class="glass p-6 rounded-2xl soft-shadow text-center">
                        <div class="text-4xl md:text-5xl text-[var(--joya-green-2)] counter-number" data-target="50800" id="beneficiaries-counter">0</div>
                        <div class="mt-3 text-sm font-medium" data-i18n="counter.beneficiaries">Beneficiaries Reached</div>
                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-300" data-i18n="counter.beneficiaries_note">Individuals reached through programs.</div>
                    </div>

                    <div class="glass p-6 rounded-2xl soft-shadow text-center">
                        <div class="text-4xl md:text-5xl text-[var(--joya-green-3)] counter-number" data-target="24" id="provinces-counter">0</div>
                        <div class="mt-3 text-sm font-medium" data-i18n="counter.provinces">Provinces Covered</div>
                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-300" data-i18n="counter.provinces_note">Working in urban & rural areas.</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- PROGRAM PREVIEW --}}
        <section id="programs" class="bg-gray-50 dark:bg-[#07120d]">
            <div class="max-w-7xl mx-auto px-6 py-16">
                <div class="text-center mb-10">
                    <h2 class="text-2xl md:text-3xl font-bold" data-i18n="programs.title">Our Core Programs</h2>
                    <p class="mt-3 text-sm md:text-base text-gray-600 dark:text-gray-300" data-i18n="programs.subtitle">
                        Programs tailored to local needs — education, livelihoods, and health.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 programs-grid">
                    {{-- Education & TVET --}}
                    <article class="program-card glass rounded-2xl p-6 soft-shadow">
                        <div class="flex items-start gap-4">
                            <div class="program-icon p-3 rounded-lg bg-white/5 border border-white/6">
                                {{-- Phosphor-style education icon --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[var(--joya-green)]" viewBox="0 0 256 256" fill="none">
                                    <path d="M128 24L24 76l104 52 104-52L128 24z" stroke="currentColor" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M32 96v48a96 96 0 0096 16 96 96 0 0096-16V96" stroke="currentColor" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold" data-i18n="program.title_1">Education & TVET</h3>
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
                                {{-- briefcase / entrepreneurship icon --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[var(--joya-green-2)]" viewBox="0 0 256 256" fill="none">
                                    <rect x="32" y="72" width="192" height="120" rx="8" stroke="currentColor" stroke-width="12" />
                                    <path d="M168 72v-16a16 16 0 00-16-16h-48a16 16 0 00-16 16v16" stroke="currentColor" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold" data-i18n="program.title_2">Livelihood & Entrepreneurship</h3>
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
                                {{-- heart/health icon --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[var(--joya-green-3)]" viewBox="0 0 256 256" fill="none">
                                    <path d="M128 216s-70-44-96-84a56 56 0 0196-64 56 56 0 0196 64c-26 40-96 84-96 84z" stroke="currentColor" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold" data-i18n="program.title_3">Health & Community Development</h3>
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
        <section id="where" class="bg-white dark:bg-[#07160a]">
            <div class="max-w-7xl mx-auto px-6 py-16">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold" data-i18n="where.title">Where We Work</h2>
                        <p class="mt-4 text-gray-600 dark:text-gray-300" data-i18n="where.desc">
                            JOYA operates across multiple provinces, focusing on areas with the greatest need and potential for impact.
                        </p>

                        <ul class="mt-6 space-y-3 text-sm text-gray-600 dark:text-gray-300">
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
                        {{-- Simple Afghanistan silhouette SVG (modern, minimal) --}}
                        <div class="glass p-6 rounded-2xl soft-shadow max-w-md w-full">
                            <svg class="af-map" viewBox="0 0 800 600" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <!-- Simplified abstract map silhouette for stylistic presentation -->
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
        <section id="mission" class="bg-gray-50 dark:bg-[#07120d]">
            <div class="max-w-7xl mx-auto px-6 py-16">
                <div class="text-center mb-10">
                    <h2 class="text-2xl md:text-3xl font-bold" data-i18n="mission.title">Our Mission</h2>
                    <p class="mt-3 text-sm md:text-base text-gray-600 dark:text-gray-300" data-i18n="mission.subtitle">
                        We believe in locally-led solutions and long-term impact.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 glass rounded-2xl soft-shadow">
                        <div class="flex items-start gap-4">
                            <div class="mission-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[var(--joya-green)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M12 2l1.5 4.5L18 8l-3 2 1 4.5L12 12l-4 2 1-4.5L6 8l4.5-1.5L12 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold" data-i18n="mission.item_1.title">Protect & Educate</h4>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300" data-i18n="mission.item_1">
                                    Support education access for marginalized youth and strengthen local schools.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 glass rounded-2xl soft-shadow">
                        <div class="flex items-start gap-4">
                            <div class="mission-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[var(--joya-green-2)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M3 12h18M12 3v18" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold" data-i18n="mission.item_2.title">Create Opportunities</h4>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300" data-i18n="mission.item_2">
                                    Build livelihood pathways and entrepreneurship opportunities for young people.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 glass rounded-2xl soft-shadow">
                        <div class="flex items-start gap-4">
                            <div class="mission-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[var(--joya-green-3)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M12 21V3M5 12h14" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold" data-i18n="mission.item_3.title">Strengthen Communities</h4>
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
        // COUNTER ANIMATION
        (function () {
            const counters = [
                { el: document.getElementById('projects-counter'), target: parseInt(document.getElementById('projects-counter').dataset.target || 0, 10) },
                { el: document.getElementById('beneficiaries-counter'), target: parseInt(document.getElementById('beneficiaries-counter').dataset.target || 0, 10) },
                { el: document.getElementById('provinces-counter'), target: parseInt(document.getElementById('provinces-counter').dataset.target || 0, 10) }
            ];

            const easeOutExpo = (t) => t === 1 ? 1 : 1 - Math.pow(2, -10 * t);

            function animateCounter(el, start, end, duration) {
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

            // Observe when stats section enters viewport
            const statsSection = document.getElementById('stats');
            let started = false;
            if (statsSection) {
                const observer = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !started) {
                            started = true;
                            counters.forEach(c => {
                                // choose duration proportional to target
                                const duration = Math.min(2200 + (c.target / 1000) * 1200, 4200);
                                animateCounter(c.el, 0, c.target, duration);
                            });
                        }
                    });
                }, { threshold: 0.3 });
                observer.observe(statsSection);
            } else {
                // fallback - animate immediately
                counters.forEach(c => animateCounter(c.el, 0, c.target, 2000));
            }

            // Simple i18n hook: buttons or links using data-i18n should be filled by the layout JS.
            // This script only ensures counter numbers are readable for screen readers.
        })();
    </script>

    <script>
        // Minor accessibility: enable keyboard activation for CTA if layout doesn't already
        document.querySelectorAll('a.cta-btn').forEach(function(btn){
            btn.addEventListener('keyup', function(e){
                if(e.key === 'Enter' || e.key === ' ') {
                    btn.click();
                }
            });
        });
    </script>
@endsection
