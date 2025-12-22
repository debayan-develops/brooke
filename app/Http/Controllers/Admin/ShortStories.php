<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryType;
use App\Models\ShortStories as ShortStoriesModel;
use App\Models\shortStorySlider as shortStorySliderModel;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreShortStories;
use App\Http\Requests\shortStorySlider;

class ShortStories extends Controller
{
    public function index(Request $request)
    {
        $shortStories = ShortStoriesModel::all();
        return view('admin.contentManager.shortStories.index')->with([
            'title' => 'Short Stories',
            'shortStories' => $shortStories,
        ]);
    }

    public function addShortStories()
    {
        $allCharacters = CategoryType::with('characters')->where('slug', 'short-story')->first();
        $allTags = CategoryType::with('tags')->where('slug', 'short-story')->first();
        $allCategories = CategoryType::with('categories')->where('slug', 'short-story')->first();
        $suggestedStories = ShortStoriesModel::all();

        return view('admin.contentManager.shortStories.addShortStories')->with([
            'title' => 'Add Short Stories',
            'characters' => ($allCharacters) ? $allCharacters->characters : [],
            'tags' => ($allTags) ? $allTags->tags : [],
            'categories' => ($allCategories) ? $allCategories->categories : [],
            'suggestedStories' => $suggestedStories,
        ]);
    }

    // --- NEW: The missing Update function ---
    public function update(StoreShortStories $request, $id)
    {
        return $this->storeShortStories($request, $id);
    }

    public function storeShortStories(StoreShortStories $request, $id = null)
    {
        $validated = $request->validated();
        $shortStory = (!empty($id)) ? ShortStoriesModel::find($id) : new ShortStoriesModel();
        
        $shortStory->title = $validated['title'];
        $shortStory->short_description = $validated['short_description'];

        if ($request->hasFile('thumbnail_photo')) {
            if (!empty($id) && $shortStory->thumbnail_photo) {
                \Storage::disk('public')->delete($shortStory->thumbnail_photo);
            }
            $file = $request->file('thumbnail_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('short_stories/thumbnails', $filename, 'public');
            $shortStory->thumbnail_photo = $filePath;
        }

        $shortStory->short_story_details = $validated['short_story_details'];
        $shortStory->status = $validated['status'];
        
        if (empty($id)) {
            $shortStory->created_by = Auth::guard('admin')->id();
        } else {
            $shortStory->updated_by = Auth::guard('admin')->id();
        }
        
        $shortStory->save();

        if (isset($validated['characters'])) $shortStory->shortStoryCharacters()->sync($validated['characters']);
        if (isset($validated['tags'])) $shortStory->shortStoryTags()->sync($validated['tags']);
        if (isset($validated['categories'])) $shortStory->shortStoryCategories()->sync($validated['categories']);
        
        if(isset($validated['suggested_stories'])) {
            $shortStory->suggestedStories()->sync($validated['suggested_stories']);
        } elseif(isset($validated['suggestedStories'])) {
            $shortStory->suggestedStories()->sync($validated['suggestedStories']);
        }

        // --- FIX: Correct redirect for "Save & Exit" ---
        if ($request->input('action') == 'save_and_exit') {
            return redirect()->route('admin.shortStories')->with('success', 'Short Story saved successfully!');
        }

        if (!empty($id)) {
            return redirect()->route('admin.shortStoryImageUpload', ['id' => $id])->with('success', 'Short Story updated successfully!');
        }
        return redirect()->route('admin.shortStoryImageUpload', ['id' => $shortStory->id])->with('success', 'Short Story added successfully!');
    }

    public function shortStoryImageUpload($id = null)
    {
        $sliderImages = shortStorySliderModel::where('short_story_id', $id)->get();
        return view('admin.contentManager.shortStories.imageUpload')->with([
            'title' => 'Upload Short Story Image',
            'id' => $id,
            'images' => $sliderImages,
        ]);
    }

    public function shortStoryImageUploadStore(shortStorySlider $request, $id = null)
    {
        $shortStory = ShortStoriesModel::findOrFail($id);
        if ($request->hasFile('slider_images')) {
            foreach ($request->file('slider_images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('short_stories/slider', $filename, 'public');
                
                $sliderImage = new shortStorySliderModel();
                $sliderImage->short_story_id = $shortStory->id;
                $sliderImage->image_path = $filePath;
                $sliderImage->save();
            }
        }
        return back()->with('success', 'Slider images uploaded successfully!');
    }

    public function deleteSliderImage($imageId)
    {
        $sliderImage = shortStorySliderModel::findOrFail($imageId);
        \Storage::disk('public')->delete($sliderImage->image_path);
        $sliderImage->delete();
        return response()->json(['success' => true]);
    }   

    public function editShortStories($id)
    {
        $shortStory = ShortStoriesModel::findOrFail($id)->load(['shortStoryCategories', 'shortStoryTags', 'shortStoryCharacters', 'suggestedStories']);
        $allCharacters = CategoryType::with('characters')->where('slug', 'short-story')->first();
        $allTags = CategoryType::with('tags')->where('slug', 'short-story')->first();
        $allCategories = CategoryType::with('categories')->where('slug', 'short-story')->first();
        $suggestedStories = ShortStoriesModel::all();

        return view('admin.contentManager.shortStories.editShortStories')->with([
            'title' => 'Edit Short Stories',
            'shortStory' => $shortStory,
            'characters' => ($allCharacters) ? $allCharacters->characters : [],
            'tags' => ($allTags) ? $allTags->tags : [],
            'categories' => ($allCategories) ? $allCategories->categories : [],
            'suggestedStories' => $suggestedStories,
        ]);
    }
}