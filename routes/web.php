<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\NewsItemController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{user}/make-admin', [AdminController::class, 'makeAdmin'])->name('admin.users.makeAdmin');
    Route::post('/admin/users/{user}/revoke-admin', [AdminController::class, 'revokeAdmin'])->name('admin.users.revokeAdmin');
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
});

Route::get('/search-users', [ProfileController::class, 'search'])->name('search.users');
Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/user-dashboard', [UserDashboardController::class, 'edit'])->name('user.dashboard');
    Route::post('/user-dashboard', [UserDashboardController::class, 'update'])->name('user.dashboard.update');
});

Route::get('/', [NewsItemController::class, 'index'])->name('welcome');

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/news/create', [NewsItemController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsItemController::class, 'store'])->name('news.store');
    Route::get('/news/{id}/edit', [NewsItemController::class, 'edit'])->name('news.edit');
    Route::put('/news/{id}', [NewsItemController::class, 'update'])->name('news.update');
    Route::delete('/news/{id}', [NewsItemController::class, 'destroy'])->name('news.destroy');
});

Route::get('/news/{id}', [NewsItemController::class, 'show'])->name('news.show');

require __DIR__.'/auth.php';
