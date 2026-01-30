<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NovelController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ShortStoryController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\CharacterController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('frontend.home');

Route::prefix('/')->name('frontend.')->group(function () {
    
    // Novel Routes
    Route::prefix('novels')->name('novel.')->group(function () {
        Route::get('/', [NovelController::class, 'index'])->name('index');
        Route::get('/chapters/{id?}', [NovelController::class, 'chapters'])->name('chapters');
        Route::get('/{novelId}/chapter/{chapterId}', [NovelController::class, 'chapterDetails'])->name('chapter-details');
    });
    
    // Blog Routes
    Route::prefix('blogs')->name('blog.')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('/freshest/{id}', [BlogController::class, 'freshestDetails'])->name('freshest-details');
        Route::get('/{id}', [BlogController::class, 'show'])->name('show');
    });
    
    // Short Story Routes
    Route::prefix('short-stories')->name('short-story.')->group(function () {
        Route::get('/', [ShortStoryController::class, 'index'])->name('index');
        Route::get('/{id}', [ShortStoryController::class, 'show'])->name('show');
    });
    Route::get('/character/{id}', [CharacterController::class, 'show']);
    // Direct page routes (without /pages prefix)
    Route::get('/biography', [PageController::class, 'biography'])->name('page.biography');
    Route::get('/contact', [PageController::class, 'contact'])->name('page.contact');
    Route::get('/published-work', [PageController::class, 'publishedWork'])->name('page.published-work');
    Route::get('/fiction', [PageController::class, 'fiction'])->name('page.fiction');
    Route::get('/non-fiction', [PageController::class, 'nonFiction'])->name('page.non-fiction');
    Route::get('/vod', [PageController::class, 'vod'])->name('page.vod');
    Route::get('/freshest', [BlogController::class, 'freshest'])->name('blog.freshest');
});

// Include the admin routes
require __DIR__.'/admin.php';