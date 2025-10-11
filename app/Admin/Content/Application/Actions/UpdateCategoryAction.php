<?php

namespace App\Admin\Content\Application\Actions;

use App\Admin\Content\Application\DTOs\CategoryData;
use App\Admin\Content\Domain\Repositories\ContentCategoryRepositoryInterface;

class UpdateCategoryAction
{
    public function __construct(
        private readonly ContentCategoryRepositoryInterface $repository
    ) {}

    public function __invoke(string $categoryId, CategoryData $categoryData): void
    {
        $this->repository->update($categoryId, (array) $categoryData);
    }
}