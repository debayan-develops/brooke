@php
    $pageTitle = 'Brooke Hennen - Freshest Details';
@endphp
@include('frontend.includes.header')
@include('frontend.includes.navbar')
  <!-- ------------------------------ HEADER SECTION ------------------------------ -->

  @include('frontend.includes.navbar')
  <!-- ------------------------------ MAIN CONTENT ------------------------------ --><!-- Hero Section -->
  <!-- Hero Section
  <section class="relative h-[60vh] bg-cover bg-center flex items-center justify-center text-center text-white animate-fadeInUp" style="background-image: url({{ asset('images/Indiana-Everglades-Icon-and-Banner-for-Articles.jpg') }});">
    <div class="bg-black bg-opacity-50 p-6 mt-24 rounded-lg animate-fadeInUp">
      <h1 class="text-5xl font-bold mb-4 tracking-wide animate-fadeInUp">FRESHEST</h1>
      <p class="text-lg max-w-xl mx-auto animate-fadeInUp">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae sapien nec sapien.</p>
    </div>
  </section> -->

  <section class="bg-white p-6 pb-0 mt-20 container mx-auto">
    <!-- Top Row: Location + Property Info -->
    <div class="flex flex-wrap justify-between items-center gap-4">
      <!-- Location -->
      <h1 class="text-3xl font-bold text-gray-800 hover:text-indigo-600 transition duration-300 ease-in-out">
        Title Goes Here 
      </h1>
    </div>

    <!-- Description -->
    <h2 class="text-xl font-semibold text-gray-600 hover:text-gray-800 transition duration-300 ease-in-out">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer id pharetra purus, at interdum leo.
    </h2>
  </section>

  <section class="container mx-auto grid grid-cols-5 gap-4 h-[472px] p-4">
    <!-- Large Left Image (40% width, full height) -->
    <div class="col-span-2 row-span-2">
      <img src="{{ asset('images/Indiana-Everglades-Icon-and-Banner-for-Articles.jpg') }}" alt="Main Image" class="w-full h-[472px] object-cover rounded-lg" />
    </div>

    <!-- Right Grid: 2 rows × 3 columns (each image: 1/2 height of section) -->
    <div class="col-span-3 grid grid-cols-3 grid-rows-2 gap-4 h-[472px]">
      <div class="">
        <img src="{{ asset('images/The-Journey-from-Hardcopy-to-Semi-Digital-Icon.jpg') }}" alt="Image 2" class="w-full h-full object-cover rounded-lg" />
      </div>
      <div class="">
        <img src="{{ asset('images/IMG_0978.JPG') }}" alt="Image 3" class="w-full h-full object-cover rounded-lg" />
      </div>
      <div class="">
        <img src="{{ asset('images/How I Organize My Writing Notebooks.jpeg') }}" alt="Image 4" class="w-full h-full object-cover rounded-lg" />
      </div>
      <div class="">
        <img src="{{ asset('images/The-Journey-from-Hardcopy-to-Semi-Digital-Icon.jpg') }}" alt="Image 5" class="w-full h-full object-cover rounded-lg" />
      </div>
      <div class="">
        <img src="{{ asset('images/How I Organize My Writing Notebooks.jpeg') }}" alt="Image 6" class="w-full h-full object-cover rounded-lg" />
      </div>
      <div class="">
        <img src="{{ asset('images/IMG_0978.JPG') }}" alt="Image 7" class="w-full h-full object-cover rounded-lg" />
      </div>
    </div>
  </section>

  <!-- Sticky Tag Bar -->
  <div class=" bg-white mt-4">
    
  </div>

  <!-- Tags + Share Top -->
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between flex-wrap gap-2 mb-6">
      <!-- Tags -->
      <div class="  py-2 px-4 flex flex-wrap gap-3 justify-center text-sm animate-fadeInUp">
        <a href="#" class="bg-gray-200 px-3 py-1 rounded hover:bg-gray-300 transition">📅 2025-07-13</a>
        <a href="#" class="bg-gray-200 px-3 py-1 rounded hover:bg-gray-300 transition">🖋 Lorem Ipsum</a>
        <a href="#" class="bg-gray-200 px-3 py-1 rounded hover:bg-gray-300 transition">📖 Placeholder</a>
        <a href="#" class="bg-gray-200 px-3 py-1 rounded hover:bg-gray-300 transition">🗂 Sample</a>
        <a href="#" class="bg-gray-200 px-3 py-1 rounded hover:bg-gray-300 transition">🎨 Demo</a>
      </div>

      <!-- Share Buttons -->
      <div class="flex gap-3 flex-wrap">
        <!-- Facebook -->
        <a href="https://www.facebook.com/sharer/sharer.php?u=https://yourblog.com/article-url" target="_blank" rel="noopener noreferrer"
        class="text-blue-600 hover:text-blue-700 transition" title="Share on Facebook">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.2l-.4 3h-1.8v7A10 10 0 0 0 22 12z"/>
            </svg>
        </a>

        <!-- Twitter -->
        <a href="https://twitter.com/intent/tweet?url=https://yourblog.com/article-url&text=Check%20out%20this%20article!" target="_blank" rel="noopener noreferrer"
        class="text-blue-400 hover:text-blue-500 transition" title="Share on Twitter">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22.46 6c-.77.35-1.6.58-2.46.69a4.3 4.3 0 0 0 1.88-2.37 8.59 8.59 0 0 1-2.72 1.04 4.28 4.28 0 0 0-7.3 3.9A12.14 12.14 0 0 1 3.15 4.6a4.28 4.28 0 0 0 1.33 5.7 4.2 4.2 0 0 1-1.94-.54v.05a4.28 4.28 0 0 0 3.43 4.2 4.3 4.3 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.97A8.6 8.6 0 0 1 2 19.54a12.13 12.13 0 0 0 6.56 1.92c7.88 0 12.2-6.53 12.2-12.2 0-.19 0-.38-.01-.57A8.7 8.7 0 0 0 22.46 6z"/>
            </svg>
        </a>

        <!-- LinkedIn -->
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://yourblog.com/article-url" target="_blank" rel="noopener noreferrer"
        class="text-blue-700 hover:text-blue-800 transition" title="Share on LinkedIn">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM3 8.98h4v12H3v-12zm7 0h3.6v1.7h.05c.5-.9 1.7-1.8 3.5-1.8 3.7 0 4.4 2.4 4.4 5.5v6.6h-4v-5.8c0-1.4-.03-3.2-2-3.2-2 0-2.3 1.5-2.3 3.1v5.9h-4v-12z"/>
            </svg>
            </a>

        <!-- Copy Link -->
        <button onclick="navigator.clipboard.writeText('https://yourblog.com/article-url')" class="text-gray-600 hover:text-gray-800 transition" title="Copy Link">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14L21 3m0 0v7m0-7h-7M3 10v11a1 1 0 001 1h11"/>
            </svg>
        </button>
      </div>
    </div>

  <!-- Story Content -->
  <main class="max-w-5xl mx-auto px-6 py-10 space-y-12 animate-fadeInUp">

    <!-- Chapter 1 -->
    <section class="space-y-4">
      <!-- <h2 class="text-3xl font-semibold text-gray-900">Chapter One</h2> -->
      <p class="text-gray-700 leading-relaxed">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer id pharetra purus, at interdum leo. Suspendisse ut ullamcorper velit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent tempus euismod ligula eu scelerisque. Cras mattis elit non nisi porta, vitae semper justo posuere. Morbi blandit id turpis eu sagittis. Praesent nec nisl eget nisi rutrum porta. Praesent in elementum neque. Duis tortor nunc, semper non viverra eget, aliquet sit amet erat. Ut tincidunt sem sit amet nulla venenatis tincidunt in in dui. Maecenas interdum massa ut neque venenatis cursus. Etiam odio urna, varius id velit a, varius vestibulum erat. Sed et convallis ligula. 
      </p>
      <p class="text-gray-700 leading-relaxed">
        Curabitur at sapien nec sapien tincidunt tincidunt. Sed tincidunt sapien nec sapien tincidunt, nec tincidunt sapien tincidunt.Maecenas interdum massa ut neque venenatis cursus. Etiam odio urna, varius id velit a, varius vestibulum erat. Sed et convallis ligula.
      </p>
    </section>

    <!-- Chapter 2 -->
    <section class="space-y-4">
      <!-- <h2 class="text-2xl font-semibold text-gray-900">Chapter Two</h2> -->
      <p class="text-gray-700 leading-relaxed">
        Praesent vitae libero tincidunt, blandit nunc sed, porttitor velit. Cras nec laoreet augue, at tristique nulla. Donec euismod sit amet quam ac placerat. Maecenas varius risus vitae mollis faucibus. Donec vel lorem non urna elementum congue. Phasellus efficitur nisl ut ante tincidunt, ac ultrices nulla ultrices. In interdum eget tortor ac consequat.
      </p>
    </section>

    <!-- Chapter 3 -->
    <section class="space-y-4">
      <!-- <h2 class="text-2xl font-semibold text-gray-900">Chapter Three</h2> -->
      <p class="text-gray-700 leading-relaxed">
        Etiam at magna id erat elementum volutpat eget rhoncus nunc. Curabitur elementum quis libero vel eleifend. Cras quis mauris ante. Praesent luctus, metus quis imperdiet accumsan, massa lacus tincidunt elit, eget aliquet ante nisl nec odio. Nam accumsan eu lorem id finibus. Pellentesque semper et nulla id pulvinar. Nam accumsan, felis eget venenatis congue, leo ligula vestibulum augue, non blandit justo diam vitae massa. Praesent sed dapibus tellus, nec placerat magna. Fusce finibus dapibus posuere. Donec nec nunc neque. Sed eget nulla auctor, rutrum turpis cursus, iaculis dui. Mauris at turpis in mi porttitor viverra. Ut suscipit sed est vel lacinia. Cras porta dictum erat a pharetra. 
      </p>
    </section>

    <!-- Chapter 4 -->
    <section class="space-y-4">
      <!-- <h2 class="text-2xl font-semibold text-gray-900">Chapter Four</h2> -->
      <p class="text-gray-700 leading-relaxed">
        Donec blandit, ante vitae auctor placerat, ex purus porta dolor, id varius odio turpis at enim. Cras suscipit efficitur nulla. Sed vestibulum neque mauris, quis semper turpis pellentesque eu. Donec ullamcorper, urna id laoreet fermentum, mi tortor efficitur nisi, non semper nunc ex non ex. Sed interdum neque libero, id semper justo congue ac. Curabitur nisi orci, laoreet sagittis sapien non, porttitor venenatis diam. Ut sit amet leo sed nisl suscipit mollis non ut diam. Sed et diam vel nisi pharetra vestibulum. Ut mauris metus, mattis id tempor ac, finibus at velit. Maecenas ultrices diam a velit pellentesque gravida. Morbi tempor velit sapien, eget suscipit dui scelerisque non. Duis finibus, risus sed tristique viverra, velit enim vestibulum leo, pulvinar sagittis mi sapien non ex. Donec placerat neque et tellus hendrerit, sit amet tempor magna pulvinar. Fusce sed elit diam. Morbi ut semper turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
      </p>
    </section>

    <!-- Quote Block -->
    <blockquote class="border-l-4 border-blue-500 pl-4 italic text-gray-600">
      “Lorem ipsum dolor sit amet, consectetur adipiscing elit.”
    </blockquote>

    <!-- Share Options at Bottom -->
    <div class="flex justify-end gap-3 mt-3">
      <!-- Facebook -->
      <a href="https://www.facebook.com/sharer/sharer.php?u=https://yourblog.com/article-url" target="_blank" rel="noopener noreferrer"
      class="text-blue-600 hover:text-blue-700 transition" title="Share on Facebook">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.2l-.4 3h-1.8v7A10 10 0 0 0 22 12z"/>
        </svg>
      </a>

      <!-- Twitter -->
      <a href="https://twitter.com/intent/tweet?url=https://yourblog.com/article-url&text=Check%20out%20this%20article!" target="_blank" rel="noopener noreferrer"
      class="text-blue-400 hover:text-blue-500 transition" title="Share on Twitter">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M22.46 6c-.77.35-1.6.58-2.46.69a4.3 4.3 0 0 0 1.88-2.37 8.59 8.59 0 0 1-2.72 1.04 4.28 4.28 0 0 0-7.3 3.9A12.14 12.14 0 0 1 3.15 4.6a4.28 4.28 0 0 0 1.33 5.7 4.2 4.2 0 0 1-1.94-.54v.05a4.28 4.28 0 0 0 3.43 4.2 4.3 4.3 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.97A8.6 8.6 0 0 1 2 19.54a12.13 12.13 0 0 0 6.56 1.92c7.88 0 12.2-6.53 12.2-12.2 0-.19 0-.38-.01-.57A8.7 8.7 0 0 0 22.46 6z"/>
        </svg>
      </a>

      <!-- LinkedIn -->
      <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://yourblog.com/article-url" target="_blank" rel="noopener noreferrer"
      class="text-blue-700 hover:text-blue-800 transition" title="Share on LinkedIn">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM3 8.98h4v12H3v-12zm7 0h3.6v1.7h.05c.5-.9 1.7-1.8 3.5-1.8 3.7 0 4.4 2.4 4.4 5.5v6.6h-4v-5.8c0-1.4-.03-3.2-2-3.2-2 0-2.3 1.5-2.3 3.1v5.9h-4v-12z"/>
        </svg>
      </a>

      <!-- Copy Link -->
      <button onclick="navigator.clipboard.writeText('https://yourblog.com/article-url')" class="text-gray-600 hover:text-gray-800 transition" title="Copy Link">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10 14L21 3m0 0v7m0-7h-7M3 10v11a1 1 0 001 1h11"/>
        </svg>
      </button>
    </div>

    <!-- CTA -->
    <!-- <div class="text-center pt-6">
      <a href="#" class="inline-block text-blue-600 font-medium text-lg relative transition-all duration-300 hover:text-blue-800 hover:-translate-y-0.5">
        Continue Reading →
        <span class="absolute left-0 bottom-0 w-full h-0.5 bg-blue-600 scale-x-0 origin-left transition-transform duration-300 hover:scale-x-100"></span>
      </a>
    </div> -->

   



  </main>
  <!-- Related Stories Slider -->
  <section class="pt-16 pb-20 px-4 md:px-8 bg-gray-100 border-t border-gray-200 ">
    <div class="max-w-5xl mx-auto">
      <h3 class="text-xl font-semibold mb-6 text-gray-800">Related Articles</h3>

      <div class="relative">
        <!-- Swiper Container -->
        <div class="swiper relatedSwiper">
          <div class="swiper-wrapper">

            <!-- Slide 1 -->
            <div class="swiper-slide">
              <a href="/article/lorem-ipsum-dolor" class="block bg-white p-4 rounded-lg shadow hover:shadow-md transition hover:-translate-y-1 hover:scale-[1.02] transform duration-300">
                <h4 class="text-lg font-semibold text-blue-600 mb-2 hover:underline">Lorem Ipsum Dolor</h4>
                <p class="text-sm text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </a>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide">
              <a href="/article/sed-ut-perspiciatis" class="block bg-white p-4 rounded-lg shadow hover:shadow-md transition hover:-translate-y-1 hover:scale-[1.02] transform duration-300">
                <h4 class="text-lg font-semibold text-blue-600 mb-2 hover:underline">Sed Ut Perspiciatis</h4>
                <p class="text-sm text-gray-600">Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</p>
              </a>
            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide">
              <a href="/article/consectetur-adipiscing-1" class="block bg-white p-4 rounded-lg shadow hover:shadow-md transition hover:-translate-y-1 hover:scale-[1.02] transform duration-300">
                <h4 class="text-lg font-semibold text-blue-600 mb-2 hover:underline">Consectetur Adipiscing</h4>
                <p class="text-sm text-gray-600">Integer nec odio. Praesent libero. Sed cursus ante dapibus.</p>
              </a>
            </div>

            <!-- Slide 4 -->
            <div class="swiper-slide">
              <a href="/article/consectetur-adipiscing-2" class="block bg-white p-4 rounded-lg shadow hover:shadow-md transition hover:-translate-y-1 hover:scale-[1.02] transform duration-300">
                <h4 class="text-lg font-semibold text-blue-600 mb-2 hover:underline">Consectetur Adipiscing</h4>
                <p class="text-sm text-gray-600">Integer nec odio. Praesent libero. Sed cursus ante dapibus.</p>
              </a>
            </div>

            <!-- Slide 5 -->
            <div class="swiper-slide">
              <a href="/article/consectetur-adipiscing-3" class="block bg-white p-4 rounded-lg shadow hover:shadow-md transition hover:-translate-y-1 hover:scale-[1.02] transform duration-300">
                <h4 class="text-lg font-semibold text-blue-600 mb-2 hover:underline">Consectetur Adipiscing</h4>
                <p class="text-sm text-gray-600">Integer nec odio. Praesent libero. Sed cursus ante dapibus.</p>
              </a>
            </div>

            <!-- Slide 6 -->
            <div class="swiper-slide">
              <a href="/article/consectetur-adipiscing-4" class="block bg-white p-4 rounded-lg shadow hover:shadow-md transition hover:-translate-y-1 hover:scale-[1.02] transform duration-300">
                <h4 class="text-lg font-semibold text-blue-600 mb-2 hover:underline">Consectetur Adipiscing</h4>
                <p class="text-sm text-gray-600">Integer nec odio. Praesent libero. Sed cursus ante dapibus.</p>
              </a>
            </div>

          </div>

            <!-- Navigation Buttons -->
            <!-- <div class="swiper-button-prev absolute top-1/2 -translate-y-1/2 -left-6 w-10 h-10 flex items-center justify-center bg-white rounded-full shadow-md text-gray-700 hover:bg-gray-100 transition duration-300 z-10">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            </div>
            <div class="swiper-button-next absolute top-1/2 -translate-y-1/2 -right-6 w-10 h-10 flex items-center justify-center bg-white rounded-full shadow-md text-gray-700 hover:bg-gray-100 transition duration-300 z-10">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
            </div> -->
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>

    const swiper = new Swiper('.relatedSwiper', {
      slidesPerView: 1,
      spaceBetween: 20,
      breakpoints: {
      640: { slidesPerView: 1 },
      768: { slidesPerView: 2 },
      1024: { slidesPerView: 2 }
      },
      // navigation: {
      // nextEl: '.swiper-button-next',
      // prevEl: '.swiper-button-prev'
      // },
      loop: true,
      grabCursor: true,
      autoplay: {
      delay: 3000,
      disableOnInteraction: false
      },
      // pagination: {
      //   el: '.swiper-pagination',
      //   clickable: true
      // }

  });

    // Search input event listenersconst searchInput = document.getElementById('searchInput');
      const searchInput = document.getElementById('searchInput');
      const typingStatus = document.getElementById('typingStatus');
      const clearBtn = document.getElementById('clearBtn');
      const genreSelect = document.getElementById('genre');

      // Live Typing + Clear Button
      searchInput.addEventListener('input', () => {
          typingStatus.classList.add('opacity-100');
          clearBtn.classList.remove('hidden');

          clearTimeout(window.typingTimeout);
          window.typingTimeout = setTimeout(() => {
          typingStatus.classList.remove('opacity-100');
          }, 1200);
      });

      // Clear Input
      clearBtn.addEventListener('click', () => {
        searchInput.value = '';
        clearBtn.classList.add('hidden');
        typingStatus.classList.remove('opacity-100');
        searchInput.focus();
      });

      // Update Placeholder Based on Genre
      genreSelect.addEventListener('change', () => {
        const selected = genreSelect.value;
        searchInput.placeholder =
        selected === 'all' ? 'Search Freshest...' : `Search ${selected} Freshest...`;
      });

    </script>

@include('frontend.includes.footer')