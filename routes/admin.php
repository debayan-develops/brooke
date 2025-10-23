<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomesController;
use App\Http\Controllers\Admin\ContentManagementController;
use App\Admin\Content\Presentation\Http\Controllers\ContentCategoryController;


Route::middleware('admin.guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/', [AuthController::class, 'login']);
});
// Route::get('/', [AuthController::class, 'index']);
// Route::post('/', [AuthController::class, 'index']);

Route::middleware(['admin.auth'])->group(function () {
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pages', [PageController::class, 'index'])->name('pages');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/homes', [HomesController::class, 'index'])->name('homes');
    Route::get('/content-category', [ContentCategoryController::class, 'index'])->name('contentCategory');
    Route::post('/content-category/create', [ContentCategoryController::class, 'store'])->name('contentCategory.create');
    Route::get('/content-category/{contentCategory}/edit', [ContentCategoryController::class, 'edit'])->name('contentCategory.edit');
    Route::post('/content-category/{contentCategory}/edit', [ContentCategoryController::class, 'update'])->name('contentCategory.update');
    Route::delete('/content-category/{contentCategory}', [ContentCategoryController::class, 'destroy'])->name('contentCategory.destroy');
    Route::get('/tags', [ContentManagementController::class, 'tags'])->name('tags');
    Route::post('/tags/add/{id?}', [ContentManagementController::class, 'addUpdateTags'])->name('tags.add');
    Route::get('/tags/edit/{id}', [ContentManagementController::class, 'editTags'])->name('tags.edit');
    Route::delete('/tags/delete/{id}', [ContentManagementController::class, 'deleteTags'])->name('tags.destroy');

    Route::get('/character', [ContentManagementController::class, 'character'])->name('character');
    Route::get('/contents', [ContentManagementController::class, 'contents'])->name('contents');
    Route::get('/novels', [ContentManagementController::class, 'novels'])->name('novels');
    Route::get('/blogs', [ContentManagementController::class, 'blogs'])->name('blogs');
    Route::get('/short-stories', [ContentManagementController::class, 'shortStories'])->name('shortStories');
    Route::get('/tags', [ContentManagementController::class, 'tags'])->name('tags');
    Route::get('/add-novels', [ContentManagementController::class, 'addNovels'])->name('addNovels');
    Route::get('/add-chapter', [ContentManagementController::class, 'addChapter'])->name('addChapter');
    Route::post('/add-chapter', [ContentManagementController::class, 'addChapter'])->name('addChapter');
    Route::get('/add-short-stories', [ContentManagementController::class, 'addShortStories'])->name('addShortStories');
    Route::post('/add-short-stories', [ContentManagementController::class, 'addShortStories'])->name('addShortStories');
    Route::get('/short-stories/image-upload', [ContentManagementController::class, 'shortStoryImageUpload'])->name('shortStoryImageUpload');
    Route::get('/add-blog', [ContentManagementController::class, 'addBlogs'])->name('addBlogs');
    Route::post('/add-blog', [ContentManagementController::class, 'addBlogs'])->name('addBlogs');
    Route::get('/blogs/image-upload', [ContentManagementController::class, 'blogImageUpload'])->name('blogImageUpload');
    // Add more admin routes here
});
?>