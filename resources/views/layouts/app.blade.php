<!doctype html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title','JOYA')</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;600;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@300;400;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            joya: '#375523',
            'joya-500': '#375523',
            'joya-400': '#4b7a3a',
            'joya-200': '#9cc68a'
          },
          fontFamily: { inter: ['Inter','sans-serif'] }
        }
      }
    }
  </script>

  <!-- Icons -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>

  <style>
    /* Font & direction helpers */
    body[data-lang="en"] { font-family: 'Inter', sans-serif; direction:ltr; text-align:left; }
    body[data-lang="fa"] { font-family: 'Vazirmatn', sans-serif; direction:rtl; text-align:right; }
    body[data-lang="ps"] { font-family: 'Noto Naskh Arabic', serif; direction:rtl; text-align:right; }

    /* Make sure inputs don't flip text direction awkwardly */
    body[data-lang="fa"] input, body[data-lang="ps"] input, body[data-lang="fa"] textarea, body[data-lang="ps"] textarea {
      direction: ltr; text-align: left;
    }

    /* Visual helpers */
    .glass { background: rgba(255,255,255,0.65); backdrop-filter: blur(8px); }
    .nav-transition { transition: background-color .35s, box-shadow .35s, transform .25s; }
    canvas#hero-canvas { position: absolute; inset: 0; z-index: 0; pointer-events: none; }

    /* Dark-mode color adjustments */
    :root { --joya: #375523; }
    .dark body { background-color: #0b0b0b; color: #eaeaea; }
    .dark .text-gray-700 { color: #d5d5d5 !important; }
    .dark .text-gray-600 { color: #c6c6c6 !important; }
    .dark .bg-white { background-color: #111827 !important; }
    .dark .bg-gray-100 { background-color: #0f1721 !important; }
    .dark .border-gray-200 { border-color: #1f2937 !important; }

    /* Blob animations (hero) */
    .blob { filter: blur(34px); opacity: .95; transform: translate3d(0,0,0); }
    @media (prefers-reduced-motion: reduce) {
      * { animation-duration: 0.001ms !important; transition-duration: 0.001ms !important; }
    }
  </style>

  @yield('head')
</head>

<body data-lang="{{ old('lang', 'en') }}" data-theme="light" class="bg-gray-50 text-gray-900">

  <!-- Header: transparent -> solid on scroll -->
  <header id="siteHeader" class="fixed inset-x-0 top-0 z-50 nav-transition">
    <div id="headerInner" class="max-w-7xl mx-auto px-5 py-4 flex items-center justify-between">
      <a href="{{ url('/') }}" class="flex items-center gap-3">
        <img id="logoImg" src="{{ asset('assets/logo/joya-logo-green.svg') }}" alt="JOYA" class="h-10 w-auto">
        <div class="hidden sm:block">
          <div class="text-sm font-semibold text-joya" data-i18n="brand">JOYA</div>
          <div class="text-xs text-gray-600" data-i18n="tagline">Joint Organization for Youth Advancement</div>
        </div>
      </a>

      <!-- Desktop nav -->
      <nav id="mainNav" class="hidden md:flex items-center gap-6 text-sm">
        <a href="{{ url('/') }}" class="hover:text-joya" data-i18n="nav.home">Home</a>
        <a href="{{ url('/about') }}" class="hover:text-joya" data-i18n="nav.about">About</a>
        <a href="{{ url('/programs') }}" class="hover:text-joya" data-i18n="nav.programs">Programs</a>
        <a href="{{ url('/projects') }}" class="hover:text-joya" data-i18n="nav.projects">Projects</a>
        <a href="{{ url('/contact') }}" class="hover:text-joya" data-i18n="nav.contact">Contact</a>
      </nav>

      <!-- actions -->
      <div class="flex items-center gap-3">
        <!-- language -->
        <div class="relative">
          <button id="langBtn" class="px-3 py-1 rounded-md border text-sm flex items-center gap-2" title="Language">
            <span id="langLabel">EN</span>
            <i class="ph ph-caret-down text-sm"></i>
          </button>
          <div id="langMenu" class="hidden absolute right-0 mt-2 bg-white shadow rounded-md overflow-hidden text-sm">
            <button class="block w-full text-left px-3 py-2 hover:bg-gray-50 lang-select" data-lang="en">English</button>
            <button class="block w-full text-left px-3 py-2 hover:bg-gray-50 lang-select" data-lang="fa">دری</button>
            <button class="block w-full text-left px-3 py-2 hover:bg-gray-50 lang-select" data-lang="ps">پښتو</button>
          </div>
        </div>

        <!-- theme -->
        <button id="themeBtn" class="p-2 rounded-md border" title="Toggle theme">
          <i id="themeIcon" class="ph ph-moon"></i>
        </button>

        <!-- mobile menu -->
        <button id="menuBtn" class="md:hidden p-2 rounded-md border">
          <i class="ph ph-list"></i>
        </button>
      </div>
    </div>

    <!-- mobile menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
      <nav class="px-5 py-4 space-y-2">
        <a href="{{ url('/') }}" class="block rounded-md px-3 py-2 hover:bg-gray-50" data-i18n="nav.home">Home</a>
        <a href="{{ url('/about') }}" class="block rounded-md px-3 py-2 hover:bg-gray-50" data-i18n="nav.about">About</a>
        <a href="{{ url('/programs') }}" class="block rounded-md px-3 py-2 hover:bg-gray-50" data-i18n="nav.programs">Programs</a>
        <a href="{{ url('/projects') }}" class="block rounded-md px-3 py-2 hover:bg-gray-50" data-i18n="nav.projects">Projects</a>
        <a href="{{ url('/contact') }}" class="block rounded-md px-3 py-2 hover:bg-gray-50" data-i18n="nav.contact">Contact</a>
      </nav>
    </div>
  </header>

  <!-- page content with top padding -->
  <main class="pt-24">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="bg-gray-100 border-t mt-12">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-6">
      <div>
        <img src="{{ asset('assets/logo/joya-logo-green.svg') }}" alt="JOYA" class="h-12 mb-3">
        <p class="text-sm text-gray-700" data-i18n="footer.description">Joint Organization for Youth Advancement — empowering youth, women and children through education, health and livelihoods.</p>
      </div>

      <div>
        <h4 class="font-semibold mb-2" data-i18n="footer.links">Quick Links</h4>
        <ul class="text-sm text-gray-700 space-y-1">
          <li><a href="/" class="hover:text-joya" data-i18n="nav.home">Home</a></li>
          <li><a href="/about" class="hover:text-joya" data-i18n="nav.about">About</a></li>
          <li><a href="/programs" class="hover:text-joya" data-i18n="nav.programs">Programs</a></li>
          <li><a href="/projects" class="hover:text-joya" data-i18n="nav.projects">Projects</a></li>
        </ul>
      </div>

      <div>
        <h4 class="font-semibold mb-2" data-i18n="footer.contact">Contact</h4>
        <p class="text-sm text-gray-700">Email: <a href="mailto:info@joya-ngo.com" class="text-joya">info@joya-ngo.com</a></p>
        <div class="flex items-center gap-3 mt-3">
          <a aria-label="LinkedIn" href="#" class="p-2 rounded-md hover:bg-gray-50"><i class="ph ph-linkedin"></i></a>
          <a aria-label="Facebook" href="#" class="p-2 rounded-md hover:bg-gray-50"><i class="ph ph-facebook-logo"></i></a>
        </div>
      </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-6 text-center text-sm text-gray-500">© {{ date('Y') }} JOYA — All rights reserved.</div>
  </footer>

  @yield('scripts')

  <!-- JS: theme, language, header behavior, logo swap, responsive menu -->
  <script>
    const $ = s => document.querySelector(s);
    const $$ = s => Array.from(document.querySelectorAll(s));

    // Mobile menu
    $('#menuBtn')?.addEventListener('click', ()=> $('#mobileMenu').classList.toggle('hidden'));

    // Language - dictionary for layout and pages
    const translations = {
      en: {
        brand:'JOYA', tagline:'Joint Organization for Youth Advancement',
        'nav.home':'Home','nav.about':'About','nav.programs':'Programs','nav.projects':'Projects','nav.contact':'Contact',
        'footer.description':'Joint Organization for Youth Advancement — empowering youth, women and children through education, health and livelihoods.',
        'footer.links':'Quick Links','footer.contact':'Contact'
      },
      fa: {
        brand:'جویا', tagline:'سازمان مشترک ارتقای جوانان',
        'nav.home':'خانه','nav.about':'درباره','nav.programs':'برنامه‌ها','nav.projects':'پروژه‌ها','nav.contact':'تماس',
        'footer.description':'جویا — تقویت جوانان، زنان و کودک از طریق آموزش، بهداشت و معیشت.',
        'footer.links':'لینک‌های سریع','footer.contact':'تماس'
      },
      ps: {
        brand:'جویا', tagline:'د ځوانانو د پرمختګ ګډ سازمان',
        'nav.home':'کور','nav.about':'زموږ په اړه','nav.programs':'پروګرامونه','nav.projects':'پروژې','nav.contact':'اړیکه',
        'footer.description':'جویا — د زده کړې، روغتیا او معيشت له لارې د ټولنو ځواکمنول.',
        'footer.links':'ګړندي لینکونه','footer.contact':'اړيکه'
      }
    };

    // apply translations to elements with data-i18n
    function applyTranslations(lang){
      const dict = translations[lang] || translations.en;
      $$('[data-i18n]').forEach(el=>{
        const key = el.getAttribute('data-i18n');
        if(key && dict[key]!==undefined) el.innerText = dict[key];
      });
    }

    // language menu open/close & selection
    const langBtn = $('#langBtn'), langMenu = $('#langMenu'), langLabel = $('#langLabel');
    langBtn?.addEventListener('click', ()=> langMenu.classList.toggle('hidden'));
    $$('.lang-select').forEach(b=>{
      b.addEventListener('click', e=>{
        const L = e.currentTarget.getAttribute('data-lang');
        setLanguage(L);
        langMenu.classList.add('hidden');
      });
    });

    function setLanguage(L){
      localStorage.setItem('site_lang', L);
      document.body.dataset.lang = L;
      // direction
      if(L === 'fa' || L === 'ps'){
        document.documentElement.setAttribute('dir','rtl');
      } else {
        document.documentElement.setAttribute('dir','ltr');
      }
      // label
      $('#langLabel').innerText = (L==='en'?'EN':(L==='fa'?'دری':'پښتو'));
      // apply translations
      applyTranslations(L);
      // emit event
      document.dispatchEvent(new CustomEvent('site:langchange',{detail:{lang:L}}));
    }

    // init language on load
    const savedLang = localStorage.getItem('site_lang') || 'en';
    setLanguage(savedLang);

    // Theme toggle - stable
    const themeBtn = $('#themeBtn'), themeIcon = $('#themeIcon');
    function setTheme(t){
      if(t === 'dark'){
        document.documentElement.classList.add('dark');
        document.body.dataset.theme = 'dark';
        themeIcon.className = 'ph ph-sun';
      } else {
        document.documentElement.classList.remove('dark');
        document.body.dataset.theme = 'light';
        themeIcon.className = 'ph ph-moon';
      }
      localStorage.setItem('theme', t);
      swapLogo();
    }
    themeBtn?.addEventListener('click', ()=> {
      const current = localStorage.getItem('theme') === 'dark' ? 'dark' : 'light';
      setTheme(current === 'dark' ? 'light' : 'dark');
    });
    setTheme(localStorage.getItem('theme') || 'light');

    // header behavior + logo swap
    const headerInner = $('#headerInner'), logoImg = $('#logoImg');
    function swapLogo(){
      const theme = localStorage.getItem('theme') === 'dark' ? 'dark' : 'light';
      const scrolled = window.scrollY > 60;
      // choose white logo when over hero small scroll in light mode, or when theme dark
      if(theme === 'dark') logoImg.src = "{{ asset('assets/logo/joya-logo-white.svg') }}";
      else logoImg.src = scrolled ? "{{ asset('assets/logo/joya-logo-green.svg') }}" : "{{ asset('assets/logo/joya-logo-white.svg') }}";
    }

    function onScroll(){
      if(window.scrollY > 60){
        headerInner.classList.add('glass','shadow-md');
        headerInner.style.backgroundColor = (document.documentElement.classList.contains('dark')) ? 'rgba(10,10,10,0.75)' : 'rgba(255,255,255,0.95)';
      } else {
        headerInner.classList.remove('glass','shadow-md');
        headerInner.style.backgroundColor = 'transparent';
      }
      swapLogo();
    }
    window.addEventListener('scroll', onScroll);
    window.addEventListener('load', onScroll);

    // listen for page-level translations
    document.addEventListener('site:langchange', e=>{
      const L = e.detail.lang || savedLang;
      // pages should pick this up and update their texts
    });
  </script>
</body>
</html>
