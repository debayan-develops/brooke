<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomesController;
use App\Http\Controllers\Admin\ContentManagementController;

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
    Route::get('/content-category', [ContentManagementController::class, 'contentCategory'])->name('contentCategory');
    Route::get('/tags', [ContentManagementController::class, 'tags'])->name('tags');
    Route::get('/contents', [ContentManagementController::class, 'contents'])->name('contents');
    Route::get('/novels', [ContentManagementController::class, 'novels'])->name('novels');
    Route::get('/blogs', [ContentManagementController::class, 'blogs'])->name('blogs');
    Route::get('/short-stories', [ContentManagementController::class, 'shortStories'])->name('shortStories');
    Route::get('/tags', [ContentManagementController::class, 'tags'])->name('tags');
    Route::get('/add-novels', [ContentManagementController::class, 'addNovels'])->name('addNovels');
    Route::get('/add-short-stories', [ContentManagementController::class, 'addShortStories'])->name('addShortStories');
    Route::post('/add-short-stories', [ContentManagementController::class, 'addShortStories'])->name('addShortStories');
    Route::get('/short-stories/image-upload', [ContentManagementController::class, 'shortStoryImageUpload'])->name('shortStoryImageUpload');
    // Add more admin routes here
});
?>