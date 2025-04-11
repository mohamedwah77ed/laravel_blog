<?php

use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\PostController;
use App\Http\Controllers\Guest\UserController;
use App\Http\Controllers\user\UserPostController;
use App\Http\Controllers\user\CommentController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('posts.index');  
});



Route::get('/home', [PostController::class, 'index'])->name('posts.index');
Route::get('/search', [PostController::class, 'search'])->name('posts.search');
Route::get('home/posts/{post}', [PostController::class, 'show'])->name('geustposts.show');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

Route::get('/dashboard',[DashboardController::class, 'index'] 
)->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/posts', [UserPostController::class, 'show'])->name('myposts.show');
    Route::get('/create', [UserPostController::class, 'create'])->name('posts.create');
    Route::post('/create_new_post', [UserPostController::class, 'store'])->name('posts.store');
    Route::get('{post}/edit', [UserPostController::class, 'edit'])->name('posts.edit');
    Route::put('/{post}', [UserPostController::class, 'update'])->name('posts.update');
    Route::delete('/{post}', [UserPostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/{post}', [UserPostController::class, 'show_post'])->name('posts.show');
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/{post}', [UserPostController::class, 'update'])->name('posts.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});









require __DIR__.'/auth.php';
require __DIR__.'/authadmin.php';