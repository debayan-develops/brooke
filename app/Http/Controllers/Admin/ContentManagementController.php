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
            'categoryType' => 'nullable|array'
        ]);

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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categoryType' => 'nullable|array'
        ]);

        $character = Character::findOrFail($id);
        $character->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        if ($request->has('categoryType')) {
            $character->types()->sync($request->categoryType);
        }

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