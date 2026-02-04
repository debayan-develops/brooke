@php
    $pageTitle = 'Brooke Hennen - Blog';
@endphp
@include('frontend.includes.header')
@include('frontend.includes.navbar')
  <style>


        html {
            scroll-behavior: smooth;
        }


        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        @keyframes filterFade {
        0% {
            opacity: 0;
            transform: scale(0.9) translateY(-10px);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
        }
        .animate-filterFade {
        animation: filterFade 0.6s ease-out forwards;
        }


        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }
    </style>
    


<!-- ------------------------------ HEADER SECTION ------------------------------ -->
    
    @include('frontend.includes.navbar')
    <section class="bg-gray-100 p-6 font-sans lg:mt-20">

        


<form method="GET" action="{{ route('frontend.blog.index') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-6xl w-full">
    
    <div class="mt-5 relative w-full">
        <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Search..." 
               class="w-full py-3 pl-10 pr-10 text-sm text-gray-700 bg-white rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-700 ease-in-out transform focus:scale-105" />
        
        <div class="absolute left-3 top-3.5 text-gray-400 pointer-events-none">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fadeInUp w-full mb-6 lg:mb-0">
        <div class="flex flex-col sm:flex-row sm:items-center gap-3 w-full">
            <label class="font-medium">Filters</label>
            
            <select name="category_id" class="p-2 border rounded w-full sm:w-auto" onchange="this.form.submit()">
                <option value="all">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <select name="sort" class="p-2 border rounded w-full sm:w-auto" onchange="this.form.submit()">
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                <option value="updated" {{ request('sort') == 'updated' ? 'selected' : '' }}>Updated</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 hover:scale-105 transition duration-300 transform w-full sm:w-auto">
            Go
        </button>
    </div>
