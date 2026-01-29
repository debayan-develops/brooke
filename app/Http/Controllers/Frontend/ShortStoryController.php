<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShortStories;
use App\Admin\Content\Domain\Models\ContentCategory;

class ShortStoryController extends Controller
{
   public function index(Request $request)
    {
        // 1. Define Junk Categories to Exclude
        $excludedCategories = ['GGG', 'gfni', 'nbvnvn', 'vsdvds'];

        // 2. Fetch Categories for Dropdown & Tags (Excluding Junk)
        $categories = \App\Admin\Content\Domain\Models\ContentCategory::whereNotIn('name', $excludedCategories)
            ->orderBy('name')
            ->get();

        // 3. Prepare the Sections Collection
        $sections = collect();

        // 4. Logic: Is this a Filter/Search request?
        // Note: We check if 'category_id' is set and is NOT 'all'
        $isFiltering = $request->filled('search') 
            || ($request->filled('category_id') && $request->category_id !== 'all') 
            || $request->filled('sort');

        if ($isFiltering) {
            // --- FILTER MODE: Flat List ---
            $query = \App\Models\ShortStories::query()->where('status', 1);

            // Search
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
                    // "Recently Uploaded" -> Just sort by newest
                    $query->orderBy('created_at', 'desc');
                } elseif ($request->category_id !== 'all') {
                    // Specific Category -> Filter by Relationship
                    $catId = $request->category_id;
                    $query->whereHas('shortStoryCategories', function($q) use ($catId) {
                        $q->where('content_categories.id', $catId);
                    });
                }
            }

            // Explicit Sort Dropdown (Overrides "Recent" if selected)
            if ($request->filled('sort')) {
                if ($request->sort == 'oldest') $query->orderBy('created_at', 'asc');
                else if ($request->sort == 'updated') $query->orderBy('updated_at', 'desc');
                else if ($request->sort == 'popular') $query->orderBy('created_at', 'desc'); // Placeholder for popular
                else $query->orderBy('created_at', 'desc');
            } elseif (!$request->filled('category_id') || $request->category_id !== 'recent') {
                // Default sort if not "Recent" mode
                $query->orderBy('created_at', 'desc');
            }

            $results = $query->get();

            // Wrap results in a fake section object
            if ($results->isNotEmpty()) {
                $section = new \stdClass();
                // Dynamic Heading based on filter
                if ($request->category_id === 'recent') {
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
            // Fetch categories (Excluding Junk) that actually have active stories
            $catGroups = \App\Admin\Content\Domain\Models\ContentCategory::whereNotIn('name', $excludedCategories)
                ->whereHas('shortStoryCategories', function($q) {
                    $q->where('status', 1);
                })
                ->with(['shortStoryCategories' => function($q) {
                    $q->where('status', 1)->orderBy('created_at', 'desc');
                }])
                ->orderBy('name')
                ->get();

            // Add them to sections
            foreach ($catGroups as $cat) {
                $cat->stories = $cat->shortStoryCategories; 
                $sections->push($cat);
            }
        }

        return view('frontend.short-stories.index', compact('sections', 'categories'));
    }
    
    public function show($id)
    {
        // 1. Fetch the Story with all its relationships
        $shortStory = ShortStories::with([
            'shortStoryCharacters', 
            'shortStoryTags', 
            'suggestedStories', 
            'shortStoryCategories',
            'sliderImages'
        ])->findOrFail($id);

        // 2. Fetch Global Lists for the Right Sidebar
        // Exclude junk categories
        $excludedCategories = ['GGG', 'gfni', 'nbvnvn', 'vsdvds'];
        
        $sidebarCategories = \App\Admin\Content\Domain\Models\ContentCategory::whereNotIn('name', $excludedCategories)
            ->orderBy('name')
            ->get();

        $sidebarTags = \App\Models\Tag::all(); // Assuming you have a Tag model

        // 3. Pass everything to the View
        return view('frontend.short-stories.details', compact(
            'shortStory', 
            'sidebarCategories', 
            'sidebarTags'
        ));
    }
}