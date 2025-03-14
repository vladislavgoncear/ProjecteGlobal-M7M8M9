<?php

use App\Http\Controllers\videosManageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiMultimediaController;

Route::post('/upload/video', [ApiMultimediaController::class, 'storeVideo']);
Route::post('/upload/photo', [ApiMultimediaController::class, 'storePhoto']);
Route::get('/user', [ApiMultimediaController::class, 'getUser']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/videos', [videosManageController::class, 'index'])->name('videos.index');
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
        Route::get('/videosmanage', [videosManageController::class, 'index'])->name('videos.manage.index');
        Route::get('/videosmanage/create', [videosManageController::class, 'index'])->name('videos.manage.create');
        Route::post('/videosmanage', [videosManageController::class, 'store'])->name('videos.manage.store');
        Route::get('/videosmanage/{video}/edit', [videosManageController::class, 'edit'])->name('videos.manage.edit');
        Route::put('/videosmanage/{video}', [videosManageController::class, 'update'])->name('videos.manage.update');
        Route::delete('/videosmanage/{video}', [videosManageController::class, 'destroy'])->name('videos.manage.destroy');
//    });
});
