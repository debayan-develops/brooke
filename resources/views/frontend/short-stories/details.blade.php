@php
    $pageTitle = 'Brooke Hennen - Short Story Details';
@endphp
@include('frontend.includes.header')
@include('frontend.includes.navbar')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

  <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in {
            animation: fade-in 0.8s ease-out forwards;
            }
            .delay-200 { animation-delay: 0.2s; }
            .delay-400 { animation-delay: 0.4s; }
            .delay-600 { animation-delay: 0.6s; }



    </style>
    


<!-- ------------------------------ HEADER SECTION ------------------------------ -->
    
    @include('frontend.includes.navbar')
    <section>
        <div class="max-w-5xl mx-auto px-4 lg:py-10 lg:mt-20">
            
            <!-- Hero Slider Section -->
            <div class="relative  group">
                <div class="swiper mySwiper rounded-lg shadow-md mb-2">
                    <div class="swiper-wrapper">
                        <!-- Slide 1 -->
                        <div class="swiper-slide relative">
                            <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Story Banner" class="w-full h-96 object-cover" />
                        </div>
                        <!-- Slide 2 -->
                        <div class="swiper-slide relative">
                            <img src="{{ asset('images/published-work.jpeg') }}" alt="Alternate Banner" class="w-full h-96 object-cover" />
                            
                        </div>
                        <!-- Add more slides as needed -->
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="swiper-button-next text-white"></div>
                    <div class="swiper-button-prev text-white"></div>

                    <!-- Pagination Dots -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <!-- Metadata -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-600 mb-6 gap-2">
                <!-- Title and Author -->
                <div class="flex flex-col gap-1">
                    <h1 class="text-2xl sm:text-3xl text-black font-bold">
                    Echoes in the Fog
                    </h1>
                    <span class="text-gray-500">
                    By <span class="font-medium text-gray-700">Brooke Hennen</span>
                    </span>
                </div>

                <!-- Published Date -->
                <span class="italic">
                    Published: July 06, 2023
                </span>
            </div>




            <!-- Story Content -->
            <div class="grid md:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="md:col-span-3 space-y-6">
                    <p class="text-lg leading-relaxed text-gray-800 animate-fade-in">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <p class="text-lg leading-relaxed text-gray-800 animate-fade-in delay-200">
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <p class="text-lg leading-relaxed text-gray-800 animate-fade-in delay-400">
                        Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida.
                    </p>
                    <p class="text-lg leading-relaxed text-gray-800 animate-fade-in delay-600">
                        Fusce convallis, mauris imperdiet gravida bibendum, nisl turpis suscipit mauris, sed placerat ipsum urna sed risus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                    </p>
                    <p class="text-lg leading-relaxed text-gray-800 animate-fade-in">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <p class="text-lg leading-relaxed text-gray-800 animate-fade-in delay-200">
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <p class="text-lg leading-relaxed text-gray-800 animate-fade-in delay-400">
                        Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida.
                    </p>
                    <p class="text-lg leading-relaxed text-gray-800 animate-fade-in delay-600">
                        Fusce convallis, mauris imperdiet gravida bibendum, nisl turpis suscipit mauris, sed placerat ipsum urna sed risus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                    </p>
                </div>


                <!-- Sidebar -->
                <aside class="md:col-span-1 space-y-6 sticky top-20">

                    <!-- Suggested Stories -->
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-700 mb-2">Suggested Stories</h3>
                        <ul class="space-y-2 text-base text-blue-600">
                        <li><a href="#" class="hover:underline">Lorem ipsum Cras eu sodales dui</a></li>
                        <li><a href="#" class="hover:underline">Lorem ipsum Cras eu  dui</a></li>
                        <li><a href="#" class="hover:underline">Lorem ipsum Cras eu sodales </a></li>
                        </ul>
                    </div>

                    <!-- Character Insights -->
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-700 mb-2">Character Insights</h3>
                        <ul class="space-y-2 text-base text-blue-600">
                            <li><a href="#" class="hover:underline">Aiden Blackthorn – The Reluctant Hero</a></li>
                            <li><a href="#" class="hover:underline">Lyra Voss – Secrets of the Healer</a></li>
                            <li><a href="#" class="hover:underline">The Crimson Order – Villains with a Code</a></li>
                            <li><a href="#" class="hover:underline">Family Ties: The Holloway Legacy</a></li>
                            <li><a href="#" class="hover:underline">Character Map & Relationships</a></li>
                        </ul>
                    </div>


                    <!-- 🏷️ Tags Section (Boxy Design) -->
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-700 mb-2">Popular Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            <a href="/tags/backstory" class="bg-gray-200 px-3 py-1 rounded text-base text-gray-700 hover:bg-gray-300 transition">Backstory</a>
                            <a href="/tags/character-study" class="bg-gray-200 px-3 py-1 rounded text-base text-gray-700 hover:bg-gray-300 transition">Character Study</a>
                            <a href="/tags/redemption" class="bg-gray-200 px-3 py-1 rounded text-base text-gray-700 hover:bg-gray-300 transition">Redemption</a>
                            <a href="/tags/flashback" class="bg-gray-200 px-3 py-1 rounded text-base text-gray-700 hover:bg-gray-300 transition">Flashback</a>
                        </div>
                    </div>

                    <!-- 📁 Horizontal Categories Card -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-5 pl-0 w-full max-w-2xl">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Categories</h2>
                        <ul class="space-y-2 text-base">
                            <li><a href="/category/category1" class="text-blue-600 hover:underline">Category 1</a></li>
                            <li><a href="/category/category2" class="text-blue-600 hover:underline">Category 2</a></li>
                            <li><a href="/category/category3" class="text-blue-600 hover:underline">Category 3</a></li>
                            <li><a href="/category/category4" class="text-blue-600 hover:underline">Category 4</a></li>
                            <li><a href="/category/category5" class="text-blue-600 hover:underline">Category 5</a></li>
                        </ul>
                    </div>


                    




                </aside>

            </div>

            <!-- CTA -->
            <div class="mt-10 text-center">
                <a href="{{ route('frontend.short-story.index') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition duration-300">
                    ← Back to All Stories
                </a>
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







    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
            delay: 5000,
            disableOnInteraction: false,
            },
            pagination: {
            el: ".swiper-pagination",
            clickable: true,
            },
            navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
            },
            effect: "fade",
            fadeEffect: {
            crossFade: true
            }
        });
        
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