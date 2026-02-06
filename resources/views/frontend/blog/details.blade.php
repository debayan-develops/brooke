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
    <div class="px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4 max-w-6xl mx-auto">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-1 tracking-tight leading-snug">
            {{ $blog->title }}
        </h1>
        <p class="text-sm text-gray-500">
            By <span class="font-medium text-gray-700">{{ $blog->author ?? 'Brooke' }}</span> · {{ $blog->created_at->format('F d, Y') }}
        </p>
    </div>
</header>

<section class="max-w-6xl mx-auto mt-6 px-6">
    <div class="swiper mySwiper rounded-lg shadow-md">
            <div class="swiper-wrapper">
                @if(isset($sliderImages) && $sliderImages->count() > 0)
                    @foreach($sliderImages as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset(config('app.assets_path') . $image->image_path) }}" 
                                 alt="Blog Slide" class="w-full h-[520px] object-cover rounded-lg" />
                        </div>
                    @endforeach
                @elseif($blog->thumbnail_photo)
                    <div class="swiper-slide">
                        <img src="{{ asset(config('app.assets_path') . $blog->thumbnail_photo) }}" 
                             class="w-full h-[520px] object-cover rounded-lg" />
                    </div>
                @endif
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
</section>


    <!-- Tags + Share Top -->
    <div class="max-w-6xl mx-auto px-6 py-3 flex items-center justify-between flex-wrap gap-2 mb-0">
        <div class="flex flex-wrap gap-2 text-xs text-white my-4">
    @foreach($blog->blogTags as $index => $tag)
        @php
            $colors = [
                'from-pink-400 to-pink-600', 
                'from-green-400 to-green-600', 
                'from-indigo-400 to-indigo-600', 
                'from-yellow-400 to-yellow-600'
            ];
            $colorClass = $colors[$index % 4];
        @endphp
        <span class="bg-gradient-to-r {{ $colorClass }} px-2 py-1 rounded-full shadow-sm">
            {{ $tag->name }}
        </span>
    @endforeach
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
</div> 

    <div class="max-w-6xl mx-auto px-6">
        @if($blog->blogCategories->count() > 0)
            <div class="flex flex-wrap items-center gap-2 mt-0 mb-6">
                <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Category:</span>
                @foreach($blog->blogCategories as $category)
                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
        @endif
    </div>


<div class="max-w-6xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-4 gap-8 mt-12">
    <main class="lg:col-span-3 space-y-12 animate-fadeInUp">
        <section class="space-y-4 text-gray-700 leading-relaxed">
            {!! $blog->blog_details !!}
        </section>
        
        <div class="flex justify-end gap-3 mt-3">
             </div>
    </main>

    <aside class="lg:col-span-1 space-y-6 sticky top-24">
        <div>
            <h2 class="text-2xl font-semibold mb-4">Suggested Articles</h2>
            <ul class="space-y-2 text-base text-blue-600">
                @foreach($relatedBlogs as $related)
                    <li>
                        <a href="{{ route('frontend.blog.show', $related->id) }}" class="hover:underline">
                            {{ $related->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-5 pl-0 w-full max-w-sm">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Categories</h2>
            <ul class="space-y-2">
                @foreach($categories as $cat)
                    <li>
                        <a href="{{ route('frontend.blog.index', ['category_id' => $cat->id]) }}" class="text-blue-600 hover:underline">
                            {{ $cat->name }}
                        </a>
                    </li>
                @endforeach
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
    @foreach($relatedBlogs as $related)
        <div class="swiper-slide">
            <a href="{{ route('frontend.blog.show', $related->id) }}" class="block bg-white p-4 rounded-lg shadow hover:shadow-md transition hover:-translate-y-1 hover:scale-[1.02] transform duration-300">
                <h4 class="text-lg font-semibold text-blue-600 mb-2 hover:underline line-clamp-1">
                    {{ $related->title }}
                </h4>
                <p class="text-sm text-gray-600 line-clamp-2">
                    {!! Str::limit(strip_tags($related->blog_details), 80) !!}
                </p>
            </a>
        </div>
    @endforeach
</div>
            </div>
        </div>
    </section>



 <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // 1. NEW: Main Blog Image Slider (The missing part)
    const mySwiper = new Swiper(".mySwiper", {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 1,
        centeredSlides: true,
        autoplay: {
            delay: 4000,
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
    });

    // 2. Existing: Related Articles Slider
    const relatedSwiper = new Swiper('.relatedSwiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 2 }
        },
        loop: true,
        grabCursor: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false
        }
    });

    // 3. Existing: Search & Typing Logic
    const searchInput = document.getElementById('searchInput');
    const typingStatus = document.getElementById('typingStatus');
    const clearBtn = document.getElementById('clearBtn');
    const genreSelect = document.getElementById('genre');

    // Live Typing + Clear Button
    if (searchInput) {
        searchInput.addEventListener('input', () => {
            if (typingStatus) typingStatus.classList.add('opacity-100');
            if (clearBtn) clearBtn.classList.remove('hidden');

            clearTimeout(window.typingTimeout);
            window.typingTimeout = setTimeout(() => {
                if (typingStatus) typingStatus.classList.remove('opacity-100');
            }, 1200);
        });

        // Clear Input
        if (clearBtn) {
            clearBtn.addEventListener('click', () => {
                searchInput.value = '';
                clearBtn.classList.add('hidden');
                if (typingStatus) typingStatus.classList.remove('opacity-100');
                searchInput.focus();
            });
        }
    }

    // Update Placeholder Based on Genre
    if (genreSelect && searchInput) {
        genreSelect.addEventListener('change', () => {
            const selected = genreSelect.value;
            searchInput.placeholder =
                selected === 'all' ? 'Search Freshest...' : `Search ${selected} Freshest...`;
        });
    }
</script>
@include('frontend.includes.footer')