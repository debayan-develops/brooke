<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogModel;
use App\Models\BlogSlider;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
public function index(Request $request)
    {
        // 1. Start Query
        $query = \App\Models\BlogModel::with('blogTags')->where('status', 1);

        // 2. Search Logic
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 3. Category Filter
        if ($request->filled('category_id') && $request->category_id !== 'all') {
            $query->whereHas('blogCategories', function($q) use ($request) {
                $q->where('content_categories.id', $request->category_id);
            });
        }

        // 4. Tag Filter
        if ($request->filled('tag_id')) {
            $query->whereHas('blogTags', function($q) use ($request) {
                $q->where('tags.id', $request->tag_id);
            });
        }

        // 5. Sort Logic
        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'updated':
                $query->orderBy('updated_at', 'desc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }

    // 3. Clone Query to separate Blogs and Journals
        $blogQuery = clone $query;
        $journalQuery = clone $query;

        // 4. Fetch 'Featured Blogs' (Top Section)
        // Default: 8 items. Explore All: 10 items.
        $perPage = $request->input('view') === 'all' ? 10 : 6;
        
        $blogs = $blogQuery->where('article_type', 'Blog')->paginate($perPage, ['*'], 'blog_page');
        //dd($blogs);
        // 5. Fetch 'Featured Journals' (Bottom Section)
        // Default: Fetch 6 (2 Visible + 4 in Dropdown)
        // Explore All: Fetch 10 per page
        $journalPerPage = $request->input('journal_view') === 'all' ? 10 : 6;
        
        // We use 'journal_page' as the page name to avoid conflict with the Blog pagination
        $journals = $journalQuery->where('article_type', 'Journal')
                                 ->paginate($journalPerPage, ['*'], 'journal_page');
        // 6. Fetch Categories (Existing Logic)
        $categories = \Illuminate\Support\Facades\DB::table('content_categories')
                        ->join('category_type_map', 'content_categories.id', '=', 'category_type_map.content_category_id')
                        ->join('category_type', 'category_type_map.category_type_id', '=', 'category_type.id')
                        ->where('category_type.slug', 'blog')
                        ->select('content_categories.*')
                        ->distinct()
                        ->get();

        return view('frontend.blog.index', compact('blogs', 'journals', 'categories'));
    }
 public function show($id)
    {
        // 1. Fetch Blog with Relationships
        $blog = \App\Models\BlogModel::with(['blogTags', 'blogCategories', 'suggestedBlogs'])
                    ->where('status', 1)
                    ->findOrFail($id);

        // 2. Fetch Slider Images
        $sliderImages = \App\Models\BlogSlider::where('blog_id', $id)->get();

        // 3. Fetch Suggested Articles (Selected in Admin)
        $relatedBlogs = $blog->suggestedBlogs()->where('status', 1)->get();

        // 4. FIX: Fetch ONLY 'Blog' Categories
        // We join the map table to filter only categories linked to the 'Blog' type
        $categories = \Illuminate\Support\Facades\DB::table('content_categories')
                        ->join('category_type_map', 'content_categories.id', '=', 'category_type_map.content_category_id')
                        ->join('category_type', 'category_type_map.category_type_id', '=', 'category_type.id')
                        ->where('category_type.slug', 'blog')
                        ->select('content_categories.*')
                        ->distinct()
                        ->get();

        // 5. Increment Views
        //$blog->increment('view_count');

        return view('frontend.blog.details', compact('blog', 'sliderImages', 'relatedBlogs', 'categories'));
    }
}