@php
    $pageTitle = 'Brooke Hennen - Short Stories';
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

        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }

        @keyframes shootArrow {
        0% { transform: translateX(-10px); opacity: 0; }
        50% { transform: translateX(5px); opacity: 1; }
        100% { transform: translateX(0); opacity: 1; }
        }
        .view-all {
        background-color: #3b82f6; /* Tailwind's blue-600 */
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: bold;
        display: inline-block;
        position: relative;
        overflow: hidden;
        }
        .view-all::after {
        content: '→';
        position: absolute;
        right: 15px;
        animation: shootArrow 1s ease-out infinite;
        }

        @keyframes shootRight {
        0% {
            transform: translateX(-10px);
            opacity: 0;
        }
        50% {
            transform: translateX(3px);
            opacity: 1;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
        }
        .shooting-link {
        position: relative;
        color: #2563eb; /* Tailwind blue-600 */
        font-size: 0.875rem;
        font-weight: 500;
        /* text-decoration: underline; */
        transition: color 0.3s ease;
        }
        .shooting-link::after {
        content: '→';
        position: absolute;
        right: -20px;
        animation: shootRight 1s ease-out infinite;
        color: #1e40af; /* Tailwind blue-800 */
        }
        .shooting-link:hover {
        color: #1e40af; /* Tailwind blue-800 */
        }


    </style>
    


<!-- ------------------------------ HEADER SECTION ------------------------------ -->
    
    @include('frontend.includes.navbar')
    <section class="bg-gray-100 p-6 lg:mt-20">
        <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg p-6 relative">
            <!-- Flex Wrapper for horizontal centering -->
            <div class="flex justify-center px-4 mb-5 lg:mb-0">
                <!-- Grid Search And Filter Container -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-6xl w-full">

                    <!-- 🔍 Search Bar Wrapper -->
                    <div class="mt-5 relative w-full">
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Search..."
                            aria-label="Search novels"
                            class="w-full py-3 pl-10 pr-10 text-sm text-gray-700 bg-white rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-700 ease-in-out transform focus:scale-105"
                        />

                        <!-- Search Icon -->
                        <div class="absolute left-3 top-3.5 text-gray-400 pointer-events-none">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

                        <!-- Clear Button -->
                        <button id="clearBtn" aria-label="Clear search" class="absolute right-3 top-3.5 text-gray-400 hover:text-red-500 hidden">
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
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 lg:mt-5 animate-fadeInUp w-full">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 gap-2 w-full">
                            <label for="genre" class="font-medium">Filters</label>
                            <select id="genre" class="p-2 border rounded w-full sm:w-auto">
                            <option disabled selected>-- Select category --</option>
                            <option value="cat1">Category 1</option>
                            <option value="cat2">Category 2</option>
                            <option value="cat3">Category 3</option>
                            <option value="cat4">Category 4</option>
                            <option value="cat5">Category 5</option>
                            <option value="cat6">Category 6</option>
                            </select>

                            <select id="dateSort" class="p-2 border rounded w-full sm:w-auto">
                            <option disabled selected>-- Select sort option --</option>
                            <option value="newest">Newest to Oldest</option>
                            <option value="oldest">Oldest to Newest</option>
                            <option value="updated">Recently Updated</option>
                            <option value="popular">Most Popular</option>
                            </select>
                        </div>

                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 hover:scale-105 transition duration-300 transform w-full sm:w-auto">
                            Go
                        </button>
                    </div>

                </div>
            </div>


            <!-- Statement About Writing Short Stories -->
            <div class="">
                <h2 class="text-3xl font-bold text-gray-800">Short Story Collection</h2>
                <p class="mt-2 text-gray-600">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris non placerat dolor, eget lacinia ipsum. Donec posuere eu ante eu elementum. Ut eu porta leo, a ultricies urna. 
                </p>
                <!-- 🏷️ Category Tags -->
                <div class="flex flex-wrap gap-3 mt-6">
                    <button onclick="filterStories('all')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">All</button>
                    <button onclick="filterStories('novel')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Novel Related</button>
                    <button onclick="filterStories('biblical')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Biblical</button>
                    <button onclick="filterStories('personal')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Personal</button>
                    <button onclick="filterStories('misc')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Misc</button>
                    <button onclick="filterStories('faith')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Faith</button>
                    <button onclick="filterStories('politics')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Politics</button>
                    <button onclick="filterStories('health')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Health</button>
                    <button onclick="filterStories('family')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Family</button>
                    <button onclick="filterStories('parenting')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Parenting</button>
                    <button onclick="filterStories('finance')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Finance</button>
                    <button onclick="filterStories('church')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Church Ministry</button>
                    <button onclick="filterStories('leadership')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Business & Leadership</button>
                    <button onclick="filterStories('women')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Women</button>
                    <button onclick="filterStories('talk')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Talk Shows</button>
                    <button onclick="filterStories('sermons')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Sermons</button>
                    <button onclick="filterStories('recent')" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition">Recently Uploaded</button>
                    
                </div>

            </div>

            <!-- Wrapper -->
            <div class="" id="short-story-archive">

                <div class="space-y-14 pt-8">

                    <!-- Novel Related -->
                    <section class="animate-fade-in-up border-b border-solid border-gray-300 pb-10">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <div class="h-1 w-10 bg-blue-500 rounded-full mb-2 animate-pulse"></div>
                                <h2 class="text-xl font-semibold">Novel Related</h2>
                            </div>
                            <div class="ml-auto mr-16">
                                <a href="short-stories/novel-related.html" class="shooting-link">
                                    View All
                                </a>
                            </div>
                        </div>
                   


                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 px-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', ['id' => 1]) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', ['id' => 1]) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>

                            <!-- Repeat for second card... -->

                            <div class="col-span-1 lg:col-span-2 flex justify-center mt-4">
                                <a href="short-stories/novel-related.html" class="shooting-link text-xl text-blue-600 hover:underline">View All →</a>
                            </div>
                        </div>


                       

                    </section>

                    <!-- Biblical -->
                    <section class="animate-fade-in-up border-b border-solid border-gray-300 pb-10">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <div class="h-1 w-10 bg-blue-500 rounded-full mb-2 animate-pulse"></div>
                                <h2 class="text-xl font-semibold">Biblical</h2>
                            </div>
                            <div class="ml-auto mr-16">
                                <a href="short-stories/novel-related.html" class="shooting-link">
                                    View All
                                </a>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 px-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>

                            <!-- Repeat for second card... -->

                            <div class="col-span-1 lg:col-span-2 flex justify-center mt-4">
                                <a href="short-stories/novel-related.html" class="shooting-link text-xl text-blue-600 hover:underline">View All →</a>
                            </div>
                        </div>
                       

                    </section>

                    <!-- Personal -->
                    <section class="animate-fade-in-up border-b border-solid border-gray-300 pb-10">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <div class="h-1 w-10 bg-blue-500 rounded-full mb-2 animate-pulse"></div>
                                <h2 class="text-xl font-semibold">Personal</h2>
                            </div>
                            <div class="ml-auto mr-16">
                                <a href="short-stories/novel-related.html" class="shooting-link">
                                    View All
                                </a>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 px-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>

                            <!-- Repeat for second card... -->

                            <div class="col-span-1 lg:col-span-2 flex justify-center mt-4">
                                <a href="short-stories/novel-related.html" class="shooting-link text-xl text-blue-600 hover:underline">View All →</a>
                            </div>
                        </div>
                       

                    </section>

                    <!-- Misc -->
                    <section class="animate-fade-in-up border-b border-solid border-gray-300 pb-10">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <div class="h-1 w-10 bg-blue-500 rounded-full mb-2 animate-pulse"></div>
                                <h2 class="text-xl font-semibold">Misc</h2>
                            </div>
                            <div class="ml-auto mr-16">
                                <a href="short-stories/novel-related.html" class="shooting-link">
                                    View All
                                </a>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 px-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                <!-- Image Container with fixed size -->
                                <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0">
                                <img src="{{ asset('images/How I Organize My Writing 21st J.jpeg') }}" alt="Fragment Before Dawn"
                                    class="object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1">
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="hover:text-blue-600 hover:underline">
                                    Lorem ipsum consectetur <br>
                                    <span class="text-sm text-gray-500 ml-2">(July 06, 2023)</span>
                                    </a>
                                    <div class="absolute left-0 -top-20 bg-yellow-50 border-l-4 border-yellow-400 text-gray-700 text-sm px-3 py-2 rounded-r shadow-lg 
                                    transition-all duration-700 ease-out opacity-0 transform scale-95 blur-sm group-hover:opacity-100 
                                    group-hover:scale-100 group-hover:blur-none group-hover:translate-y-1 w-full pointer-events-none">
                                    <span class="italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum porta vulputate. Pellentesque placerat leo in tellus convallis.</span>
                                    </div>
                                </h3>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                    <span class="bg-gray-200 px-2 py-1 rounded">Backstory</span>
                                    <span class="bg-gray-200 px-2 py-1 rounded">Character Study</span>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('frontend.short-story.show', 1) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md 
                                    hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                    <span class="z-10 relative">See More →</span>
                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                    </a>
                                </div>
                                </div>
                            </div>

                            <!-- Repeat for second card... -->

                            <div class="col-span-1 lg:col-span-2 flex justify-center mt-4">
                                <a href="short-stories/novel-related.html" class="shooting-link text-xl text-blue-600 hover:underline">View All →</a>
                            </div>
                        </div>

                    </section>

                </div>
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

        
        
    </script>





@include('frontend.includes.footer')