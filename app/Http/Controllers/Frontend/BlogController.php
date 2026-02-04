<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogModel; // FIX: Use the User's Repository Model
use App\Models\BlogSlider;
use Illuminate\Support\Facades\DB; // FIX: Import DB to fetch categories directly

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // 1. Fetch Active Blogs
        $query = BlogModel::where('status', 1);

        // 2. Search Logic
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 3. Sorting
        $blogs = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // 4. Fetch Categories for Filter (Direct from DB to avoid Model errors)
        // We use the table 'blog_categories' which we seeded
        $categories = DB::table('blog_categories')->where('status', 1)->get();

        return view('frontend.blog.index', compact('blogs', 'categories'));
    }

    public function show($id)
    {
        // 1. Fetch Blog
        $blog = BlogModel::where('status', 1)->findOrFail($id);

        // 2. Fetch Slider Images (Correctly using BlogSlider Model)
        $sliderImages = BlogSlider::where('blog_id', $id)->get();

        // 3. Fetch Related Articles
        $relatedBlogs = BlogModel::where('id', '!=', $id)
                            ->where('status', 1)
                            ->inRandomOrder()
                            ->take(6)
                            ->get();

        // 4. Fetch Categories
        $categories = DB::table('blog_categories')->where('status', 1)->get();

        // 5. Increment View Count
        $blog->increment('view_count');

        return view('frontend.blog.details', compact('blog', 'sliderImages', 'relatedBlogs', 'categories'));
    }
}