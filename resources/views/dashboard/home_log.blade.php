<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Home | SIKOMPIT</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @extends('layouts.app')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body class="bg-white text-[#003366] font-sans overflow-x-hidden">
  <!-- Pop-up Selamat Datang -->
  @if(session('first_login') || session('success'))
  <script>
  document.addEventListener('DOMContentLoaded', function() {
  Swal.fire({
    icon: 'success',
    title: 'Login Berhasil!',
    text: '{{ session("success") ?? "Selamat datang di SIKOMPIT!" }}',
    confirmButtonText: 'Mulai Jelajahi',
    confirmButtonColor: '#0d9488'
  });
});
  </script>
  @endif
  <!-- Header Navbar -->
  <header class="sticky top-0 z-50 bg-[#003366]">
        <nav class="flex items-center justify-between py-5 shadow-md px-4">
    <!-- Logo dan Nama Aplikasi -->
    <div class="flex items-center space-x-3 text-white font-bold text-2xl">
      <img src="{{ asset('images/Logo.png') }}" alt="Logo SIKOMPIT" class="h-10" />
      <span>SIKOMPIT</span>
    </div>

      <div class="flex-grow max-w-xl mx-12 relative">
        <button
          onclick="searchProjects()"
          class="absolute right-3 top-1/2 -translate-y-1/2 text-[#003366] hover:text-[#003366]"
          aria-label="Search"
        >
          <i class="fa fa-search text-lg"></i>
        </button>
      </div>

     <ul class="flex flex-wrap space-x-8 text-white font-semibold text-lg" role="menubar">
  <li role="none">
    <a href="{{ url('home') }}"
       role="menuitem"
       class="relative {{ Request::is('home') ? 'text-[#00d1aa]' : 'hover:text-[#00d1aa] focus:text-[#00d1aa]' }}">
      Home
      <span class="absolute bottom-0 left-0 h-[2px] bg-[#00c896] transition-all duration-300 ease-in-out {{ Request::is('home') ? 'w-full' : 'w-0 hover:w-full focus:w-full' }}"></span>
    </a>
  </li>
  <li role="none">
    <a href="{{ url('project') }}"
       role="menuitem"
       class="relative {{ Request::is('project') ? 'text-[#00d1aa]' : 'hover:text-[#00d1aa] focus:text-[#00d1aa]' }}">
      Projects
      <span class="absolute bottom-0 left-0 h-[2px] bg-[#00c896] transition-all duration-300 ease-in-out {{ Request::is('project') ? 'w-full' : 'w-0 hover:w-full focus:w-full' }}"></span>
    </a>
  </li>
  <li role="none">
    <a href="{{ url('bootcamp') }}"
       role="menuitem"
       class="relative {{ Request::is('bootcamp') ? 'text-[#00d1aa]' : 'hover:text-[#00d1aa] focus:text-[#00d1aa]' }}">
      Bootcamp
      <span class="absolute bottom-0 left-0 h-[2px] bg-[#00c896] transition-all duration-300 ease-in-out {{ Request::is('bootcamp') ? 'w-full' : 'w-0 hover:w-full focus:w-full' }}"></span>
    </a>
  </li>
  <li role="none">
    <a href="{{ url('activity') }}"
       role="menuitem"
       class="relative {{ Request::is('activity') ? 'text-[#00d1aa]' : 'hover:text-[#00d1aa] focus:text-[#00d1aa]' }}">
      Activities
      <span class="absolute bottom-0 left-0 h-[2px] bg-[#00c896] transition-all duration-300 ease-in-out {{ Request::is('activity') ? 'w-full' : 'w-0 hover:w-full focus:w-full' }}"></span>
    </a>
  </li>
