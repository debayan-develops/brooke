<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomesController;
use App\Http\Controllers\Admin\ContentManagementController;
use App\Http\Controllers\Admin\ShortStories;
use App\Http\Controllers\Admin\BlogController;
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
    Route::post('/character/add/{id?}', [ContentManagementController::class, 'addUpdateCharacter'])->name('character.add');
    Route::get('/character/edit/{id}', [ContentManagementController::class, 'editCharacter'])->name('character.edit');
    Route::delete('/character/delete/{id}', [ContentManagementController::class, 'deleteCharacter'])->name('character.destroy');
    Route::get('/contents', [ContentManagementController::class, 'contents'])->name('contents');
    Route::get('/novels', [ContentManagementController::class, 'novels'])->name('novels');
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
    Route::get('/add-blogs', [BlogController::class, 'addBlogs'])->name('addBlogs');
    Route::post('/add-blogs', [BlogController::class, 'storeBlog'])->name('addBlogs.add');
    Route::get('/blogs/image-upload/{id}', [BlogController::class, 'blogImageUpload'])->name('blogImageUpload');
    Route::post('/blogs/image-upload/{id}', [BlogController::class, 'blogImageUploadStore'])->name('blogImageUpload.store');
    Route::delete('/blogs/image-upload/delete/{imageId}', [BlogController::class, 'deleteSliderImage'])->name('blogImageUpload.destroy');
    Route::get('/edit-blogs/{id}', [BlogController::class, 'editBlogs'])->name('editBlogs');
    Route::post('/edit-blogs/{id}', [BlogController::class, 'storeBlog'])->name('editBlogs.update');
    // Route::delete('/blogs/delete/{id}', [BlogController::class, 'deleteBlog'])->name('blogs.destroy');

    // Short Stories Routes start here
    Route::get('/short-stories', [ShortStories::class, 'index'])->name('shortStories');
    Route::get('/add-short-stories', [ShortStories::class, 'addShortStories'])->name('addShortStories');
    Route::post('/add-short-stories', [ShortStories::class, 'storeShortStories'])->name('addShortStories.add');
    Route::get('/edit-short-stories/{id}', [ShortStories::class, 'editShortStories'])->name('editShortStories');
    Route::post('/edit-short-stories/{id}', [ShortStories::class, 'storeShortStories'])->name('editShortStories.update');
    Route::get('/short-stories/image-upload/{id}', [ShortStories::class, 'shortStoryImageUpload'])->name('shortStoryImageUpload');
    Route::post('/short-stories/image-upload/{id}', [ShortStories::class, 'shortStoryImageUploadStore'])->name('shortStoryImageUpload.store');
    // Route::delete('/short-stories/delete/{id}', [ShortStories::class, 'deleteShortStories'])->name('shortStories.destroy');
    Route::delete('/short-stories/image-upload/delete/{imageId}', [ShortStories::class, 'deleteSliderImage'])->name('shortStoryImageUpload.destroy');
    // Short Stories Routes end here
    Route::get('/tags', [ContentManagementController::class, 'tags'])->name('tags');
    Route::get('/add-novels', [ContentManagementController::class, 'addNovels'])->name('addNovels');
    Route::get('/add-chapter', [ContentManagementController::class, 'addChapter'])->name('addChapter');
    Route::post('/add-chapter', [ContentManagementController::class, 'addChapter'])->name('addChapter');
    
    // Add more admin routes here
});
?>