<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNovelRequest;
use App\Models\NovelModel as Novel;
use App\Models\CategoryType;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class NovelController extends Controller
{
    public function index(Request $request)
    {
        $novels = Novel::all();
        return view('admin.contentManager.novels.index')->with([
            'title' => 'Novels',
            'novels' => $novels,
            // You can pass additional data here if needed
        ]);
    }
    public function addBNovels()
    {
        // Fix: Use optional chaining (?->) or null coalescing to prevent crash if 'blog' category type is missing
        $allTags = CategoryType::with('tags')->where('slug', 'novel')->first();
        $allCategories = CategoryType::with('categories')->where('slug', 'novel')->first();
        return view('admin.contentManager.novels.addNovels')->with([
            'title' => 'Add Novels',
            // Safe navigation: if $allCategories is null, return empty array []
            'categories' => ($allCategories) ? $allCategories->categories : [],
            'tags' => ($allTags) ? $allTags->tags : [],
        ]);
    }
    public function editNovels($id)
    {
        $novel = Novel::with(['novelTags', 'novelCategories', 'suggestedNovels'])->findOrFail($id);
        $allTags = CategoryType::with('tags')->where('slug', 'novel')->first();
        $allCategories = CategoryType::with('categories')->where('slug', 'novel')->first();
        return view('admin.contentManager.novels.addNovels')->with([
            'title' => 'Edit Novel',
            'novel' => $novel,
            // Safe navigation: if $allCategories is null, return empty array []
            'categories' => ($allCategories) ? $allCategories->categories : [],
            'tags' => ($allTags) ? $allTags->tags : [],
        ]);
    }
    public function getNovels(Request $request)
    {
        return DataTables::of(Novel::query()->select('title', 'thumbnail','description','status','id' ))
        ->addColumn('title', function ($novel) {
            return '<a style="color:blue" target="_blank" href="'.route('admin.editNovels', ['id' => $novel->id]).'">'.$novel->title.'</a>';
        })
        ->addColumn('thumbnail', function ($novel) {
            return '<img src="'.asset(config('app.assets_path')).'/'.$novel->thumbnail.'" style="width: 60px; height: 60px;" />';
        })
        ->addColumn('chapters', function ($novel) {
            return 0; // Placeholder for chapters count
        })
        ->editColumn('description', function($row) {
            return Str::limit(strip_tags($row->description), 50, '...');
        })
        ->addColumn('actions', function ($novel) {
            $html = '<div class="buttons right nowrap">';
            $html .= '<a href="'.route('admin.novels.addChapter', ['novelId' => $novel->id]).'" class="edit-btn button small blue mr-1"><span class="icon"><i class="mdi mdi-square-edit-outline"></i></span> <span style="display:inline-flex; align-items:center; justify-content:left; width:5.1rem">Add Chapters</span></a>';
            $html .= '<a href="'.route('admin.editNovels', ['id' => $novel->id]).'" class="edit-btn button small blue mr-1"><span class="icon"><i class="mdi mdi-square-edit-outline"></i></span></a>';
            // $html .= '<a href="'.route('admin.novels.delete', ['id' => $novel->id]).'" class="delete-btn button small red"><span class="icon"><i class="mdi mdi-delete"></i></span></a>';
            $html .= '<button class="delete-btn button small red --jb-modal" data-id="'.$novel->id.'" data-name="'.$novel->title.'" type="button">
                                            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                        </button>';
            $html .= '</div>';
            return $html;
            //return '<a href="'.route('admin.homes.edit', ['id' => $home->id]).'" class="edit-btn button small blue"><span class="icon"><i class="mdi mdi-square-edit-outline"></i></span></a>';
        })
        ->rawColumns(['actions', 'thumbnail', 'chapters', 'title', 'description'])
        ->toJson();
    }
    public function storeNovel(StoreNovelRequest $request, $id = null)
    {
        
        $validated = $request->validated();
        $novel = (!empty($id)) ? Novel::find($id) : new Novel();
        $novel->title = $validated['title'];
        $novel->permission = $validated['permission'] ?? null;
        // $blog->short_description = $validated['short_description'];
        // dd(Auth::guard('admin')->id());
        // Handle file upload
        if ($request->hasFile('thumbnail')) {
            if (!empty($id) && $novel->thumbnail) {
                // Delete old file
                \Storage::disk('public')->delete($novel->thumbnail);
            }
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('novels/thumbnails', $filename, 'public');
            $novel->thumbnail = $filePath;
        }
        $novel->description = $validated['description'] ?? null;
        $novel->about_story = $validated['about_story'] ?? null;
        $novel->status = $validated['status'];
        if (empty($id)) {
            $novel->created_by = Auth::guard('admin')->id();
        } else {
            $novel->updated_by = Auth::guard('admin')->id();
        }
        $novel->save();
        // Sync relationships
        // if (isset($validated['blogTypes'])) {
        //     $novel->blogTypes()->sync($validated['blogTypes']);
        // }
        if (isset($validated['tags'])) {
            $novel->novelTags()->sync($validated['tags']);
        }
        // if (isset($validated['categories'])) {
        //     $novel->novelCategories()->sync($validated['categories']);
        // }
        if(isset($validated['related_novels'])) {
            $novel->suggestedNovels()->sync($validated['related_novels']);
        }
        if (!empty($id)) {
            // dd($shortStory);
            return redirect()->route('admin.addChapter', ['id' => $id])->with('success', 'Novel updated successfully!');
        }
        // return redirect()->route('admin.addChapter', ['id' => $novel->id])->with('success', 'Novel added successfully!');
        return redirect()->route('admin.novels')->with('success', 'Novel added successfully!');
    }
    public function addChapter($novelId = null)
    {

        return view('admin.contentManager.novels.addChapter')->with([
            'title' => 'Add Chapter',
            'novelId' => $novelId,
            'images' => []
        ]);
    }
}