</ul>
    </nav>
  </header>

  <!-- User info -->
  <section class="flex items-center py-8 bg-white gap-6 pl-4 reveal">
  <img
    src="{{ asset('images/profilejohn.png') }}"
    alt="Profile Picture"
    class="w-24 h-24 rounded-full object-cover"
  />
  <div>
    <h2 class="text-2xl font-bold text-[#002147]">John Doe</h2>
    <p class="text-base text-gray-700 mt-1">Hi John! Welcome to SIKOMPIT</p>
      <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button
        type="submit"
        class="mt-3 px-6 py-2 rounded-lg bg-[#FF6F47] text-white font-semibold hover:bg-[#26e1bc] transition-colors"
      >
        LOGOUT
      </button>
    </form>
  </div>
</section>

<!-- Main Content -->
<main class="max-w-[1200px] mx-auto px-5 pb-20">

  <!-- Activities Section -->
<section class="flex flex-col-reverse md:flex-row md:justify-between md:items-start gap-10 mt-8">
    <div class="max-w-xs text-center md:text-left mt-19 ml-45">
        <h1 class="text-4xl font-bold mb-2">Activities</h1>
        <p class="text-lg text-[#28557c] mb-5">Your last Update Activity</p>
        <a href="{{ route('activity.index') }}" 
           class="inline-block bg-[#00d1aa] text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-[#26e1bc] transition-colors">
            See All
        </a>
    </div>

    <div class="flex-1 flex flex-col md:flex-row gap-8 mt-[-40px]">
      <!-- Pie Chart Section -->
        <div class="w-full md:w-1/2">
            <h2 class="text-2xl font-bold text-[#003366] text-center">Activity Distribution</h2>
            <div class="w-full mx-auto mt-2" style="height: 350px;">
                <canvas id="activityPieChart"></canvas>
            </div>
        </div>
        <!-- Recent Activities List -->
        <div class="w-full md:w-1/2 bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-[#003366] mb-6 flex items-center gap-2">
                Latest Entries
            </h2>
            <div class="space-y-4">
                @foreach($recentActivities as $activity)
                <div class="flex items-start space-x-4 p-4 bg-gray-50 hover:bg-gray-100 rounded-lg shadow-sm transition duration-200">
                    <div class="flex-shrink-0 mt-1">
                        @if($activity->jenis_daftar == 'project')
                            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-green-100 text-green-600 font-bold">
                                P
                            </div>
                        @else
                            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold">
                                B
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800">
                            @if($activity->jenis_daftar == 'project')
                                {{ $activity->posisi ?? 'N/A' }}
                            @else
                                {{ $activity->nama_bootcamp ?? 'N/A' }}
                            @endif
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">
                            @if($activity->jenis_daftar == 'project')
                                Perusahaan: <span class="text-gray-800 font-medium">{{ $activity->perusahaan_mitra}}</span>
                            @else
                                Penyedia: <span class="text-gray-800 font-medium">{{ $activity->activity_type }}</span>
                            @endif
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
    </div>
</section>

</main>

<!-- Projects -->
  <section class="bg-white px-12 py-4 max-w-[1200px] mx-auto reveal">
    <div
      class="flex flex-wrap justify-center items-center gap-5 mb-2">
      <div class="max-w-[300px] rounded-lg overflow-hidden">
        <img src="images/Logo2.png" alt="Logo" class="w-full" />
      </div>
      <div class="max-w-[400px] text-left">
        <h2 class="text-4xl text-[#003366] font-bold mb-2.5">PROJECT AVAILABLE</h2>
        <p class="text-lg text-[#444] mb-5">Increase your experience by joining our project</p>
        <a href="{{ route('project.index') }}"  class="inline-block bg-[#00d1aa] text-white px-6 py-3 rounded-md font-bold hover:bg-[#009e7f] transition-colors duration-300">View All</a>
      </div>
    </div>

    <div
      class="flex flex-wrap justify-center gap-7 mt-5">
