@php
    $pageTitle = 'Brooke Hennen - Blog Details';
@endphp
@include('frontend.includes.header')
@include('frontend.includes.navbar')
  <!-- ------------------------------ HEADER SECTION ------------------------------ -->

  @include('frontend.includes.navbar')
  <!-- ------------------------------ MAIN CONTENT ------------------------------ -->

    <!-- Blog Title with Share Buttons -->
    <!-- Sticky Blog Title + Author -->
    <header class="sticky top-0 lg:top-20 z-40 bg-white lg:mt-20 border-b border-gray-200 ">
        <div class="px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4  max-w-6xl mx-auto">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-1 tracking-tight leading-snug">
            The Journey Through Everglades: A Reflection
            </h1>
            <p class="text-sm text-gray-500">
            By <span class="font-medium text-gray-700">Brooke</span> · July 13, 2025
            </p>
        </div>
    </header>
    <!-- Swiper Slider -->
    <section class="max-w-6xl mx-auto mt-6 px-6">
        
        <!-- Swiper Slider -->
        <div class="swiper mySwiper rounded-lg shadow-md">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                <img src="{{ '/images/Indiana-Everglades-Icon-and-Banner-for-Articles.jpg' }}" alt="Slide 1" class="w-full h-[520px] object-cover rounded-lg" />
                </div>
                <div class="swiper-slide">
                <img src="{{ '/images/Alternate-Blog-Banner.jpg' }}" alt="Slide 2" class="w-full h-[520px] object-cover rounded-lg" />
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
        

    </section>

    <!-- Tags + Share Top -->
    <div class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between flex-wrap gap-2 mb-6">
        <div class="flex flex-wrap gap-2 text-white">
            <span class="bg-gradient-to-r from-pink-400 to-pink-600 px-2 py-1 rounded-full shadow-sm">Blog</span>
            <span class="bg-gradient-to-r from-green-400 to-green-600 px-2 py-1 rounded-full shadow-sm">Process</span>
            <span class="bg-gradient-to-r from-indigo-400 to-indigo-600 px-2 py-1 rounded-full shadow-sm">Reflection</span>
            <span class="bg-gradient-to-r from-yellow-400 to-yellow-600 px-2 py-1 rounded-full shadow-sm">Epiphany</span>
        </div>
        <div class="flex gap-3 flex-wrap">
        <!-- Share buttons (Facebook, Twitter, LinkedIn, Copy) -->
            <!-- 🔗 Share Options at Bottom -->
            <div class="flex justify-end gap-4 border-t pt-6">
                
                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://yourblog.com/article-url"
                target="_blank" rel="noopener noreferrer"
                class="text-blue-600 hover:text-blue-700 transition" title="Share on Facebook">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.2l-.4 3h-1.8v7A10 10 0 0 0 22 12z"/>
                    </svg>
                </a>

                <!-- Twitter -->
                <a href="https://twitter.com/intent/tweet?url=https://yourblog.com/article-url&text=Check%20out%20this%20article!"
                target="_blank" rel="noopener noreferrer"
                class="text-blue-400 hover:text-blue-500 transition" title="Share on Twitter">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22.46 6c-.77.35-1.6.58-2.46.69a4.3 4.3 0 0 0 1.88-2.37 8.59 8.59 0 0 1-2.72 1.04 4.28 4.28 0 0 0-7.3 3.9A12.14 12.14 0 0 1 3.15 4.6a4.28 4.28 0 0 0 1.33 5.7 4.2 4.2 0 0 1-1.94-.54v.05a4.28 4.28 0 0 0 3.43 4.2 4.3 4.3 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.97A8.6 8.6 0 0 1 2 19.54a12.13 12.13 0 0 0 6.56 1.92c7.88 0 12.2-6.53 12.2-12.2 0-.19 0-.38-.01-.57A8.7 8.7 0 0 0 22.46 6z"/>
                    </svg>  
                </a>

                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://yourblog.com/article-url"
                target="_blank" rel="noopener noreferrer"
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
    </div>

    <!-- Main Content + Sidebar -->
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-4 gap-8 mt-12">
        <!-- Main Content -->
        <main class="lg:col-span-3 space-y-12 animate-fadeInUp">
        <section class="space-y-4">
            <p class="text-gray-700 leading-relaxed">
            <strong class="text-2xl">Lorem ipsum</strong> Cras eu sodales dui, sit amet rutrum arcu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris dignissim pellentesque massa, eget tincidunt odio auctor ac. Vestibulum non dolor in leo varius dignissim eget quis nulla. Vivamus viverra felis sit amet auctor imperdiet. In convallis massa at felis efficitur fermentum. Nulla auctor ac ante id volutpat. Curabitur efficitur ligula turpis, vel ultricies turpis scelerisque vitae. Nulla mauris tellus, venenatis sit amet condimentum non, viverra a ipsum. Fusce lectus felis, dapibus dictum eleifend sit amet, fermentum in nibh. Mauris a mi volutpat nisi mattis eleifend ut eu purus. Ut nec urna id erat scelerisque pulvinar nec vel ante. Fusce euismod auctor massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.


            </p>
            <p class="text-gray-700 leading-relaxed">
                Fusce auctor convallis ornare. Nunc eleifend elit ut justo convallis, quis laoreet mi maximus. Proin consectetur blandit elit id convallis. Nullam quis tristique quam, in ultrices ipsum. Ut sit amet enim et metus rutrum sollicitudin. Pellentesque eget luctus erat. Duis imperdiet felis non ligula pellentesque, maximus aliquet libero ullamcorper. Aenean diam odio, finibus at venenatis nec, congue nec nisl. Curabitur tempor, velit vitae vulputate placerat, urna massa varius quam, nec fermentum justo sapien in orci. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque luctus enim dui, vel tempor ex interdum eu. Duis libero magna, congue eget bibendum at, fringilla sit amet odio. Duis tempus, nunc in sodales interdum, dui nunc pharetra mauris, non lacinia odio purus ac odio. Maecenas dictum enim ligula, feugiat gravida lorem aliquam eu.

            </p>
            <p class="text-gray-700 leading-relaxed">
                Fusce auctor convallis ornare. Nunc eleifend elit ut justo convallis, quis laoreet mi maximus. Proin consectetur blandit elit id convallis. Nullam quis tristique quam, in ultrices ipsum. Ut sit amet enim et metus rutrum sollicitudin. Pellentesque eget luctus erat. Duis imperdiet felis non ligula pellentesque, maximus aliquet libero ullamcorper. Aenean diam odio, finibus at venenatis nec, congue nec nisl. Curabitur tempor, velit vitae vulputate placerat, urna massa varius quam, nec fermentum justo sapien in orci. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque luctus enim dui, vel tempor ex interdum eu. Duis libero magna, congue eget bibendum at, fringilla sit amet odio. Duis tempus, nunc in sodales interdum, dui nunc pharetra mauris, non lacinia odio purus ac odio. Maecenas dictum enim ligula, feugiat gravida lorem aliquam eu.

            </p>
            <p class="text-gray-700 leading-relaxed">
                Fusce auctor convallis ornare. Nunc eleifend elit ut justo convallis, quis laoreet mi maximus. Proin consectetur blandit elit id convallis. Nullam quis tristique quam, in ultrices ipsum. Ut sit amet enim et metus rutrum sollicitudin. Pellentesque eget luctus erat. Duis imperdiet felis non ligula pellentesque, maximus aliquet libero ullamcorper. Aenean diam odio, finibus at venenatis nec, congue nec nisl. Curabitur tempor, velit vitae vulputate placerat, urna massa varius quam, nec fermentum justo sapien in orci. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque luctus enim dui, vel tempor ex interdum eu. Duis libero magna, congue eget bibendum at, fringilla sit amet odio. Duis tempus, nunc in sodales interdum, dui nunc pharetra mauris, non lacinia odio purus ac odio. Maecenas dictum enim ligula, feugiat gravida lorem aliquam eu.

            </p>
        </section>

        <!-- Share Buttons at Bottom -->
        <div class="flex justify-end gap-3 mt-3">
            <!-- 🔗 Share Options at Bottom -->
            <div class="max-w-6xl mx-auto px-6 mt-12">
                <div class="flex justify-end gap-4 border-t pt-6">
                    
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://yourblog.com/article-url"
                    target="_blank" rel="noopener noreferrer"
                    class="text-blue-600 hover:text-blue-700 transition" title="Share on Facebook">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.2l-.4 3h-1.8v7A10 10 0 0 0 22 12z"/>
                        </svg>
                    </a>

                    <!-- Twitter -->
                    <a href="https://twitter.com/intent/tweet?url=https://yourblog.com/article-url&text=Check%20out%20this%20article!"
                    target="_blank" rel="noopener noreferrer"
                    class="text-blue-400 hover:text-blue-500 transition" title="Share on Twitter">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.46 6c-.77.35-1.6.58-2.46.69a4.3 4.3 0 0 0 1.88-2.37 8.59 8.59 0 0 1-2.72 1.04 4.28 4.28 0 0 0-7.3 3.9A12.14 12.14 0 0 1 3.15 4.6a4.28 4.28 0 0 0 1.33 5.7 4.2 4.2 0 0 1-1.94-.54v.05a4.28 4.28 0 0 0 3.43 4.2 4.3 4.3 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.97A8.6 8.6 0 0 1 2 19.54a12.13 12.13 0 0 0 6.56 1.92c7.88 0 12.2-6.53 12.2-12.2 0-.19 0-.38-.01-.57A8.7 8.7 0 0 0 22.46 6z"/>
                        </svg>  
                    </a>

                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://yourblog.com/article-url"
                    target="_blank" rel="noopener noreferrer"
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

        </div>
        </main>

        <!-- Sidebar -->
        <aside class="lg:col-span-1 space-y-6 sticky top-24">
            <div>
                <h2 class="text-2xl font-semibold mb-4">Suggested Articles</h2>
                <ul class="space-y-2 text-base text-blue-600">
                    <li><a href="#" class="hover:underline">Lorem ipsum Cras eu arcu.</a></li>
                    <li><a href="#" class="hover:underline">Lorem ipsum Cras eu sodales t rutrum arcu.</a></li>
                    <li><a href="#" class="hover:underline">Lorem ipsum  dui, sit amet rutrum arcu.</a></li>
                </ul>
            </div>
           <!-- 📁 Categories Card -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-5 pl-0 w-full max-w-sm">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Categories</h2>
                <ul class="space-y-2">
                    <li><a href="/category/category1" class="text-blue-600 hover:underline">Category 1</a></li>
                    <li><a href="/category/category2" class="text-blue-600 hover:underline">Category 2</a></li>
                    <li><a href="/category/category3" class="text-blue-600 hover:underline">Category 3</a></li>
                    <li><a href="/category/category4" class="text-blue-600 hover:underline">Category 4</a></li>
                    <li><a href="/category/category5" class="text-blue-600 hover:underline">Category 5</a></li>
                </ul>
            </div>

        </aside>
    </div>

    <!-- Share Section -->


    <!-- Related Stories Slider -->
    <section class="pt-16 pb-20 px-4 md:px-8 bg-gray-100 border-t border-gray-200 mt-16">
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