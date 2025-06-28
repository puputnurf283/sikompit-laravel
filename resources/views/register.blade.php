<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir SIKOMPIT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="bg-white text-[#003366]">

    <header>
        <nav class="flex justify-between items-center bg-[#003366] p-5 shadow-md">
            <div class="flex items-center text-white text-xl font-bold">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo SIKOMPIT" class="h-10 mr-2">
                <span>SIKOMPIT</span>
            </div>
        </nav>
    </header>

    <div class="max-w-5xl mx-auto mt-16 bg-white p-12 rounded-lg shadow-lg">
        <!-- Header Formulir diperpanjang -->
        <div class="flex justify-between items-center bg-[#6785a6] py-5 px-4 text-white font-bold rounded-t-lg">
            <h2 class="text-lg">FORMULIR</h2>
            <a href="{{ url()->previous() }}" class="text-white text-4xl">&times;</a>
        </div>

        @if ($errors->any())
            <div class="text-red-500 mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('register.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_list" value="{{ $idList }}">
            <input type="hidden" name="jenis_daftar" value="{{ $jenis }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
                <div>
                    <label for="nama" class="block mb-2 font-medium">Nama</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                        class="w-full p-3 border border-gray-300 rounded-lg text-base mb-6 focus:ring-2 focus:ring-[#003366] transition duration-300">

                    <label for="tanggal_lahir" class="block mb-2 font-medium">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                        class="w-full p-3 border border-gray-300 rounded-lg text-base mb-6 focus:ring-2 focus:ring-[#003366] transition duration-300">

                    <label for="status" class="block mb-2 font-medium">Status</label>
                    <input type="text" name="status" id="status" value="{{ old('status') }}" required
                        class="w-full p-3 border border-gray-300 rounded-lg text-base mb-6 focus:ring-2 focus:ring-[#003366] transition duration-300">
                </div>

                <div>
                    <label for="email" class="block mb-2 font-medium">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full p-3 border border-gray-300 rounded-lg text-base mb-6 focus:ring-2 focus:ring-[#003366] transition duration-300">

                    <label for="jenis_kelamin" class="block mb-2 font-medium">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" required
                        class="w-full p-3 border border-gray-300 rounded-lg text-base mb-6 focus:ring-2 focus:ring-[#003366] transition duration-300">
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>

                    <label for="portofolio" class="block mb-2 font-medium">
                        @if(strtolower($jenis) == 'bootcamp')
                            Kartu Pelajar
                        @else
                            Portofolio
                        @endif
                    </label>
                    <input type="file" name="portofolio" id="portofolio" required
                        class="w-full p-3 border border-gray-300 rounded-lg text-base mb-6 focus:ring-2 focus:ring-[#003366] transition duration-300">
                </div>
            </div>

            <div class="flex flex-wrap md:flex-row gap-4 mt-8">
                @if($isBootcamp)
                    <button type="submit"
                        class="bg-[#005b94] text-white py-3 px-6 rounded-lg hover:bg-[#004472] transition duration-300"
                        onclick="return confirm('Yakin ingin mendaftar bootcamp ini?')">Daftar</button>
                @else
                    <button type="submit" name="simpan"
                        class="bg-[#003366] text-white py-3 px-6 rounded-lg hover:bg-[#002244] transition duration-300"
                        onclick="return confirm('Yakin hanya menyimpan data? data yang disimpan belum diajukan, data dapat diedit kembali.')">Simpan</button>
                        <button type="submit" name="ajukan"
                        class="bg-[#005b94] text-white py-3 px-6 rounded-lg hover:bg-[#004472] transition duration-300"
                        onclick="return confirm('Yakin ingin mengajukan formulir? Data yang diajukan tidak bisa diedit kembali.')">Ajukan</button>
                @endif
            </div>
        </form>
    </div>

</body>
</html>