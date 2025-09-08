<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentManagementController extends Controller {

    /**
     * Handle the incoming request.
     */

    public function contentCategory(Request $request)
    {
        return view('admin.contentManager.contentCategory')->with([
            'title' => 'Content Category',
            // You can pass additional data here if needed
        ]);
    }

    public function tags(Request $request)
    {
        return view('admin.contentManager.tags.index')->with([
            'title' => 'Tags',
            // You can pass additional data here if needed
        ]);
    }

    public function character(Request $request)
    {
        return view('admin.contentManager.character.index')->with([
            'title' => 'Characters',
            // You can pass additional data here if needed
        ]);
    }

    public function contents(Request $request)
    {
        return view('admin.contentManager.contents')->with([
            'title' => 'Contents',
            // You can pass additional data here if needed
        ]);
    }

    public function novels(Request $request)
    {
        return view('admin.contentManager.novels.index')->with([
            'title' => 'Novels ',
            // You can pass additional data here if needed
        ]);
    }

    public function blogs(Request $request)
    {
        return view('admin.contentManager.blogs.index')->with([
            'title' => 'Blogs',
            // You can pass additional data here if needed
        ]);
    }

    public function shortStories(Request $request)
    {
        return view('admin.contentManager.shortStories.index')->with([
            'title' => 'Short Stories',
            // You can pass additional data here if needed
        ]);
    }



    public function addNovels(Request $request)
    {
        return view('admin.contentManager.novels.addNovels')->with([
            'title' => 'Add Novels',
            // You can pass additional data here if needed
        ]);
    }

    public function addShortStories(Request $request)
    {
        if ($request->isMethod('post')) {
        // Handle POST logic
            // $validatedData = $request->validate([
            //     'title' => 'required|string|max:255',
            //     'author' => 'required|string|max:255',
            //     'category' => 'required|string|max:255',
            //     'status' => 'required|in:published,draft',
            //     'about_home' => 'nullable|string',
            //     'introducing' => 'nullable|string',
            //     // Add other fields and their validation rules as needed
            // ]);

            // Process the validated data (e.g., save to database)
            // ...

            // Redirect or return a response after processing
            return redirect()->route('admin.shortStoryImageUpload')->with('success', 'Short Story added successfully!');
        }
        return view('admin.contentManager.shortStories.addShortStories')->with([
            'title' => 'Add Short Stories',
            // You can pass additional data here if needed
        ]);
    }

    public function shortStoryImageUpload(Request $request)
    {
        return view('admin.contentManager.shortStories.imageUpload')->with([
            'title' => 'Upload Short Story Image',
            'images' => [], // Assuming images are passed as a query parameter
            // You can pass additional data here if needed
        ]);
    }

}
