<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Project | SIKOMPIT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @extends('layouts.app')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="bg-white text-[#003366] font-sans overflow-x-hidden">

  <!-- Header Navbar -->
  <header class="sticky top-0 z-50 bg-[#003366]">
    <nav class="flex items-center justify-between py-5 shadow-md px-4">
      <!-- Logo dan Nama Aplikasi -->
      <div class="flex items-center space-x-3 text-white font-bold text-2xl">
        <img src="{{ asset('images/Logo.png') }}" alt="Logo SIKOMPIT" class="h-10" />
        <span>SIKOMPIT</span>
      </div>

     <div class="flex-grow max-w-xl mx-12 relative">
    <form action="{{ route('project.index') }}" method="GET" class="flex items-center">
        <input
            type="text"
            name="keyword"
            placeholder="search what you looking for..." 
            value="{{ request('keyword') }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-full bg-white text-black focus:outline-none focus:ring-2 focus:ring-teal-500"
        />
        <button
            type="button" 
            class="absolute right-3 top-1/2 -translate-y-1/2 text-[#003366] hover:text-[#003366] p-2 rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500"
            aria-label="Search"
            onclick="searchProjects()" 
        >
            <i class="fa fa-search text-lg"></i>
        </button>
    </form>
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

  <section class="flex items-center py-8 bg-white gap-6 pl-4 reveal">
    <img src="{{ asset('images/profilejohn.png') }}" alt="Profile Picture" class="w-24 h-24 rounded-full object-cover" />
    <div>
      @if(Auth::check())
        <p class="text-lg font-semibold text-[#003366]">Halo, {{ Auth::user()->name }}</p>
      @else
        <p class="text-lg font-bold text-[#003366]">Halo, John Doe!</p>
      @endif

      <div class="flex gap-2 my-2">
        <span class="bg-teal-500 text-white text-xs py-1 px-3 rounded-md">Developer</span>
        <span class="bg-teal-500 text-white text-xs py-1 px-3 rounded-md">Tech Enthusiast</span>
      </div>

      <p class="text-black">Passionate about coding and learning new technologies</p>
    </div>
  </section>

  <main class="p-8">
    <section class="projects-section fade-up reveal">
      <h2 class="text-3xl font-bold text-[#003366] text-center mb-12">Project yang Tersedia</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @if($projects->count() > 0)
          @foreach($projects as $project)
            <div class="bg-white shadow-lg rounded-lg p-4 reveal">
              <div class="relative">
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
                  <a href="#" class="bg-teal-500 text-white py-2 px-4 rounded-lg text-sm" onclick="openModal('{{ $project->id }}')">Selengkapnya</a>
                  <a href="{{ route('register.form', ['id_list' => $project->id, 'jenis' => 'project']) }}" class="bg-[#003366] text-white py-2 px-4 rounded-lg text-sm">
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

      <div class="pagination fade-up mt-8 text-center">
          @if ($projects->onFirstPage())
              <span class="inline-block py-2 px-4 text-sm bg-gray-200 rounded-lg text-gray-500">&laquo;</span>
          @else
              <a href="{{ $projects->previousPageUrl() }}" class="inline-block py-2 px-4 text-sm bg-gray-200 rounded-lg hover:bg-teal-500 hover:text-white">&laquo;</a>
          @endif

          @foreach ($projects->getUrlRange(1, $projects->lastPage()) as $page => $url)
              @if ($page == $projects->currentPage())
                  <span class="inline-block py-2 px-4 text-sm bg-teal-500 text-white rounded-lg">{{ $page }}</span>
              @else
                  <a href="{{ $url }}" class="inline-block py-2 px-4 text-sm bg-gray-200 rounded-lg hover:bg-teal-500 hover:text-white">{{ $page }}</a>
              @endif
          @endforeach

          @if ($projects->hasMorePages())
              <a href="{{ $projects->nextPageUrl() }}" class="inline-block py-2 px-4 text-sm bg-gray-200 rounded-lg hover:bg-teal-500 hover:text-white">&raquo;</a>
          @else
              <span class="inline-block py-2 px-4 text-sm bg-gray-200 rounded-lg text-gray-500">&raquo;</span>
          @endif
      </div>
    </section>

    <section class="partners fade-up mt-12 text-center reveal">
      <h2 class="text-2xl font-bold text-[#003366]">Top Partnered Companies</h2>
      <p class="text-sm text-gray-500 mt-2">Trusted companies actively hiring valid tech talents</p>
      <div class="flex justify-center gap-10 mt-8 flex-wrap">
        <img src="{{ asset('images/partner1.png') }}" alt="Partner 1" class="h-16 object-contain" />
        <img src="{{ asset('images/partner2.png') }}" alt="Partner 2" class="h-16 object-contain" />
        <img src="{{ asset('images/partner3.png') }}" alt="Partner 3" class="h-16 object-contain" />
        <img src="{{ asset('images/partner4.png') }}" alt="Partner 4" class="h-16 object-contain" />
      </div>
    </section>
  </main>

  <footer class="bg-[#003366] text-white py-4 text-center mt-12">
    <ul class="flex justify-center gap-8">
      <li><a href="#">About Us</a></li>
      <li><a href="#">Services</a></li>
      <li><a href="#">Contact</a></li>
      <li><a href="#">Privacy Policy</a></li>
    </ul>
  </footer>

  {{-- Modal Template --}}
<div class="modal fixed inset-0 flex justify-center items-center hidden" id="projectModal">
    <div class="modal-content bg-white p-6 rounded-lg shadow-lg max-w-3xl w-full">
        <span class="close-btn absolute top-3 right-3 text-2xl cursor-pointer text-black" onclick="closeModal()">&times;</span>
        <div class="modal-body" id="modal-body-content">
            {{-- Isi detail project dimuat via JavaScript --}}
        </div>
    </div>
</div>

  <script>
    function openModal(id) {
      fetch(`/project/detail/${id}`)
        .then(response => response.json())
        .then(data => {
          const modalBody = document.getElementById("modal-body-content");
          modalBody.innerHTML = `
            <img src="/images/PROJECT.png" alt="Header" class="w-full h-48 object-cover rounded-t-lg">
            <div class="p-4">
              <h2 class="text-xl font-bold text-[#003366]">${data.posisi}</h2>
                <p class="text-black"><strong>Penyedia:</strong> ${data.perusahaan_mitra}</p>
                    <p class="text-black"><strong>Biaya:</strong> Rp${data.biaya}</p>
                    <p class="text-black"><strong>Deskripsi:</strong> ${data.deskripsi_proyek}</p>
                    <p class="text-black"><strong>Periode:</strong> ${data.jangka_waktu}</p>
                    <p class="text-black"><strong>Lokasi:</strong> Jakarta, ID</p>
            </div>
          `;
          document.getElementById("projectModal").classList.remove("hidden");
        });
    }

    function closeModal() {
    document.getElementById("projectModal").classList.add("hidden");
}


    window.onclick = function (event) {
        const modal = document.getElementById("projectModal");
        if (event.target == modal) {
            modal.classList.add("hidden");
        }
    }
  </script>
</body>
</html>
