<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Activity | SIKOMPIT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @extends('layouts.app')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-white text-blue-900 overflow-x-hidden">
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}", 
            showConfirmButton: false,
            timer: 2500
        });
    </script>
@endif
    <!-- Header/Navbar -->
    <header class="sticky top-0 z-50 bg-[#003366]">
        <nav class="flex items-center justify-between py-5 shadow-md px-4">
            <!-- Logo dan Nama Aplikasi -->
            <div class="flex items-center space-x-3 text-white font-bold text-2xl">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo SIKOMPIT" class="h-10" />
                <span>SIKOMPIT</span>
            </div>
        
            <div class="flex-grow max-w-xl mx-12 relative">
                <form action="{{ route('activity.index') }}" method="GET" class="flex items-center" onsubmit="searchActivity(); return false;">
                    <input
                        type="text"
                        name="keyword"
                        id="searchKeyword"
                        placeholder="search what you looking for..." 
                        value="{{ request('keyword') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full bg-white text-black focus:outline-none focus:ring-2 focus:ring-teal-500"
                    />
                    <button
                        type="submit"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-[#003366] hover:text-[#003366] p-2 rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500"
                        aria-label="Search"
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

    <!-- Main Content -->
    <main class="px-8">
        <h2 class="text-2xl font-bold mt-8 mb-5 text-blue-900 reveal">Your Activity</h2>
        
        <!-- Filters -->
        <div class="flex justify-end gap-4 mb-4 reveal">
            <div class="flex items-center">
                <label for="jenisFilter" class="mr-2 font-bold whitespace-nowrap">Filter Jenis Daftar:</label>
                <select id="jenisFilter" onchange="filterProjects()" class="px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">Semua Jenis</option>
                    <option value="project">Project</option>
                    <option value="bootcamp">Bootcamp</option>
                </select>
            </div>
            
            <div class="flex items-center">
                <label for="statusFilter" class="mr-2 font-bold whitespace-nowrap">Filter Status Proyek:</label>
                <select id="statusFilter" onchange="filterProjects()" class="px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">Semua Status</option>
                    <option value="terdaftar">Terdaftar</option>
                    <option value="belum_diajukan">Belum Diajukan</option>
                    <option value="diajukan">Diajukan</option>
                    <option value="diterima">Diterima</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>
        </div>

        <!-- Projects Container -->
        <div id="project-container" class="space-y-5 mb-24 reveal">
            <div id="no-data-message" class="hidden text-center text-lg text-gray-500 mt-5">Data tidak ditemukan</div>
            
            @foreach ($activities as $project)
            @php
                $statusClass = str_replace(' ', '_', strtolower($project->status_pengajuan));
                $statusText = $project->status_pengajuan;
                $disabled = ($project->jenis_daftar === 'bootcamp' && $project->status_pengajuan === 'TERDAFTAR') || 
                ($project->jenis_daftar === 'project' && $project->status_pengajuan !== 'BELUM DIAJUKAN');
                $icons = ['🟩', '🟨', '🟥', '🟦', '🟪', '⬛️', '⬜️', '🟫'];
                $icon = $icons[array_rand($icons)];
                $jenisClass = strtolower($project->jenis_daftar) === 'bootcamp' ? 'bg-blue-700' : 'bg-green-600';
            @endphp
            
            <div class="project-card relative bg-white p-5 rounded-xl shadow-lg reveal"
                data-status="{{ $statusClass }}"
                data-jenis="{{ strtolower($project->jenis_daftar) }}">
                <!-- Jenis Badge -->
                <span class="absolute top-3 left-3 px-2 py-1 rounded text-xs font-bold text-white {{ $jenisClass }} z-10">
                    {{ ucfirst($project->jenis_daftar) }}
                </span>
                
                <!-- Project Header -->
                <div class="flex justify-between items-center mb-3 reveal">
                  <div class="flex items-center reveal">
                    <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-lg text-2xl mr-4">{{ $icon }}</div>
                    <div>
                      <div class="font-bold">{{ $project->posisi }}</div>
                      <div class="text-[#003366] text-sm reveal">
                        @if(strtolower($project->jenis_daftar) === 'bootcamp')
                          <span class="font-bold">{{ $project->perusahaan_mitra }} · {{ $project->nama }}</span>
                        @else
                          {{ $project->perusahaan_mitra }} · {{ $project->nama }}
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="font-bold text-blue-500">Rp{{ number_format($project->biaya, 0, ',', '.') }} /month</div>
                </div>

                <!-- Date -->
                <div class="text-gray-500 text-xs mb-3">{{ $project->jangka_waktu }}</div>
                
                <!-- Description -->
                <div class="text-gray-700 text-sm mb-4">{{ $project->deskripsi_proyek }}</div>
                
                <!-- Status and Actions -->
                <div class="flex justify-between items-center">
                    <!-- Status Badge di tengah -->
                    <div class="flex-1 flex justify-center items-center" style="height: 40px;">
                        <div class="px-3 py-1 rounded-2xl text-xs font-bold uppercase
                            @if($statusClass === 'belum_diajukan') bg-purple-200 text-purple-800
                            @elseif($statusClass === 'diajukan') bg-yellow-200 text-yellow-800
                            @elseif($statusClass === 'diterima') bg-green-200 text-green-800
                            @elseif($statusClass === 'ditolak') bg-red-200 text-red-800
                            @elseif($statusClass === 'terdaftar') bg-green-500 text-white
                            @endif
                            flex items-center justify-center h-full">
                            {{ $statusText }}
                        </div>
                    </div>

                    <!-- Action Icons -->
                    <div class="flex gap-3 reveal">
                        <!-- Submit Button -->
                        @if($project->status_pengajuan === 'BELUM DIAJUKAN')
                        <span class="cursor-pointer hover:scale-110 transition ajukan-btn reveal" data-id="{{ $project->id }}">🔼</span>
                        @else
                            <span class="opacity-40 cursor-not-allowed">🔼</span>
                        @endif
                        
                        <!-- Delete Button -->
                        <span class="cursor-pointer hover:scale-110 hover:text-red-500 transition hapus-btn reveal" data-id="{{ $project->id }}">🗑️</span>
                        
                        <!-- Edit Button -->
                        @if($project->status_pengajuan === 'BELUM DIAJUKAN')
                            <a href="{{ route('activity.edit', $project->id) }}" class="cursor-pointer hover:scale-110 transition reveal">✏️</a>
                        @else
                            <span class="opacity-40 cursor-not-allowed">✏️</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full bg-[#003366] text-white py-4 text-center mt-12">
        <ul class="flex justify-center gap-8">
          <li><a href="#">About Us</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="#">Privacy Policy</a></li>
        </ul>
    </footer>


    <script>
        function filterProjects() {
            const statusFilter = document.getElementById("statusFilter").value;
            const jenisFilter = document.getElementById("jenisFilter").value;
            const projects = document.querySelectorAll(".project-card");
            let visibleCount = 0;

            projects.forEach(project => {
                const projectStatus = project.getAttribute('data-status');
                const projectJenis = project.getAttribute('data-jenis');

                const statusMatch = statusFilter === "all" || projectStatus === statusFilter;
                const jenisMatch = jenisFilter === "all" || projectJenis === jenisFilter;

                if (statusMatch && jenisMatch) {
                    project.style.display = "block";
                    visibleCount++;
                } else {
                    project.style.display = "none";
                }
            });

            document.getElementById("no-data-message").style.display = 
                visibleCount === 0 ? "block" : "none";
            
            console.log('Filter applied:', {
                status: statusFilter,
                jenis: jenisFilter,
                visible: visibleCount
            });
        }

       function hapusData(id) {
    if (confirm("Yakin ingin menghapus data ini?")) {
        fetch(`/activity/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ _method: 'DELETE' })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message || 'Data berhasil dihapus!',
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire('Gagal', data.message || 'Terjadi kesalahan', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Oops', error.message || 'Terjadi kesalahan saat menghapus data', 'error');
        });
    }
}


        function ajukanData(id) {
            if (confirm("Yakin ingin mengajukan proyek ini?")) {
                window.location.href = `/ajukan/${id}`;
            }
        }

        function searchActivity() {
            const keyword = document.getElementById("searchKeyword").value;
            const url = `/activity?keyword=${encodeURIComponent(keyword)}`;
            
            // Redirect dengan parameter pencarian
            window.location.href = url;
        }

        document.addEventListener("DOMContentLoaded", function () {
            // Inisialisasi filter saat halaman dimuat
            filterProjects();

            // Event listeners untuk tombol aksi
            document.querySelectorAll('.hapus-btn').forEach(btn => {
                btn.addEventListener('click', () => hapusData(btn.dataset.id));
            });

            document.querySelectorAll('.ajukan-btn').forEach(btn => {
                btn.addEventListener('click', () => ajukanData(btn.dataset.id));
            });
        });
    </script>
</body>
</html>