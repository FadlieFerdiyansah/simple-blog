<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;


Route::middleware('role:admin')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
});

Route::get('search', [PostController::class, 'search'])->name('search');
Route::get('posts', [PostController::class, 'index'])->name('posts');
Route::get('categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::prefix('posts')->group(function() {
    Route::get('create', [PostController::class, 'create'])->name('posts.create');
    Route::post('create', [PostController::class, 'store']);

    Route::get('{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::patch('{post:slug}/edit', [PostController::class, 'update']);

    Route::delete('{post:slug}/delete', [PostController::class, 'destroy'])->name('posts.delete');


    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories', [CategoryController::class, 'store']);


    Route::get('/tags', [TagController::class, 'index'])->name('tags');
    Route::post('/tags', [TagController::class, 'store']);

});
Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::post('posts/{post:slug}/comment', [CommentController::class, 'comment'])->name('posts.comment');


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');