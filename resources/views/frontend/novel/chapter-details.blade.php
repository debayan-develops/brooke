@php
    $pageTitle = 'Brooke Hennen - ' . ($chapter->title ?? 'Chapter Details');
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
    /* ---- CKEDITOR FRONTEND DISPLAY FIXES ---- */
    /* Headings */
    .ck-content h2 {
        display: block !important;
        font-size: 28px !important;
        font-weight: 900 !important;
        margin: 24px 0 12px 0 !important;
        line-height: 1.3 !important;
        color: #111827 !important;
    }
    .ck-content h3 {
        display: block !important;
        font-size: 24px !important;
        font-weight: 800 !important;
        margin: 20px 0 10px 0 !important;
        line-height: 1.3 !important;
        color: #1f2937 !important;
    }
    .ck-content h4 {
        display: block !important;
        font-size: 20px !important;
        font-weight: 700 !important;
        margin: 16px 0 8px 0 !important;
        line-height: 1.3 !important;
        color: #374151 !important;
    }
    
    /* Paragraphs & Bold Text */
    .ck-content p {
        margin-bottom: 16px !important;
        line-height: 1.8 !important;
    }
    .ck-content strong, .ck-content b {
        font-weight: bold !important;
        color: #000 !important;
    }

    /* Lists (Bullets & Numbers) */
    .ck-content ul {
        list-style-type: disc !important;
        padding-left: 24px !important;
        margin-bottom: 16px !important;
        display: block !important;
    }
    .ck-content ol {
        list-style-type: decimal !important;
        padding-left: 24px !important;
        margin-bottom: 16px !important;
        display: block !important;
    }
    .ck-content li {
        display: list-item !important;
        margin-bottom: 6px !important;
    }

    /* Blockquotes (Quotes) */
    .ck-content blockquote {
        display: block !important;
        border-left: 5px solid #3b82f6 !important; /* Blue accent line */
        background-color: #f3f4f6 !important; /* Light gray background */
        padding: 12px 20px !important;
        margin: 20px 0 !important;
        font-style: italic !important;
        color: #4b5563 !important;
        border-radius: 4px;
    }
    
    /* Links inside content */
    .ck-content a {
        color: #2563eb !important;
        text-decoration: underline !important;
    }
  </style>

