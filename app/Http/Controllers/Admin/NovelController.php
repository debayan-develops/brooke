<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NovelModel as Novel; // Ensure this matches your model name
use App\Models\NovelChapterModel;
use App\Models\NovelChapterSliderImagesModel;
use Illuminate\Support\Facades\Storage;

class NovelController extends Controller
{
    // --- NOVEL LIST & ADD (Existing functions you likely had) ---

    public function index()
    {
        $novels = Novel::all();
        return view('admin.contentManager.novels.index', [
            'title' => 'Novels',
            'novels' => $novels
        ]);
    }

    public function addBNovels()
    {
        // Initialize empty arrays to prevent "Undefined variable" errors
        $tags = []; 
        $relatedNovels = []; // <--- Added this

        return view('admin.contentManager.novels.addNovels', [
            'title' => 'Add Novel',
            'tags'  => $tags,
            'relatedNovels' => $relatedNovels // <--- Passing it to the view
        ]);
    }

    public function storeNovel(Request $request)
    {
        // 1. Validate all the new fields
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',   // Short Description
            'about_story' => 'nullable|string',   // About Story
            'permission' => 'required|integer',   // 0, 1, 2
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // <--- Banner Validation
            'status' => 'required|boolean',
        ]);

        $data = [
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'description' => $request->input('description'),
            'about_story' => $request->input('about_story'),
            'permission' => $request->input('permission'),
            'status' => $request->input('status'),
        ];

        // 2. Handle Thumbnail
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('novels', 'public');
        }

        // 3. Handle Banner Image (THE FIX)
        // We use the same 'novels/banners' path and 'public' disk as the Update function.
        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('novels/banners', 'public');
        }

        // 4. Create the Novel
        $novel = Novel::create($data);

        // 5. Save Tags and Related Novels (Since you added them to the Add Page)
        if ($request->has('tags')) {
            $novel->tags()->sync($request->input('tags'));
        }
        if ($request->has('relatedNovels')) {
            $novel->relatedNovels()->sync($request->input('relatedNovels'));
        }

        return redirect()->route('admin.novels')->with('success', 'Novel added successfully!');
    }
    // --- NOVEL EDIT / UPDATE / DELETE (Moved from ContentManagementController) ---

    public function editNovels($id)
    {
        $novel = Novel::with(['chapters', 'tags', 'relatedNovels'])->findOrFail($id);
        
        // Fetch lists for the dropdowns
        $tags = \App\Models\Tag::all(); // Assuming your Tag model is here
        $relatedNovels = Novel::where('id', '!=', $id)->get(); // Get all novels except self

        return view('admin.contentManager.novels.editNovels', [
            'title' => 'Edit Novel',
            'novel' => $novel,
            'tags'  => $tags,
            'relatedNovels' => $relatedNovels
        ]);
    }

    public function updateNovel(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string', // Short Description
            'about_story' => 'nullable|string', // About Story
            'permission' => 'required|integer', // 0, 1, 2
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        $novel = Novel::findOrFail($id);

        $data = [
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'description' => $request->input('description'),
            'about_story' => $request->input('about_story'),
            'permission' => $request->input('permission'),
            'status' => $request->input('status'),
        ];

        // 1. Handle Images
        if ($request->hasFile('thumbnail')) {
            if ($novel->thumbnail && Storage::disk('public')->exists($novel->thumbnail)) {
                Storage::disk('public')->delete($novel->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('novels', 'public');
        }

        if ($request->hasFile('banner_image')) {
            if ($novel->banner_image && Storage::disk('public')->exists($novel->banner_image)) {
                Storage::disk('public')->delete($novel->banner_image);
            }
            $data['banner_image'] = $request->file('banner_image')->store('novels/banners', 'public');
        }

        // 2. Update Basic Data
        $novel->update($data);

        // 3. Update Relationships (Tags & Related Novels)
        // Ensure your NovelModel has 'tags()' and 'relatedNovels()' relationships defined.
        if ($request->has('tags')) {
            $novel->tags()->sync($request->input('tags'));
        }
        if ($request->has('relatedNovels')) {
            $novel->relatedNovels()->sync($request->input('relatedNovels'));
        }

        return redirect()->route('admin.novels')->with('success', 'Novel updated successfully!');
    }

    public function deleteNovel($id)
    {
        $novel = Novel::findOrFail($id);
        
        if ($novel->thumbnail && Storage::disk('public')->exists($novel->thumbnail)) {
            Storage::disk('public')->delete($novel->thumbnail);
        }

        $novel->delete(); // Cascading delete for chapters usually handled by DB, or add manual logic here if needed

        return back()->with('success', 'Novel deleted successfully!');
    }

    // --- CHAPTER MANAGEMENT (Moved from ContentManagementController) ---

    public function addChapter($novel_id)
    {
        $novel = Novel::with('chapters')->findOrFail($novel_id);
        
        return view('admin.contentManager.novels.addChapter', [
            'title' => 'Add Chapter: ' . $novel->title,
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
        ]);

        $chapter = new NovelChapterModel();
        $chapter->novel_id = $novel_id;
        $chapter->title = $request->input('title');
        $chapter->chapter_number = $request->input('chapter_number');
        $chapter->description = $request->input('description');
        $chapter->is_active = $request->input('is_active', 1);
        $chapter->save();

        return redirect()->route('admin.addChapter', $novel_id)->with('success', 'Chapter added successfully!');
    }

    public function editChapter($novel_id, $chapter_id)
    {
        $novel = Novel::with('chapters')->findOrFail($novel_id);
        $chapterToEdit = NovelChapterModel::findOrFail($chapter_id);

        return view('admin.contentManager.novels.addChapter', [
            'title' => 'Edit Chapter: ' . $chapterToEdit->title,
            'novelId' => $novel_id,
            'novel' => $novel,
            'chapters' => $novel->chapters,
            'chapterToEdit' => $chapterToEdit
        ]);
    }

    public function updateChapter(Request $request, $chapter_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'chapter_number' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $chapter = NovelChapterModel::findOrFail($chapter_id);
        
        $chapter->update([
            'title' => $request->input('title'),
            'chapter_number' => $request->input('chapter_number'),
            'description' => $request->input('description'),
            'is_active' => $request->input('is_active', 1),
        ]);

        return redirect()->route('admin.addChapter', $chapter->novel_id)
                         ->with('success', 'Chapter updated successfully!');
    }

    public function deleteChapter($id)
    {
        $chapter = NovelChapterModel::findOrFail($id);
        $chapter->delete();
        return back()->with('success', 'Chapter deleted successfully!');
    }

    // --- SLIDER MANAGEMENT (Moved from ContentManagementController) ---

    public function addChapterSlider($chapter_id)
    {
        $chapter = NovelChapterModel::findOrFail($chapter_id);
        $sliderImages = NovelChapterSliderImagesModel::where('novel_chapter_id', $chapter_id)->get();

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

                NovelChapterSliderImagesModel::create([
                    'novel_chapter_id' => $chapter_id,
                    'image_path' => $path,
                    'is_active' => 1
                ]);
            }
        }

        return back()->with('success', 'Slider images uploaded successfully!');
    }

    public function updateChapterSliderImage(Request $request, $image_id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
        ]);

        $image = NovelChapterSliderImagesModel::findOrFail($image_id);
        $image->title = $request->input('title');
        $image->save();

        return back()->with('success', 'Image title updated successfully!');
    }

    public function deleteChapterSliderImage($image_id)
    {
        $image = NovelChapterSliderImagesModel::findOrFail($image_id);
        
        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $image->delete();
        return back()->with('success', 'Image removed successfully!');
    }
}