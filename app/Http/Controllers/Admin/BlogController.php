<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogs;
use App\Http\Requests\shortStorySlider; // Ensure this request class exists
use App\Models\BlogModel;
use App\Models\BlogType;
use App\Models\CategoryType;
use App\Models\BlogSlider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // Fetch latest blogs
        $blogs = BlogModel::orderBy('created_at', 'desc')->get();
        return view('admin.contentManager.blogs.index')->with([
            'title' => 'Blogs',
            'blogs' => $blogs,
        ]);
    }

    public function addBlogs()
    {
        $allTags = CategoryType::with('tags')->where('slug', 'blog')->first();
        $allCategories = CategoryType::with('categories')->where('slug', 'blog')->first();
        $blogTypes = BlogType::all();
        $suggestedBlogs = BlogModel::all();

        return view('admin.contentManager.blogs.addBlogs')->with([
            'title' => 'Add Blogs',
            'categories' => ($allCategories) ? $allCategories->categories : [],
            'tags' => ($allTags) ? $allTags->tags : [],
            'blogTypes' => $blogTypes,
            'suggestedBlogs' => $suggestedBlogs,
        ]);
    }

    public function storeBlog(Request $request, $id = null)
    {
        // 1. Find or Create the Blog Entry
        $blog = (!empty($id)) ? BlogModel::find($id) : new BlogModel();
        
        // 2. Save Basic Fields
        $blog->title = $request->title;
        // Generate slug from title
        $blog->slug = \Illuminate\Support\Str::slug($request->title);
        $blog->status = $request->status; // 1 = Publish, 0 = Draft
        
        // --- DATA MAPPING FIX ---
        // Map the form input 'blog_details' to the database column 'description'
        $blog->description = $request->blog_details; 

        // 3. Handle Author (Create/Update)
        if (empty($id)) {
            $blog->created_by = Auth::guard('admin')->id() ?? 1;
        } else {
            $blog->updated_by = Auth::guard('admin')->id() ?? 1;
        }

        // 4. Handle Thumbnail Upload
        // Input Name: 'thumbnail_photo' | DB Column: 'thumbnail_image'
        if ($request->hasFile('thumbnail_photo')) {
            
            // Optional: Delete old image to save space
            if (!empty($id) && $blog->thumbnail_image) {
                Storage::disk('public')->delete($blog->thumbnail_image);
            }

            $file = $request->file('thumbnail_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Save file to: storage/app/public/blogs/thumbnails
            $filePath = $file->storeAs('blogs/thumbnails', $filename, 'public');
            
            // Save the path to the Database
            $blog->thumbnail_image = $filePath; 
        }
        
        // Save the Blog Record
        $blog->save();

        // 5. Sync Relationships (Tags, Categories, Types)
        // Checks if the dropdowns were selected in the form
        if ($request->has('tags')) {
            $blog->blogTags()->sync($request->tags);
        }
        if ($request->has('categories')) {
            $blog->blogCategories()->sync($request->categories);
        }
        if ($request->has('blogTypes')) {
            $blog->blogTypes()->sync($request->blogTypes);
        }
        if ($request->has('suggestedArticles')) {
            $blog->suggestedBlogs()->sync($request->suggestedArticles);
        }

        // 6. REDIRECT LOGIC (Button Check)
        // Check if "Update & Finish" (value="save_and_exit") was clicked
        if ($request->input('action') === 'save_and_exit') {
            return redirect()->route('admin.blogs')
                             ->with('success', 'Blog updated and finished successfully!');
        } 
        else {
            // Default to "Update & Next" -> Go to Slider Page
            return redirect()->route('admin.blogImageUpload', ['id' => $blog->id])
                             ->with('success', 'Details saved! Now upload slider images.');
        }
    }

    public function editBlogs($id)
    {
        $blog = BlogModel::findOrFail($id);
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
        // Fetch slider images
        $blogSlider = BlogSlider::where('blog_id', $id)->get();
        return view('admin.contentManager.blogs.imageUpload')->with([
            'title' => 'Blog Image Upload',
            'blogId' => $id,
            'images' => $blogSlider,
        ]);
    }

    public function blogImageUploadStore(Request $request, $id)
    {
        $blog = BlogModel::findOrFail($id);

        if ($request->hasFile('slider_images')) {
            foreach ($request->file('slider_images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('blogs/slider', $filename, 'public');
                
                // Save to 'blog_slider' table (using BlogSlider model)
                BlogSlider::create([
                    'blog_id' => $blog->id,
                    'image_path' => $filePath,
                ]);
            }
        }

        // Redirect back to upload page to see the images
        return redirect()->route('admin.blogImageUpload', ['id' => $id])->with('success', 'Images uploaded!');
    }

    public function deleteSliderImage($imageId)
    {
        $sliderImage = BlogSlider::findOrFail($imageId);
        Storage::disk('public')->delete($sliderImage->image_path);
        $sliderImage->delete();

        return response()->json(['success' => true]);
    }
}