<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContentManagementController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ShortStories;
use App\Admin\Content\Presentation\Http\Controllers\ContentCategoryController;
use App\Http\Controllers\Admin\NovelController;

Route::prefix('admin')->name('admin.')->group(function () {

    // --- AUTH ROUTES ---
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // --- CONTENT MANAGEMENT ---
        Route::prefix('content-manager')->group(function () {
            
            // Categories
            Route::get('/categories', [ContentCategoryController::class, 'index'])->name('contentCategory');
            Route::post('/categories/create', [ContentCategoryController::class, 'store'])->name('contentCategory.create');
            Route::get('/categories/{contentCategory}/edit', [ContentCategoryController::class, 'edit'])->name('contentCategory.edit');
            Route::post('/categories/{contentCategory}/update', [ContentCategoryController::class, 'update'])->name('contentCategory.update');
            Route::delete('/categories/{contentCategory}', [ContentCategoryController::class, 'destroy'])->name('contentCategory.destroy');

            // Tags
            Route::get('/tags', [ContentManagementController::class, 'tags'])->name('tags'); 
            Route::post('/tags', [ContentManagementController::class, 'storeTag'])->name('tags.store'); 
            Route::get('/tags/{id}/edit', [ContentManagementController::class, 'editTag'])->name('tags.edit'); 
            Route::put('/tags/{id}', [ContentManagementController::class, 'updateTag'])->name('tags.update'); 
            Route::delete('/tags/{id}', [ContentManagementController::class, 'deleteTag'])->name('tags.destroy');

            // Characters
            Route::get('/characters', [ContentManagementController::class, 'character'])->name('character'); 
            Route::post('/characters', [ContentManagementController::class, 'storeCharacter'])->name('characters.store'); 
            Route::get('/characters/{id}/edit', [ContentManagementController::class, 'editCharacter'])->name('characters.edit'); 
            Route::put('/characters/{id}', [ContentManagementController::class, 'updateCharacter'])->name('characters.update'); 
            Route::delete('/characters/{id}', [ContentManagementController::class, 'deleteCharacter'])->name('characters.destroy');
        });

        // --- BLOGS ---
        Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
        Route::get('/blogs/add', [BlogController::class, 'addBlogs'])->name('addBlogs');
        Route::post('/blogs/add', [BlogController::class, 'storeBlog'])->name('addBlogs.add');
        Route::get('/blogs/edit/{id}', [BlogController::class, 'editBlogs'])->name('editBlogs');
        Route::post('/blogs/edit/{id}', [BlogController::class, 'storeBlog'])->name('editBlogs.update');
        Route::get('/blogs/image-upload/{id}', [BlogController::class, 'blogImageUpload'])->name('blogImageUpload');
        Route::post('/blogs/image-upload/{id}', [BlogController::class, 'blogImageUploadStore'])->name('blogImageUpload.store');
        Route::delete('/blogs/image-upload/delete/{id}', [BlogController::class, 'deleteSliderImage']);

        // --- SHORT STORIES ---
        Route::get('/short-stories', [ShortStories::class, 'index'])->name('shortStories');
        Route::get('/short-stories/add', [ShortStories::class, 'addShortStories'])->name('addShortStories');
        Route::post('/short-stories/add', [ShortStories::class, 'storeShortStories'])->name('addShortStories.add');
        Route::get('/short-stories/edit/{id}', [ShortStories::class, 'editShortStories'])->name('editShortStories');
        Route::post('/short-stories/edit/{id}', [ShortStories::class, 'storeShortStories'])->name('editShortStories.update');
        Route::post('/short-stories/update/{id}', [ShortStories::class, 'update'])->name('editShortStories.update');
        Route::get('/short-stories/image-upload/{id}', [ShortStories::class, 'shortStoryImageUpload'])->name('shortStoryImageUpload');
        Route::post('/short-stories/image-upload/{id}', [ShortStories::class, 'shortStoryImageUploadStore'])->name('shortStoryImageUpload.store');
        Route::delete('/short-stories/image-upload/delete/{id}', [ShortStories::class, 'deleteSliderImage']);

        // --- USERS & PAGES ---
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/homes', [App\Http\Controllers\Admin\HomesController::class, 'index'])->name('homes');
        Route::get('/pages', [App\Http\Controllers\Admin\PageController::class, 'index'])->name('pages');
        Route::get('/contents', [ContentManagementController::class, 'index'])->name('contents');

       // --- NOVELS (Updated to use NovelController) ---
        Route::prefix('novels')->group(function () {
            
            // 1. Novel List & Create
            Route::get('/', [NovelController::class, 'index'])->name('novels');
            Route::get('/get-novels', [NovelController::class, 'getNovels'])->name('getNovels');
            Route::get('/add', [NovelController::class, 'addBNovels'])->name('addNovels');
            Route::post('/add', [NovelController::class, 'storeNovel'])->name('addNovels.add');
            
            // 2. Novel Edit & Delete (Changed to NovelController)
            Route::get('/edit/{id}', [NovelController::class, 'editNovels'])->name('editNovels'); 
            Route::post('/update/{id}', [NovelController::class, 'updateNovel'])->name('novels.update');
            Route::delete('/delete/{id}', [NovelController::class, 'deleteNovel'])->name('novels.delete');

            // 3. Chapter Management (Changed to NovelController)
            Route::get('/add-chapter/{novel_id}', [NovelController::class, 'addChapter'])->name('addChapter');
            Route::post('/store-chapter/{novel_id}', [NovelController::class, 'storeChapter'])->name('novels.storeChapter');
            Route::get('/edit-chapter/{novel_id}/{chapter_id}', [NovelController::class, 'editChapter'])->name('novels.editChapter');
            Route::put('/update-chapter/{chapter_id}', [NovelController::class, 'updateChapter'])->name('novels.updateChapter');
            Route::delete('/delete-chapter/{id}', [NovelController::class, 'deleteChapter'])->name('novels.deleteChapter');

            // 4. Chapter Slider Management (Changed to NovelController)
            Route::get('/chapter/slider/{chapter_id}', [NovelController::class, 'addChapterSlider'])->name('novels.addChapterSlider');
            Route::post('/chapter/slider/{chapter_id}', [NovelController::class, 'storeChapterSlider'])->name('novels.storeChapterSlider');
            Route::post('/chapter/slider/update/{image_id}', [NovelController::class, 'updateChapterSliderImage'])->name('novels.updateChapterSliderImage');
            Route::delete('/chapter/slider/delete/{image_id}', [NovelController::class, 'deleteChapterSliderImage'])->name('novels.deleteChapterSliderImage');
        });
    });
});