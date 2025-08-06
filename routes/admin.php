<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomesController;

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
    // Add more admin routes here
});
?>