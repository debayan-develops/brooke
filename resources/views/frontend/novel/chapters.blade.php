@php
    $pageTitle = 'Brooke Hennen - Novel Chapters';
@endphp
@include('frontend.includes.header')
@include('frontend.includes.navbar')
    <!-- 🖼️ Banner -->
    <div class="bg-cover max-w-6xl mx-auto bg-center h-[400px] flex items-center justify-center text-white lg:mt-20" style="background-image: url({{ '/images/Falling-Into-Love-With-Comics-Again.jpg' }})">
        <!-- <div class="bg-black bg-opacity-50 w-full h-full"></div> -->
    </div>
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl font-bold  px-6 py-2 rounded">The Chronicles of Emberlight</h1>
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
                        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg border border-gray-300 hover:bg-gray-200 transition">
                         10-50
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg border border-gray-300 hover:bg-gray-200 transition">
                        51-100
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg border border-gray-300 hover:bg-gray-200 transition">
                        101-150
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg border border-gray-300 hover:bg-gray-200 transition">
                        151-200
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg border border-gray-300 hover:bg-gray-200 transition">
                        201-250
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg border border-gray-300 hover:bg-gray-200 transition">
                        251-300
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg border border-gray-300 hover:bg-gray-200 transition">
                        301-350
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg border border-gray-300 hover:bg-gray-200 transition">
                        351-400
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg border border-gray-300 hover:bg-gray-200 transition">
                        401-450
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg border border-gray-300 hover:bg-gray-200 transition">
                        451-500
                        </button>
                        <!-- <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg border border-gray-300 hover:bg-gray-200 transition">
                        501-550
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg border border-gray-300 hover:bg-gray-200 transition">
                        550-600
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg border border-gray-300 hover:bg-gray-200 transition">
                        601-650
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg border border-gray-300 hover:bg-gray-200 transition">
                        651-700
                        </button> -->
                    </div>
                </div>
            </div>
        </section>



        <!-- Dropdown Section -->
        <details class="bg-white rounded shadow overflow-hidden transition-all duration-300 ease-in-out mb-6">
            <summary class="cursor-pointer px-7 py-2 font-semibold bg-blue-100 hover:bg-blue-200">About This Story</summary>
            <div class="px-7 py-2 text-sm text-gray-700">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec volutpat augue id nisl efficitur, rhoncus gravida odio dignissim. Mauris nisl turpis, lacinia id feugiat at, ornare in leo. Praesent porta aliquet ligula non ultrices. Etiam consequat eu massa a auctor. Vivamus accumsan, nisi vitae lacinia placerat, sem quam posuere leo, sed blandit erat odio nec ante. Cras condimentum rhoncus magna eget vehicula.
            </div>
        </details>

        <!-- 🏷️ Redesigned Tags / Blog Links -->
        <div class="max-w-6xl mx-auto px-4">
            <h3 class="text-xl font-semibold mb-4 px-3">Related Tags</h3>
            <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-4 px-3">
                <a href="#" class="flex items-center gap-1 bg-gray-200 px-2 py-1 rounded hover:bg-gray-300 transition">Tag 1</a>
                <a href="#" class="flex items-center gap-1 bg-gray-200 px-2 py-1 rounded hover:bg-gray-300 transition">Tag 2</a>
                <a href="#" class="flex items-center gap-1 bg-gray-200 px-2 py-1 rounded hover:bg-gray-300 transition">Tag 3</a>
                <a href="#" class="flex items-center gap-1 bg-gray-200 px-2 py-1 rounded hover:bg-gray-300 transition">Tag 4</a>
                <a href="#" class="flex items-center gap-1 bg-gray-200 px-2 py-1 rounded hover:bg-gray-300 transition">Tag 5</a>
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
                    13 Chapters
                </span>
            </div>


            <!-- Search Input -->
            <div class="mb-4">
                <input
                type="text"
                id="chapterSearch"
                placeholder="Search chapters..."
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300"
                />
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full table-auto bg-white rounded shadow">
                    <thead class="bg-gray-100 text-gray-700 text-left">
                        <tr>
                        <th class="px-4 py-2">Chapter Name</th>
                        <th class="px-4 py-2 cursor-pointer select-none" id="releaseDateHeader">
                            Release Date
                            <span id="sortIcon" class="inline-block ml-1 text-sm text-gray-500">🔽</span>
                        </th>
                        </tr>
                    </thead>
                    <tbody id="chapterTableBody" class="text-gray-800">
                        <tr>
                            <td class="px-4 py-2 border-b">
                            <a href="{{ route('frontend.novel.chapter-details', ['novelId' => 1, 'chapterId' => 1]) }}" class="text-blue-600 hover:underline">Chapter 1: Echoes in the Fog 📕</a>
                            </td>
                            <td class="px-4 py-2 border-b text-sm text-gray-500">Aug 13, 2025</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border-b">
                            <a href="{{ route('frontend.novel.chapter-details', ['novelId' => 1, 'chapterId' => 1]) }}" class="text-blue-600 hover:underline">Chapter 2: The Whispering Woods 📕</a>
                            </td>
                            <td class="px-4 py-2 border-b text-sm text-gray-500">Aug 12, 2025</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border-b">
                            <a href="{{ route('frontend.novel.chapter-details', ['novelId' => 1, 'chapterId' => 1]) }}" class="text-blue-600 hover:underline">Chapter 3: Ember's Edge 📕</a>
                            </td>
                            <td class="px-4 py-2 border-b text-sm text-gray-500">Aug 14, 2025</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border-b">
                            <a href="{{ route('frontend.novel.chapter-details', ['novelId' => 1, 'chapterId' => 1]) }}" class="text-blue-600 hover:underline">Chapter 4: The Hollow Flame 📖</a>
                            </td>
                            <td class="px-4 py-2 border-b text-sm text-gray-500">Aug 12, 2025</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border-b">
                            <a href="{{ route('frontend.novel.chapter-details', ['novelId' => 1, 'chapterId' => 1]) }}" class="text-blue-600 hover:underline">Chapter 5: Echoes of the Past</a>
                            </td>
                            <td class="px-4 py-2 border-b text-sm text-gray-500">Aug 13, 2025</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border-b">
                            <a href="#" class="text-blue-600 hover:underline">Chapter 6: The Forgotten Temple</a>
                            </td>
                            <td class="px-4 py-2 border-b text-sm text-gray-500">Aug 12, 2025</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border-b">
                            <a href="#" class="text-blue-600 hover:underline">Chapter 7: Shadows Rising</a>
                            </td>
                            <td class="px-4 py-2 border-b text-sm text-gray-500">Aug 12, 2025</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border-b">
                            <a href="#" class="text-blue-600 hover:underline">Chapter 8: The Crystal Veil</a>
                            </td>
                            <td class="px-4 py-2 border-b text-sm text-gray-500">Aug 12, 2025</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border-b">
                            <a href="#" class="text-blue-600 hover:underline">Chapter 9: The Final Trial</a>
                            </td>
                            <td class="px-4 py-2 border-b text-sm text-gray-500">Aug 12, 2025</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border-b">
                            <a href="#" class="text-blue-600 hover:underline">Chapter 10: Rebirth</a>
                            </td>
                            <td class="px-4 py-2 border-b text-sm text-gray-500">Aug 12, 2025</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border-b">
                            <a href="#" class="text-blue-600 hover:underline">Chapter 11: The Silent Storm</a>
                            </td>
                            <td class="px-4 py-2 border-b text-sm text-gray-500">Aug 12, 2025</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border-b">
                            <a href="#" class="text-blue-600 hover:underline">Chapter 12: The Last Ember</a>
                            </td>
                            <td class="px-4 py-2 border-b text-sm text-gray-500">Aug 12, 2025</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border-b">
                            <a href="#" class="text-blue-600 hover:underline">Chapter 13: Beyond the Veil</a>
                            </td>
                            <td class="px-4 py-2 border-b text-sm text-gray-500">Aug 12, 2025</td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <!-- Pagination Container -->
            <div id="pagination" class="flex justify-center items-center space-x-2 mt-8 text-sm select-none mb-7">
                <button class="page-btn active-page px-3 py-1 rounded border bg-red-500 text-white font-semibold transition">1</button>
                <button class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">2</button>
                <button class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">3</button>
                <button class="page-btn px-3 py-1 rounded border bg-white text-gray-700 hover:bg-gray-100 transition">Next</button>
            </div>
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
            <ul class="space-y-2">
                <li><a href="#" class="block px-4 py-2 bg-white rounded shadow hover:bg-gray-100 text-blue-600 font-medium transition">The Forgotten Realm</a></li>
                <li><a href="#" class="block px-4 py-2 bg-white rounded shadow hover:bg-gray-100 text-blue-600 font-medium transition">Chronicles of Eloria</a></li>
                <li><a href="#" class="block px-4 py-2 bg-white rounded shadow hover:bg-gray-100 text-blue-600 font-medium transition">The Last Ember</a></li>
                <li><a href="#" class="block px-4 py-2 bg-white rounded shadow hover:bg-gray-100 text-blue-600 font-medium transition">Whispers of the Void</a></li>
                <li><a href="#" class="block px-4 py-2 bg-white rounded shadow hover:bg-gray-100 text-blue-600 font-medium transition">Echoes of the Ancients</a></li>
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