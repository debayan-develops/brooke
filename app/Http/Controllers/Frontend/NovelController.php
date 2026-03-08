<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    // FIX: Added 'Request $request' to handle Search & Sort
    public function index(\Illuminate\Http\Request $request)
    {
        // 1. Fetch the "categories" (which are actually Tags assigned to the 'novel' type)
        $categories = \App\Models\Tag::whereHas('types', function ($query) {
            $query->where('slug', 'novel')->orWhere('name', 'novel');
        })->get();

        // 2. Start the query for active novels
        $query = \App\Models\NovelModel::with(['tags', 'chapters'])->where('status', 1);

        // 3. Apply Text Search (Searches title or description)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // 4. Apply Category Filter (Using the tags relationship pivot)
        if ($request->filled('category')) {
            $categoryId = $request->category;
            $query->whereHas('tags', function($q) use ($categoryId) {
                // 'tags.id' refers to the id in the tags table
                $q->where('tags.id', $categoryId); 
            });
        }

        // 5. Apply Sorting
        switch ($request->sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'updated': // Recently Updated
                $query->orderBy('updated_at', 'desc');
                break;
            case 'popular': // Most Popular
                $query->withCount('chapters')->orderBy('chapters_count', 'desc');
                break;
            default: // 'newest' (Default)
                $query->orderBy('created_at', 'desc');
                break;
        }

        // 6. Execute Query with Pagination & Keep Filters in Links
        $novels = $query->paginate(12)->withQueryString();

        return view('frontend.novel.index', compact('novels', 'categories'));
    }
   public function chapters(\Illuminate\Http\Request $request, $id)
    {
        // 1. Fetch the novel and relations (exclude chapters here to save memory)
        $novel = \App\Models\NovelModel::with([
            'tags', 
            'relatedNovels', 
            'characters'
        ])->findOrFail($id);

        // 2. Base query for active chapters
        $baseQuery = \App\Models\NovelChapterModel::where('novel_id', $id)->where('is_active', 1);
        
        // Calculate the highest chapter number to generate ranges (before any searches are applied)
        $highestChapter = (clone $baseQuery)->max('chapter_number') ?? 0;
        $totalChaptersCount = (clone $baseQuery)->count();

       // 3. Generate dynamic "Jump To" ranges (Minimum 10 ranges up to 500, extending if there are more chapters)
        $ranges = [];
        // Changed max limit from 250 to 500
        $maxLimit = max(500, ceil($highestChapter / 50) * 50); 
        for ($i = 0; $i < $maxLimit; $i += 50) {
            $start = $i == 0 ? 0 : $i + 1;
            $end = $i + 50;
            $ranges[] = "{$start}-{$end}";
        }

        // 4. Apply the currently selected range
        $currentRange = $request->get('range', '0-50');
        $query = clone $baseQuery;
        
        if ($currentRange) {
            $parts = explode('-', $currentRange);
            if (count($parts) == 2) {
                $query->whereBetween('chapter_number', [(int)$parts[0], (int)$parts[1]]);
            }
        }

        // 5. Apply Optional Text Search
        if ($request->filled('chapter_search')) {
            $search = $request->chapter_search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('chapter_number', 'like', "%{$search}%");
            });
        }

        // 6. Paginate (10 Chapters per page)
        $chapters = $query->orderBy('chapter_number', 'asc')->paginate(10)->withQueryString();

        return view('frontend.novel.chapters', compact('novel', 'chapters', 'ranges', 'currentRange', 'totalChaptersCount'));
    }

    public function chapterDetails($novelId, $chapterId)
    {
        // 1. Fetch the Novel
        $novel = \App\Models\NovelModel::findOrFail($novelId);
        
        // 2. Fetch the Chapter with its Slider Images
        $chapter = \App\Models\NovelChapterModel::with('sliderImages')
                        ->where('novel_id', $novelId)
                        ->findOrFail($chapterId);

        // 3. Get Previous and Next Chapters for Pagination
        $previousChapter = \App\Models\NovelChapterModel::where('novel_id', $novelId)
                            ->where('is_active', 1)
                            ->where('chapter_number', '<', $chapter->chapter_number)
                            ->orderBy('chapter_number', 'desc')
                            ->first();

        $nextChapter = \App\Models\NovelChapterModel::where('novel_id', $novelId)
                            ->where('is_active', 1)
                            ->where('chapter_number', '>', $chapter->chapter_number)
                            ->orderBy('chapter_number', 'asc')
                            ->first();

        return view('frontend.novel.chapter-details', compact('novel', 'chapter', 'previousChapter', 'nextChapter'));
    }
}