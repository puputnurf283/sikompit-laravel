<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>SIKOMPIT Login</title>
  @vite(['resources/css/app.css', 'resources/js/app.jsx'])
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<body class="bg-gray-100 flex justify-center items-center min-h-screen font-sans">

  <div class="flex w-4/5 max-w-5xl bg-white shadow-lg rounded-lg overflow-hidden">

    <!-- Login Form -->
    <div class="flex-1 p-12 flex flex-col justify-center">
  <div class="flex items-center gap-3 mb-4">
    <img src="{{ asset('images/Logo2.png') }}" alt="logo" class="w-10 h-auto" />
    <h2 class="text-2xl text-teal-600 font-semibold">SIKOMPIT</h2>
  </div>
  <p class="text-gray-700 mb-8 text-sm">Artificial Intelligence giving you travel recommendations</p>

  <div id="login-root"></div>
</div>


    <!-- Login Image -->
    <div class="flex-1 bg-gray-50 flex items-center justify-center">
      <img src="images/login_sikompit.png" alt="Decor" class="object-cover w-full h-full rounded-r-lg" />
    </div>

  </div>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}", 
        confirmButtonText: 'OK',
        confirmButtonColor: '#0d9488',
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal Login!',
        text: "{{ session('error') }}",  <!-- Gunakan double quote di sini -->
        confirmButtonText: 'Mengerti',
        confirmButtonColor: '#0d9488',
    });
</script>
@endif
</body>

</html>
