<?php

namespace App\Admin\Content\Domain\Repositories;

use App\Admin\Content\Domain\Models\CategoryType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryTypeRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function findById(string $id): ?CategoryType;
    public function create(array $data): CategoryType;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
}