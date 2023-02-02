<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::group(['prefix' => 'bai-viet'], function () {
        Route::get('', [PostController::class, 'index'])->name('admin.posts');
        Route::post('/tao-bai-viet', [PostController::class, 'createPost'])->name('admin.posts.create');
        Route::get('/{id}/preview', [PostController::class, 'preview'])->name('admin.posts.preview');
        Route::delete('/{id}/delete', [PostController::class, 'deletePost'])->name('admin.posts.delete');
        Route::post('/cap-nhat-bai-viet', [PostController::class, 'update'])->name('admin.posts.update');


        // Route::get('', function () {
        //     return Inertia::render('Admin/Posts/Posts');
        // })->name('admin.posts');

        // Route::get('/test', [TestController::class, 'index'])->name('admin.test');
        // Route::post('/post-test', [TestController::class, 'create'])->name('admin.post_test');

        // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


});
// Route::group(['', 'middleware' => 'auth'], function () {
//     Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
//     Route::get('/test', [TestController::class, 'index'])->name('admin.test');
//     Route::post('/post-test', [TestController::class, 'create'])->name('admin.post_test');

//     // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



require __DIR__.'/auth.php';
