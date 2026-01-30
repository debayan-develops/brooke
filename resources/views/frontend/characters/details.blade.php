@php
    $pageTitle = $character->name . ' - Character Profile';
@endphp

@include('frontend.includes.header')
@include('frontend.includes.navbar')

<style>
    body {
        font-family: 'Georgia', 'Times New Roman', serif;
        color: #333;
        background-color: #f9f9f9;
    }
    .classic-container {
        max-width: 1100px;
        margin: 0 auto;
        background: #ffffff;
        padding: 40px 60px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        min-height: 80vh;
    }
    .char-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #111;
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }
    .meta-row {
        border-bottom: 2px solid #f3f4f6;
        padding-bottom: 1rem;
        margin-bottom: 2rem;
        font-family: 'Georgia', serif;
        font-size: 0.95rem;
        color: #666;
        font-style: italic;
    }
    
    /* HTML Content Styling */
    .html-content {
        font-size: 1.15rem;
        line-height: 1.9;
        color: #2d3748;
        font-family: sans-serif;
    }
    .html-content p { margin-bottom: 1rem; }
    .html-content ul { list-style-type: disc !important; margin-left: 1.5rem !important; margin-bottom: 1rem; }
    .html-content ol { list-style-type: decimal !important; margin-left: 1.5rem !important; margin-bottom: 1rem; }
    .html-content li { margin-bottom: 0.25rem; }
    .html-content strong { font-weight: 700; color: #111; }

    /* Sidebar Styling */
    .sidebar-heading {
        font-family: 'Georgia', serif;
        font-size: 1.25rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e5e7eb;
    }
</style>

<div class="py-10 lg:py-16">
    <div class="classic-container">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <div class="lg:col-span-8">
                
                <h1 class="char-title">{{ $character->name }}</h1>

                <div class="meta-row">
                    Character by <span class="font-bold text-gray-800">Brooke Hennen</span>
                </div>

                <div class="html-content">
                    {!! $character->description !!}
                </div>
                
                <div class="mt-12 pt-8 border-t border-gray-100">
                    <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline font-sans font-bold">
                        ← Back
                    </a>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-10 border-l border-gray-100 pl-0 lg:pl-10">
                
                <div>
                    <h3 class="sidebar-heading">Appears In Stories</h3>
                    
                    @if($character->stories->count() > 0)
                        <div class="space-y-6">
                            @foreach($character->stories as $story)
                                <div class="w-full">
                                    <a href="{{ route('frontend.short-story.show', $story->id) }}" class="block">
                                        <span class="text-blue-600 font-sans font-bold text-base hover:underline">
                                            {{ $story->title }}
                                        </span>
                                    </a>
                                    
                                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">
                                        {{ Str::limit(strip_tags($story->short_description ?? $story->short_story_details), 80) }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400 italic text-sm">This character is not linked to any stories yet.</p>
                    @endif
                </div>

            </div>

        </div>

    </div>
</div>

@include('frontend.includes.footer')