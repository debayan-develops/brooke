<?php

namespace App\Admin\Content\Application\Actions;

use App\Admin\Content\Application\DTOs\CategoryData;
use App\Admin\Content\Domain\Repositories\ContentCategoryRepositoryInterface;

class CreateCategoryAction
{
    public function __construct(
        private readonly ContentCategoryRepositoryInterface $repository
    ) {}

    public function __invoke(CategoryData $categoryData): void
    {
        $this->repository->create((array) $categoryData);
    }
}