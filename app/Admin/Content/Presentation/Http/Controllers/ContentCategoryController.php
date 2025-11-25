<?php

namespace App\Admin\Content\Presentation\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Admin\Content\Application\Actions\CreateCategoryAction;
use App\Admin\Content\Application\Actions\DeleteCategoryAction;
use App\Admin\Content\Application\Actions\UpdateCategoryAction;
use App\Admin\Content\Application\DTOs\CategoryData;
use App\Admin\Content\Domain\Models\ContentCategory;
use App\Admin\Content\Domain\Repositories\ContentCategoryRepositoryInterface;
use App\Admin\Content\Presentation\Http\Requests\StoreCategoryRequest;
use App\Admin\Content\Domain\Models\CategoryType;

class ContentCategoryController extends Controller
{
    public function __construct(
        private readonly ContentCategoryRepositoryInterface $repository
    ) {}

    public function index()
    {
        // FIX: Fetch ALL categories with 'types' relationship eagerly loaded.
        // This allows the client-side JavaScript to search/filter the entire dataset instantly
        // and prevents the "Types showing as None" issue.
        $categories = ContentCategory::with('types')->orderBy('id', 'desc')->get();
        
        $categoryTypes = CategoryType::all();
        
        return view('admin.contentManager.contentCategory')->with([
            'title' => 'Content Category',
            'categories' => $categories,
            'categoryTypes' => $categoryTypes,
        ]);
    }

    public function create()
    {
        return view('admin.content_categories.create');
    }

    public function store(StoreCategoryRequest $request, CreateCategoryAction $action)
    {
        $action(CategoryData::fromRequest($request->validated()));
        
        return redirect()->route('admin.contentCategory')
                         ->with('success', 'Category created successfully.');
    }

    public function edit(ContentCategory $contentCategory)
    {
        // Ensure types are loaded for the edit modal
        return response()->json([$contentCategory->load('types')]);
    }

    public function update(StoreCategoryRequest $request, ContentCategory $contentCategory, UpdateCategoryAction $action)
    {
        $action($contentCategory->id, CategoryData::fromRequest($request->validated()));

        return redirect()->route('admin.contentCategory')
                         ->with('success', 'Category updated successfully.');
    }

    public function destroy(ContentCategory $contentCategory, DeleteCategoryAction $action)
    {
        $action($contentCategory->id);

        return redirect()->route('admin.contentCategory')
                         ->with('success', 'Category deleted successfully.');
    }
}