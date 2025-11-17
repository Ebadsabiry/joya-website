<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', 'JOYA')</title>

  {{-- Tailwind CSS --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-gray-50 text-gray-900">

  {{-- NAVBAR --}}
  <header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
      <a href="{{ url('/') }}" class="text-xl font-semibold text-blue-700">JOYA</a>
      <nav class="space-x-4">
        <a href="{{ url('/') }}" class="hover:text-blue-700">Home</a>
        <a href="{{ url('/about') }}" class="hover:text-blue-700">About</a>
        <a href="{{ url('/programs') }}" class="hover:text-blue-700">Programs</a>
        <a href="{{ url('/projects') }}" class="hover:text-blue-700">Projects</a>
        <a href="{{ url('/contact') }}" class="hover:text-blue-700">Contact</a>
      </nav>
    </div>
  </header>

  {{-- PAGE CONTENT --}}
  <main class="flex-1 container mx-auto px-4 py-8">
    @yield('content')
  </main>

  {{-- FOOTER --}}
  <footer class="bg-white border-t">
    <div class="container mx-auto px-4 py-6 text-sm text-gray-600">
      <div class="flex justify-between">
        <div>© {{ date('Y') }} JOYA — All rights reserved.</div>
        <div>Contact: joya.organization@gmail.com | +93 766 472 325</div>
      </div>
    </div>
  </footer>

</body>
</html>
