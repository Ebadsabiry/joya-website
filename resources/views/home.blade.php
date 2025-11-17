@extends('layouts.app')

@section('title', 'JOYA — Empowering Communities')

@section('head')
<!-- Add any page-specific head here if needed -->
@endsection

@section('content')
<!-- HERO -->
<section class="relative overflow-hidden rounded-2xl">
  <div class="absolute inset-0 bg-gradient-to-br from-[#375523] via-[#3e6f2b] to-[#78a66b] opacity-95"></div>

  <!-- decorative shapes -->
  <div aria-hidden="true" class="absolute -left-20 -top-20 w-80 h-80 bg-white/6 rounded-full blur-3xl animate-blob"></div>
  <div aria-hidden="true" class="absolute right-0 -bottom-20 w-96 h-96 bg-white/4 rounded-full blur-3xl animate-blob animation-delay-2000"></div>

  <div class="relative z-10 max-w-6xl mx-auto px-6 py-24 text-center text-white">
    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight drop-shadow-lg">
      Building Hope Through Youth, Education & Community Development
    </h1>
    <p class="mt-6 max-w-3xl mx-auto text-lg md:text-xl opacity-90">
      JOYA empowers communities across Afghanistan with programs in education, livelihoods, and health — delivering sustainable, community-led change.
    </p>

    <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
      <a href="{{ url('/programs') }}" class="inline-flex items-center gap-3 bg-white text-[#375523] px-6 py-3 rounded-full font-semibold shadow hover:translate-y-[-2px] transition">
        Our Programs
      </a>

      <a href="{{ url('/contact') }}" class="inline-flex items-center gap-3 border border-white/60 text-white px-6 py-3 rounded-full font-medium hover:bg-white/10 transition">
        Contact Us
      </a>
    </div>

    <!-- quick stats -->
    <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-4xl mx-auto text-center">
      <div class="bg-white/8 p-6 rounded-xl">
        <div class="text-4xl font-extrabold text-white counter" data-target="48">0</div>
        <div class="mt-2 text-sm text-white/90">Projects Completed</div>
      </div>

      <div class="bg-white/8 p-6 rounded-xl">
        <div class="text-4xl font-extrabold text-white counter" data-target="120000">0</div>
        <div class="mt-2 text-sm text-white/90">Beneficiaries Reached</div>
      </div>

      <div class="bg-white/8 p-6 rounded-xl">
        <div class="text-4xl font-extrabold text-white counter" data-target="12">0</div>
        <div class="mt-2 text-sm text-white/90">Provinces Covered</div>
      </div>
    </div>
  </div>
</section>

<!-- PROGRAMS -->
<section class="mt-12">
  <div class="max-w-6xl mx-auto px-6">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Key Program Areas</h2>
      <a href="{{ url('/programs') }}" class="text-sm text-[#375523] font-medium hover:underline">See all programs →</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- card 1 -->
      <div class="p-6 rounded-xl shadow tilt-float border border-gray-100">
        <div class="w-12 h-12 rounded-lg bg-[#eaf7ea] flex items-center justify-center text-[#375523] text-2xl">🎓</div>
        <h3 class="mt-4 text-lg font-semibold">Education & TVET</h3>
        <p class="mt-2 text-sm text-gray-600">Literacy, vocational training, and youth skills programs that prepare people for work.</p>
      </div>

      <!-- card 2 -->
      <div class="p-6 rounded-xl shadow tilt-float border border-gray-100">
        <div class="w-12 h-12 rounded-lg bg-[#eaf7ea] flex items-center justify-center text-[#375523] text-2xl">💼</div>
        <h3 class="mt-4 text-lg font-semibold">Livelihoods & Entrepreneurship</h3>
        <p class="mt-2 text-sm text-gray-600">Income generation, small business support, and vocational opportunities for vulnerable households.</p>
      </div>

      <!-- card 3 -->
      <div class="p-6 rounded-xl shadow tilt-float border border-gray-100">
        <div class="w-12 h-12 rounded-lg bg-[#eaf7ea] flex items-center justify-center text-[#375523] text-2xl">🏥</div>
        <h3 class="mt-4 text-lg font-semibold">Health & Community Development</h3>
        <p class="mt-2 text-sm text-gray-600">Community health awareness, mother & child support, and resilience-building activities.</p>
      </div>
    </div>
  </div>