<main class="p-8">
  <section class="projects-section fade-up reveal">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @if($projects->count() > 0)
        @foreach($projects->take(3) as $project) <!-- Display only 3 projects -->
          <div class="bg-white shadow-lg rounded-lg p-4 reveal">
            
            <div class="relative">
               <!-- Manually Add Badges for UI -->
                        @if($loop->index == 0)
                            <span class="absolute top-2.5 left-2.5 bg-[#00d1aa] text-white px-2.5 py-1 text-xs rounded-md font-bold z-10">Trending</span>
                        @elseif($loop->index == 1)
                            <span class="absolute top-2.5 left-2.5 bg-[#00d1aa] text-white px-2.5 py-1 text-xs rounded-md font-bold z-10">New</span>
                        @else
                            <span class="absolute top-2.5 left-2.5 bg-[#00d1aa] text-white px-2.5 py-1 text-xs rounded-md font-bold z-10">Popular</span>
                        @endif
              <img src="{{ asset('images/PROJECT.png') }}" alt="Project" class="w-full h-48 object-cover rounded-t-lg">
                    </div>
            <div class="mt-4">
              <div class="flex justify-between items-center">
                <div>
                  <h3 class="text-xl text-[#003366] font-bold">{{ $project->posisi }}</h3>
                  <p class="text-sm text-gray-500">{{ $project->perusahaan_mitra }} • Jakarta, ID</p>
                </div>
                <p class="text-teal-500 text-lg font-semibold">Rp{{ number_format($project->biaya, 0, ',', '.') }}<span class="text-sm">/project</span></p>
              </div>
              <div class="flex gap-2 mt-3">
                <span class="bg-teal-100 text-teal-800 text-xs py-1 px-2 rounded-md">Entry Level</span>
                <span class="bg-yellow-100 text-yellow-800 text-xs py-1 px-2 rounded-md">Full Time</span>
                <span class="bg-pink-100 text-pink-800 text-xs py-1 px-2 rounded-md">Remote</span>
              </div>
              <p class="mt-4 text-sm text-gray-600">Periode: {{ $project->jangka_waktu }}</p>
              <p class="text-gray-700 text-sm mt-2">{{ \Illuminate\Support\Str::limit($project->deskripsi_proyek, 120, '...') }}</p>

              <div class="mt-4 flex justify-between">
                <a href="{{ route('project.index') }}" class="bg-teal-500 text-white py-2 px-4 rounded-lg text-sm">Selengkapnya</a>
                <a href="{{ route('project.index') }}" class="bg-[#003366] text-white py-2 px-4 rounded-lg text-sm">
                  <span class="text-[#003366] ">44</span> Daftar <span class="text-[#003366] ">44</span>
                </a>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <p>Belum ada proyek tersedia saat ini.</p>
      @endif
    </div>
  </section>
