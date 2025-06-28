<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>@yield('title') | SIKOMPIT</title>

    <!-- CSS Utama -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    @stack('styles')

    <!-- CSS Reveal Animation -->
 <style>
.reveal {
  opacity: 0;
  transform: translateY(4px);
  transition: opacity 1.4s cubic-bezier(0.4, 0, 0.2, 1),
              transform 1.4s cubic-bezier(0.4, 0, 0.2, 1);
  will-change: opacity, transform;
}

.reveal.active {
  opacity: 1;
  transform: translateY(0);
}

.delay-100 { transition-delay: 0.1s; }
.delay-200 { transition-delay: 0.2s; }
.delay-300 { transition-delay: 0.3s; }
.delay-400 { transition-delay: 0.4s; }
.delay-500 { transition-delay: 0.5s; }
</style
</head>
<body>
    <!-- JS Utama -->
    <script src="{{ asset('js/app.js') }}"> </script>
    @stack('scripts')

    <!-- Script untuk Reveal Effect -->
    <script>
document.addEventListener("DOMContentLoaded", function () {
  const revealElements = document.querySelectorAll(".reveal");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        // Tambahkan class active secara halus menggunakan requestAnimationFrame
        window.requestAnimationFrame(() => {
          entry.target.classList.add("active");
          observer.unobserve(entry.target);
        });
      }
    });
  }, {
    threshold: 0.15,  // Trigger ketika 15% elemen terlihat
    rootMargin: "0px 0px -30px 0px" // Sedikit lebih longgar supaya trigger lebih smooth
  });

  revealElements.forEach((el) => observer.observe(el));
});
</script>

</body>
</html>
