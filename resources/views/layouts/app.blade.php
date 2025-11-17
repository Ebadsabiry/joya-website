<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title','JOYA')</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            joya: '#375523',
            'joya-600': '#375523',
            'joya-500': '#4b7a3a'
          },
          fontFamily: { body: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'] }
        }
      }
    }
  </script>

  <!-- Phosphor icons -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>

  @yield('head')
  <style>
    /* small helpers */
    .glass { background: rgba(255,255,255,0.65); backdrop-filter: blur(8px); }
    .nav-transition { transition: background-color .35s, box-shadow .35s, transform .25s; }
    /* particle canvas sits under hero */
    canvas#hero-canvas { position: absolute; inset: 0; z-index: 0; pointer-events: none; }
    /* reduced motion */
    @media (prefers-reduced-motion: reduce) { * { animation-duration: 0.001ms !important; transition-duration: 0.001ms !important; } }
  </style>
</head>
<body class="bg-gray-50 text-gray-900 font-body" data-theme="light">

  <!-- HEADER: transparent -> solid on scroll -->
  <header id="siteHeader" class="fixed inset-x-0 top-0 z-50 nav-transition">
    <div id="headerInner" class="max-w-7xl mx-auto px-5 py-4 flex items-center justify-between">
      <a href="{{ url('/') }}" class="flex items-center gap-3">
        <!-- navbar logo: green by default; we will switch to white when header is over hero -->
        <img id="logoImg" src="{{ asset('assets/logo/joya-logo-green.svg') }}" alt="JOYA" class="h-10 w-auto">
        <div class="hidden sm:block">
          <div class="text-sm font-semibold text-joya">JOYA</div>
          <div class="text-xs text-gray-600">Joint Organization for Youth Advancement</div>
        </div>
      </a>

      <!-- Desktop nav -->
      <nav class="hidden md:flex items-center gap-6 text-sm">
        <a href="{{ url('/') }}" class="hover:text-joya">Home</a>
        <a href="{{ url('/about') }}" class="hover:text-joya">About</a>
        <a href="{{ url('/programs') }}" class="hover:text-joya">Programs</a>
        <a href="{{ url('/projects') }}" class="hover:text-joya">Projects</a>
        <a href="{{ url('/contact') }}" class="hover:text-joya">Contact</a>
      </nav>

      <!-- actions -->
      <div class="flex items-center gap-3">
        <!-- language -->
        <div class="relative">
          <button id="langBtn" class="px-3 py-1 rounded-md border text-sm flex items-center gap-2">
            <span id="langLabel">EN</span> <i class="ph ph-caret-down text-sm"></i>
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
        <a href="{{ url('/') }}" class="block rounded-md px-3 py-2 hover:bg-gray-50">Home</a>
        <a href="{{ url('/about') }}" class="block rounded-md px-3 py-2 hover:bg-gray-50">About</a>
        <a href="{{ url('/programs') }}" class="block rounded-md px-3 py-2 hover:bg-gray-50">Programs</a>
        <a href="{{ url('/projects') }}" class="block rounded-md px-3 py-2 hover:bg-gray-50">Projects</a>
        <a href="{{ url('/contact') }}" class="block rounded-md px-3 py-2 hover:bg-gray-50">Contact</a>
      </nav>
    </div>
  </header>

  <!-- page content -->
  <main class="pt-24">
    @yield('content')
  </main>

  <!-- FOOTER -->
  <footer class="bg-gray-100 border-t mt-12">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-6">
      <div>
        <img src="{{ asset('assets/logo/joya-logo-green.svg') }}" alt="JOYA" class="h-12 mb-3">
        <p class="text-sm text-gray-700">Joint Organization for Youth Advancement — empowering youth, women and children through education, health and livelihoods.</p>
      </div>

      <div>
        <h4 class="font-semibold mb-2">Quick Links</h4>
        <ul class="text-sm text-gray-700 space-y-1">
          <li><a href="/" class="hover:text-joya">Home</a></li>
          <li><a href="/about" class="hover:text-joya">About</a></li>
          <li><a href="/programs" class="hover:text-joya">Programs</a></li>
          <li><a href="/projects" class="hover:text-joya">Projects</a></li>
        </ul>
      </div>

      <div>
        <h4 class="font-semibold mb-2">Contact</h4>
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

  <!-- SCRIPTS: header scroll effect, mobile, theme, language, logo swap and small helpers -->
  <script>
    // helpers
    const $ = (sel)=>document.querySelector(sel);
    const $$ = (sel)=>Array.from(document.querySelectorAll(sel));

    // mobile menu
    document.getElementById('menuBtn')?.addEventListener('click', ()=> {
      document.getElementById('mobileMenu').classList.toggle('hidden');
    });

    // language menu
    const langBtn = $('#langBtn'), langMenu = $('#langMenu'), langLabel = $('#langLabel');
    langBtn?.addEventListener('click', ()=> langMenu.classList.toggle('hidden'));
    $$('.lang-select').forEach(b=>{
      b.addEventListener('click', (e)=>{
        const L = e.currentTarget.getAttribute('data-lang');
        localStorage.setItem('site_lang', L);
        langLabel.innerText = (L==='en'?'EN':(L==='fa'?'دری':'پښتو'));
        langMenu.classList.add('hidden');
        // simple client-side text switcher: dispatch event
        document.dispatchEvent(new CustomEvent('site:langchange',{detail:{lang:L}}));
      });
    });
    // init lang
    const savedLang = localStorage.getItem('site_lang') || 'en';
    langLabel.innerText = (savedLang==='en'?'EN':(savedLang==='fa'?'دری':'پښتو'));

    // theme toggle (dark/light)
    const themeBtn = $('#themeBtn'), themeIcon = $('#themeIcon'), root = document.documentElement;
    function setTheme(t){
      if(t==='dark'){ root.classList.add('dark'); document.body.dataset.theme='dark'; themeIcon.className='ph ph-sun'; localStorage.setItem('theme','dark'); }
      else { root.classList.remove('dark'); document.body.dataset.theme='light'; themeIcon.className='ph ph-moon'; localStorage.setItem('theme','light'); }
    }
    themeBtn?.addEventListener('click', ()=> setTheme((localStorage.getItem('theme')==='dark')? 'light':'dark'));
    // init theme
    setTheme(localStorage.getItem('theme')==='dark' ? 'dark' : 'light');

    // header: transparent -> solid on scroll + logo swap
    const header = $('#siteHeader'), headerInner = $('#headerInner'), logoImg = $('#logoImg');
    function onScroll(){
      if(window.scrollY > 50){
        headerInner.classList.add('glass','shadow-md');
        headerInner.style.backgroundColor = 'rgba(255,255,255,0.95)';
        logoImg.src = "{{ asset('assets/logo/joya-logo-green.svg') }}";
        // if dark theme use white logo
        if(document.body.dataset.theme === 'dark') logoImg.src = "{{ asset('assets/logo/joya-logo-white.svg') }}";
      } else {
        headerInner.classList.remove('glass','shadow-md');
        headerInner.style.backgroundColor = 'transparent';
        // when over hero, use white logo if light background over hero; but default green
        if(document.body.dataset.theme === 'dark') logoImg.src = "{{ asset('assets/logo/joya-logo-white.svg') }}";
        else logoImg.src = "{{ asset('assets/logo/joya-logo-green.svg') }}";
      }
    }
    onScroll();
    window.addEventListener('scroll', onScroll);
    window.addEventListener('load', onScroll);

    // language event example: you can listen for language change and update texts
    document.addEventListener('site:langchange', (e)=>{
      // placeholder: in future we will swap texts via JS or server-side translation
      console.log('Lang changed to', e.detail.lang);
    });
  </script>
</body>
</html>