</main>

    </div>
  </section>

  <!-- Bootcamp Section -->
  <section class="bg-white py-16 px-5 text-center max-w-[1200px] mx-auto">
    <div
      class="flex flex-wrap justify-center items-center gap-10 mb-16">
      <div class="max-w-[300px] rounded-lg overflow-hidden shadow-lg reveal">
        <img src="images/IT.png" alt="IT Bootcamp" class="w-full" />
      </div>
      <div class="max-w-[400px] text-left reveal delay-100">
        <h2 class="text-4xl text-[#003366] font-bold mb-2.5">IT BOOTCAMP</h2>
        <p class="text-lg text-[#444] mb-5">Explore your abilities with our bootcamp</p>
        <a href="{{ route('bootcamp.index') }}"  class="inline-block bg-[#00d1aa] text-white px-6 py-3 rounded-md font-bold hover:bg-[#009e7f] transition-colors duration-300">View Details</a>
      </div>
    </div>

    <div
      class="grid grid-cols-[repeat(auto-fit,minmax(280px,1fr))] gap-7 max-w-[1200px] mx-auto">

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 reveal">
        @if($bootcamps->count() > 0)
            @foreach($bootcamps->take(3) as $bootcamp) <!-- Display only 3 bootcamps -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden reveal">
                    <div class="relative">
                        <!-- Manually Add Badges for UI -->
                        @if($loop->index == 0)
                            <span class="absolute top-2.5 left-2.5 bg-[#00d1aa] text-white px-2.5 py-1 text-xs rounded-md font-bold z-10">Trending</span>
                        @elseif($loop->index == 1)
                            <span class="absolute top-2.5 left-2.5 bg-[#00d1aa] text-white px-2.5 py-1 text-xs rounded-md font-bold z-10">New</span>
                        @else
                            <span class="absolute top-2.5 left-2.5 bg-[#00d1aa] text-white px-2.5 py-1 text-xs rounded-md font-bold z-10">Popular</span>
                        @endif
                        <img src="{{ asset('images/bootcamp.png') }}" alt="Bootcamp" class="w-full h-48 object-cover">
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-xl text-[#003366] font-bold">{{ $bootcamp->nama_bootcamp }}</h3>
                                <p class="text-sm text-gray-600 text-left ">{{ $bootcamp->penyedia }}</p>
                            </div>
                            <p class="text-teal-500 text-lg font-semibold">Rp{{ number_format($bootcamp->biaya, 0, ',', '.') }}</p>
                        </div>

                          <p class="text-sm text-gray-500 mt-2 text-left">Periode: 
                              {{ \Carbon\Carbon::parse($bootcamp->tanggal_mulai)->format('d F Y') }} - 
                              {{ \Carbon\Carbon::parse($bootcamp->tanggal_selesai)->format('d F Y') }}
                          </p>

                          <p class="text-sm text-gray-600 mt-3 text-left">{{ \Illuminate\Support\Str::limit($bootcamp->deskripsi, 120, '...') }}</p>


                        <div class="flex justify-between mt-6"> 
                            <a href="{{ route('bootcamp.index') }}" class="text-white bg-teal-500 py-2 px-6 rounded-lg text-sm" >Selengkapnya</a>
                            <a href="{{ route('bootcamp.index') }}" class="text-white bg-[#003366] py-2 px-6 rounded-lg text-sm">
                                <span class="text-[#003366] ">44</span> Daftar <span class="text-[#003366] ">44</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-left text-gray-600">Belum ada bootcamp tersedia saat ini.</p>
        @endif
    </div>
</section>

  <!-- Sikompit Team Section -->
  <section
    class="bg-white border-b border-gray-200 py-10 flex justify-center max-w-[1200px] mx-auto reveal">
    <div
      class="flex flex-wrap justify-between items-center gap-5 max-w-[1000px] w-full">
      <img src="images/TIM.png" alt="Sikompit Team" class="w-[100px] h-[100px] rounded-full object-cover" />
      <div class="flex-1 flex flex-col justify-center reveal">
        <h2 class="text-[#003366] text-2xl m-0">Sikompit Team</h2>
        <p class="text-gray-600">Passionate professionals ready to guide you</p>
      </div>
      <a href="#"
        class="bg-[#003366] text-white px-5 py-2.5 rounded-lg inline-block whitespace-nowrap reveal">Meet the Team</a>
    </div>
  </section>

  <!-- Client Testimonials Section -->
  <section class="text-center py-16 max-w-[1200px] mx-auto px-5 reveal">
    <h2 class="text-4xl text-[#003366] mb-2.5 font-semibold">Client Testimonials</h2>
    <p class="mb-5">See what our clients have to say</p>
    <button
      class="bg-[#003366] text-white px-6 py-3 rounded-lg mb-10 hover:bg-[#002f6c] transition-colors duration-300">Read
      All Reviews</button>

    <div class="flex flex-wrap justify-center gap-7 reveal">
      <div
        class="bg-[#e9e8e8] rounded-lg p-5 w-[300px] text-left">
        <div class="flex items-center gap-2.5 mb-2.5">
          <img src="images/JOHN.png" alt="John Doe" class="w-10 h-10 rounded-full object-cover" />
          <strong>John Doe</strong>
        </div>
        <div class="text-yellow-400 mb-2.5">★★★★★</div>
        <p>Great services, highly recommended!</p>
      </div>

      <div
        class="bg-[#e9e8e8] rounded-lg p-5 w-[300px] text-left reveal">
        <div class="flex items-center gap-2.5 mb-2.5">
          <img src="images/JANE.png" alt="Jane Smith" class="w-10 h-10 rounded-full object-cover" />
          <strong>Jane Smith</strong>
        </div>
        <div class="text-yellow-400 mb-2.5">★★★★★</div>
        <p>Professional team with excellent communication</p>
      </div>

      <div
        class="bg-[#e9e8e8] rounded-lg p-5 w-[300px] text-left reveal">
        <div class="flex items-center gap-2.5 mb-2.5">
          <img src="images/DAVID.png" alt="David Brown" class="w-10 h-10 rounded-full object-cover" />
          <strong>David Brown</strong>
        </div>
        <div class="text-yellow-400 mb-2.5">★★★★★</div>
        <p>Quality work delivered on time</p>
      </div>
    </div>
  </section>


  <!-- CONTACT Section -->
  <section
    class="bg-white py-16 px-10 max-w-[1200px] mx-auto reveal">
    <div
      class="flex flex-wrap justify-between gap-10 max-w-[1200px] mx-auto reveal">
      <div class="flex-1 min-w-[300px]">
        <h2 class="text-[#002f6c] text-4xl mb-2.5 font-semibold">Contact Us</h2>
        <p class="text-[#3a4a5b] text-lg">Have a query or need assistance? Reach out to us.</p>
      </div>
      <form
        class="flex-1 min-w-[300px] flex flex-col">
        <label for="name" class="font-semibold mt-4 text-[#002f6c]">Name</label>
        <input
          type="text" id="name" placeholder="Enter your name" required
          class="rounded-lg border border-gray-300 p-3 mt-1 text-base" />
        <small class="text-gray-400 mb-2.5">Required</small>

        <label for="email" class="font-semibold mt-4 text-[#002f6c]">Email</label>
        <input
          type="email" id="email" placeholder="Enter your email address" required
          class="rounded-lg border border-gray-300 p-3 mt-1 text-base" />
        <small class="text-gray-400 mb-2.5">Required</small>

        <label for="message" class="font-semibold mt-4 text-[#002f6c]">Message</label>
        <textarea
          id="message" rows="4" maxlength="500" placeholder="Type your message here"
          class="rounded-lg border border-gray-300 p-3 mt-1 text-base"></textarea>
        <small class="text-gray-400 mb-2.5">Max 500 characters</small>

        <button
          type="submit"
          class="bg-[#003c78] hover:bg-[#002f6c] text-white rounded-lg p-3 text-lg mt-5 cursor-pointer transition-colors duration-300">
          Send Message
        </button>
      </form>
    </div>
  </section>
  </main>
<footer class="bg-[#003c78] py-6 text-center w-full">
  <ul class="flex justify-center gap-8 flex-wrap m-0 p-0">
    <li><a href="#" class="font-bold text-white no-underline">About Us</a></li>
    <li><a href="#" class="font-bold text-white no-underline">Services</a></li>
    <li><a href="#" class="font-bold text-white no-underline">Contact</a></li>
    <li><a href="#" class="font-bold text-white no-underline">Privacy Policy</a></li>
  </ul>
</footer>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Data yang dikirim dari controller
        const initialData = JSON.parse('{!! json_encode($dataForPieChart) !!}');

        // Membuat grafik pie dengan Chart.js
        const ctx = document.getElementById('activityPieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Projects', 'Bootcamps'],
                datasets: [{
                    data: [initialData.project, initialData.bootcamp],
                    backgroundColor: ['#00c4b3', '#003366'],
                    borderColor: ['#fff', '#fff'],
                    borderWidth: 2,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: { size: 14 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw} entries`;
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    });
</script>
@endpush
</body>

</html>