<?php

namespace App\Admin\Content\Domain\Repositories;

use App\Admin\Content\Domain\Models\ContentCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ContentCategoryRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function findById(string $id): ?ContentCategory;
    public function create(array $data): ContentCategory;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
}