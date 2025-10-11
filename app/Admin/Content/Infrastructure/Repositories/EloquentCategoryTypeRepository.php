<?php

namespace App\Admin\Content\Infrastructure\Repositories;

use App\Admin\Content\Domain\Models\CategoryType;
use App\Admin\Content\Domain\Repositories\CategoryTypeRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentCategoryTypeRepository implements CategoryTypeRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return CategoryType::latest()->paginate($perPage);
    }

    public function findById(string $id): ?CategoryType
    {
        return CategoryType::find($id);
    }

    public function create(array $data): CategoryType
    {
        return CategoryType::create($data);
    }

    public function update(string $id, array $data): bool
    {
        return CategoryType::where('id', $id)->update($data);
    }

    public function delete(string $id): bool
    {
        return CategoryType::destroy($id);
    }
}