@php
    $pageTitle = 'Brooke Hennen - Short Stories';
@endphp
@include('frontend.includes.header')
@include('frontend.includes.navbar')

<style>
    /* Animations */
    @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
    .animate-fadeInUp { animation: fadeInUp 0.6s ease-out forwards; }
    
    @keyframes filterFade { 0% { opacity: 0; transform: scale(0.9) translateY(-10px); } 100% { opacity: 1; transform: scale(1) translateY(0); } }
    .animate-filterFade { animation: filterFade 0.6s ease-out forwards; }

    @keyframes fade-in-up { 0% { opacity: 0; transform: translateY(30px); } 100% { opacity: 1; transform: translateY(0); } }
    .animate-fade-in-up { animation: fade-in-up 0.8s ease-out forwards; }

    /* Tags */
    .tag {
        transition: all 0.3s ease;
    }
    .tag.active {
        background-color: #000;
        color: #fff !important;
        border-color: #000;
    }
    .tag:hover {
        background-color: #f0f0f0;
    }
    /* Force Left Alignment for Tags */
    .tags-container {
        justify-content: flex-start !important;
    }

    /* RESTORED: View All Button Styles */
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
        text-decoration: none;
        transition: background-color 0.3s ease;
    }
    .view-all:hover {
        background-color: #2563eb; /* Darker blue */
    }
    .view-all::after {
        content: '→'; /* The arrow */
        position: absolute;
        right: 15px;
        animation: shootArrow 1s ease-out infinite;
    }
    /* Pad right to make room for the animated arrow */
    .view-all { padding-right: 40px; }

    @keyframes shootRight {
        0% { transform: translateX(-10px); opacity: 0; }
        50% { transform: translateX(3px); opacity: 1; }
        100% { transform: translateX(0); opacity: 1; }
    }
    .shooting-link {
        position: relative;
        color: #2563eb;
        font-size: 0.875rem;
        font-weight: 500;
        transition: color 0.3s ease;
        text-decoration: none;
    }
    .shooting-link::after {
        content: '→';
        position: absolute;
        right: -20px;
        animation: shootRight 1s ease-out infinite;
        color: #1e40af;
    }
    .shooting-link:hover { color: #1e40af; }
</style>

<section class="bg-gray-100 p-6 lg:mt-20">
    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg p-6 relative">
        
        <div class="flex justify-center px-4 mb-5 lg:mb-0">
            <form method="GET" action="{{ route('frontend.short-story.index') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-6xl w-full">
                
                <div class="mt-5 relative w-full">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search..." 
                        class="w-full py-3 pl-10 pr-10 text-sm text-gray-700 bg-white rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-700 ease-in-out transform focus:scale-105" 
                    />
                    <div class="absolute left-3 top-3.5 text-gray-400 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 lg:mt-5 animate-fadeInUp w-full">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 gap-2 w-full">
                        <label class="font-medium">Filters</label>
                        
                        <select name="category_id" class="p-2 border rounded w-full sm:w-auto" onchange="this.form.submit()">
                            <option value="all">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                            <option value="recent" {{ request('category_id') == 'recent' ? 'selected' : '' }}>Recently Uploaded</option>
                        </select>

                        <select name="sort" class="p-2 border rounded w-full sm:w-auto" onchange="this.form.submit()">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest to Oldest</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest to Newest</option>
                            <option value="updated" {{ request('sort') == 'updated' ? 'selected' : '' }}>Recently Updated</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 hover:scale-105 transition duration-300 transform w-full sm:w-auto">
                        Go
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-12">
            <h2 class="text-3xl font-bold text-gray-800">Short Story Collection</h2>
            <p class="mt-2 text-gray-600">
                Browse our collection of short stories categorized for your reading pleasure.
            </p>
            
            <div class="tags-container flex flex-wrap gap-3 mt-6 mb-8">
                <a href="{{ route('frontend.short-story.index') }}" 
                   class="tag {{ !request('category_id') || request('category_id') == 'all' ? 'active' : '' }}"
                   style="padding: 8px 15px; border: 1px solid #ddd; border-radius: 20px; text-decoration: none; color: #333;">
                   All
                </a>

                @foreach($categories as $category)
                    <a href="{{ route('frontend.short-story.index', ['category_id' => $category->id]) }}" 
                       class="tag {{ request('category_id') == $category->id ? 'active' : '' }}"
                       style="padding: 8px 15px; border: 1px solid #ddd; border-radius: 20px; text-decoration: none; color: #333;">
                       {{ $category->name }}
                    </a>
                @endforeach

                <a href="{{ route('frontend.short-story.index', ['category_id' => 'recent']) }}" 
                   class="tag {{ request('category_id') == 'recent' ? 'active' : '' }}"
                   style="padding: 8px 15px; border: 1px solid #ddd; border-radius: 20px; text-decoration: none; color: #333;">
                   Recently Uploaded
                </a>
            </div>
        </div>

        <div id="short-story-archive">
            <div class="space-y-14 pt-8">
                
                @forelse($sections as $section)
                    @if(count($section->stories) > 0)
                        <section class="animate-fade-in-up border-b border-solid border-gray-300 pb-10">
                            
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <div class="h-1 w-10 bg-blue-500 rounded-full mb-2"></div>
                                    <h2 class="text-xl font-semibold">{{ $section->name }}</h2>
                                </div>
                                
                                {{-- TOP VIEW ALL (Blinking Single Arrow) --}}
                                @if(!request('category_id') && !request('search') && isset($section->id))
                                    <div class="ml-auto mr-16">
                                        <a href="{{ route('frontend.short-story.index', ['category_id' => $section->id]) }}" class="shooting-link">
                                            View All
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 px-4">
                                {{-- LIMIT Logic: Show only 4 items if not filtering/searching --}}
                                @php
                                    $storiesToDisplay = (request('category_id') || request('search')) 
                                                        ? $section->stories 
                                                        : $section->stories->take(4);
                                @endphp

                                @foreach($storiesToDisplay as $story)
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-6 sm:space-y-0 border-t border-gray-300 pt-6">
                                        
                                        <div class="w-36 h-44 overflow-hidden rounded-md mx-auto sm:mx-0 flex-shrink-0">
                                            @if($story->thumbnail_photo)
                                                <img src="{{ asset('storage/' . $story->thumbnail_photo) }}" 
                                                     onerror="this.onerror=null;this.src='{{ asset('images/' . $story->thumbnail_photo) }}';"
                                                     alt="{{ $story->title }}"
                                                     class="w-full h-full object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                            @else
                                                <img src="{{ asset('images/demo-book.png') }}" alt="Default"
                                                    class="w-full h-full object-cover transform transition duration-500 hover:-translate-y-1 hover:scale-105 hover:brightness-90">
                                            @endif
                                        </div>

                                        <div class="flex-1">
                                            <h3 class="text-xl sm:text-2xl font-semibold mb-2 relative group">
                                                <a href="{{ route('frontend.short-story.show', $story->id) }}" class="hover:text-blue-600 hover:underline">
                                                    {{ $story->title }} <br>
                                                    <span class="text-sm text-gray-500 ml-2">({{ $story->created_at->format('F d, Y') }})</span>
                                                </a>
                                            </h3>

                                            <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                                                @foreach($story->shortStoryCategories as $cat)
                                                    <span class="bg-gray-200 px-2 py-1 rounded">{{ $cat->name }}</span>
                                                @endforeach
                                            </div>

                                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                                {{ Str::limit(strip_tags($story->short_description), 120) }}
                                            </p>

                                            <div class="mt-4">
                                                <a href="{{ route('frontend.short-story.show', $story->id) }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md hover:bg-blue-700 transition duration-300 relative overflow-hidden w-full sm:w-auto justify-center">
                                                    <span class="z-10 relative">Read Story →</span>
                                                    <span class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transform scale-0 group-hover:scale-100 transition-all duration-700 rounded"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- BOTTOM VIEW ALL BUTTON (Blue Button with Arrows) --}}
                            {{-- Only show if NOT filtering AND there are more than 4 stories --}}
                            @if(!request('category_id') && !request('search') && isset($section->id) && $section->stories->count() > 4)
                                <div class="flex justify-center mt-8">
                                    <a href="{{ route('frontend.short-story.index', ['category_id' => $section->id]) }}" class="view-all">
                                        View All
                                    </a>
                                </div>
                            @endif

                        </section>
                    @endif
                @empty
                    <div class="text-center py-10">
                        <p class="text-xl text-gray-500">No stories found matching your criteria.</p>
                        <a href="{{ route('frontend.short-story.index') }}" class="text-blue-600 underline mt-2 block">Clear Filters</a>
                    </div>
                @endforelse

                @if(request('category_id') || request('search'))
                    <div class="mt-10 flex justify-center">
                        {{-- Note: Pagination links require the query result to be a Paginator object --}}
                        {{-- Since we are manually creating collections in controller for search, standard links() might need adjustment in controller if strict pagination is needed. --}}
                        {{-- However, for the 'search' view, simpler is better. --}}
                    </div>
                @endif

            </div>
        </div>

    </div>
</section>

@include('frontend.includes.footer')