</section>

<!-- NEWS & DOCUMENTS -->
<section class="mt-12">
  <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- news -->
    <div class="p-6 bg-white rounded-xl shadow">
      <h3 class="text-lg font-semibold mb-3">Latest Announcements</h3>

      <article class="mb-3">
        <h4 class="font-medium">JOYA starts new literacy classes in Parwan</h4>
        <p class="text-sm text-gray-600 mt-1">Updated: when needed</p>
      </article>

      <article class="mb-3">
        <h4 class="font-medium">Community health outreach scheduled for next month</h4>
        <p class="text-sm text-gray-600 mt-1">Updated: when needed</p>
      </article>

      <a href="{{ url('/news') }}" class="text-sm text-[#375523] hover:underline">All announcements →</a>
    </div>

    <!-- documents -->
    <div class="p-6 bg-white rounded-xl shadow">
      <h3 class="text-lg font-semibold mb-3">Important Documents</h3>
      <p class="text-sm text-gray-600 mb-4">Visitors can download official forms and requirement documents.</p>

      <ul class="space-y-3">
        <li>
          <a href="{{ asset('files/requirement-form.pdf') }}" class="text-[#375523] hover:underline" target="_blank">Requirement Form (PDF)</a>
        </li>
        <!-- add more links here -->
      </ul>
    </div>
  </div>
</section>

<!-- WHERE WE WORK (simplified map placeholder) -->
<section class="mt-12">
  <div class="max-w-6xl mx-auto px-6">
    <h3 class="text-xl font-semibold mb-4">Where We Work</h3>
    <div class="bg-white rounded-xl p-6 shadow text-center">
      <div class="text-gray-600">Provinces covered: Kabul, Parwan, Balkh, Herat, and others.</div>
      <div class="mt-4">
        <!-- placeholder map box -->
        <div class="h-48 bg-gradient-to-br from-green-50 to-gray-100 rounded-md flex items-center justify-center text-gray-400">
          (Interactive map will be added — or embed Google Map later)
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CALL TO ACTION -->
<section class="mt-12 mb-16">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <div class="p-10 bg-[#f3faf3] rounded-xl shadow">
      <h3 class="text-2xl font-bold text-[#375523]">Want to work with JOYA?</h3>
      <p class="mt-3 text-gray-700">Contact us at <a href="mailto:info@joya-ngo.com" class="text-[#375523] font-medium">info@joya-ngo.com</a> — we welcome partners and donors.</p>
      <div class="mt-6">
        <a href="{{ url('/contact') }}" class="inline-block bg-[#375523] text-white px-6 py-3 rounded-full font-semibold">Get in touch</a>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
<!-- Counters and simple animation scripts -->
<script>
  // counters
  (function() {
    const counters = document.querySelectorAll('.counter');
    counters.forEach(c => {
      const target = +c.getAttribute('data-target') || 0;
      let current = 0;
      const step = Math.max(1, Math.floor(target / 200));
      function tick() {
        current += step;
        if (current >= target) {
          c.innerText = target.toLocaleString();
        } else {
          c.innerText = current.toLocaleString();
          requestAnimationFrame(tick);
        }
      }
      tick();
    });
  })();

  // small "blob" animation CSS injection (for older browsers fallback)
  (function(){
    const style = document.createElement('style');
    style.innerHTML = `
      @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(20px, -10px) scale(1.05); }
        66% { transform: translate(-10px, 20px) scale(0.95); }
        100% { transform: translate(0px, 0px) scale(1); }
      }
      .animate-blob { animation: blob 8s infinite; }
      .animation-delay-2000 { animation-delay: 2s; }
    `;
    document.head.appendChild(style);
  })();
</script>
@endsection
