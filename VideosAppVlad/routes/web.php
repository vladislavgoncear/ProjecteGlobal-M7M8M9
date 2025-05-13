<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeriesManageController;
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

        Route::resource('videos', VideosController::class)->except(['show']);
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

Route::resource('series', SeriesController::class)->except(['show']);
Route::post('/upload/video', [ApiMultimediaController::class, 'storeVideo']);
Route::post('/upload/photo', [ApiMultimediaController::class, 'storePhoto']);
Route::get('/user', [ApiMultimediaController::class, 'getUser']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/videos', [VideosController::class, 'index'])->name('videos.index');
Route::get('/videos/{id}', [videosManageController::class, 'show'])->name('videos.show');
Route::get('/videos/{id}', [VideosController::class, 'show'])->name('videos.show');


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


// Rutes protegides per middleware 'auth'
//Route::middleware(['auth'])->group(function () {
    // Rutes de gestió de sèries (CRUD)
    Route::prefix('series/manage')->group(function () {
        Route::get('/', [SeriesManageController::class, 'index'])->name('series.manage.index');
        Route::get('/create', [SeriesManageController::class, 'create'])->name('series.manage.create');
        Route::post('/', [SeriesManageController::class, 'store'])->name('series.manage.store');
        Route::get('/{series}/edit', [SeriesManageController::class, 'edit'])->name('series.manage.edit');
        Route::put('/{series}', [SeriesManageController::class, 'update'])->name('series.manage.update');
        Route::delete('/{series}', [SeriesManageController::class, 'destroy'])->name('series.manage.destroy');
    });

    // Rutes d'índex i show de sèries
    Route::get('/series', [SeriesController::class, 'index'])->name('series.index');
    Route::get('/series/{series}', [SeriesController::class, 'show'])->name('series.show');
Route::get('/series/{series}/add-videos', [SeriesManageController::class, 'addVideos'])->name('series.manage.add-videos');
Route::post('/series/{series}/add-videos', [SeriesManageController::class, 'storeVideos'])->name('series.store-videos');
//});

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
