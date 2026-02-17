<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Character;
use App\Models\CategoryType;
use App\Models\NovelModel as Novel;
use App\Models\NovelChapterSliderImagesModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; // Added for file deletion

class ContentManagementController extends Controller
{
    public function index()
    {
        return view('admin.contentManager.contents')->with(['title' => 'Contents']);
    }

    // ================= TAGS LOGIC =================

    public function tags()
    {
        // Fetch ALL tags with types eagerly loaded for client-side filtering
        $tags = Tag::with('types')->orderBy('id', 'desc')->get();
        $categoryTypes = CategoryType::all();

        return view('admin.contentManager.tags.index')->with([
            'title' => 'Tags',
            'tags' => $tags,
            'categoryTypes' => $categoryTypes
        ]);
    }

    public function storeTag(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'categoryType' => 'nullable|array'
        ]);

        $tag = Tag::create(['name' => $request->name]);

        if ($request->has('categoryType')) {
            $tag->types()->sync($request->categoryType);
        }

        return redirect()->route('admin.tags')->with('success', 'Tag added successfully');
    }

    public function editTag($id)
    {
        // Return JSON for AJAX modal
        $tag = Tag::with('types')->findOrFail($id);
        return response()->json([$tag]);
    }

    public function updateTag(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'categoryType' => 'nullable|array'
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update(['name' => $request->name]);

        if ($request->has('categoryType')) {
            $tag->types()->sync($request->categoryType);
        }

        return redirect()->route('admin.tags')->with('success', 'Tag updated successfully');
    }

    public function deleteTag($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->types()->detach(); // Clean up pivot table
        $tag->delete();

        return redirect()->route('admin.tags')->with('success', 'Tag deleted successfully');
    }

    // ================= CHARACTERS LOGIC =================

    public function character()
    {
        // Fetch ALL characters with types for client-side filtering
        $characters = Character::with('types')->orderBy('id', 'desc')->get();
        $categoryTypes = CategoryType::all();

        return view('admin.contentManager.character.index')->with([
            'title' => 'Characters',
            'characters' => $characters,
            'categoryTypes' => $categoryTypes
        ]);
    }

    public function storeCharacter(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categoryType' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('characters', 'public');
            $data['image'] = $path;
        }
        $character = Character::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        if ($request->has('categoryType')) {
            $character->types()->sync($request->categoryType);
        }

        return redirect()->route('admin.character')->with('success', 'Character added successfully');
    }

    public function editCharacter($id)
    {
        $character = Character::with('types')->findOrFail($id);
        return response()->json([$character]);
    }

    public function updateCharacter(Request $request, $id)
{
    // 1. Validate the incoming request data
    $request->validate([
        'name'         => 'required|string|max:255',
        'description'  => 'nullable|string',
        'categoryType' => 'nullable|array',
        'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
    ]);

    // 2. Find the character or fail with 404
    $character = Character::findOrFail($id);
    
    // 3. Prepare basic data for update
    $data = [
        'name'        => $request->name,
        'description' => $request->description
    ];

    // 4. Handle Image Upload & Delete Old Image
    if ($request->hasFile('image')) {
        // Delete old image if it exists in storage
        if ($character->image && Storage::disk('public')->exists($character->image)) {
            Storage::disk('public')->delete($character->image);
        }
        
        // Store new image and update the data array
        $path = $request->file('image')->store('characters', 'public');
        $data['image'] = $path;
    }

    // 5. Update the character record
    $character->update($data);

    // 6. Sync Many-to-Many Relationship (Categories)
    // Note: This only updates categories if 'categoryType' is present in the request.
    if ($request->has('categoryType')) {
        $character->types()->sync($request->categoryType);
    }

    // 7. Redirect back with success message
    return redirect()->route('admin.character')->with('success', 'Character updated successfully');
}

    public function deleteCharacter($id)
    {
        $character = Character::findOrFail($id);
        $character->types()->detach();
        $character->delete();

        return redirect()->route('admin.character')->with('success', 'Character deleted successfully');
    }

   
}