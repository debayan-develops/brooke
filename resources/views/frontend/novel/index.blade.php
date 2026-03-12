@php
    $pageTitle = 'Brooke Hennen - Novels';
@endphp
@include('frontend.includes.header')
@include('frontend.includes.navbar')
  <style>
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
        /* FIX: Display CKEditor Content Correctly on Frontend */
    .formatted-content h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-top: 0.75rem;
        margin-bottom: 0.5rem;
        color: #1a202c;
    }
    /* UPDATED: H3 (Sub-heading) - Matches Admin */
    .formatted-content h3 {
        font-size: 1.35rem;        /* Larger, like a sub-title */
        font-weight: 700;
        margin-top: 1rem;
        margin-bottom: 0.5rem;
        color: #374151;            /* Dark Gray */
        text-decoration: none;     /* No underline */
        line-height: 1.3;
    }

    /* NEW: H4 (Small Heading) - For deeper nesting */
    .formatted-content h4 {
        font-size: 1.15rem;        /* Smaller, distinct from paragraph */
        font-weight: 600;
        margin-top: 0.75rem;
        margin-bottom: 0.25rem;
        color: #4b5563;            /* Lighter Gray */
        line-height: 1.4;
    }
    }
    .formatted-content p {
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }
    .formatted-content ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-bottom: 0.5rem;
    }
    .formatted-content ol {
        list-style-type: decimal;
        padding-left: 1.5rem;
        margin-bottom: 0.5rem;
    }
    .formatted-content blockquote {
        border-left: 4px solid #3b82f6;
        padding-left: 1rem;
        font-style: italic;
        background-color: #f9fafb;
    }

    </style>
    


<!-- ------------------------------ HEADER SECTION ------------------------------ -->
    
    @include('frontend.includes.navbar')
    <section class="bg-gray-100 p-6 font-sans lg:mt-20">

      <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg p-6 relative">

            <div class="flex justify-center px-4">
                <form id="novelSearchForm" action="{{ route('frontend.novel.index') }}" method="GET" class="hidden"></form>

<div class="grid grid-cols-1 md:grid-cols-10 gap-6 mt-5 items-start w-full max-w-6xl">

    <div class="relative md:col-span-4 w-full">
        <input
            type="text"
            id="searchInput"
            name="search"
            value="{{ request('search') }}"
            form="novelSearchForm"
            placeholder="Search..."
            aria-label="Search novels"
            class="w-full py-3 pl-10 pr-10 text-sm text-gray-700 bg-white rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-700 ease-in-out transform focus:scale-105"
        />

        <div class="absolute left-3 top-3.5 text-gray-400 pointer-events-none">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

        <button id="clearBtn" aria-label="Clear search"
            class="absolute right-3 top-3.5 text-gray-400 hover:text-red-500 hidden">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <p id="typingStatus"
            class="text-xs text-gray-400 mt-2 ml-1 opacity-0 transition-opacity duration-500">
            Typing…
        </p>
    </div>

    <div class="flex flex-col sm:flex-row flex-wrap gap-4 animate-fadeInUp md:col-span-6 w-full mb-6 lg:mb-0">
        
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 w-full sm:w-auto">
            <label for="genre" class="text-sm font-medium text-gray-700">Filters</label>
            <select id="genre"
                name="category"
                form="novelSearchForm"
                class="p-2 border border-gray-300 rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300 w-full sm:w-auto">
                
                <option value="" {{ request('category') ? '' : 'selected' }}>-- All Categories --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center gap-2 w-full sm:w-auto">
            <select id="dateSort"
                name="sort"
                form="novelSearchForm"
                onchange="document.getElementById('novelSearchForm').submit()"
                class="p-2 border border-gray-300 rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300 w-full sm:w-auto">
                <option disabled {{ request('sort') ? '' : 'selected' }}>-- Select sort option --</option>
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest to Oldest</option>
                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest to Newest</option>
                <option value="updated" {{ request('sort') == 'updated' ? 'selected' : '' }}>Recently Updated</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
            </select>
        </div>

        <div class="w-full sm:w-auto">
            <button
                type="submit"
                form="novelSearchForm"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 hover:scale-105 transition duration-300 transform w-full sm:w-auto">
                Go
            </button>
        </div>
    </div>
