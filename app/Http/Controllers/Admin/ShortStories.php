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
// IMPORTANT: Make sure this Model path matches your project. 
// If your character model is named 'ShortStoryCharacter', change it here.
use App\Models\Character; 

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
        // 1. Get Validated Data for Main Fields
        $validated = $request->validated();
        
        $shortStory = (!empty($id)) ? ShortStoriesModel::find($id) : new ShortStoriesModel();
        
        // 2. Save Main Text Data
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

        /* =================================================================
           FIX: ROBUST RELATIONSHIP SYNCING
           We use $request->input() to bypass potential validation stripping
           and ensure data is saved.
           =================================================================
        */

        // 1. SYNC CHARACTERS (With "Create on Fly" Logic)
        /* =================================================================
           FIX: SYNC CHARACTERS (AND ATTACH TO CATEGORY TYPE)
           =================================================================
        */
        if ($request->has('characters')) {
            $rawCharacters = $request->input('characters');
            $finalCharacterIds = [];

            // 1. Get the "Short Story" Category Type ID to link new characters
            // (This ensures they show up in the list next time)
            $shortStoryType = \App\Models\CategoryType::where('slug', 'short-story')->first();

            if (is_array($rawCharacters)) {
                foreach ($rawCharacters as $item) {
                    if (is_numeric($item)) {
                        // EXISTING CHARACTER (ID)
                        $finalCharacterIds[] = $item;
                    } else {
                        // NEW CHARACTER (String Name)
                        // 1. Create or Find the Character
                        // Replace '\App\Models\Character' with your actual Model name if different
                        $newChar = \App\Models\Character::firstOrCreate(['name' => $item]);
                        
                        // 2. Link it to "Short Story" Type (if not already linked)
                        if ($shortStoryType) {
                            // Assuming there is a relation like 'categoryTypes()' or using the pivot table directly
                            // If your Character model has: public function categoryTypes() { return $this->belongsToMany(...); }
                            // Then use: $newChar->categoryTypes()->syncWithoutDetaching([$shortStoryType->id]);
                            
                            // If you don't have the relationship set up in the Model, use the DB facade directly:
                            \DB::table('character_type_map')->updateOrInsert([
                                'character_id' => $newChar->id,
                                'category_type_id' => $shortStoryType->id
                            ], [
                                'created_at' => now(), 
                                'updated_at' => now()
                            ]);
                        }

                        $finalCharacterIds[] = $newChar->id;
                    }
                }
                // 3. Sync all IDs to the Short Story
                $shortStory->shortStoryCharacters()->sync($finalCharacterIds);
            }
        } else {
            // Detach if empty selection
            if ($request->isMethod('post') || $request->isMethod('put')) {
                $shortStory->shortStoryCharacters()->detach();
            }
        }

        // 2. SYNC TAGS
        if ($request->has('tags')) {
            $shortStory->shortStoryTags()->sync($request->input('tags'));
        } elseif ($request->isMethod('post') || $request->isMethod('put')) {
            $shortStory->shortStoryTags()->detach();
        }

        // 3. SYNC CATEGORIES
        if ($request->has('categories')) {
            $shortStory->shortStoryCategories()->sync($request->input('categories'));
        } elseif ($request->isMethod('post') || $request->isMethod('put')) {
            $shortStory->shortStoryCategories()->detach();
        }
        
        // 4. SYNC SUGGESTED STORIES
        // Check for multiple possible input names to be safe
        $suggestedIds = [];
        if($request->has('suggested_stories')) {
            $suggestedIds = $request->input('suggested_stories');
        } elseif($request->has('suggestedStories')) {
            $suggestedIds = $request->input('suggestedStories');
        } elseif($request->has('suggested_story_ids')) {
            $suggestedIds = $request->input('suggested_story_ids');
        }

        if(!empty($suggestedIds)) {
            $shortStory->suggestedStories()->sync($suggestedIds);
        } elseif ($request->isMethod('post') || $request->isMethod('put')) {
             // Detach if empty and we are currently saving
             $shortStory->suggestedStories()->detach();
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
        // 1. Load the story with relationships
        $shortStory = ShortStoriesModel::findOrFail($id)->load(['shortStoryCategories', 'shortStoryTags', 'shortStoryCharacters', 'suggestedStories']);
        
        // 2. Load the dropdown data
        $allCharacters = CategoryType::with('characters')->where('slug', 'short-story')->first();
        $allTags = CategoryType::with('tags')->where('slug', 'short-story')->first();
        $allCategories = CategoryType::with('categories')->where('slug', 'short-story')->first();
        $suggestedStories = ShortStoriesModel::all();

        // 3. Pass data to the view
        return view('admin.contentManager.shortStories.editShortStories')->with([
            'title' => 'Edit Short Stories',
            'shortStory' => $shortStory,
            
            // --- FIX 1: Rename 'characters' to 'allCharacters' ---
            // The view expects $allCharacters, so we map the data to that name.
            'allCharacters' => ($allCharacters) ? $allCharacters->characters : [],

            'tags' => ($allTags) ? $allTags->tags : [],
            'categories' => ($allCategories) ? $allCategories->categories : [],
            
            // --- FIX 2: Pass 'allStories' as well ---
            // If your view uses $allStories loop, this ensures it works.
            'allStories' => $suggestedStories, 
            'suggestedStories' => $suggestedStories, // Keep this too, just in case
        ]);
    }

    public function sliderImages()
    {
        return $this->hasMany(\App\Models\shortStorySlider::class, 'short_story_id');
    }
}