</form>


            <!-- Statement About Writing BLOGS/JOURNALS -->
            <div class="mb-6 lg:mb-0">
                <h2 class="text-3xl font-bold text-gray-800">Blog / Journal Archive</h2>
                <p class="mt-2 text-gray-600">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris non placerat dolor, eget lacinia ipsum. Donec posuere eu ante eu elementum. Ut eu porta leo, a ultricies urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris non placerat dolor, eget lacinia ipsum. Donec posuere eu ante eu elementum. Ut eu porta leo, a ultricies urna.
                </p>
            </div>

            
            <!-- Wrapper -->
            <div class="space-y-12">





 <section id="journal-section" class="bg-gradient-to-b from-white via-blue-50 to-white py-12 px-6 rounded-xl shadow-inner animate-fade-in-up">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 border-b border-gray-300 pb-2 px-4">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-blue-800 tracking-tight animate-fade-in-down">
            Featured Blog
        </h2>
        
        <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4">
            <a href="{{ route('frontend.blog.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm shadow-md text-center">
                Explore All
            </a>
            <button id="blogToggleBtn" onclick="toggleDropdown('blogDropdown', 'blogToggleText', 'blogToggleIcon')"
                class="flex items-center justify-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded hover:bg-blue-100 hover:text-blue-700 transition duration-300 shadow-sm">
                <span id="blogToggleText">+ View More</span>
                <svg id="blogToggleIcon" class="w-4 h-4 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </button>
        </div>
    </div>

 <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @forelse($blogs->take(2) as $blog)
            <div class="transition-transform duration-300 transform hover:scale-[1.02] hover:shadow-xl hover:bg-blue-50 rounded-lg p-4 border-t">
                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-4 sm:space-y-0">
                    <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0 flex-shrink-0">
                        {{-- FIX: Check if thumbnail exists, else show default --}}
                        @if($blog->thumbnail_image)
                            <img src="{{ asset(config('app.assets_path') . $blog->thumbnail_image) }}" 
                                 alt="{{ $blog->title }}" loading="lazy"
                                 class="object-cover transform transition duration-500 hover:scale-105 hover:brightness-90 hover:rotate-1 w-full h-full">
                        @else
                            <img src="{{ asset('images/default-book.png') }}" 
                                 alt="No Image" class="object-cover w-full h-full opacity-50">
                        @endif
                    </div>
                    <div class="flex-1">
                        <h2 class="text-lg sm:text-xl font-semibold mb-2">
                            <a href="{{ route('frontend.blog.show', $blog->id) }}" class="hover:text-blue-600 hover:underline">
                                {{ $blog->title }}
                                <span class="ml-2 text-sm text-gray-500">({{ $blog->created_at->format('M d, Y') }})</span>
                            </a>
                        </h2>
                        <div class="flex flex-wrap gap-2 text-xs text-white">
                            {{-- The '?? []' ensures it never crashes if null --}}
                            @foreach($blog->categories ?? [] as $cat)
                                <span class="bg-gradient-to-r from-pink-400 to-pink-600 px-2 py-1 rounded-full shadow-sm">{{ $cat->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No blog posts found.</p>
        @endforelse
    </div>

    <div id="blogDropdown" class="mt-8 hidden animate-fade-in-up">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($blogs->skip(2) as $blog)
                <div class="transition-transform duration-300 transform hover:scale-[1.02] hover:shadow-xl hover:bg-blue-50 rounded-lg p-4 border-t">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-4 sm:space-y-0">
                        <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0 flex-shrink-0">
                            {{-- FIX: Check if thumbnail exists, else show default --}}
                            @if($blog->thumbnail_image)
                                <img src="{{ asset(config('app.assets_path') . $blog->thumbnail_image) }}" 
                                     alt="{{ $blog->title }}" loading="lazy"
                                     class="object-cover transform transition duration-500 hover:scale-105 hover:brightness-90 hover:rotate-1 w-full h-full">
                            @else
                                <img src="{{ asset('images/default-book.png') }}" 
                                     alt="No Image" class="object-cover w-full h-full opacity-50">
                            @endif
                        </div>
                        <div class="flex-1">
                            <h2 class="text-lg sm:text-xl font-semibold mb-2">
                                <a href="{{ route('frontend.blog.show', $blog->id) }}" class="hover:text-blue-600 hover:underline">
                                    {{ $blog->title }}
                                    <span class="ml-2 text-sm text-gray-500">({{ $blog->created_at->format('M d, Y') }})</span>
                                </a>
                            </h2>
                            <div class="flex flex-wrap gap-2 text-xs text-white">
                                {{-- The '?? []' ensures it never crashes if null --}}
                                @foreach($blog->categories ?? [] as $cat)
                                    <span class="bg-gradient-to-r from-green-400 to-green-600 px-2 py-1 rounded-full shadow-sm">{{ $cat->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-8 flex justify-center">
            {{ $blogs->appends(request()->query())->links() }}
        </div>
    </div>
</section>



                <!-- 📓 Journal Entries -->
                <section  id="blog-section"  class="animate-fade-in-up">
                    <!-- Category Header -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4 border-b border-gray-200 px-4 pb-2">
                        <!-- Title -->
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-blue-800 tracking-tight animate-fade-in-down">
                            Featured Journal
                        </h2>

                        <!-- Button Group -->
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4 w-full sm:w-auto">
                            <!-- Explore All Button -->
                            <a href="journal-collection.html"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm shadow-md text-center w-full sm:w-auto">
                            Explore All
                            </a>

                            <!-- Toggle Button -->
                            <button id="journalToggleBtn"
                                    onclick="toggleDropdown('journalDropdown', 'journalToggleText')"
                                    class="flex items-center justify-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded hover:bg-blue-100 hover:text-blue-700 transition duration-300 shadow-sm w-full sm:w-auto">
                            <span id="journalToggleText" class="mr-1">+ View More</span>
                            <svg id="blogToggleIcon" class="w-4 h-4 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                            </button>
                        </div>
                    </div>


                    <!-- 🔽 Dropdown Section -->
                    <div id="journalDropdown" class="mt-8 hidden animate-fade-in-up">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Dropdown Article Card -->
                            <div class="transition-transform duration-300 transform hover:scale-[1.02] hover:shadow-xl hover:bg-blue-50 rounded-lg p-4 border-t">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-4 sm:space-y-0">
                                    
                                    <!-- Image Container (fixed size across all screens) -->
                                    <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                    <img src="{{ '/images/The-Journey-from-Hardcopy-to-Semi-Digital-Icon.jpg' }}" alt="Process Notes" loading="lazy"
                                        class="object-cover transform transition duration-500 hover:scale-105 hover:brightness-90 hover:rotate-1 w-full h-full">
                                    </div>

                                    <!-- Text Content -->
                                    <div class="flex-1">
                                    <h2 class="text-lg sm:text-xl font-semibold mb-2">
                                        <a href="{{ route('frontend.blog.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                        Lorem ipsum dolor sit amet
                                        <span class="ml-2 text-sm text-gray-500">(Jul 23, 2024)</span>
                                        </a>
                                    </h2>

                                    <!-- Tags -->
                                    <div class="flex flex-wrap gap-2 text-xs text-white">
                                        <span class="bg-gradient-to-r from-pink-400 to-pink-600 px-2 py-1 rounded-full shadow-sm">Blog</span>
                                        <span class="bg-gradient-to-r from-green-400 to-green-600 px-2 py-1 rounded-full shadow-sm">Process</span>
                                        <span class="bg-gradient-to-r from-indigo-400 to-indigo-600 px-2 py-1 rounded-full shadow-sm">Reflection</span>
                                        <span class="bg-gradient-to-r from-yellow-400 to-yellow-600 px-2 py-1 rounded-full shadow-sm">Epiphany</span>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dropdown Article Card -->
                            <div class="transition-transform duration-300 transform hover:scale-[1.02] hover:shadow-xl hover:bg-blue-50 rounded-lg p-4 border-t">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-4 sm:space-y-0">
                                    
                                    <!-- Image Container (fixed size across all screens) -->
                                    <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                    <img src="{{ '/images/The-Journey-from-Hardcopy-to-Semi-Digital-Icon.jpg' }}" alt="Process Notes" loading="lazy"
                                        class="object-cover transform transition duration-500 hover:scale-105 hover:brightness-90 hover:rotate-1 w-full h-full">
                                    </div>

                                    <!-- Text Content -->
                                    <div class="flex-1">
                                    <h2 class="text-lg sm:text-xl font-semibold mb-2">
                                        <a href="{{ route('frontend.blog.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                        Lorem ipsum dolor sit amet
                                        <span class="ml-2 text-sm text-gray-500">(Jul 23, 2024)</span>
                                        </a>
                                    </h2>

                                    <!-- Tags -->
                                    <div class="flex flex-wrap gap-2 text-xs text-white">
                                        <span class="bg-gradient-to-r from-pink-400 to-pink-600 px-2 py-1 rounded-full shadow-sm">Blog</span>
                                        <span class="bg-gradient-to-r from-green-400 to-green-600 px-2 py-1 rounded-full shadow-sm">Process</span>
                                        <span class="bg-gradient-to-r from-indigo-400 to-indigo-600 px-2 py-1 rounded-full shadow-sm">Reflection</span>
                                        <span class="bg-gradient-to-r from-yellow-400 to-yellow-600 px-2 py-1 rounded-full shadow-sm">Epiphany</span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Dropdown Article Card -->
                            <div class="transition-transform duration-300 transform hover:scale-[1.02] hover:shadow-xl hover:bg-blue-50 rounded-lg p-4 border-t">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-4 sm:space-y-0">
                                    
                                    <!-- Image Container (fixed size across all screens) -->
                                    <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                    <img src="{{ '/images/The-Journey-from-Hardcopy-to-Semi-Digital-Icon.jpg' }}" alt="Process Notes" loading="lazy"
                                        class="object-cover transform transition duration-500 hover:scale-105 hover:brightness-90 hover:rotate-1 w-full h-full">
                                    </div>

                                    <!-- Text Content -->
                                    <div class="flex-1">
                                    <h2 class="text-lg sm:text-xl font-semibold mb-2">
                                        <a href="{{ route('frontend.blog.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                        Lorem ipsum dolor sit amet
                                        <span class="ml-2 text-sm text-gray-500">(Jul 23, 2024)</span>
                                        </a>
                                    </h2>

                                    <!-- Tags -->
                                    <div class="flex flex-wrap gap-2 text-xs text-white">
                                        <span class="bg-gradient-to-r from-pink-400 to-pink-600 px-2 py-1 rounded-full shadow-sm">Blog</span>
                                        <span class="bg-gradient-to-r from-green-400 to-green-600 px-2 py-1 rounded-full shadow-sm">Process</span>
                                        <span class="bg-gradient-to-r from-indigo-400 to-indigo-600 px-2 py-1 rounded-full shadow-sm">Reflection</span>
                                        <span class="bg-gradient-to-r from-yellow-400 to-yellow-600 px-2 py-1 rounded-full shadow-sm">Epiphany</span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Dropdown Article Card -->
                            <div class="transition-transform duration-300 transform hover:scale-[1.02] hover:shadow-xl hover:bg-blue-50 rounded-lg p-4 border-t">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-4 sm:space-y-0">
                                    
                                    <!-- Image Container (fixed size across all screens) -->
                                    <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                    <img src="{{ '/images/The-Journey-from-Hardcopy-to-Semi-Digital-Icon.jpg' }}" alt="Process Notes" loading="lazy"
                                        class="object-cover transform transition duration-500 hover:scale-105 hover:brightness-90 hover:rotate-1 w-full h-full">
                                    </div>

                                    <!-- Text Content -->
                                    <div class="flex-1">
                                    <h2 class="text-lg sm:text-xl font-semibold mb-2">
                                        <a href="{{ route('frontend.blog.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                        Lorem ipsum dolor sit amet
                                        <span class="ml-2 text-sm text-gray-500">(Jul 23, 2024)</span>
                                        </a>
                                    </h2>

                                    <!-- Tags -->
                                    <div class="flex flex-wrap gap-2 text-xs text-white">
                                        <span class="bg-gradient-to-r from-pink-400 to-pink-600 px-2 py-1 rounded-full shadow-sm">Blog</span>
                                        <span class="bg-gradient-to-r from-green-400 to-green-600 px-2 py-1 rounded-full shadow-sm">Process</span>
                                        <span class="bg-gradient-to-r from-indigo-400 to-indigo-600 px-2 py-1 rounded-full shadow-sm">Reflection</span>
                                        <span class="bg-gradient-to-r from-yellow-400 to-yellow-600 px-2 py-1 rounded-full shadow-sm">Epiphany</span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Grid of Featured Articles -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Article Card -->
                        <div class="transition-transform duration-300 transform hover:scale-[1.02] hover:shadow-xl hover:bg-blue-50 rounded-lg p-4 border-t">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-4 sm:space-y-0">
                                
                                <!-- Image Container (fixed size across all screens) -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ '/images/The-Journey-from-Hardcopy-to-Semi-Digital-Icon.jpg' }}" alt="Process Notes" loading="lazy"
                                    class="object-cover transform transition duration-500 hover:scale-105 hover:brightness-90 hover:rotate-1 w-full h-full">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h2 class="text-lg sm:text-xl font-semibold mb-2">
                                    <a href="{{ route('frontend.blog.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum dolor sit amet
                                    <span class="ml-2 text-sm text-gray-500">(Jul 23, 2024)</span>
                                    </a>
                                </h2>

                                <!-- Tags -->
                                <div class="flex flex-wrap gap-2 text-xs text-white">
                                    <span class="bg-gradient-to-r from-pink-400 to-pink-600 px-2 py-1 rounded-full shadow-sm">Blog</span>
                                    <span class="bg-gradient-to-r from-green-400 to-green-600 px-2 py-1 rounded-full shadow-sm">Process</span>
                                    <span class="bg-gradient-to-r from-indigo-400 to-indigo-600 px-2 py-1 rounded-full shadow-sm">Reflection</span>
                                    <span class="bg-gradient-to-r from-yellow-400 to-yellow-600 px-2 py-1 rounded-full shadow-sm">Epiphany</span>
                                </div>
                                </div>
                            </div>
                        </div>


                        <!-- Article Card -->
                        <div class="transition-transform duration-300 transform hover:scale-[1.02] hover:shadow-xl hover:bg-blue-50 rounded-lg p-4 border-t">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-4 sm:space-y-0">
                                
                                <!-- Image Container (fixed size across all screens) -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                    <img src="{{ '/images/The-Journey-from-Hardcopy-to-Semi-Digital-Icon.jpg' }}" alt="Process Notes" loading="lazy"
                                    class="object-cover transform transition duration-500 hover:scale-105 hover:brightness-90 hover:rotate-1 w-full h-full">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                    <h2 class="text-lg sm:text-xl font-semibold mb-2">
                                        <a href="{{ route('frontend.blog.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                        Lorem ipsum dolor sit amet
                                        <span class="ml-2 text-sm text-gray-500">(Jul 23, 2024)</span>
                                        </a>
                                    </h2>

                                    <!-- Tags -->
                                    <div class="flex flex-wrap gap-2 text-xs text-white">
                                        <span class="bg-gradient-to-r from-pink-400 to-pink-600 px-2 py-1 rounded-full shadow-sm">Blog</span>
                                        <span class="bg-gradient-to-r from-green-400 to-green-600 px-2 py-1 rounded-full shadow-sm">Process</span>
                                        <span class="bg-gradient-to-r from-indigo-400 to-indigo-600 px-2 py-1 rounded-full shadow-sm">Reflection</span>
                                        <span class="bg-gradient-to-r from-yellow-400 to-yellow-600 px-2 py-1 rounded-full shadow-sm">Epiphany</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                
            </div>


            
            <!-- Pagination Container -->
            <!-- <div id="pagination" class="flex justify-center items-center space-x-2 mt-8 text-sm select-none">
                <button class="page-btn active-page px-3 py-1 rounded border bg-red-500 text-white font-semibold transition">1</button>
                <button class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">2</button>
                <button class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">3</button>
                <button class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">Next</button>
            </div> -->
        </div>
    </section>

    <!-- ⬆️ Scroll-to-Top Button -->
    <button id="scrollToTopBtn"
    class="fixed bottom-5 right-5 z-50 p-3 bg-blue-500 text-white rounded-full shadow-lg hover:bg-blue-600 hover:scale-110 transition-all duration-300 opacity-0 invisible">
        <svg class="w-5 h-5 arrow-icon transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
    </button>







   <script>
        function toggleStoryDetails(storyId) {
            const storyBlock = document.querySelector(`[data-id="${storyId}"]`);
            const details = storyBlock.querySelector('.extra-details');
            const iconPath = storyBlock.querySelector('.icon-path');
            const iconButton = storyBlock.querySelector('.icon-toggle');

            const isHidden = details.classList.contains('hidden');
            details.classList.toggle('hidden');

            // Swap icon path
            iconPath.setAttribute('d', isHidden
            ? 'M20 12H4' // Minus
            : 'M12 4v16m8-8H4' // Plus
            );

            // Rotate icon
            iconButton.classList.toggle('rotate-180', isHidden);
        }

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
            selected === 'all' ? 'Search novels...' : `Search ${selected} novels...`;
        });

        // favorite’s toggle function
         function toggleFavorite(button) {
        const icon = button.querySelector('.favorite-icon');
        const countSpan = button.querySelector('.favorite-count');
        const isLiked = icon.classList.contains('liked');

        // ✅ New outline and filled paths (smooth heart shape)
        const outlinePath = `
        <path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            d="M12 21C12 21 7 16.5 5 13.5C3 10.5 4 7 7 6
            C9 5.5 11 7 12 8.5
            C13 7 15 5.5 17 6
            C20 7 21 10.5 19 13.5
            C17 16.5 12 21 12 21Z" />
        `;

        const filledPath = `
        <path fill="currentColor"
            d="M12 21C12 21 7 16.5 5 13.5C3 10.5 4 7 7 6
            C9 5.5 11 7 12 8.5
            C13 7 15 5.5 17 6
            C20 7 21 10.5 19 13.5
            C17 16.5 12 21 12 21Z" />
        `;

        if (!isLiked) {
        icon.innerHTML = filledPath;
        icon.classList.add('liked', 'text-red-500');
        } else {
        icon.innerHTML = outlinePath;
        icon.classList.remove('liked', 'text-red-500');
        }

        // Update count (demo logic)
        let count = parseInt(countSpan.textContent.replace(/,/g, ''));
        countSpan.textContent = isLiked ? count - 1 : count + 1;
        }

        // function toggleDropdown(id) {
        //     const el = document.getElementById(id);
        //     el.classList.toggle('hidden');
        // }

        function toggleDropdown(dropdownId, textId, iconId) {
            const dropdown = document.getElementById(dropdownId);
            const toggleText = document.getElementById(textId);
            const toggleIcon = document.getElementById(iconId);

            const isHidden = dropdown.classList.contains('hidden');

            dropdown.classList.toggle('hidden');
            toggleText.textContent = isHidden ? '− View Less' : '+ View More';
            toggleIcon.classList.toggle('rotate-180');

            // Controlled scroll with reduced offset
            if (isHidden) {
                setTimeout(() => {
                const offset = dropdown.offsetTop - 40; // reduce scroll distance (adjust as needed)
                window.scrollTo({ top: offset, behavior: 'smooth' });
                }, 100);
            }
        }
        
    </script>





@include('frontend.includes.footer')