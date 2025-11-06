<?php

namespace App\Admin\Content\Infrastructure\Repositories;

use App\Admin\Content\Domain\Models\ContentCategory;
use App\Admin\Content\Domain\Repositories\ContentCategoryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentContentCategoryRepository implements ContentCategoryRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return ContentCategory::latest()->paginate($perPage);
    }

    public function findById(string $id): ?ContentCategory
    {
        return ContentCategory::find($id);
    }

    public function create(array $data): ContentCategory
    {
        $catArr['name'] = $data['name'];
        $category = ContentCategory::create($catArr);
        $category->types()->attach($data['categoryType']);
        return $category;
    }

    public function update(string $id, array $data): bool
    {
        $category = ContentCategory::find($id);
        $category->name = $data['name'];
        $res = $category->save();
        $category->types()->sync($data['categoryType']);
        return $res;
    }

    public function delete(string $id): bool
    {
        $ContentCategory = ContentCategory::findOrFail($id);
        $ContentCategory->types()->detach();
        return $ContentCategory->delete();
    }
}