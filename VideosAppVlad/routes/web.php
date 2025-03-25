<?php

use App\Http\Controllers\usersController;
use App\Http\Controllers\UsersManageController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\videosManageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiMultimediaController;

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    // User management routes (CRUD)
    Route::prefix('users/manage')->group(function () {
        Route::get('/', [UsersManageController::class, 'index'])->name('users.manage.index');
        Route::get('/create', [UsersManageController::class, 'create'])->name('users.manage.create');
        Route::post('/', [UsersManageController::class, 'store'])->name('users.manage.store');
        Route::get('/{user}/edit', [UsersManageController::class, 'edit'])->name('users.manage.edit');
        Route::put('/{user}', [UsersManageController::class, 'update'])->name('users.manage.update');
        Route::delete('/{user}', [UsersManageController::class, 'destroy'])->name('users.manage.destroy');
    });

    // User index and show routes
    Route::get('/users', [usersController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [usersController::class, 'show'])->name('users.show');
});


Route::post('/upload/video', [ApiMultimediaController::class, 'storeVideo']);
Route::post('/upload/photo', [ApiMultimediaController::class, 'storePhoto']);
Route::get('/user', [ApiMultimediaController::class, 'getUser']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/videos', [VideosController::class, 'index'])->name('videos.index');
Route::get('/videos/{id}', [videosManageController::class, 'show'])->name('videos.show');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

//    Route::middleware('role:Video Manager')->group(function () {
        Route::get('/videosmanager', [videosManageController::class, 'index'])->name('videos.manage.index');
        Route::get('/videosmanage/create', [videosManageController::class, 'create'])->name('videos.manage.create');
        Route::post('/videosmanage', [videosManageController::class, 'store'])->name('videos.manage.store');
        Route::get('/videosmanage/{video}/edit', [videosManageController::class, 'edit'])->name('videos.manage.edit');
        Route::put('/videosmanage/{video}', [videosManageController::class, 'update'])->name('videos.manage.update');
        Route::delete('/videosmanage/{video}', [videosManageController::class, 'destroy'])->name('videos.manage.destroy');
//    });


});