</div>
            </div>


            

            <!-- BEST RATED Banner -->
            <div class="flex items-center mb-4">
                <div class="animate-fadeInUp">
                    <!-- <span class="mr-2">🔥</span> -->
                     <h2 class="text-3xl font-bold text-red-600 mb-4">NOVELS</h2>
                </div>
            </div>

            <p class="text-gray-600 mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris non placerat dolor, eget lacinia ipsum. Donec posuere eu ante eu elementum. Ut eu porta leo, a ultricies urna. </p>

            @forelse($novels as $novel)
            <div class="max-w-4xl mx-auto bg-white rounded-lg mb-6" data-id="story-{{ $novel->id }}">
                <div class="flex flex-col sm:flex-row sm:items-start sm:space-x-6 space-y-4 sm:space-y-0 border-t border-gray-300 pt-6">
                    
                    <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                        <img src="{{ asset(config('app.assets_path') . $novel->thumbnail) }}" alt="{{ $novel->title }}"
                            class="w-full h-full object-cover transform transition duration-300 hover:scale-105 hover:brightness-90">
                    </div>

                    <div class="flex-1 w-full">
                        <a href="{{ route('frontend.novel.chapters', $novel->id) }}">
                            <h2 class="text-xl sm:text-2xl font-semibold mb-3 hover:text-blue-600 text-center sm:text-left">
                                {{ $novel->title }}
                            </h2>
                        </a>

                        <div class="flex flex-wrap justify-center sm:justify-start gap-2 text-sm text-gray-600 mb-4">
                            @foreach($novel->tags as $tag)
                                <span class="flex items-center gap-1 bg-gray-200 px-2 py-1 rounded">{{ $tag->name }}</span>
                            @endforeach
                        </div>

                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between text-sm text-gray-700 gap-4">
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16h8M8 12h8M8 8h8M4 4h16v16H4V4z" />
                                    </svg>
                                    <strong>Pages:</strong> - 
                                </div>

                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 5v16l7-5 7 5V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" />
                                    </svg>
                                    <strong>Chapters:</strong> {{ $novel->chapters->count() }}
                                </div>

                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <strong>Date:</strong> {{ $novel->created_at->format('F d, Y') }}
                                </div>

                                <button onclick="toggleFavorite(this)"
                                    class="flex items-center gap-2 text-gray-500 hover:text-red-500 transition-colors duration-300">
                                        <svg class="w-5 h-5 favorite-icon text-gray-500 transition" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 21C12 21 7 16.5 5 13.5C3 10.5 4 7 7 6C9 5.5 11 7 12 8.5C13 7 15 5.5 17 6C20 7 21 10.5 19 13.5C17 16.5 12 21 12 21Z" />
                                        </svg>
                                        <span class="favorite-count">0</span>
                                </button>
                            </div>

                            <div class="lg:self-center lg:justify-self-end">
                                <button onclick="toggleStoryDetails(this, 'story-{{ $novel->id }}')"
                                    class="icon-toggle flex items-center justify-center lg:justify-end gap-2 text-gray-600 hover:text-gray-900 transition-transform duration-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pointer-events-none transform" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path class="icon-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span class="toggle-label text-sm font-medium">View More</span>
                                </button>
                            </div>
                        </div>

                        <div class="hidden extra-details mt-4 space-y-2 text-sm text-gray-700 transition-all duration-700 ease-in-out px-4">
                           <div class="formatted-content text-gray-700">
                             {!! $novel->description !!}
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">No novels found at the moment.</p>
                </div>
            @endforelse

            <div class="mt-12 flex justify-center">
                {{ $novels->links() }}
            </div>
                        <!-- View More Button -->
                        <div class="lg:self-center lg:justify-self-end">
                            <button onclick="toggleStoryDetails(this, 'story-1')"
                                class="icon-toggle flex items-center justify-center lg:justify-end gap-2 text-gray-600 hover:text-gray-900 transition-transform duration-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pointer-events-none transform" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path class="icon-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span class="toggle-label text-sm font-medium">View More</span>
                            </button>
                        </div>
                    </div>

                    <!-- Hidden Expandable Section -->
                    <div class="hidden extra-details mt-4 space-y-2 text-sm text-gray-700 transition-all duration-700 ease-in-out px-4">
                        <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris non placerat dolor, eget lacinia ipsum. Donec posuere eu ante eu elementum. Ut eu porta leo, a ultricies urna.
                        </p>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Pagination Container -->
            <div id="pagination" class="flex justify-center items-center space-x-2 mt-8 text-sm select-none">
                <button class="page-btn active-page px-3 py-1 rounded border bg-red-500 text-white font-semibold transition">1</button>
                <button class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">2</button>
                <button class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">3</button>
                <button class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">Next</button>
            </div>


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
        // Toggle function for label and icon and expand/collapse details
        function toggleStoryDetails(button, id) {
            const details = document.querySelector(`[data-id="${id}"] .extra-details`);
            const label = button.querySelector('.toggle-label');
            const iconPath = button.querySelector('.icon-path');

            const isHidden = details.classList.contains('hidden');
            details.classList.toggle('hidden');

            label.textContent = isHidden ? 'View Less' : 'View More';

            // Change icon path: + to -
            iconPath.setAttribute('d',
                isHidden
                    ? 'M20 12H4' // – icon
                    : 'M12 4v16m8-8H4' // + icon
            );
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

        


        
    </script>





@include('frontend.includes.footer')