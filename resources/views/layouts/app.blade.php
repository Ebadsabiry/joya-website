<!doctype html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title data-auto>@yield('title','JOYA')</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;600;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@300;400;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors:{
            joya:'#375523',
            'joya-400':'#4b7a3a'
          },
          fontFamily: { inter:['Inter','sans-serif'] }
        }
      }
    }
  </script>

  <!-- Icons -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>

  <!-- Styles -->
  <style>
    body[data-lang="en"] { font-family:'Inter',sans-serif; direction:ltr; text-align:left; }
    body[data-lang="fa"] { font-family:'Vazirmatn',sans-serif; direction:rtl; text-align:right; }
    body[data-lang="ps"] { font-family:'Noto Naskh Arabic',serif; direction:rtl; text-align:right; }

    body[data-lang="fa"] input, body[data-lang="ps"] input,
    body[data-lang="fa"] textarea, body[data-lang="ps"] textarea {
      direction: ltr; text-align:left;
    }

    .glass { background: rgba(255,255,255,0.65); backdrop-filter: blur(8px); }
    .nav-transition { transition: 0.35s; }

    .dark body { background-color:#0b0b0b; color:#eaeaea; }
  </style>

  @yield('head')
</head>

<body data-lang="{{ old('lang','en') }}" data-theme="light" class="bg-gray-50 text-gray-900">

  <!-- HEADER -->
  <header id="siteHeader" class="fixed inset-x-0 top-0 z-50 nav-transition">
    <div id="headerInner" class="max-w-7xl mx-auto px-5 py-4 flex items-center justify-between">

      <!-- Logo -->
      <a href="{{ url('/') }}" class="flex items-center gap-3">
        <img id="logoImg" src="{{ asset('assets/logo/joya-logo-green.svg') }}" class="h-10 w-auto">
        <div class="hidden sm:block">
          <div class="text-sm font-semibold text-joya">JOYA</div>
          <div class="text-xs text-gray-600">Joint Organization for Youth Advancement</div>
        </div>
      </a>

      <!-- NAV -->
      <nav class="hidden md:flex items-center gap-6 text-sm">
        <a href="/" class="hover:text-joya" data-auto>Home</a>
        <a href="/about" class="hover:text-joya" data-auto>About</a>
        <a href="/programs" class="hover:text-joya" data-auto>Programs</a>
        <a href="/projects" class="hover:text-joya" data-auto>Projects</a>
        <a href="/contact" class="hover:text-joya" data-auto>Contact</a>
      </nav>

      <!-- RIGHT SIDE: Language + Theme + Menu -->
      <div class="flex items-center gap-3">

        <!-- LOCAL LANGUAGE DROPDOWN (kept) -->
        <div class="relative">
          <button id="langBtn" class="px-3 py-1 rounded-md border text-sm flex items-center gap-2">
            <span id="langLabel">EN</span>
            <i class="ph ph-caret-down text-sm"></i>
          </button>
          <div id="langMenu"
               class="hidden absolute right-0 mt-2 bg-white shadow rounded-md overflow-hidden text-sm z-50">
            <button class="block w-full text-left px-3 py-2 hover:bg-gray-50 lang-select"
                    data-lang="en">English</button>
            <button class="block w-full text-left px-3 py-2 hover:bg-gray-50 lang-select"
                    data-lang="fa">Dari</button>
            <button class="block w-full text-left px-3 py-2 hover:bg-gray-50 lang-select"
                    data-lang="ps">Pashto</button>
          </div>
        </div>

        <!-- GOOGLE TRANSLATE DROPDOWN (new) -->
        <select id="googleTranslateSelector"
                class="px-3 py-1 border rounded-md text-sm bg-white">
          <option value="">Translate</option>
          <option value="en">English</option>
          <option value="fa">Dari</option>
          <option value="ps">Pashto</option>
        </select>

        <!-- THEME BUTTON -->
        <button id="themeBtn" class="p-2 rounded-md border">
          <i id="themeIcon" class="ph ph-moon"></i>
        </button>

        <button id="menuBtn" class="md:hidden p-2 rounded-md border">
          <i class="ph ph-list"></i>
        </button>
      </div>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
      <nav class="px-5 py-4 space-y-2">
        <a href="/" class="block rounded-md px-3 py-2 hover:bg-gray-50">Home</a>
        <a href="/about" class="block rounded-md px-3 py-2 hover:bg-gray-50">About</a>
        <a href="/programs" class="block rounded-md px-3 py-2 hover:bg-gray-50">Programs</a>
        <a href="/projects" class="block rounded-md px-3 py-2 hover:bg-gray-50">Projects</a>
        <a href="/contact" class="block rounded-md px-3 py-2 hover:bg-gray-50">Contact</a>
      </nav>
    </div>
  </header>

  <main class="pt-24">
    @yield('content')
  </main>

  <!-- FOOTER -->
  <footer class="bg-gray-100 border-t mt-12">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-6">

      <div>
        <img src="{{ asset('assets/logo/joya-logo-green.svg') }}" class="h-12 mb-3">
        <p class="text-sm text-gray-700" data-auto>Joint Organization for Youth Advancement — empowering communities.</p>
      </div>

      <div>
        <h4 class="font-semibold mb-2" data-auto>Quick Links</h4>
        <ul class="text-sm text-gray-700 space-y-1">
          <li><a href="/" class="hover:text-joya">Home</a></li>
          <li><a href="/about" class="hover:text-joya">About</a></li>
          <li><a href="/programs" class="hover:text-joya">Programs</a></li>
          <li><a href="/projects" class="hover:text-joya">Projects</a></li>
        </ul>
      </div>

      <div>
        <h4 class="font-semibold mb-2">Contact</h4>
        <p class="text-sm text-gray-700">Email: info@joya-ngo.com</p>
      </div>

    </div>

    <div class="max-w-7xl mx-auto px-6 py-6 text-center text-sm text-gray-500">
      © {{ date('Y') }} JOYA — All rights reserved.
    </div>
  </footer>

  @yield('scripts')

  <!-- INTERNAL LANGUAGE SYSTEM -->
  <script src="/js/auto-translate.js"></script>

  <!-- GOOGLE TRANSLATE HANDLER -->
  <script>
    document.getElementById("googleTranslateSelector").addEventListener("change", function () {
      const lang = this.value;
      if (!lang) return;

      const url = `https://translate.google.com/translate?sl=auto&tl=${lang}&u=${encodeURIComponent(location.href)}`;
      window.location.href = url;
    });
  </script>

  <!-- LOCAL LANGUAGE MENU + THEME + HEADER -->
  <script>
    const $ = s => document.querySelector(s);
    const $$ = s => [...document.querySelectorAll(s)];

    $('#menuBtn')?.addEventListener('click', () => $('#mobileMenu').classList.toggle('hidden'));

    $('#langBtn')?.addEventListener('click', () => $('#langMenu').classList.toggle('hidden'));

    $$('.lang-select').forEach(btn => {
      btn.addEventListener('click', e => {
        const L = e.target.dataset.lang;
        setLanguage(L);
        $('#langMenu').classList.add('hidden');
      });
    });

    function setLanguage(L){
      localStorage.setItem('site_lang', L);
      document.body.dataset.lang = L;

      if(L === 'fa' || L === 'ps') document.documentElement.dir = 'rtl';
      else document.documentElement.dir = 'ltr';

      $('#langLabel').innerText = (L === 'en' ? 'EN' : (L === 'fa' ? 'دری' : 'پښتو'));

      loadLanguage(L);
    }

    setLanguage(localStorage.getItem('site_lang') || 'en');
  </script>

</body>
</html>
