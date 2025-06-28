<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome | SIKOMPIT</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @extends('layouts.app')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    
</head>

<body class="font-poppins bg-white">

  @if(session('logout_success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'success',
        title: 'Logout Berhasil!',
        text: '{{ session("logout_success") }}',
        confirmButtonText: 'OK',
        confirmButtonColor: '#0d9488'
    });
});
</script>
@endif
  <!-- Header -->
  <header
    class="sticky top-0 z-50 bg-[#003366] px-7 py-9 flex items-center justify-between text-white">
    <div class="flex items-center">
      <img src="images/Logo.png" alt="Logo SIKOMPIT" class="h-10 mr-2.5" />
      <span class="text-2xl font-bold">SIKOMPIT</span>
    </div>
    <div class="flex items-center">
      <button
        class="ml-2.5 px-5 py-2 rounded-full bg-[#00d1aa] text-white text-lg transition-colors duration-300 hover:bg-white hover:text-[#003366]">
        SIGN UP
      </button>
      <a href="{{ url('login') }}"
        class="ml-2.5 px-5 py-2 rounded-full border-2 border-white text-white text-lg transition-colors duration-300 hover:bg-white hover:text-[#003366]">
        LOGIN
      </a>
    </div>
  </header>

  <!-- Main -->
  <main
    class="flex flex-wrap justify-center items-center gap-7 p-12 max-w-[1200px] mx-auto">
    <div class="flex-1 min-w-[300px] pr-7 reveal">
      <h1 class="text-4xl text-[#003366] mb-5 font-bold">
        Welcome to <span class="text-[#00d1aa]">SIKOMPIT</span>!
      </h1>
      <p class="text-lg mb-7 text-[#333]">Your destination for IT projects and bootcamps</p>
      <button
        class="bg-[#00d1aa] text-white py-3 px-6 rounded-lg text-lg transition-colors duration-300 hover:bg-[#009c94]">
        Explore Services
      </button>
    </div>
    <div class="flex-1 min-w-[300px] flex justify-center reveal">
      <img src="images/openlaptop.png" alt="Typing on Laptop" class="w-full max-w-[500px] h-auto " />
    </div>
  </main>

  <!-- Projects -->
  <section class="bg-white px-12 py-16 max-w-[1200px] mx-auto reveal">
    <div
      class="flex flex-wrap justify-center items-center gap-10 mb-16">
      <div class="max-w-[300px] rounded-lg overflow-hidden">
        <img src="images/Logo2.png" alt="Logo" class="w-full" />
      </div>
      <div class="max-w-[400px] text-left">
        <h2 class="text-4xl text-[#003366] font-bold mb-2.5">PROJECT AVAILABLE</h2>
        <p class="text-lg text-[#444] mb-5">Increase your experience by joining our project</p>
        <a href="#" class="inline-block bg-[#00d1aa] text-white px-6 py-3 rounded-md font-bold hover:bg-[#009e7f] transition-colors duration-300">View All</a>
      </div>
    </div>

    <div
      class="flex flex-wrap justify-center gap-7 mt-10">

      <!-- Card 1 -->
      <div
        class="bg-[#f4f6f8] rounded-2xl shadow-md w-[320px] flex flex-col overflow-hidden reveal">
        <div class="relative">
          <img src="images/PROJECT.png" alt="PROJECT" class="w-full rounded-t-2xl" />
          <span
            class="absolute top-2.5 left-2.5 bg-[#00c4b3] text-white text-xs px-2.5 py-1 rounded-full">Popular</span>
          <i
            class="fa-regular fa-bookmark absolute top-2.5 right-2.5 text-[#333] text-lg cursor-pointer"></i>
        </div>
        <div class="p-5 flex flex-col flex-grow">
          <div class="mb-2.5 w-full">
            <div class="flex items-start gap-2.5 flex-nowrap">
              <img src="images/MICRO.png" alt="MICRO" class="w-7.5 h-7.5" />
              <div class="flex-1 min-w-0">
                <div
                  class="flex justify-between items-center gap-2.5 flex-wrap">
                  <h3 class="text-[#003366] text-base m-0">Product Designer</h3>
                  <span class="text-[#003366] font-bold text-sm whitespace-nowrap">Rp3,5 Jt
                    <span class="text-[#666] font-normal text-xs">/month</span>
                  </span>
                </div>
                <p
                  class="text-xs text-[#888] mt-1 truncate whitespace-nowrap overflow-hidden">
                  Microsoft • Chicago, IL
                </p>
              </div>
            </div>
          </div>
          <div class="my-2.5">
            <span class="inline-block bg-green-600 text-white text-xs px-2.5 py-1 rounded-full mr-1">Entry Level</span>
            <span class="inline-block bg-yellow-500 text-white text-xs px-2.5 py-1 rounded-full mr-1">Full Time</span>
            <span class="inline-block bg-pink-600 text-white text-xs px-2.5 py-1 rounded-full">Remote</span>
          </div>
          <p class="text-xs text-[#666] mb-2.5 flex items-center gap-1.5"><i class="fa-regular fa-clock"></i> Jun 2025 - Dec 2025</p>
          <p
            class="text-sm text-[#333] mb-3 flex-grow">
            Responsible for crafting user-centered designs that blend functionality with visual appeal.
          </p>
          <div class="flex gap-2.5 mt-auto">
            <button
              class="flex-1 py-2 px-4 rounded-lg bg-[#00c4b3] text-white text-sm cursor-pointer">Read More</button>
            <button
              class="flex-1 py-2 px-4 rounded-lg bg-[#003366] text-white text-sm cursor-pointer">Apply</button>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div
        class="bg-[#f4f6f8] rounded-2xl shadow-md w-[320px] flex flex-col overflow-hidden reveal delay-100">
        <div class="relative">
          <img src="images/PROJECT.png" alt="PROJECT" class="w-full rounded-t-2xl" />
          <span
            class="absolute top-2.5 left-2.5 bg-[#00c4b3] text-white text-xs px-2.5 py-1 rounded-full">New</span>
          <i
            class="fa-regular fa-bookmark absolute top-2.5 right-2.5 text-[#333] text-lg cursor-pointer"></i>
        </div>
        <div class="p-5 flex flex-col flex-grow">
          <div class="mb-2.5 w-full">
            <div class="flex items-start gap-2.5 flex-nowrap">
              <img src="images/MICRO.png" alt="MICRO" class="w-7.5 h-7.5" />
              <div class="flex-1 min-w-0">
                <div
                  class="flex justify-between items-center gap-2.5 flex-wrap">
                  <h3 class="text-[#003366] text-base m-0">UI/UX Intern</h3>
                  <span class="text-[#003366] font-bold text-sm whitespace-nowrap">Rp2 Jt
                    <span class="text-[#666] font-normal text-xs">/month</span>
                  </span>
                </div>
                <p
                  class="text-xs text-[#888] mt-1 truncate whitespace-nowrap overflow-hidden">
                  Adobe • Jakarta, ID
                </p>
              </div>
            </div>
          </div>
          <div class="my-2.5">
            <span class="inline-block bg-green-600 text-white text-xs px-2.5 py-1 rounded-full mr-1">Internship</span>
            <span class="inline-block bg-yellow-500 text-white text-xs px-2.5 py-1 rounded-full mr-1">Part Time</span>
            <span class="inline-block bg-pink-600 text-white text-xs px-2.5 py-1 rounded-full">On Site</span>
          </div>
          <p class="text-xs text-[#666] mb-2.5 flex items-center gap-1.5"><i class="fa-regular fa-clock"></i> May 2025 - Aug 2025</p>
          <p
            class="text-sm text-[#333] mb-3 flex-grow">
            Assist in creating wireframes and prototypes while learning from experienced designers.
          </p>
          <div class="flex gap-2.5 mt-auto">
            <button
              class="flex-1 py-2 px-4 rounded-lg bg-[#00c4b3] text-white text-sm cursor-pointer">Read More</button>
            <button
              class="flex-1 py-2 px-4 rounded-lg bg-[#003366] text-white text-sm cursor-pointer">Apply</button>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div
        class="bg-[#f4f6f8] rounded-2xl shadow-md w-[320px] flex flex-col overflow-hidden reveal delay-200"">
        <div class="relative">
          <img src="images/PROJECT.png" alt="PROJECT" class="w-full rounded-t-2xl" />
          <span
            class="absolute top-2.5 left-2.5 bg-[#00c4b3] text-white text-xs px-2.5 py-1 rounded-full">Hot</span>
          <i
            class="fa-regular fa-bookmark absolute top-2.5 right-2.5 text-[#333] text-lg cursor-pointer"></i>
        </div>
        <div class="p-5 flex flex-col flex-grow">
          <div class="mb-2.5 w-full">
            <div class="flex items-start gap-2.5 flex-nowrap">
              <img src="images/MICRO.png" alt="MICRO" class="w-7.5 h-7.5" />
              <div class="flex-1 min-w-0">
                <div
                  class="flex justify-between items-center gap-2.5 flex-wrap">
                  <h3 class="text-[#003366] text-base m-0">Web Developer</h3>
                  <span class="text-[#003366] font-bold text-sm whitespace-nowrap">Rp4 Jt
                    <span class="text-[#666] font-normal text-xs">/month</span>
                  </span>
                </div>
                <p
                  class="text-xs text-[#888] mt-1 truncate whitespace-nowrap overflow-hidden">
                  Tokopedia • Bandung, ID
                </p>
              </div>
            </div>
          </div>
          <div class="my-2.5">
            <span class="inline-block bg-green-600 text-white text-xs px-2.5 py-1 rounded-full mr-1">Junior</span>
            <span class="inline-block bg-yellow-500 text-white text-xs px-2.5 py-1 rounded-full mr-1">Full Time</span>
            <span class="inline-block bg-pink-600 text-white text-xs px-2.5 py-1 rounded-full">Hybrid</span>
          </div>
          <p class="text-xs text-[#666] mb-2.5 flex items-center gap-1.5"><i class="fa-regular fa-clock"></i> Apr 2025 - Oct 2025</p>
          <p class="text-sm text-[#333] mb-3 flex-grow">
            Collaborate with the front-end team to build user-friendly and scalable web applications.
          </p>
          <div class="flex gap-2.5 mt-auto">
            <button
              class="flex-1 py-2 px-4 rounded-lg bg-[#00c4b3] text-white text-sm cursor-pointer">Read More</button>
            <button
              class="flex-1 py-2 px-4 rounded-lg bg-[#003366] text-white text-sm cursor-pointer">Apply</button>
          </div>
        </div>
      </div>

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
        <a href="#" class="inline-block bg-[#00d1aa] text-white px-6 py-3 rounded-md font-bold hover:bg-[#009e7f] transition-colors duration-300">View Details</a>
      </div>
    </div>

    <div
      class="grid grid-cols-[repeat(auto-fit,minmax(280px,1fr))] gap-7 max-w-[1200px] mx-auto">

      <div
        class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col h-full relative reveal delay-100">
        <span
          class="absolute top-2.5 left-2.5 bg-[#00d1aa] text-white px-2.5 py-1 text-xs rounded-md font-bold z-10">New</span>
        <img src="images/web.png" alt="Web Development" class="w-full h-[250px] object-cover block" />
        <div class="p-4 text-left">
          <h4 class="text-sm text-[#666] mb-1">Web Development</h4>
          <h3 class="text-lg font-bold text-black">Responsive & Interactive</h3>
        </div>
      </div>

      <div
        class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col h-full relative reveal delay-200">
        <span
          class="absolute top-2.5 left-2.5 bg-[#00d1aa] text-white px-2.5 py-1 text-xs rounded-md font-bold z-10">Trending</span>
        <img src="images/UI.png" alt="UI/UX Design" class="w-full h-[250px] object-cover block" />
        <div class="p-4 text-left">
          <h4 class="text-sm text-[#666] mb-1">UI/UX Design</h4>
          <h3 class="text-lg font-bold text-black">User-Centric</h3>
        </div>
      </div>

      <div
        class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col h-full relative reveal delay-300">
        <span
          class="absolute top-2.5 left-2.5 bg-[#00d1aa] text-white px-2.5 py-1 text-xs rounded-md font-bold z-10">Popular</span>
        <img src="images/mobile.png" alt="Mobile Development" class="w-full h-[250px] object-cover block" />
        <div class="p-4 text-left">
          <h4 class="text-sm text-[#666] mb-1">Mobile Development</h4>
          <h3 class="text-lg font-bold text-black">iOS & Android</h3>
        </div>
      </div>
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
  <footer
    class="bg-[#003c78] py-5 text-center">
    <ul
      class="flex justify-center gap-10 flex-wrap list-none m-0 p-0">
      <li><a href="#" class="font-bold text-white no-underline">About Us</a></li>
      <li><a href="#" class="font-bold text-white no-underline">Services</a></li>
      <li><a href="#" class="font-bold text-white no-underline">Contact</a></li>
      <li><a href="#" class="font-bold text-white no-underline">Privacy Policy</a></li>
    </ul>
  </footer>

</body>

</html>
