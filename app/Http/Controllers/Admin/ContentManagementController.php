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

    // ================= NOVEL LOGIC (NEW) =================

    public function editNovels($id)
    {
        // Load novel with chapters for the table, and tags/related for selection
        $novel = Novel::with(['chapters', 'tags', 'relatedNovels'])->findOrFail($id);
        
        // Data for dropdowns
        $tags = Tag::all(); 
        $relatedNovels = Novel::where('id', '!=', $id)->get(); // Exclude self

        return view('admin.contentManager.novels.editNovels')->with([
            'title' => 'Edit Novel',
            'novel' => $novel,
            'tags' => $tags,
            'relatedNovels' => $relatedNovels
        ]);
    }

    public function updateNovel(Request $request, $id)
    {
        // 1. Validate
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'about_story' => 'nullable|string',
            'status' => 'required|boolean',
            'permission' => 'required|integer',
            'thumbnail' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
            'tags' => 'nullable|array',
            'relatedNovels' => 'nullable|array',
        ]);

        $novel = Novel::findOrFail($id);

        // 2. Update Basic Fields
        $novel->title = $request->input('title');
        $novel->author = $request->input('author');
        $novel->description = $request->input('description');
        $novel->about_story = $request->input('about_story');
        $novel->status = $request->input('status');
        $novel->permission = $request->input('permission');

        // 3. Handle Thumbnail Upload
        if ($request->hasFile('thumbnail')) {
            if ($novel->thumbnail) {
                Storage::disk('public')->delete($novel->thumbnail);
            }
            $path = $request->file('thumbnail')->store('novels/thumbnails', 'public');
            $novel->thumbnail = $path;
        }

        // 4. Handle Banner Upload
        if ($request->hasFile('banner_image')) {
            if ($novel->banner_image) {
                Storage::disk('public')->delete($novel->banner_image);
            }
            $path = $request->file('banner_image')->store('novels/banners', 'public');
            $novel->banner_image = $path;
        }

        $novel->save();

        // 5. Sync Relationships
        if ($request->has('tags')) {
            $novel->tags()->sync($request->input('tags'));
        }
        if ($request->has('relatedNovels')) {
            $novel->relatedNovels()->sync($request->input('relatedNovels'));
        }

        // 6. Handle "Update & Finish" Button
        if ($request->input('action') == 'save_and_exit') {
            return redirect()->route('admin.novels')->with('success', 'Novel updated successfully!');
        }

        // Default: Stay on page (Update & Next)
        return back()->with('success', 'Novel updated successfully!');
    }
    // ================= CHAPTER LOGIC =================

    public function addChapter($novel_id)
  {
    // Ensure we load the 'chapters' relationship so the table isn't empty
    $novel = Novel::with('chapters')->findOrFail($novel_id);
    
    // Pass variables directly as the second argument
    return view('admin.contentManager.novels.addChapter', [
        'title' => 'Add Chapter: ' . $novel->title, // This fixes the "$title undefined" error
        'novelId' => $novel_id,
        'novel' => $novel,
        'chapters' => $novel->chapters,
    ]);
  }

    public function storeChapter(Request $request, $novel_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'chapter_number' => 'required|integer',
            'description' => 'nullable|string',
            'content' => 'nullable|string', // Assuming you have body content
        ]);

        $chapter = new \App\Models\novelChapterModel();
        $chapter->novel_id = $novel_id;
        $chapter->title = $request->input('title');
        $chapter->chapter_number = $request->input('chapter_number');
        $chapter->description = $request->input('description');
        // $chapter->content = $request->input('content'); // Uncomment if you have content column
        $chapter->is_active = 1;
        $chapter->save();

        return redirect()->route('admin.editNovels', $novel_id)->with('success', 'Chapter added successfully!');
    }

    public function deleteNovel($id)
    {
        $novel = Novel::findOrFail($id);
        
        // Optional: Delete images from storage if they exist
        if ($novel->thumbnail) {
            Storage::disk('public')->delete($novel->thumbnail);
        }
        if ($novel->banner_image) {
            Storage::disk('public')->delete($novel->banner_image);
        }

        // Delete the novel (and chapters due to cascade if set up in DB, otherwise manual delete)
        $novel->delete();

        return back()->with('success', 'Novel deleted successfully!');
    }
    // ================= CHAPTER ACTIONS (Delete & Slider) =================

    public function deleteChapter($id)
    {
        $chapter = \App\Models\novelChapterModel::findOrFail($id);
        $chapter->delete();
        return back()->with('success', 'Chapter deleted successfully!');
    }

    public function addChapterSlider($chapter_id)
    {
        $chapter = \App\Models\novelChapterModel::findOrFail($chapter_id);
        // Fetch existing slider images
        $sliderImages = \App\Models\novelChapterSliderImagesModel::where('novel_chapter_id', $chapter_id)->get();

        return view('admin.contentManager.novels.addSlider', compact('chapter', 'sliderImages'));
    }

    public function storeChapterSlider(Request $request, $chapter_id)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('novels/chapters/sliders', 'public');

                \App\Models\novelChapterSliderImagesModel::create([
                    'novel_chapter_id' => $chapter_id,
                    'image_path' => $path,
                    'is_active' => 1
                ]);
            }
        }

        return back()->with('success', 'Slider images uploaded successfully!');
    }

    public function deleteChapterSliderImage($image_id)
    {
        $image = \App\Models\novelChapterSliderImagesModel::findOrFail($image_id);
        
        // Delete file from storage
        if ($image->image_path) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $image->delete();
        return back()->with('success', 'Image removed successfully!');
    }
    public function editChapter($novel_id, $chapter_id)
    {
        $novel = Novel::with('chapters')->findOrFail($novel_id);
        $chapterToEdit = \App\Models\novelChapterModel::findOrFail($chapter_id);

        return view('admin.contentManager.novels.addChapter', [
            'title' => 'Edit Chapter: ' . $chapterToEdit->title,
            'novelId' => $novel_id,
            'novel' => $novel,
            'chapters' => $novel->chapters,
            'chapterToEdit' => $chapterToEdit // This triggers "Edit Mode" in the view
        ]);
    }

    public function updateChapter(Request $request, $chapter_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'chapter_number' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $chapter = \App\Models\novelChapterModel::findOrFail($chapter_id);
        
        $chapter->update([
            'title' => $request->input('title'),
            'chapter_number' => $request->input('chapter_number'),
            'description' => $request->input('description'),
            'is_active' => $request->input('is_active', 1),
        ]);

        return redirect()->route('admin.addChapter', $chapter->novel_id)
                         ->with('success', 'Chapter updated successfully!');
    }
    public function updateChapterSliderImage(Request $request, $image_id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
        ]);

        $image = \App\Models\novelChapterSliderImagesModel::findOrFail($image_id);
        $image->title = $request->input('title');
        $image->save();

        return back()->with('success', 'Image title updated successfully!');
    }
}