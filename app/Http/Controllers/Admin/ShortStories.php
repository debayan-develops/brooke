<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryType;
use App\Models\Character;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreShortStories;
use App\Models\ShortStories as ShortStoriesModel;

class ShortStories extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::all();
        $categoryTypes = CategoryType::all();
        $characters = Character::with('shortStories')->find(1);
        return view('admin.contentManager.shortStories.index')->with([
            'title' => 'Short Stories',
            'characters' => $characters,
            // You can pass additional data here if needed
        ]);
    }

    public function addShortStories()
    {

        $allCharacters = CategoryType::with('characters')->where('slug', 'short-story')->first();
        $allTags = CategoryType::with('tags')->where('slug', 'short-story')->first();
        $allCategories = CategoryType::with('categories')->where('slug', 'short-story')->first();

        return view('admin.contentManager.shortStories.addShortStories')->with([
            'title' => 'Add Short Stories',
            'characters' => $allCharacters->characters??[],
            'tags' => $allTags->tags??[],
            'categories' => $allCategories->categories??[],
            // You can pass additional data here if needed
        ]);
    }

    public function storeShortStories(StoreShortStories $request, $id = null)
    {
        
        $validated = $request->validated();
        $shortStory = (!empty($id)) ? ShortStoriesModel::find($id) : new ShortStoriesModel();
        $shortStory->title = $validated['title'];
        $shortStory->short_description = $validated['short_description'];
        // Handle file upload
        if ($request->hasFile('thumbnail_photo')) {
            $file = $request->file('thumbnail_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('short_stories/thumbnails', $filename, 'public');
            $shortStory->thumbnail_photo = $filePath;
        }
        $shortStory->short_story_details = $validated['short_story_details'];
        $shortStory->status = $validated['status'];
        if (empty($id)) {
            $shortStory->created_by = Auth::id();
        }
        $shortStory->updated_by = Auth::id();
        $shortStory->save();

        // Sync relationships
        if (isset($validated['characters'])) {
            $shortStory->shortStoryCharacters()->sync($validated['characters']);
        }
        if (isset($validated['tags'])) {
            $shortStory->shortStoryTags()->sync($validated['tags']);
        }
        if (isset($validated['categories'])) {
            $shortStory->shortStoryCategories()->sync($validated['categories']);
        }
        if(isset($validated['suggested_stories'])) {
            $shortStory->suggestedStories()->sync($validated['suggested_stories']);
        }
        return redirect()->route('admin.shortStoryImageUpload')->with('success', 'Short Story added successfully!');
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
