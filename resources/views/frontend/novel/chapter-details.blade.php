@php
    $pageTitle = 'Brooke Hennen - Chapter Details';
@endphp
@include('frontend.includes.header')
@include('frontend.includes.navbar')
  <style>
   

    /* Prevent horizontal scroll globally */
    body, html {
    overflow-x: hidden;
    }

    /* Comment box styling */
    .comment-box {
    position: fixed;
    top: 100px;
    right: -100%; /* Start off-screen */
    width: 100%;
    max-width: 360px;
    height: 100vh;
    background-color: white;
    box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
    transition: right 0.4s ease;
    z-index: 50;
    overflow-y: auto;
    }

    /* When active, slide into view */
    .comment-box.active {
    right: 0;
    }


    </style>

<!-- ------------------------------ HEADER SECTION ------------------------------ -->

  @include('frontend.includes.navbar')
  <!-- ------------------------------ MAIN CONTENT ------------------------------ -->


    

    <!-- Main Scrollable Container -->
    <div id="mainContainer" class="min-h-screen max-h-screen overflow-y-scroll lg:mt-20">

        <!-- Top Image Banner -->
        <section class="relative max-w-6xl mx-auto h-[300px] sm:h-[360px] md:h-96 overflow-hidden mt-3">
            <!-- Swiper Slider -->
            <div class="swiper mySwiper h-full rounded-lg">
                <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide relative h-full">
                    <img src="{{ '/images/The-Journey-from-Hardcopy-to-Semi-Digital-Icon.jpg' }}" alt="Chapter Banner"
                    class="w-full h-full object-cover brightness-90" />
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center"></div>
                    <h1 class="absolute bottom-4 sm:bottom-5 text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white text-center px-4 leading-snug">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </h1>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide relative h-full">
                    <img src="{{ '/images/published-work.jpeg' }}" alt="Alternate Banner"
                    class="w-full h-full object-cover brightness-90" />
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center"></div>
                    <h1 class="absolute bottom-4 sm:bottom-5 text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white text-center px-4 leading-snug">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </h1>
                </div>
                </div>

                <!-- Optional Navigation -->
                <div class="swiper-button-next text-white"></div>
                <div class="swiper-button-prev text-white"></div>

                <!-- Optional Pagination -->
                <div class="swiper-pagination"></div>
            </div>

            <!-- Scroll-Based Progress Bar -->
            <div id="scrollProgress" class="fixed top-[62px] lg:top-20 left-0 w-full h-1 bg-gray-200 z-50 mt-2">
                <div id="scrollBar" class="h-full bg-blue-600 w-0 transition-all duration-200 ease-out"></div>
            </div>
        </section>



        <!-- 📌 Sticky Header with Responsive Two-Row Layout -->
        <div class="max-w-6xl mx-auto sticky top-0 z-10 bg-white shadow-sm px-4 py-3 space-y-3">

            <!-- 🔹 Row 1: Chapter Title + Author -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
                <h2 class="text-lg font-semibold text-gray-700">
                Chapter 12: Donec volutpat augue id nisl efficitu
                </h2>
                <span class="text-sm text-gray-500">By Brooke Hennen</span>
            </div>

            <!-- 🔹 Row 2: Navigation + Add Note -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-4 text-sm">

                <!-- Navigation Buttons -->
                <div class="flex flex-wrap gap-2">
                    <!-- Back to Chapters List -->
                    <a href="{{ route('frontend.novel.chapters') }}" class="group flex items-center gap-2 bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition-transform duration-300 hover:scale-105">
                        <svg class="w-4 h-4 text-white group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Chapters List
                    </a>

                    <!-- Previous Chapter -->
                    <button class="group flex items-center gap-2 bg-gray-100 text-gray-700 px-3 py-1 rounded hover:bg-gray-200 transition-transform duration-300 hover:scale-105">
                        <svg class="w-4 h-4 text-gray-500 group-hover:text-gray-700 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Previous Chapter
                    </button>

                    <!-- Next Chapter -->
                    <button class="group flex items-center gap-2 bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition-transform duration-300 hover:scale-105">
                        Next Chapter
                        <svg class="w-4 h-4 text-white group-hover:text-gray-200 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <!-- Add Note Button -->
                    <button onclick="openCommentPanel()" class="flex items-center gap-2 text-blue-600 hover:text-blue-800 transition">
                    💬 Add Note
                    </button>
                </div>

                
            </div>
        </div>




        <!-- Reading Content -->
        

        <!-- 📘 Novel Content Scroll Tracker -->
        <!-- 📘 Novel Content Scroll Tracker -->
        <div id="novelContent" class="max-w-6xl mx-auto px-4 sm:px-6 py-8 relative">
            <main class="max-w-6xl mx-auto px-4 sm:px-6 py-8">
                <h3 class="text-xl sm:text-2xl font-bold mb-6 text-gray-800 text-center sm:text-left">Chapter 12: Maecenas consectetur eros et pharetra ultrices</h3>

                <!-- 🧾 Chapter Content -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <!-- 📖 Paragraphs -->
                    <div class="md:col-span-10 space-y-6 text-base sm:text-lg leading-relaxed">
                        <!-- Paragraph 1 -->
                        <div class="relative group">
                            <p class="pr-5">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eleifend, dui vitae finibus rhoncus, diam ante pretium ex, ut vehicula lacus sapien quis leo. Morbi lacinia blandit sodales. Vestibulum auctor bibendum consequat. Praesent laoreet leo massa, vel dignissim ante fringilla at. Aliquam dignissim nec nibh vitae dignissim. Nam lobortis, ligula sed fermentum lobortis, elit nibh pellentesque orci, eu pulvinar mi dui eget arcu. Vestibulum sem libero, viverra non sapien eget, pellentesque rutrum quam.
                            </p>
                            

                        </div>

                        <!-- Paragraph 2 -->
                        <div class="relative group">
                            <p class="pr-5">
                                Vestibulum feugiat ut nibh at gravida. Donec vitae sapien tempor, feugiat nulla ut, vehicula sem. Nam eros lacus, viverra vel tortor sed, mollis suscipit nulla. Integer convallis est a mi viverra hendrerit. Sed sit amet ligula vel eros luctus aliquet. Nunc pulvinar consequat nulla in lacinia. Quisque ornare orci elit, in pulvinar diam vulputate ac. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras consectetur elit accumsan cursus congue. Nulla sit amet aliquet tellus. Donec interdum lacus id eros consequat vestibulum. Vestibulum non luctus tellus. Integer quis pulvinar elit. Cras facilisis felis sit amet iaculis ultrices.
                            </p>
                        </div>

                        <!-- Paragraph 3 -->
                        <div class="relative group">
                            <p class="pr-5">
                                Cras eu sodales dui, sit amet rutrum arcu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris dignissim pellentesque massa, eget tincidunt odio auctor ac. Vestibulum non dolor in leo varius dignissim eget quis nulla. Vivamus viverra felis sit amet auctor imperdiet. In convallis massa at felis efficitur fermentum. Nulla auctor ac ante id volutpat. Curabitur efficitur ligula turpis, vel ultricies turpis scelerisque vitae. Nulla mauris tellus, venenatis sit amet condimentum non, viverra a ipsum. Fusce lectus felis, dapibus dictum eleifend sit amet, fermentum in nibh. Mauris a mi volutpat nisi mattis eleifend ut eu purus. Ut nec urna id erat scelerisque pulvinar nec vel ante. Fusce euismod auctor massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.


                            </p>

                        </div>

                        <!-- Paragraph 4 -->
                        <div class="relative group">
                            <p class="pr-5">
                                Cras eu sodales dui, sit amet rutrum arcu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris dignissim pellentesque massa, eget tincidunt odio auctor ac. Vestibulum non dolor in leo varius dignissim eget quis nulla. Vivamus viverra felis sit amet auctor imperdiet. In convallis massa at felis efficitur fermentum. Nulla auctor ac ante id volutpat. Curabitur efficitur ligula turpis, vel ultricies turpis scelerisque vitae. Nulla mauris tellus, venenatis sit amet condimentum non, viverra a ipsum. Fusce lectus felis, dapibus dictum eleifend sit amet, fermentum in nibh. Mauris a mi volutpat nisi mattis eleifend ut eu purus. Ut nec urna id erat scelerisque pulvinar nec vel ante. Fusce euismod auctor massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.


                            </p>

                        </div>
                    </div>

                    
                </div>

                <!-- 🔲 Backdrop Blur -->
                <div id="commentOverlay" class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-sm z-40 hidden"></div>

                <!-- 📝 Add Note Panel -->
                <div id="commentPanel" class="fixed top-0 right-0 w-full sm:max-w-md h-full bg-white shadow-xl z-50 transform translate-x-full transition-transform duration-300 flex flex-col">

                    <!-- 🔒 Fixed Header -->
                    <div class="flex justify-between items-center px-4 py-3 border-b shrink-0 mt-16 sm:mt-20">
                        <h2 class="text-base sm:text-lg font-semibold text-gray-800">Your Notes</h2>
                        <button onclick="closeCommentPanel()" class="text-gray-500 hover:text-red-500 text-xl font-bold">×</button>
                    </div>

                    <!-- 📚 Scrollable Notes List -->
                    <div class="overflow-y-auto px-4 py-4 space-y-6 flex-1">

                        <!-- Note Item -->
                        <div class="bg-gray-50 border rounded p-3">
                            <div class="flex justify-between items-center text-sm text-gray-600 mb-1">
                                <span>Chapter 12</span>
                            </div>
                            <div class="text-sm text-gray-800">Loved the pacing and buildup. Might want to revisit the cliffhanger ending.</div>
                        </div>

                        <div class="bg-gray-50 border rounded p-3">
                            <div class="flex justify-between items-center text-sm text-gray-600 mb-1">
                                <span>Chapter 11</span>
                                
                            </div>
                            <div class="text-sm text-gray-800">Dialogue felt a bit rushed. Consider rephrasing Meera’s final line.</div>
                        </div>
                        <div class="bg-gray-50 border rounded p-3">
                            <div class="flex justify-between items-center text-sm text-gray-600 mb-1">
                                <span>Chapter 12</span>
                                
                            </div>
                            <div class="text-sm text-gray-800">Dialogue felt a bit rushed. Consider rephrasing Meera’s final line.</div>
                        </div>
                        <div class="bg-gray-50 border rounded p-3">
                            <div class="flex justify-between items-center text-sm text-gray-600 mb-1">
                                <span>Chapter 13</span>
                                
                            </div>
                            <div class="text-sm text-gray-800">Dialogue felt a bit rushed. Consider rephrasing Meera’s final line.</div>
                        </div>
                        <div class="bg-gray-50 border rounded p-3">
                            <div class="flex justify-between items-center text-sm text-gray-600 mb-1">
                                <span>Chapter 15</span>
                                
                            </div>
                            <div class="text-sm text-gray-800">Dialogue felt a bit rushed. Consider rephrasing Meera’s final line.</div>
                        </div>

                        <!-- Add more note items dynamically as needed -->
                    </div>

                    <!-- ✍️ Fixed Note Input -->
                    <div class="px-4 py-3 border-t shrink-0 bg-white">
                        <label for="noteInput" class="text-sm text-gray-600">Add a new note</label>
                        <textarea id="noteInput" class="w-full border rounded p-2 text-sm resize-none focus:outline-none focus:ring focus:border-blue-300 mt-1" rows="3" placeholder="Write your thoughts or reminders..."></textarea>
                        <button class="mt-2 bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700 transition">Save Note</button>
                    </div>
                </div>


            </main>
        </div>



        

        <!-- Back to Chapters List -->
        <div class="mb-5 text-center">
            <a href="{{ route('frontend.novel.chapters') }}" class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded hover:bg-gray-200 transition-transform duration-300 hover:scale-105">
                <svg class="w-4 h-4 text-gray-500 group-hover:text-gray-700 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Chapters List
            </a>
        </div>
            

        </div>


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

        //comment Box 
        function openCommentPanel() {
            document.getElementById('commentOverlay').classList.remove('hidden');
            document.getElementById('commentPanel').classList.remove('translate-x-full');
        }

        function closeCommentPanel() {
            document.getElementById('commentOverlay').classList.add('hidden');
            document.getElementById('commentPanel').classList.add('translate-x-full');
        }

        // Scroll Progress Script 
        const container = document.getElementById('mainContainer');
        const scrollBar = document.getElementById('scrollBar');
        const novelContent = document.getElementById('novelContent');

        container.addEventListener('scroll', () => {
            const containerRect = container.getBoundingClientRect();
            const contentRect = novelContent.getBoundingClientRect();

            const visibleHeight = container.clientHeight;
            const contentHeight = novelContent.offsetHeight;

            const distanceScrolled = container.scrollTop - novelContent.offsetTop;
            const scrollableHeight = contentHeight - visibleHeight;

            const scrollPercent = Math.min(Math.max((distanceScrolled / scrollableHeight) * 100, 0), 100);
            scrollBar.style.width = scrollPercent + '%';
        });

    </script>



    







    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


 

@include('frontend.includes.footer')