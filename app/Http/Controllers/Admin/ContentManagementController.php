<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\storeCharacterRequest;
use App\Admin\Content\Domain\Models\CategoryType;
use App\Models\Character;

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

    public function tags()
    {
        $categoryTypes = CategoryType::all();
        $tags = Tag::all();

        return view('admin.contentManager.tags.index')->with([
            'title' => 'Tags',
            'tags' => $tags,
            'categoryTypes' => $categoryTypes,
            // You can pass additional data here if needed
        ]);
    }

    public function editTags($id)
    {
        $tags = Tag::find($id);
        return response()->json([$tags->load('types')]);
    }

    public function addUpdateTags(StoreTagRequest $request, $id = null)
    {
        $validated = $request->validated();

        if ($id) {
            $tag = Tag::find($id);
            $tag->name = $validated['name'];
            $tag->save();
            $tag->types()->sync($validated['tagsType']);
            return redirect()->back()->with('success', 'Tag updated successfully!');
        }

        $tagArr['name'] = $validated['name'];

        $tag = Tag::create($tagArr);
        $tag->types()->attach($validated['tagsType']);
        return redirect()->back()->with('success', 'Tag added successfully!');
    }

    public function deleteTags($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->types()->detach();
        $tag->delete();
        return redirect()->back()->with('success', 'Tag deleted successfully!');
    }

    public function character()
    {
        $categoryTypes = CategoryType::all();
        $characters = Character::all();
        return view('admin.contentManager.character.index')->with([
            'title' => 'Characters',
            'characters' => $characters,
            'categoryTypes' => $categoryTypes,
            // You can pass additional data here if needed
        ]);
    }

    public function addUpdateCharacter(storeCharacterRequest $request, $id = null)
    {
        $validated = $request->validated();

        if ($id) {
            $character = Character::find($id);
            $character->name = $validated['name'];
            $character->types()->sync($validated['characterType']);
            // $character->description = $validated['description'];
            $character->save();
            return redirect()->back()->with('success', 'Character updated successfully!');
        }

        $characterArr['name'] = $validated['name'];
        // $characterArr['description'] = $validated['description'];

        $character = Character::create($characterArr);
        $character->types()->attach($validated['characterType']);
        return redirect()->back()->with('success', 'Character added successfully!');
    }

    public function editCharacter($id)
    {
        $character = Character::find($id);
        return response()->json([$character->load('types')]);
    }

    public function deleteCharacter($id)
    {
        $character = Character::findOrFail($id);
        $character->types()->detach();
        $character->delete();
        return redirect()->back()->with('success', 'Tag deleted successfully!');
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

    public function addChapter(Request $request)
    {
        return view('admin.contentManager.novels.addChapter')->with([
            'title' => 'Add Chapter',
            'images' => [], // Assuming images are passed as a query parameter
            // You can pass additional data here if needed
        ]);
    }

    // public function addShortStories(Request $request)
    // {
    //     if ($request->isMethod('post')) {
    //     // Handle POST logic
    //         // $validatedData = $request->validate([
    //         //     'title' => 'required|string|max:255',
    //         //     'author' => 'required|string|max:255',
    //         //     'category' => 'required|string|max:255',
    //         //     'status' => 'required|in:published,draft',
    //         //     'about_home' => 'nullable|string',
    //         //     'introducing' => 'nullable|string',
    //         //     // Add other fields and their validation rules as needed
    //         // ]);

    //         // Process the validated data (e.g., save to database)
    //         // ...

    //         // Redirect or return a response after processing
    //         return redirect()->route('admin.shortStoryImageUpload')->with('success', 'Short Story added successfully!');
    //     }
    //     return view('admin.contentManager.shortStories.addShortStories')->with([
    //         'title' => 'Add Short Stories',
    //         // You can pass additional data here if needed
    //     ]);
    // }

    public function shortStoryImageUpload(Request $request)
    {
        return view('admin.contentManager.shortStories.imageUpload')->with([
            'title' => 'Upload Short Story Image',
            'images' => [], // Assuming images are passed as a query parameter
            // You can pass additional data here if needed
        ]);
    }

    public function addBlogs(Request $request)
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
            return redirect()->route('admin.blogImageUpload')->with('success', 'Blog added successfully!');
        }
        return view('admin.contentManager.blogs.addBlogs')->with([
            'title' => 'Add Blog',
            // You can pass additional data here if needed
        ]);
    }

    public function blogImageUpload(Request $request)
    {
        return view('admin.contentManager.blogs.imageUpload')->with([
            'title' => 'Upload Blog Image',
            'images' => [], // Assuming images are passed as a query parameter
            // You can pass additional data here if needed
        ]);
    }

}
