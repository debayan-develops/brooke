@php
    $pageTitle = 'Brooke Hennen - Novel Chapters';
@endphp
@include('frontend.includes.header')
@include('frontend.includes.navbar')
    <!-- 🖼️ Banner -->
    <div class="bg-cover max-w-6xl mx-auto bg-center h-[400px] flex items-center justify-center text-white lg:mt-20" style="background-image: url({{ asset(config('app.assets_path') . '/' . ($novel->banner_image ?? $novel->thumbnail)) }})">
    </div>
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl font-bold px-6 py-2 rounded">{{ $novel->title }}</h1>
    </div>
    
    


    <!-- 📖 Book Description -->
    <section class="max-w-6xl mx-auto my-8 ">
        <h1 class="text-3xl font-bold mb-4">📖 Story Chapters</h1>

        <!-- ⏩ Redesigned Jump Bar -->
        <section class=" mx-auto px-4 mb-6">
            <div class="bg-white shadow-md rounded-lg p-4">
                <div class="flex items-center justify-start gap-4 flex-wrap">
                    <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                        Jump to:
                    </h3>

                    <div class="flex gap-2 flex-wrap">
                        @foreach($ranges as $range)
                @php
                    $isActive = ($currentRange == $range);
                @endphp
                <a href="{{ request()->fullUrlWithQuery(['range' => $range, 'page' => 1]) }}" 
                   class="px-4 py-2 font-semibold rounded shadow transition {{ $isActive ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    {{ $range }}
                </a>
            @endforeach
                    </div>
                </div>
            </div>
        </section>



        <!-- Dropdown Section -->
       <details class="bg-white rounded shadow overflow-hidden transition-all duration-300 ease-in-out mb-6">
            <summary class="cursor-pointer px-7 py-2 font-semibold bg-blue-100 hover:bg-blue-200">About This Story</summary>
            <div class="px-7 py-2 text-sm text-gray-700">
                {!! $novel->about_story !!}
            </div>
        </details>
        <!-- 🏷️ Redesigned Tags / Blog Links -->
        <div class="max-w-6xl mx-auto px-4">
            <h3 class="text-xl font-semibold mb-4 px-3">Related Tags</h3>
            <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-4 px-3">
                @forelse($novel->tags as $tag)
                    <a href="#" class="flex items-center gap-1 bg-gray-200 px-2 py-1 rounded hover:bg-gray-300 transition">{{ $tag->name }}</a>
                @empty
                    <span class="text-gray-500 text-sm">No tags found.</span>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 📂 Chapter Navigation -->

    <section class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-12 gap-6 my-10">

        <!-- 📘 Chapter Table -->
        <!-- Chapter Listing Section -->
        <div class="md:col-span-6 shadow-md px-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold">Current Chapters</h3>
                <span class="inline-block bg-blue-100 text-blue-700 text-sm font-medium px-3 py-1 rounded-lg shadow">
                    {{ $totalChaptersCount }} Chapters
                </span>
            </div>

            <div class="mb-4">
                <form action="{{ url()->current() }}" method="GET">
                    <input type="hidden" name="range" value="{{ $currentRange }}">
                    <input type="text" name="chapter_search" value="{{ request('chapter_search') }}" id="chapterSearch" placeholder="Search chapters..." class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300" onchange="this.form.submit()"/>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full table-auto bg-white rounded shadow">
                    <thead class="bg-gray-100 text-gray-700 text-left">
                        <tr>
                        <th class="px-4 py-2">Chapter Name</th>
                        <th class="px-4 py-2 cursor-pointer select-none" id="releaseDateHeader">
                            Release Date <span id="sortIcon" class="inline-block ml-1 text-sm text-gray-500">🔽</span>
                        </th>
                        </tr>
                    </thead>
                    <tbody id="chapterTableBody" class="text-gray-800">
                        @forelse($chapters as $chapter)
                        <tr>
                            <td class="px-4 py-2 border-b">
                            <a href="{{ route('frontend.novel.chapter-details', ['novelId' => $novel->id, 'chapterId' => $chapter->id]) }}" class="text-blue-600 hover:underline">
                                Chapter {{ $chapter->chapter_number }}: {{ $chapter->title }} 📕
                            </a>
                            </td>
                            <td class="px-4 py-2 border-b text-sm text-gray-500">{{ $chapter->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-4 py-4 text-center text-gray-500 border-b">No chapters published yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if ($chapters->hasPages())
                <div id="pagination" class="flex justify-center items-center space-x-2 mt-8 text-sm select-none mb-7 px-4">
                    
                    {{-- Previous Page Link --}}
                    @if ($chapters->onFirstPage())
                        <span class="page-btn px-3 py-1 rounded border bg-gray-100 text-gray-400 cursor-not-allowed transition">Prev</span>
                    @else
                        <a href="{{ $chapters->previousPageUrl() }}" class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">Prev</a>
                    @endif

                    {{-- Sliding Window for Page Numbers --}}
                    @php
                        $start = max($chapters->currentPage() - 2, 1);
                        $end = min($chapters->currentPage() + 2, $chapters->lastPage());
                    @endphp

                    @if($start > 1)
                        <a href="{{ $chapters->url(1) }}" class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">1</a>
                        @if($start > 2)
                            <span class="page-btn px-3 py-1 rounded border bg-white text-gray-700">...</span>
                        @endif
                    @endif

                    @for ($page = $start; $page <= $end; $page++)
                        @if ($page == $chapters->currentPage())
                            <span class="page-btn active-page px-3 py-1 rounded border bg-red-500 text-white font-semibold transition">{{ $page }}</span>
                        @else
                            <a href="{{ $chapters->url($page) }}" class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">{{ $page }}</a>
                        @endif
                    @endfor

                    @if($end < $chapters->lastPage())
                        @if($end < $chapters->lastPage() - 1)
                            <span class="page-btn px-3 py-1 rounded border bg-white text-gray-700">...</span>
                        @endif
                        <a href="{{ $chapters->url($chapters->lastPage()) }}" class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">{{ $chapters->lastPage() }}</a>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($chapters->hasMorePages())
                        <a href="{{ $chapters->nextPageUrl() }}" class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">Next</a>
                    @else
                        <span class="page-btn px-3 py-1 rounded border bg-gray-100 text-gray-400 cursor-not-allowed transition">Next</span>
                    @endif

                </div>
            @endif
        </div>
        <!-- 📜 Older Drafts with Dropdowns -->
        <div class="md:col-span-3">
            <h3 class="text-xl font-semibold mb-4">Older Versions</h3>
            <ul class="space-y-2">
            <li>
                <details class="bg-white rounded shadow">
                <summary class="cursor-pointer px-4 py-2 hover:bg-gray-100">Chapter 1 Drafts</summary>
                <ul class="pl-6 py-2 space-y-1">
                    <li><a href="#" class="text-blue-600 hover:underline">Draft v1</a></li>
                    <li><a href="#" class="text-blue-600 hover:underline">Draft v2</a></li>
                </ul>
                </details>
            </li>
            <li>
                <details class="bg-white rounded shadow">
                <summary class="cursor-pointer px-4 py-2 hover:bg-gray-100">Chapter 2 Drafts</summary>
                <ul class="pl-6 py-2 space-y-1">
                    <li><a href="#" class="text-blue-600 hover:underline">Draft v1</a></li>
                </ul>
                </details>
            </li>
            <li>
                <details class="bg-white rounded shadow">
                <summary class="cursor-pointer px-4 py-2 hover:bg-gray-100">Chapter 3 Drafts</summary>
                <ul class="pl-6 py-2 space-y-1">
                    <li><a href="#" class="text-blue-600 hover:underline">Draft v1</a></li>
                    <li><a href="#" class="text-blue-600 hover:underline">Draft v2</a></li>
                    <li><a href="#" class="text-blue-600 hover:underline">Draft v3</a></li>
                </ul>
                </details>
            </li>
            <li>
                <details class="bg-white rounded shadow">
                <summary class="cursor-pointer px-4 py-2 hover:bg-gray-100">Chapter 5 Drafts</summary>
                <ul class="pl-6 py-2 space-y-1">
                    <li><a href="#" class="text-blue-600 hover:underline">Draft v1</a></li>
                </ul>
                </details>
            </li>
            <li>
                <details class="bg-white rounded shadow">
                <summary class="cursor-pointer px-4 py-2 hover:bg-gray-100">Chapter 7 Drafts</summary>
                <ul class="pl-6 py-2 space-y-1">
                    <li><a href="#" class="text-blue-600 hover:underline">Draft v1</a></li>
                    <li><a href="#" class="text-blue-600 hover:underline">Draft v2</a></li>
                </ul>
                </details>
            </li>
            </ul>
        </div>
        <!-- 📚 Related Novels -->
        <div class="md:col-span-3">
            
            <h3 class="text-xl font-semibold mb-4">Related Novels</h3>
            <ul class="space-y-2 mb-8">
                @forelse($novel->relatedNovels as $related)
                    <li><a href="{{ route('frontend.novel.chapters', $related->id) }}" class="block px-4 py-2 bg-white rounded shadow hover:bg-gray-100 text-blue-600 font-medium transition">{{ $related->title }}</a></li>
                @empty
                    <li class="px-4 py-2 text-gray-500 text-sm">No related novels found.</li>
                @endforelse
            </ul>

            <h3 class="text-xl font-semibold mb-4">Characters</h3>
            <ul class="space-y-2">
                @forelse($novel->characters as $character)
                    <li><a href="{{ url('character', $character->id) }}" class="block px-4 py-2 bg-white rounded shadow hover:bg-gray-100 text-blue-600 font-medium transition">{{ $character->name }}</a></li>
                @empty
                    <li class="px-4 py-2 text-gray-500 text-sm">No characters found.</li>
                @endforelse
            </ul>

        </div>
    </section>


    <!-- 💬 Discord Links -->
    <section class="max-w-4xl mx-auto px-4 mb-16">
        <h3 class="text-xl font-semibold mb-2">Join the Discussion</h3>
        <ul class="space-y-2">
            <li><a href="https://discord.com/invite/yourchannel" class="text-indigo-600 hover:underline">#Chapter-1-Discussion</a></li>
            <li><a href="https://discord.com/invite/yourchannel" class="text-indigo-600 hover:underline">#Lore-Theories</a></li>
            <li><a href="https://discord.com/invite/yourchannel" class="text-indigo-600 hover:underline">#Character-Design</a></li>
        </ul>
    </section>


    <!-- Scripts -->
  <script>
    // ✅ Track Read Chapters
    // document.addEventListener("DOMContentLoaded", () => {
    //   const chapterLinks = document.querySelectorAll(".chapter-link");

    //   chapterLinks.forEach(link => {
    //     const chapterId = link.getAttribute("data-chapter");
    //     const isRead = localStorage.getItem(`read-${chapterId}`);

    //     if (isRead) {
    //       link.classList.add("line-through", "text-gray-400");
    //       if (!link.innerHTML.includes("✅")) link.innerHTML += " ✅";
    //     }

    //     link.addEventListener("click", () => {
    //       localStorage.setItem(`read-${chapterId}`, "true");
    //       link.classList.add("line-through", "text-gray-400");
    //       if (!link.innerHTML.includes("✅")) link.innerHTML += " ✅";
    //     });
    //   });
    // });\

    // 🔍 Search Chapters
    const chapterSearch = document.getElementById("chapterSearch");
    const releaseDateHeader = document.getElementById("releaseDateHeader");
    const sortIcon = document.getElementById("sortIcon");
    const tableBody = document.getElementById("chapterTableBody");

    let ascending = true;

    const getChapterRows = () =>
        Array.from(tableBody.querySelectorAll("tr")).map(row => ({
        element: row,
        date: new Date(row.querySelector("td:last-child").textContent.trim())
        }));

    const sortChapters = () => {
        const rows = getChapterRows();
        rows.sort((a, b) => ascending ? a.date - b.date : b.date - a.date);
        tableBody.innerHTML = "";
        rows.forEach(row => tableBody.appendChild(row.element));
        sortIcon.textContent = ascending ? "🔼" : "🔽";
        ascending = !ascending;
    };

    chapterSearch.addEventListener("input", () => {
        const query = chapterSearch.value.toLowerCase();
        tableBody.querySelectorAll("tr").forEach(row => {
        const chapterName = row.querySelector("td").textContent.toLowerCase();
        row.style.display = chapterName.includes(query) ? "" : "none";
        });
    });

    releaseDateHeader.addEventListener("click", sortChapters);
    //end
   

    searchInput.addEventListener("input", () => {
        const query = searchInput.value.toLowerCase();
        const filtered = chapters.filter(ch => ch.name.toLowerCase().includes(query));
        renderChapters(filtered);
    });

    sortButton.addEventListener("click", () => {
        chapters.sort((a, b) => ascending
        ? new Date(a.date) - new Date(b.date)
        : new Date(b.date) - new Date(a.date)
        );
        ascending = !ascending;
        renderChapters(chapters);
    });

    // Initial render
    renderChapters(chapters);

    // 📚 Load More Chapters
    document.getElementById("load-more").addEventListener("click", () => {
      document.getElementById("more-chapters").classList.remove("hidden");
      document.getElementById("load-more").classList.add("hidden");
    });

    // 🎯 Animate Dropdowns
    document.querySelectorAll("details").forEach(detail => {
      detail.addEventListener("toggle", () => {
        if (detail.open) {
          detail.classList.add("transition-all", "duration-300", "ease-in-out");
        }
      });
    });
  </script>
  <!------------------------------- NEW FOOTER SECTION ---------------------------- -->
    
@include('frontend.includes.footer')