<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogs;
use App\Http\Requests\shortStorySlider;
use App\Models\BlogModel;
use App\Models\BlogType;
use App\Models\CategoryType;
use App\Models\BlogSlider;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = BlogModel::all();
        return view('admin.contentManager.blogs.index')->with([
            'title' => 'Blogs',
            'blogs' => $blogs,
            // You can pass additional data here if needed
        ]);
    }
    public function addBlogs()
    {
        // Fix: Use optional chaining (?->) or null coalescing to prevent crash if 'blog' category type is missing
        $allTags = CategoryType::with('tags')->where('slug', 'blog')->first();
        $allCategories = CategoryType::with('categories')->where('slug', 'blog')->first();
        $blogTypes = BlogType::all();
        $suggestedBlogs = BlogModel::all();

        return view('admin.contentManager.blogs.addBlogs')->with([
            'title' => 'Add Blogs',
            // Safe navigation: if $allCategories is null, return empty array []
            'categories' => ($allCategories) ? $allCategories->categories : [],
            'tags' => ($allTags) ? $allTags->tags : [],
            'blogTypes' => $blogTypes,
            'suggestedBlogs' => $suggestedBlogs,
        ]);
    }

    public function storeBlog(StoreBlogs $request, $id = null)
    {
        
        $validated = $request->validated();
        $blog = (!empty($id)) ? BlogModel::find($id) : new BlogModel();
        $blog->title = $validated['title'];
        // $blog->short_description = $validated['short_description'];
        // dd(Auth::guard('admin')->id());
        // Handle file upload
        if ($request->hasFile('thumbnail_photo')) {
            if (!empty($id) && $blog->thumbnail_photo) {
                // Delete old file
                \Storage::disk('public')->delete($blog->thumbnail_photo);
            }
            $file = $request->file('thumbnail_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('blogs/thumbnails', $filename, 'public');
            $blog->thumbnail_photo = $filePath;
        }
        $blog->blog_details = $validated['blog_details'];
        $blog->status = $validated['status'];
        if (empty($id)) {
            $blog->created_by = Auth::guard('admin')->id();
        } else {
            $blog->updated_by = Auth::guard('admin')->id();
        }
        $blog->save();
        // Sync relationships
        if (isset($validated['blogTypes'])) {
            $blog->blogTypes()->sync($validated['blogTypes']);
        }
        if (isset($validated['tags'])) {
            $blog->blogTags()->sync($validated['tags']);
        }
        if (isset($validated['categories'])) {
            $blog->blogCategories()->sync($validated['categories']);
        }
        if(isset($validated['suggestedArticles'])) {
            $blog->suggestedBlogs()->sync($validated['suggestedArticles']);
        }
        if (!empty($id)) {
            // dd($shortStory);
            return redirect()->route('admin.blogImageUpload', ['id' => $id])->with('success', 'Blog updated successfully!');
        }
        return redirect()->route('admin.blogImageUpload', ['id' => $blog->id])->with('success', 'Blog added successfully!');
    }

    public function editBlogs($id)
    {
        $blog = BlogModel::findOrFail($id)->load(['blogTags', 'blogCategories', 'blogTypes', 'suggestedBlogs']);
        $allTags = CategoryType::with('tags')->where('slug', 'blog')->first();
        $allCategories = CategoryType::with('categories')->where('slug', 'blog')->first();
        $blogTypes = BlogType::all();
        $suggestedBlogs = BlogModel::all();

        return view('admin.contentManager.blogs.editBlogs')->with([
            'title' => 'Edit Blogs',
            'blog' => $blog,
            'categories' => ($allCategories) ? $allCategories->categories : [],
            'tags' => ($allTags) ? $allTags->tags : [],
            'blogTypes' => $blogTypes,
            'suggestedBlogs' => $suggestedBlogs,
        ]);
    }

    public function blogImageUpload($id)
    {
        // $blog = BlogModel::findOrFail($id);
        $blogSlider = BlogSlider::where('blog_id', $id)->get();
        return view('admin.contentManager.blogs.imageUpload')->with([
            'title' => 'Blog Image Upload',
            'blogId' => $id,
            'images' => $blogSlider,
        ]);
    }
    public function blogImageUploadStore(shortStorySlider $request, $id)
    {
        $blog = BlogModel::findOrFail($id);


        // Handle additional image uploads here
        if ($request->hasFile('slider_images')) {
            foreach ($request->file('slider_images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('blogs/slider', $filename, 'public');
                BlogSlider::create([
                    'blog_id' => $blog->id,
                    'image_path' => $filePath,
                ]);
                // Save the file path to a related model or a JSON column as needed
            }
        }

        return back()->with('success', 'Blog images uploaded successfully!');
    }

    public function deleteSliderImage($imageId)
    {
        $sliderImage = BlogSlider::findOrFail($imageId);
        // Delete the image file from storage
        \Storage::disk('public')->delete($sliderImage->image_path);
        // Delete the database record
        $sliderImage->delete();

        return response()->json(['success' => true]);
    }
}
