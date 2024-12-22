<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\NewsItemController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileMessageController;
use App\Http\Controllers\PrivateMessageController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/news/create', [NewsItemController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsItemController::class, 'store'])->name('news.store');
    Route::get('/news/{id}/edit', [NewsItemController::class, 'edit'])->name('news.edit');
    Route::put('/news/{id}', [NewsItemController::class, 'update'])->name('news.update');
    Route::delete('/news/{id}', [NewsItemController::class, 'destroy'])->name('news.destroy');
});
Route::get('/news/{id}', [NewsItemController::class, 'show'])->name('news.show');

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/admin/faq', [FAQController::class, 'adminIndex'])->name('admin.faq.index');
    Route::post('/admin/faq/store-category', [FAQController::class, 'storeCategory'])->name('admin.faq.storeCategory');
    Route::post('/admin/faq/store-faq', [FAQController::class, 'storeFAQ'])->name('admin.faq.storeFAQ');
    Route::delete('/admin/faq/category/{id}', [FAQController::class, 'destroyCategory'])->name('admin.faq.destroyCategory');
    Route::delete('/admin/faq/item/{id}', [FAQController::class, 'destroyFAQ'])->name('admin.faq.destroyFAQ');
    Route::put('/admin/faq/category/{id}', [FAQController::class, 'updateCategory'])->name('admin.faq.updateCategory');
    Route::put('/admin/faq/item/{id}', [FAQController::class, 'updateFAQ'])->name('admin.faq.updateFAQ');
});

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');


Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/admin/contact', [ContactController::class, 'adminIndex'])->name('admin.contact.index');
    Route::post('/admin/contact/reply/{id}', [ContactController::class, 'replyToMessage'])->name('admin.contact.reply');
    Route::delete('/admin/contact/{id}', [ContactController::class, 'destroy'])->name('admin.contact.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/news/{id}/like', [NewsItemController::class, 'like'])->name('news.like');
    Route::post('/news/{id}/comment', [NewsItemController::class, 'comment'])->name('news.comment');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/profile/{id}/message', [ProfileMessageController::class, 'store'])->name('profile.message.store');
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/messages', [PrivateMessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/send', [PrivateMessageController::class, 'send'])->name('messages.send');
});

require __DIR__.'/auth.php';
