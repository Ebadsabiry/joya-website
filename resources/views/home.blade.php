@extends('layouts.app')

@section('title', 'Home - JOYA')

@section('content')
  <section class="bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-4">Welcome to JOYA</h1>

    <p class="mb-4">
      Joint Organization for Youth Advancement (JOYA) is a national NGO working to empower Afghan youth, women, and vulnerable communities through education, health, livelihoods, and community development.
    </p>

    <div class="grid md:grid-cols-3 gap-4 mt-6">
      <div class="p-4 bg-blue-50 rounded">
        <h3 class="font-semibold">Programs</h3>
        <p class="text-sm">Education, Health, Livelihoods, Agriculture.</p>
      </div>

      <div class="p-4 bg-green-50 rounded">
        <h3 class="font-semibold">Where We Work</h3>
        <p class="text-sm">Kabul, Parwan, Balkh, Herat and more provinces.</p>
      </div>

      <div class="p-4 bg-yellow-50 rounded">
        <h3 class="font-semibold">Get Involved</h3>
        <p class="text-sm">Volunteer, partner, or support our initiatives.</p>
      </div>
    </div>
  </section>
@endsection