<div id="mainContainer" class="min-h-screen max-h-screen overflow-y-scroll lg:mt-20">

        <section class="relative max-w-6xl mx-auto h-[300px] sm:h-[360px] md:h-96 overflow-hidden mt-3">
            <div class="swiper mySwiper h-full rounded-lg">
                <div class="swiper-wrapper">
                    @forelse($chapter->sliderImages as $slider)
                    <div class="swiper-slide relative h-full">
                        <img src="{{ asset(config('app.assets_path') . '/' . $slider->image_path) }}" alt="{{ $slider->title ?? 'Chapter Banner' }}" class="w-full h-full object-cover brightness-90" />
                        class="w-full h-full object-cover brightness-90" />
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center"></div>
                        @if($slider->title)
                        <h1 class="absolute bottom-4 sm:bottom-5 text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white text-center px-4 leading-snug">
                            {{ $slider->title }}
                        </h1>
                        @endif
                    </div>
                    @empty
                    <div class="swiper-slide relative h-full">
                        <img src="{{ asset(config('app.assets_path') . '/' . ($novel->banner_image ?? $novel->thumbnail)) }}" alt="Novel Banner"
                        class="w-full h-full object-cover brightness-90" />
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center"></div>
                        <h1 class="absolute bottom-4 sm:bottom-5 text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white text-center px-4 leading-snug">
                            Chapter {{ $chapter->chapter_number }}: {{ $chapter->title }}
                        </h1>
                    </div>
                    @endforelse
                </div>

                <div class="swiper-button-next text-white"></div>
                <div class="swiper-button-prev text-white"></div>

                <div class="swiper-pagination"></div>
            </div>

            <div id="scrollProgress" class="fixed top-[62px] lg:top-20 left-0 w-full h-1 bg-gray-200 z-50 mt-2">
                <div id="scrollBar" class="h-full bg-blue-600 w-0 transition-all duration-200 ease-out"></div>
            </div>
        </section>


        <div class="max-w-6xl mx-auto sticky top-0 z-10 bg-white shadow-sm px-4 py-3 space-y-3">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
                <h2 class="text-lg font-semibold text-gray-700">
                    Chapter {{ $chapter->chapter_number }}: {{ $chapter->title }}
                </h2>
                <span class="text-sm text-gray-500">By Brooke Hennen</span>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-4 text-sm">

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('frontend.novel.chapters', $novel->id) }}" class="group flex items-center gap-2 bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition-transform duration-300 hover:scale-105">
                        <svg class="w-4 h-4 text-white group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Chapters List
                    </a>

                    @if($previousChapter)
                    <a href="{{ route('frontend.novel.chapter-details', ['novelId' => $novel->id, 'chapterId' => $previousChapter->id]) }}" class="group flex items-center gap-2 bg-gray-100 text-gray-700 px-3 py-1 rounded hover:bg-gray-200 transition-transform duration-300 hover:scale-105">
                        <svg class="w-4 h-4 text-gray-500 group-hover:text-gray-700 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Previous Chapter
                    </a>
                    @else
                    <button disabled class="group flex items-center gap-2 bg-gray-100 text-gray-400 px-3 py-1 rounded cursor-not-allowed">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg> Previous Chapter
                    </button>
                    @endif

                    @if($nextChapter)
                    <a href="{{ route('frontend.novel.chapter-details', ['novelId' => $novel->id, 'chapterId' => $nextChapter->id]) }}" class="group flex items-center gap-2 bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition-transform duration-300 hover:scale-105">
                        Next Chapter
                        <svg class="w-4 h-4 text-white group-hover:text-gray-200 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    @else
                    <button disabled class="group flex items-center gap-2 bg-gray-300 text-gray-500 px-3 py-1 rounded cursor-not-allowed">
                        Next Chapter <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                    @endif

                    <button onclick="openCommentPanel()" class="flex items-center gap-2 text-blue-600 hover:text-blue-800 transition">
                    💬 Add Note
                    </button>
                </div>
            </div>
        </div>

        <div id="novelContent" class="max-w-6xl mx-auto px-4 sm:px-6 py-8 relative">
            <main class="max-w-6xl mx-auto px-4 sm:px-6 py-8">
                <h3 class="text-xl sm:text-2xl font-bold mb-6 text-gray-800 text-center sm:text-left">
                    Chapter {{ $chapter->chapter_number }}: {{ $chapter->title }}
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <div class="md:col-span-10 space-y-6 text-base sm:text-lg leading-relaxed ck-content">
                        {!! $chapter->description !!}
                    </div>
                </div>

                <div id="commentOverlay" class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-sm z-40 hidden"></div>

                <div id="commentPanel" class="fixed top-0 right-0 w-full sm:max-w-md h-full bg-white shadow-xl z-50 transform translate-x-full transition-transform duration-300 flex flex-col">

                    <div class="flex justify-between items-center px-4 py-3 border-b shrink-0 mt-16 sm:mt-20">
                        <h2 class="text-base sm:text-lg font-semibold text-gray-800">Your Notes</h2>
                        <button onclick="closeCommentPanel()" class="text-gray-500 hover:text-red-500 text-xl font-bold">×</button>
                    </div>

                    <div class="overflow-y-auto px-4 py-4 space-y-6 flex-1">

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
                    </div>

                    <div class="px-4 py-3 border-t shrink-0 bg-white">
                        <label for="noteInput" class="text-sm text-gray-600">Add a new note</label>
                        <textarea id="noteInput" class="w-full border rounded p-2 text-sm resize-none focus:outline-none focus:ring focus:border-blue-300 mt-1" rows="3" placeholder="Write your thoughts or reminders..."></textarea>
                        <button class="mt-2 bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700 transition">Save Note</button>
                    </div>
                </div>
            </main>
        </div>

        <div class="mb-5 text-center">
            <a href="{{ route('frontend.novel.chapters', $novel->id) }}" class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded hover:bg-gray-200 transition-transform duration-300 hover:scale-105">
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

        // Comment Box 
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
            const distanceScrolled = container.scrollTop - novelContent.offsetTop;
            const scrollableHeight = novelContent.offsetHeight - container.clientHeight;
            const scrollPercent = Math.min(Math.max((distanceScrolled / scrollableHeight) * 100, 0), 100);
            scrollBar.style.width = scrollPercent + '%';
        });
    </script>

@include('frontend.includes.footer')