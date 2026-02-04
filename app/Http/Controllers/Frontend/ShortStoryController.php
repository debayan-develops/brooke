<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShortStories;
use App\Admin\Content\Domain\Models\ContentCategory; // Adjust path if needed
use App\Models\Tag;

class ShortStoryController extends Controller
{
    public function index(Request $request)
    {
        // 1. Define Junk Categories to Exclude
        $excludedCategories = ['GGG', 'gfni', 'nbvnvn', 'vsdvds'];

        // 2. Fetch Categories for Dropdown (Excluding Junk)
        $categories = ContentCategory::whereNotIn('name', $excludedCategories)
            ->orderBy('name')
            ->get();

        // 3. Prepare the Sections Collection
        $sections = collect();

        // 4. Check if we need to Filter (Search, Category, Tag, or Sort)
        $isFiltering = $request->filled('search') 
            || ($request->filled('category_id') && $request->category_id !== 'all') 
            || ($request->filled('tag_id') && $request->tag_id !== 'all') // Tag Filter
            || $request->filled('sort');

        if ($isFiltering) {
            // --- FILTER MODE: Flat List ---
            
            // FIX: Changed 'active' back to 1
            $query = ShortStories::with(['shortStoryCategories', 'sliderImages', 'shortStoryTags'])
                     ->where('status', 1); 

            // Search Logic
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('short_description', 'like', "%{$search}%");
                });
            }

            // Category Filter Logic
            if ($request->filled('category_id')) {
                if ($request->category_id === 'recent') {
                    $query->orderBy('created_at', 'desc');
                } elseif ($request->category_id !== 'all') {
                    $catId = $request->category_id;
                    $query->whereHas('shortStoryCategories', function($q) use ($catId) {
                        $q->where('content_categories.id', $catId);
                    });
                }
            }

            // Tag Filter Logic
            if ($request->has('tag_id') && $request->tag_id != 'all') {
                $query->whereHas('shortStoryTags', function($q) use ($request) {
                    $q->where('tag_id', $request->tag_id);
                });
            }

            // Sorting Logic
            if ($request->filled('sort')) {
                if ($request->sort == 'oldest') $query->orderBy('created_at', 'asc');
                else if ($request->sort == 'updated') $query->orderBy('updated_at', 'desc');
                else if ($request->sort == 'popular') $query->orderBy('view_count', 'desc'); 
                else $query->orderBy('created_at', 'desc');
            } elseif (!$request->filled('category_id') || $request->category_id !== 'recent') {
                $query->orderBy('created_at', 'desc');
            }

            // Get Results
            $results = $query->paginate(12);

            // Wrap in a Section for the View
            if ($results->isNotEmpty()) {
                $section = new \stdClass();
                
                // Dynamic Heading
                if ($request->has('tag_id')) {
                    $tagName = Tag::find($request->tag_id)->name ?? 'Tag';
                    $section->name = "Stories tagged with #$tagName";
                } elseif ($request->category_id === 'recent') {
                    $section->name = "Recently Uploaded Stories";
                } elseif ($request->filled('search')) {
                    $section->name = "Search Results";
                } else {
                    $section->name = "Filtered Stories";
                }
                
                $section->stories = $results;
                $sections->push($section);
            }

        } else {
            // --- DEFAULT MODE: Grouped by Category ---
            
            // FIX: Changed 'active' back to 1 here as well
            $catGroups = ContentCategory::whereNotIn('name', $excludedCategories)
                ->whereHas('shortStoryCategories', function($q) {
                    $q->where('status', 1); 
                })
                ->with(['shortStoryCategories' => function($q) {
                    $q->where('status', 1)
                      ->with('shortStoryTags') // Load Tags
                      ->orderBy('created_at', 'desc');
                }])
                ->orderBy('name')
                ->get();

            // Push groups into sections
            foreach ($catGroups as $cat) {
                $cat->stories = $cat->shortStoryCategories; 
                $sections->push($cat);
            }
        }

        return view('frontend.short-stories.index', compact('sections', 'categories'));
    }

    public function show($id)
    {
        $shortStory = ShortStories::with([
            'shortStoryCharacters', 
            'shortStoryTags', 
            'suggestedStories', 
            'shortStoryCategories',
            'sliderImages'
        ])->findOrFail($id);

        $excludedCategories = ['GGG', 'gfni', 'nbvnvn', 'vsdvds'];
        
        $sidebarCategories = ContentCategory::whereNotIn('name', $excludedCategories)
            ->orderBy('name')
            ->get();

        $sidebarTags = Tag::all(); 

        return view('frontend.short-stories.details', compact(
            'shortStory', 
            'sidebarCategories', 
            'sidebarTags'
        ));
    }
}