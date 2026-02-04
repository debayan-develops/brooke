@php
    $pageTitle = $shortStory->title . ' - Brooke Hennen';
    $authorName = 'Brooke Hennen';
@endphp
@include('frontend.includes.header')
@include('frontend.includes.navbar')

<style>
    /* HTML CONTENT STYLING (For Character Descriptions) */
    .html-content p { margin-bottom: 0.8rem; }
    
    /* FIX: Force Bullets on Frontend */
    .html-content ul { 
        list-style-type: disc !important; 
        margin-left: 1.5rem !important; 
        margin-bottom: 1rem; 
    }
    
    /* FIX: Force Numbers on Frontend */
    .html-content ol { 
        list-style-type: decimal !important; 
        margin-left: 1.5rem !important; 
        margin-bottom: 1rem; 
    }
    
    .html-content li { margin-bottom: 0.25rem; }
    .html-content strong { font-weight: 700; color: #111; }
    .html-content em { font-style: italic; }
    .html-content blockquote {
        border-left: 4px solid #3b82f6;
        padding-left: 1rem;
        color: #555;
        font-style: italic;
        margin: 1rem 0;
    }
    /* TYPOGRAPHY: Classic Serif Look */
    body {
        font-family: 'Georgia', 'Times New Roman', serif;
        color: #333;
        background-color: #f9f9f9;
    }

    /* THE MAIN CONTENT BOX */
    .classic-container {
        max-width: 1100px;
        margin: 0 auto;
        background: #ffffff;
        padding: 40px 60px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    /* TITLE */
    .story-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #111;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }

    /* META (Author Left / Date Right) */
    .meta-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #f3f4f6;
        padding-bottom: 1rem;
        margin-bottom: 2rem;
        
        /* UPDATED STYLES HERE: */
        font-family: 'Georgia', serif; /* Matches body font */
        font-size: 0.95rem;
        color: #666;
        font-style: italic; /* Forces Italics */
        /* Removed text-transform: uppercase; */
    }

    /* STORY BODY */
    .story-body {
        font-size: 1.15rem;
        line-height: 1.9;
        color: #2d3748;
        text-align: left;
    }
    .story-body p { margin-bottom: 1.5rem; }

    /* SIDEBAR STYLING */
    .sidebar-heading {
        font-family: 'Georgia', serif;
        font-size: 1.25rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e5e7eb;
    }
    .sidebar-link {
        color: #2563eb;
        text-decoration: none;
        display: block;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        line-height: 1.4;
        font-family: sans-serif;
    }
    .sidebar-link:hover { text-decoration: underline; color: #1e40af; }

    /* TAGS */
    .tag-pill {
        display: inline-block;
        background-color: #f3f4f6;
        color: #4b5563;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 0.8rem;
        margin-right: 5px;
        margin-bottom: 5px;
        text-decoration: none;
        font-family: sans-serif;
    }
    .tag-pill:hover { background-color: #e5e7eb; color: #111; }

    /* SCROLLBAR HIDE */
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

    @media (max-width: 768px) {
        .classic-container { padding: 20px; }
        .story-title { font-size: 2rem; }
    }
</style>

<div class="py-10 lg:py-16">
    
    <div class="classic-container">
        
        @if($shortStory->sliderImages && $shortStory->sliderImages->count() > 0)
            <div class="w-full h-[400px] lg:h-[500px] mb-8 relative group bg-gray-100 rounded-sm overflow-hidden shadow-sm">
                
                <div id="sliderTrack" class="flex overflow-x-auto snap-x snap-mandatory h-full scrollbar-hide" style="scroll-behavior: smooth;">
                   @foreach($shortStory->sliderImages as $image)
                        <div class="w-full flex-shrink-0 snap-center h-full relative">
                            @php
                                // Path Fix: Strip "C:\Users..." and get just the filename
                                //$cleanPath = str_replace('\\', '/', $image->image_path);
                               // $filename = basename($cleanPath); 
                                $finalUrl = asset(config('app.assets_path') .  $image->image_path);
                            @endphp

                            <img src="{{ $finalUrl }}" 
                                 onerror="this.onerror=null;this.src='/images/demo-book.png';"
                                 alt="Story Slide" 
                                 class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>

                <button onclick="document.getElementById('sliderTrack').scrollBy({left: -window.innerWidth, behavior: 'smooth'})"
                        class="absolute inset-y-0 left-0 px-4 flex items-center justify-center bg-transparent border-0 cursor-pointer opacity-50 hover:opacity-100 transition duration-300 z-10 focus:outline-none">
                    <span class="text-white text-5xl font-bold drop-shadow-lg shadow-black">‹</span>
                </button>

                <button onclick="document.getElementById('sliderTrack').scrollBy({left: window.innerWidth, behavior: 'smooth'})"
                        class="absolute inset-y-0 right-0 px-4 flex items-center justify-center bg-transparent border-0 cursor-pointer opacity-50 hover:opacity-100 transition duration-300 z-10 focus:outline-none">
                    <span class="text-white text-5xl font-bold drop-shadow-lg shadow-black">›</span>
                </button>

            </div>
        @else
            <div class="w-full h-[300px] mb-8 bg-gray-200 flex items-center justify-center text-gray-500 rounded-sm">
                <p>No slider images available for this story.</p>
            </div>
        @endif

        <h1 class="story-title">{{ $shortStory->title }}</h1>
        
        <div class="meta-row">
            <div class="text-left">
                By <span class="font-bold text-gray-800">{{ $authorName }}</span>
            </div>
            <div class="text-right">
                Published: {{ $shortStory->created_at->format('F d, Y') }}
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <div class="lg:col-span-8">
                <div class="story-body">
                    {!! $shortStory->short_story_details !!}
                </div>

                <div class="mt-12 text-center pt-8 border-t border-gray-100">
                    <a href="{{ route('frontend.short-story.index') }}" 
                       class="inline-block bg-blue-600 text-white px-8 py-3 rounded text-sm font-bold uppercase tracking-wide hover:bg-blue-700 transition shadow-md no-underline">
                        ← Back to All Stories
                    </a>
                </div>
            </div>

           <div class="lg:col-span-4 space-y-10 border-l border-gray-100 pl-0 lg:pl-10">
                
                @if($shortStory->suggestedStories->count() > 0)
                <div>
                    <h3 class="sidebar-heading">Suggested Stories</h3>
                    <div class="space-y-4">
                        @foreach($shortStory->suggestedStories as $suggested)
                            <div class="w-full">
                                <a href="{{ route('frontend.short-story.show', $suggested->id) }}" class="block">
                                    <span class="text-blue-600 font-sans font-medium text-base hover:underline">
                                        {{ $suggested->title }}
                                    </span>
                                </a>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ Str::limit(strip_tags($suggested->short_description ?? $suggested->short_story_details), 80) }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($shortStory->shortStoryCharacters->count() > 0)
                <div>
                    <h3 class="sidebar-heading">Character Insights</h3>
                    <div class="space-y-3"> 
                        @foreach($shortStory->shortStoryCharacters as $character)
                            <div>
                                <a href="{{ url('/character/' . $character->id) }}" class="text-blue-600 font-bold text-sm font-sans hover:underline block">
                                    {{ $character->name }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div>
                    <h3 class="sidebar-heading">Popular Tags</h3>
                    <div class="flex flex-wrap">
                        @foreach($sidebarTags as $tag)
                            <a href="#" class="tag-pill hover:bg-gray-200 transition">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="sidebar-heading">Categories</h3>
                    <div class="space-y-2">
                        @foreach($sidebarCategories as $category)
                            <div class="w-max">
                                <a href="{{ route('frontend.short-story.index', ['category_id' => $category->id]) }}" class="text-blue-600 font-sans text-sm hover:underline">
                                    {{ $category->name }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@include('frontend.includes.footer')