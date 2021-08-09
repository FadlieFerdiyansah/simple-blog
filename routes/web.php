<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Models\Category;

Route::middleware('role:admin')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
});

Route::get('posts', [PostController::class, 'index'])->name('posts');
Route::get('posts/search', [PostController::class, 'search'])->name('search');
Route::get('categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::middleware('auth')->prefix('posts')->group(function() {
    Route::get('create', [PostController::class, 'create'])->name('posts.create');
    Route::post('create', [PostController::class, 'store']);

    Route::get('{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::patch('{post:slug}/edit', [PostController::class, 'update']);

    Route::delete('{post:slug}/delete', [PostController::class, 'destroy'])->name('posts.delete');


    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/create', [CategoryController::class, 'store']);
    Route::get('/categories/{category:slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category:slug}/edit', [CategoryController::class, 'update']);
    Route::delete('/categories/{category:slug}', [CategoryController::class, 'destroy'])->name('categories.delete');

    Route::get('/tags', [TagController::class, 'index'])->name('tags');
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/tags/create', [TagController::class, 'store']);
    Route::get('/tags/{tag:slug}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/{tag:slug}/edit', [TagController::class, 'update']);
    Route::delete('/tags/{tag:slug}', [TagController::class, 'destroy'])->name('tags.delete');
});
Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::post('posts/{post:slug}/comment', [CommentController::class, 'comment'])->name('posts.comment');


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');