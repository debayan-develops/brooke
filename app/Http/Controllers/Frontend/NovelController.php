<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    // FIX: Added 'Request $request' to handle Search & Sort
    public function index(Request $request)
    {
        // 1. Start Query with Relationships (Do not paginate yet)
        $query = \App\Models\NovelModel::with(['tags', 'chapters'])
                    ->where('status', 1);

        // 2. Search Logic (Title or Description)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // 3. Sorting Logic
        switch ($request->sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'updated': // Recently Updated
                $query->orderBy('updated_at', 'desc');
                break;
            case 'popular': // Most Popular
                // Sort by chapter count as a proxy for popularity
                $query->withCount('chapters')->orderBy('chapters_count', 'desc');
                break;
            default: // 'newest' (Default)
                $query->orderBy('created_at', 'desc');
                break;
        }

        // 4. Execute Query with Pagination & Keep Filters in Links
        $novels = $query->paginate(12)->withQueryString();

        return view('frontend.novel.index', compact('novels'));
    }

    public function chapters($id)
    {
        // Fetch the novel along with its relations
        $novel = \App\Models\NovelModel::with([
            'tags', 
            'chapters' => function($query) {
                $query->where('is_active', 1)->orderBy('chapter_number', 'asc');
            }, 
            'relatedNovels', 
            'characters'
        ])->findOrFail($id);

        return view('frontend.novel.chapters', compact('novel'));
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