@php
    $pageTitle = 'Brooke Hennen - Freshest';
@endphp
@include('frontend.includes.header')
@include('frontend.includes.navbar')
  <section class="bg-gray-100 text-gray-800  font-sans">
    <div class="max-w-7xl mx-auto p-0 lg:p-6 space-y-6">

      <!-- Flex Wrapper for horizontal centering -->
      <div class="flex justify-center static md:sticky top-0 z-10 bg-white shadow-sm">
        <!-- Grid Search And Filter Container -->
        <div class="grid grid-cols-1 md:grid-cols-2  mb-6 lg:mb-0 mt-0 lg:mt-20 gap-0 md:gap-8 max-w-6xl mx-auto px-4">

          <!-- 🔍 Search Bar Wrapper -->
          <div class="mt-5 relative">
            <input
              type="text"
              id="searchInput"
              placeholder="Search..."
              aria-label="Search novels"
              class="w-full py-2.5 pl-10 pr-10 text-sm text-gray-700 bg-white rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300 ease-in-out"
            />

            <!-- Search Icon -->
            <div class="absolute left-3 top-3 text-gray-400 pointer-events-none">
              <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>

            <!-- Clear Button -->
            <button id="clearBtn" aria-label="Clear search" class="absolute right-3 top-3 text-gray-400 hover:text-red-500 hidden">
              <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>

            <!-- Typing Hint -->
            <p id="typingStatus" class="text-xs text-gray-400 mt-2 ml-1 opacity-0 transition-opacity duration-500">Typing…</p>
          </div>

          <!-- Filter Section -->
          <div class="flex flex-col md:flex-row md:items-center gap-4 animate-fadeInUp mt-5">
            <!-- Filter Group -->
            <div class="flex flex-col md:flex-row md:items-center gap-2">
              <label for="genre" class="font-medium">Filters</label>
              <select id="genre" class="p-2 border rounded">
                <option disabled selected>-- Select category --</option>
                <option value="cat1">Category 1</option>
                <option value="cat2">Category 2</option>
                <option value="cat3">Category 3</option>
                <option value="cat4">Category 4</option>
                <option value="cat5">Category 5</option>
                <option value="cat6">Category 6</option>
              </select>
            </div>

            <!-- Sort Group -->
            <div class="flex flex-col md:flex-row md:items-center gap-2">
              <!-- <label for="dateSort" class="font-medium">Sort</label> -->
              <select id="dateSort" class="p-2 border rounded">
                <option disabled selected>-- Select sort option --</option>
                <option value="newest">Newest to Oldest</option>
                <option value="oldest">Oldest to Newest</option>
                <option value="updated">Recently Updated</option>
                <option value="popular">Most Popular</option>
              </select>
            </div>

            <!-- Go Button -->
            <button class="bg-blue-600 text-white px-5 py-2.5 rounded-md hover:bg-blue-700 hover:scale-105 transition duration-300 transform">
              Go
            </button>
          </div>

        </div>
      </div>

      
      <!-- FRESHEST Section -->
      <section class="animate-fadeInUp mb-10 px-6 lg:px-0">
        <h1 class="text-3xl font-bold text-red-600 mb-4">FRESHEST</h1>
        <p class="text-gray-600">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris non placerat dolor, eget lacinia ipsum. Donec posuere eu ante eu elementum. Ut eu porta leo, a ultricies urna.
        </p>
      </section>

      <!-- Stories Grid -->
      <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Story Card -->
        <article class="bg-white p-4 rounded-lg shadow flex flex-col md:flex-row items-center md:items-start text-center md:text-left animate-fadeInUp transition-all hover:shadow-lg">
          <!-- Image -->
          <div class="w-48 h-60 overflow-hidden rounded-md mt-2 mb-4 md:mb-0 md:mr-6 mx-auto md:mx-0">
            <img src="{{ asset('images/Indiana-Everglades-Icon-and-Banner-for-Articles.jpg') }}" alt="Everglades fantasy landscape" class="w-full h-full object-cover transform transition duration-300 hover:scale-105 hover:brightness-90">
          </div>
          <!-- Content -->
          <div class="flex-1">
            <a href="{{ route('frontend.blog.index') }}" class="text-2xl font-semibold mb-1 text-black hover:text-blue-600 block">Mystic Everglades</a>
            <p class="text-gray-700 mb-3">
              Deep within the enchanted forest. Follow the trail of forgotten legends and uncover the truth behind the whispers.
            </p>

            <!-- Tags -->
            <div class="bg-gray-100 p-3 mb-2 rounded flex flex-wrap justify-center md:justify-start gap-2 text-sm text-gray-700">
              <a href="#" class="flex items-center gap-1 bg-white px-2 py-1 rounded hover:bg-gray-200 transition">📅 <span>2025-07-13</span></a>
              <a href="#" class="flex items-center gap-1 bg-white px-2 py-1 rounded hover:bg-gray-200 transition">🖋 <span>Elara Moon</span></a>
              <a href="#" class="flex items-center gap-1 bg-white px-2 py-1 rounded hover:bg-gray-200 transition">📖 <span>Nature</span></a>
              <a href="#" class="flex items-center gap-1 bg-white px-2 py-1 rounded hover:bg-gray-200 transition">🗂 <span>Adventure</span></a>
              <a href="#" class="flex items-center gap-1 bg-white px-2 py-1 rounded hover:bg-gray-200 transition">🎨 <span>Fantasy</span></a>
            </div>

            <!-- CTA -->
            <a href="{{ route('frontend.blog.index') }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300">
              Read More →
            </a>
          </div>
        </article>

        <!-- Repeat for other cards -->
        <!-- Story Card 2 -->
        <article class="bg-white p-4 rounded-lg shadow flex flex-col md:flex-row items-center md:items-start text-center md:text-left animate-fadeInUp transition-all hover:shadow-lg">
          <div class="w-48 h-60 overflow-hidden rounded-md mt-2 mb-4 md:mb-0 md:mr-6 mx-auto md:mx-0">
            <img src="{{ asset('images/Indiana-Everglades-Icon-and-Banner-for-Articles.jpg') }}" alt="Fantasy forest illustration" class="w-full h-full object-cover transform transition duration-300 hover:scale-105 hover:brightness-90">
          </div>
          <div class="flex-1">
            <a href="{{ route('frontend.novel.index') }}" class="text-2xl font-semibold mb-1 text-black hover:text-blue-600 block">Whispers of the Forest</a>
            <p class="text-gray-700 mb-3">
              Deep within the enchanted forest. Follow the trail of forgotten legends and uncover the truth behind the whispers.
            </p>
            <div class="bg-gray-100 p-3 mb-2 rounded flex flex-wrap justify-center md:justify-start gap-2 text-sm text-gray-700">
              <a href="#" class="flex items-center gap-1 bg-white px-2 py-1 rounded hover:bg-gray-200 transition">📅 <span>2025-07-20</span></a>
              <a href="#" class="flex items-center gap-1 bg-white px-2 py-1 rounded hover:bg-gray-200 transition">🖋 <span>Kael Thorn</span></a>
              <a href="#" class="flex items-center gap-1 bg-white px-2 py-1 rounded hover:bg-gray-200 transition">📖 <span>Mystery</span></a>
              <a href="#" class="flex items-center gap-1 bg-white px-2 py-1 rounded hover:bg-gray-200 transition">🗂 <span>Legends</span></a>
              <a href="#" class="flex items-center gap-1 bg-white px-2 py-1 rounded hover:bg-gray-200 transition">🎨 <span>Forest</span></a>
            </div>
            <a href="{{ route('frontend.novel.index') }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300">
              Read More →
            </a>
          </div>
        </article>

        <!-- Story Card 3 -->
        <article class="bg-white p-4 rounded-lg shadow flex flex-col md:flex-row items-center md:items-start text-center md:text-left animate-fadeInUp transition-all hover:shadow-lg">
          <div class="w-48 h-60 overflow-hidden rounded-md mt-2 mb-4 md:mb-0 md:mr-6 mx-auto md:mx-0">
            <img src="{{ asset('images/Indiana-Everglades-Icon-and-Banner-for-Articles.jpg') }}" alt="Fantasy forest illustration" class="w-full h-full object-cover transform transition duration-300 hover:scale-105 hover:brightness-90">
          </div>
          <div class="flex-1">
            <a href="{{ route('frontend.short-story.index') }}" class="text-2xl font-semibold mb-1 text-black hover:text-blue-600 block">Whispers of the Forest</a>
            <p class="text-gray-700 mb-3">
              Deep within the enchanted forest. Follow the trail of forgotten legends and uncover the truth behind the whispers.
            </p>
            <div class="bg-gray-100 p-3 mb-2 rounded flex flex-wrap justify-center md:justify-start gap-2 text-sm text-gray-700">
              <a href="#" class="flex items-center gap-1 bg-white px-2 py-1 rounded hover:bg-gray-200 transition">📅 <span>2025-07-20</span></a>
              <a href="#" class="flex items-center gap-1 bg-white px-2 py-1 rounded hover:bg-gray-200 transition">🖋 <span>Kael Thorn</span></a>
              <a href="#" class="flex items-center gap-1 bg-white px-2 py-1 rounded hover:bg-gray-200 transition">📖 <span>Mystery</span></a>
              <a href="#" class="flex items-center gap-1 bg-white px-2 py-1 rounded hover:bg-gray-200 transition">🗂 <span>Legends</span></a>
              <a href="#" class="flex items-center gap-1 bg-white px-2 py-1 rounded hover:bg-gray-200 transition">🎨 <span>Forest</span></a>
            </div>
            <a href="{{ route('frontend.short-story.index') }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300">
              Read More →
            </a>
          </div>
        </article>
      </section>



      
    </div>
  </section>

  
    <!-- Pagination Container -->
    <div id="pagination" class="flex justify-center items-center space-x-2 mt-8 text-sm select-none mb-7">
      <button class="page-btn active-page px-3 py-1 rounded border bg-red-500 text-white font-semibold transition">1</button>
      <button class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">2</button>
      <button class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">3</button>
      <button class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">Next</button>
    </div>

  <script>
    // // Animate story cards on load
    // window.addEventListener('DOMContentLoaded', () => {
    // document.querySelectorAll('.story-card').forEach((card, idx) => {
    //     setTimeout(() => {
    //     card.classList.remove('opacity-0', 'translate-y-5');
    //     }, 200 * idx);
    // });
    // });

    // // Filter function (basic demo)
    // function filterStories() {
    // alert("Filtering stories by genre...");
    // }

    // Search input event listeners
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