<?php

namespace App\Admin\Content\Application\Actions;

use App\Admin\Content\Domain\Repositories\ContentCategoryRepositoryInterface;

class DeleteCategoryAction
{
    public function __construct(
        private readonly ContentCategoryRepositoryInterface $repository
    ) {}

    public function __invoke(string $categoryId): void
    {
        $this->repository->delete($categoryId);
    }
}