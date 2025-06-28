<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Bootcamp | SIKOMPIT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @extends('layouts.app')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<!-- Header Navbar -->
  <header class="sticky top-0 z-50 bg-[#003366]">
        <nav class="flex items-center justify-between py-5 shadow-md px-4">
    <!-- Logo dan Nama Aplikasi -->
    <div class="flex items-center space-x-3 text-white font-bold text-2xl">
      <img src="{{ asset('images/Logo.png') }}" alt="Logo SIKOMPIT" class="h-10" />
      <span>SIKOMPIT</span>
    </div>

     <div class="flex-grow max-w-xl mx-12 relative">
    <form action="{{ route('bootcamp.index') }}" method="GET" class="flex items-center">
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
  <img
    src="{{ asset('images/profilejohn.png') }}"
    alt="Profile Picture"
    class="w-24 h-24 rounded-full object-cover"
  />
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

<main>
 
    <section class="py-16 px-6 bg-white">
        <h2 class="text-3xl font-bold text-[#003366]  text-center mb-12">Bootcamp yang Tersedia</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 reveal">
            @if($bootcamps->count() > 0)
                @foreach($bootcamps as $bootcamp)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden reveal">
                        <div class="relative">
                            <img src="{{ asset('images/bootcamp.png') }}" alt="Bootcamp" class="w-full h-48 object-cover">
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-xl text-[#003366]  font-bold">{{ $bootcamp->nama_bootcamp }}</h3>
                                    <p class="text-sm text-gray-600">{{ $bootcamp->penyedia }}</p>
                                </div>
                                <p class="text-teal-500 text-lg font-semibold">Rp{{ number_format($bootcamp->biaya, 0, ',', '.') }}</p>
                            </div>

                            <p class="text-sm text-gray-500 mt-2">Periode: 
                                {{ \Carbon\Carbon::parse($bootcamp->tanggal_mulai)->format('d F Y') }} - 
                                {{ \Carbon\Carbon::parse($bootcamp->tanggal_selesai)->format('d F Y') }}
                            </p>

                            <p class="text-sm text-gray-600 mt-3">{{ \Illuminate\Support\Str::limit($bootcamp->deskripsi, 120, '...') }}</p>

                            <div class="flex justify-between mt-6"> 
                                <a href="#" class="text-white bg-teal-500 py-2 px-6 rounded-lg text-sm" onclick="openModal('{{$bootcamp->id}}')">Selengkapnya</a>
                                <a href="{{ route('register.form', ['id_list' => $bootcamp->id, 'jenis' => 'bootcamp']) }}" class="text-white bg-[#003366] py-2 px-6 rounded-lg l text-sm">
                                    <span class="text-[#003366] ">44</span> Daftar <span class="text-[#003366] ">44</span>
                                </a>
                            </div>
                             </div>
                    </div>
                @endforeach

                {{ $bootcamps->links() }} {{-- pagination links --}}
            @else
                <p class="text-center text-gray-600">Belum ada bootcamp tersedia saat ini.</p>
            @endif
        </div>
        <!-- Pagination -->
    <div class="pagination fade-up mt-8 text-center">
        {{-- Previous Page Link --}}
        @if ($bootcamps->onFirstPage())
            <span class="inline-block py-2 px-4 text-sm bg-gray-200 rounded-lg text-gray-500">&laquo;</span>
        @else
            <a href="{{ $bootcamps->previousPageUrl() }}" class="inline-block py-2 px-4 text-sm bg-gray-200 rounded-lg hover:bg-teal-500 hover:text-white">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @php
            $current = $bootcamps->currentPage();
            $last = $bootcamps->lastPage();
            $start = max($current - 2, 1);
            $end = min($current + 2, $last);
        @endphp

        @if($start > 1)
            <a href="{{ $bootcamps->url(1) }}" class="inline-block py-2 px-4 text-sm bg-gray-200 rounded-lg hover:bg-teal-500 hover:text-white">1</a>
            @if($start > 2)
                <span class="inline-block py-2 px-4 text-sm">...</span>
            @endif
        @endif

        @for ($page = $start; $page <= $end; $page++)
            @if ($page == $bootcamps->currentPage())
                <span class="inline-block py-2 px-4 text-sm bg-teal-500 text-white rounded-lg">{{ $page }}</span>
            @else
                <a href="{{ $bootcamps->url($page) }}" class="inline-block py-2 px-4 text-sm bg-gray-200 rounded-lg hover:bg-teal-500 hover:text-white">{{ $page }}</a>
            @endif
        @endfor

        @if($end < $last)
            @if($end < $last - 1)
                <span class="inline-block py-2 px-4 text-sm">...</span>
            @endif
            <a href="{{ $bootcamps->url($last) }}" class="inline-block py-2 px-4 text-sm bg-gray-200 rounded-lg hover:bg-teal-500 hover:text-white">{{ $last }}</a>
        @endif

        {{-- Next Page Link --}}
        @if ($bootcamps->hasMorePages())
            <a href="{{ $bootcamps->nextPageUrl() }}" class="inline-block py-2 px-4 text-sm bg-gray-200 rounded-lg hover:bg-teal-500 hover:text-white">&raquo;</a>
        @else
            <span class="inline-block py-2 px-4 text-sm bg-gray-200 rounded-lg text-gray-500">&raquo;</span>
        @endif
    </div>
    </section>

    <footer class="bg-[#003366] text-white py-6">
        <ul class="flex justify-center space-x-8">
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
    fetch(`/bootcamp/detail/${id}`)
        .then(response => response.json())
        .then(data => {
            const modalBody = document.getElementById("modal-body-content");
            modalBody.innerHTML = `
                <img src="/images/bootcamp.png" alt="Header" class="w-full h-48 object-cover rounded-t-lg">
                <div class="p-4">
                    <h2 class="text-xl font-bold text-[#003366]">${data.nama_bootcamp}</h2>
                    <p><strong>Penyedia:</strong> ${data.penyedia}</p>
                    <p><strong>Biaya:</strong> Rp${data.biaya}</p>
                    <p><strong>Deskripsi:</strong> ${data.deskripsi}</p>
                    <p><strong>Tanggal:</strong> ${data.tanggal_mulai} - ${data.tanggal_selesai}</p>
                    <p><strong>Waktu Kelas:</strong> ${data.waktu_kelas}</p>
                    <p><strong>Hari Kelas:</strong> ${data.hari_kelas}</p>
                    <p><strong>Durasi:</strong> ${data.durasi}</p>
                    <p><strong>Silabus:</strong> ${data.silabus}</p>
                    <p><strong>Fasilitas:</strong> ${data.fasilitas}</p>
                    <p><strong>Mentor:</strong> ${data.mentor}</p>
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

    document.getElementById("searchInput").addEventListener("input", function() {
        searchBootcamps();
    });

    function searchBootcamps() {
        const keyword = document.getElementById("searchInput").value;
        const url = `/bootcamp?keyword=${encodeURIComponent(keyword)}`;
        
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            const parser = new DOMParser();
            const htmlDoc = parser.parseFromString(data.html, 'text/html');
            const newContent = htmlDoc.querySelector('.bootcamp-list').innerHTML;
            
            document.querySelector('.bootcamp-list').innerHTML = newContent;
        })
        .catch(error => console.error('Error:', error));
    }
</script>
</body>
</html>
