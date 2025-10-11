<?php

namespace App\Admin\Content\Providers;

use Illuminate\Support\ServiceProvider;

use App\Admin\Content\Domain\Repositories\ContentCategoryRepositoryInterface;
// use App\Admin\Content\Domain\Repositories\CategoryTypeRepositoryInterface;

use App\Admin\Content\Infrastructure\Repositories\EloquentContentCategoryRepository;
// use App\Admin\Content\Infrastructure\Repositories\EloquentCategoryTypeRepository;

class ContentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ContentCategoryRepositoryInterface::class,
            // CategoryTypeRepositoryInterface::class,
            EloquentContentCategoryRepository::class,
            // EloquentCategoryTypeRepository::class,
        );
    }
}