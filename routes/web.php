<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('/post/home');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/home', [PostController::class, 'home'])->name('post.home');
    Route::post('/profiles', [PostController::class, 'store'])->name('profiles.store');
    Route::get('/users', [PostController::class, 'user'])->name('post.user');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/index', [PostController::class, 'index'])->name('post.dashboard');
    Route::post('/user/{user}/follow', [FollowController::class, 'toggle'])->name('user.follow');
    Route::get('/follow-requests', [FollowController::class, 'requestsList'])->name('follow.requests');
    Route::post('/follow-requests/{user}/approve', [FollowController::class, 'approve'])->name('follow.approve');
    Route::post('/follow-requests/{user}/reject', [FollowController::class, 'reject'])->name('follow.reject');
});


require __DIR__.'/auth.php';