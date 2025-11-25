<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContentManagementController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ShortStories;
use App\Admin\Content\Presentation\Http\Controllers\ContentCategoryController;

Route::prefix('admin')->name('admin.')->group(function () {

    // Auth Routes
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Content Management Group
        Route::prefix('content-manager')->group(function () {
            
            // --- CATEGORIES ---
            Route::get('/categories', [ContentCategoryController::class, 'index'])->name('contentCategory');
            Route::post('/categories/create', [ContentCategoryController::class, 'store'])->name('contentCategory.create');
            Route::get('/categories/{contentCategory}/edit', [ContentCategoryController::class, 'edit'])->name('contentCategory.edit');
            Route::post('/categories/{contentCategory}/update', [ContentCategoryController::class, 'update'])->name('contentCategory.update');
            Route::delete('/categories/{contentCategory}', [ContentCategoryController::class, 'destroy'])->name('contentCategory.destroy');

            // --- TAGS ---
            Route::get('/tags', [ContentManagementController::class, 'tags'])->name('tags'); 
            Route::post('/tags', [ContentManagementController::class, 'storeTag'])->name('tags.store'); 
            
            // Explicitly named routes for Edit/Update/Delete
            Route::get('/tags/{id}/edit', [ContentManagementController::class, 'editTag'])->name('tags.edit'); 
            Route::put('/tags/{id}', [ContentManagementController::class, 'updateTag'])->name('tags.update'); 
            Route::delete('/tags/{id}', [ContentManagementController::class, 'deleteTag'])->name('tags.destroy');

            // --- CHARACTERS ---
            Route::get('/characters', [ContentManagementController::class, 'character'])->name('character'); 
            Route::post('/characters', [ContentManagementController::class, 'storeCharacter'])->name('characters.store'); 
            
            // Explicitly named routes for Edit/Update/Delete
            Route::get('/characters/{id}/edit', [ContentManagementController::class, 'editCharacter'])->name('characters.edit'); 
            Route::put('/characters/{id}', [ContentManagementController::class, 'updateCharacter'])->name('characters.update'); 
            Route::delete('/characters/{id}', [ContentManagementController::class, 'deleteCharacter'])->name('characters.destroy');
        });

        // Blogs
        Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
        Route::get('/blogs/add', [BlogController::class, 'addBlogs'])->name('addBlogs');
        Route::post('/blogs/add', [BlogController::class, 'storeBlog'])->name('addBlogs.add');
        Route::get('/blogs/edit/{id}', [BlogController::class, 'editBlogs'])->name('editBlogs');
        Route::post('/blogs/edit/{id}', [BlogController::class, 'storeBlog'])->name('editBlogs.update');
        Route::get('/blogs/image-upload/{id}', [BlogController::class, 'blogImageUpload'])->name('blogImageUpload');
        Route::post('/blogs/image-upload/{id}', [BlogController::class, 'blogImageUploadStore'])->name('blogImageUpload.store');
        Route::delete('/blogs/image-upload/delete/{id}', [BlogController::class, 'deleteSliderImage']);

        // Short Stories
        Route::get('/short-stories', [ShortStories::class, 'index'])->name('shortStories');
        Route::get('/short-stories/add', [ShortStories::class, 'addShortStories'])->name('addShortStories');
        Route::post('/short-stories/add', [ShortStories::class, 'storeShortStories'])->name('addShortStories.add');
        Route::get('/short-stories/edit/{id}', [ShortStories::class, 'editShortStories'])->name('editShortStories');
        Route::get('/short-stories/image-upload/{id}', [ShortStories::class, 'shortStoryImageUpload'])->name('shortStoryImageUpload');
        Route::post('/short-stories/image-upload/{id}', [ShortStories::class, 'shortStoryImageUploadStore'])->name('shortStoryImageUpload.store');
        Route::delete('/short-stories/image-upload/delete/{id}', [ShortStories::class, 'deleteSliderImage']);

        // Users
        Route::get('/users', [UserController::class, 'index'])->name('users');
        
        // Other pages
        Route::get('/homes', [App\Http\Controllers\Admin\HomesController::class, 'index'])->name('homes');
        Route::get('/pages', [App\Http\Controllers\Admin\PageController::class, 'index'])->name('pages');
        Route::get('/contents', [ContentManagementController::class, 'index'])->name('contents');
        Route::get('/novels', [ContentManagementController::class, 'novels'])->name('novels');
        Route::get('/novels/add', [ContentManagementController::class, 'addNovels'])->name('addNovels');
        Route::get('/novels/add-chapter', [ContentManagementController::class, 'addChapter'])->name('addChapter');
    });
});