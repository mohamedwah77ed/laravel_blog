<?php
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\UserProfileController;

Route::prefix('admin')
    ->middleware(['auth', 'authadmin'])
    ->group(function () {
        Route::get('/index', [AdminPostController::class, 'index'])->name('admin.index');
        Route::get('/users', [UserProfileController::class, 'index'])->name('users.index');
        Route::get('/admins', [AdminProfileController::class, 'index'])->name('adminsprofile.index');
        Route::get('users/{user}/edit', [UserProfileController::class, 'edit'])->name('users.edit');
        Route::get('admin/{user}/edit', [AdminProfileController::class, 'edit'])->name('admin.edit');
        Route::put('users/{user}', [UserConUserProfileControllertroller::class, 'update'])->name('users.update');
        Route::put('admin/{user}', [AdminProfileController::class, 'update'])->name('admins.update');
        Route::delete('users/{user}', [UserProfileController::class, 'destroy'])->name('users.destroy');
        Route::delete('admins/{admin}', [AdminProfileController::class, 'destroy'])->name('admins.destroy');
        Route::get('{post}/edit', [AdminPostController::class, 'edit_post'])->name('admin.post.edit');
        Route::put('/post/update/{id}', [AdminPostController::class, 'update_post'])->name('admin.post.update');
        Route::delete('/post/delete/{id}', [AdminPostController::class, 'destroy'])->name('admin.post.delete');
        
    });




require __DIR__.'/auth.php';
require __DIR__.'/authadmin.php';