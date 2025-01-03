<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\NewsItemController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileMessageController;
use App\Http\Controllers\PrivateMessageController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

//PUBLIC
Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');
Route::get('/news/{id}', [NewsItemController::class, 'show'])->name('news.show');
Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/search-users', [ProfileController::class, 'search'])->name('search.users');

//LOGGED-IN USERS
Route::middleware('auth')->group(function () {
    //PRFOILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/{id}/message', [ProfileMessageController::class, 'store'])->name('profile.message.store');

    //USER DASHBOARD
    Route::get('/user-dashboard', [UserDashboardController::class, 'edit'])->name('user.dashboard');
    Route::post('/user-dashboard', [UserDashboardController::class, 'update'])->name('user.dashboard.update');

    //NEWS LIKES & COMMENTS
    Route::post('/news/{id}/like', [NewsItemController::class, 'like'])->name('news.like');
    Route::post('/news/{id}/comment', [NewsItemController::class, 'comment'])->name('news.comment');

    //FAQ
    Route::post('/faq/submit-question', [FAQController::class, 'submitQuestion'])->name('faq.submitQuestion');

    //MESSAGES
    Route::get('/messages', [PrivateMessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/send', [PrivateMessageController::class, 'send'])->name('messages.send');
});

//ADMIN
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/createPost', [NewsItemController::class, 'create'])->name('news.create'); //voor een of andere reden krijg ik altijd
    //error 404 NOT FOUND als ik de route bij de news groep zet?

    //USER-MANAGEMENT
    Route::prefix('admin/users')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.users.index');
        Route::post('{user}/make-admin', [AdminController::class, 'makeAdmin'])->name('admin.users.makeAdmin');
        Route::post('{user}/revoke-admin', [AdminController::class, 'revokeAdmin'])->name('admin.users.revokeAdmin');
        Route::get('/create', [AdminController::class, 'create'])->name('admin.users.create');
        Route::post('/', [AdminController::class, 'store'])->name('admin.users.store');
    });

    //NEWS-MANAGEMENT
    Route::prefix('news')->group(function () {
        Route::post('/', [NewsItemController::class, 'store'])->name('news.store');
        Route::get('{id}', [NewsItemController::class, 'show'])->name('news.show');
        Route::get('{id}/edit', [NewsItemController::class, 'edit'])->name('news.edit');
        Route::put('{id}', [NewsItemController::class, 'update'])->name('news.update');
        Route::delete('{id}', [NewsItemController::class, 'destroy'])->name('news.destroy');
    });

    //FAQ-MANAGEMENT
    Route::prefix('admin/faq')->group(function () {
        Route::get('/', [FAQController::class, 'adminIndex'])->name('admin.faq.index');
        Route::post('/store-category', [FAQController::class, 'storeCategory'])->name('admin.faq.storeCategory');
        Route::post('/store-faq', [FAQController::class, 'storeFAQ'])->name('admin.faq.storeFAQ');
        Route::delete('/category/{id}', [FAQController::class, 'destroyCategory'])->name('admin.faq.destroyCategory');
        Route::delete('/item/{id}', [FAQController::class, 'destroyFAQ'])->name('admin.faq.destroyFAQ');
        Route::put('/category/{id}', [FAQController::class, 'updateCategory'])->name('admin.faq.updateCategory');
        Route::put('/item/{id}', [FAQController::class, 'updateFAQ'])->name('admin.faq.updateFAQ');
        Route::post('/user-questions/{id}/add-to-faq', [FAQController::class, 'addToFAQ'])->name('admin.userQuestions.addToFAQ');
        Route::delete('/user-questions/{id}', [FAQController::class, 'deleteUserQuestion'])->name('admin.userQuestions.delete');
    });

    //CONTACT-MANAGEMENT
    Route::prefix('admin/contact')->group(function () {
        Route::get('/', [ContactController::class, 'adminIndex'])->name('admin.contact.index');
        Route::post('/reply/{id}', [ContactController::class, 'replyToMessage'])->name('admin.contact.reply');
        Route::delete('/{id}', [ContactController::class, 'destroy'])->name('admin.contact.destroy');
    });
});
require __DIR__ . '/auth.php';
