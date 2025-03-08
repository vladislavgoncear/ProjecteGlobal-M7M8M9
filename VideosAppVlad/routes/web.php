<?php

use App\Http\Controllers\videosManageController;
use Illuminate\Support\Facades\Route;

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
        Route::get('/videosmanage', [videosManageController::class, 'index'])->name('videos.index');
        Route::get('/videosmanage/create', [videosManageController::class, 'index'])->name('videos.create');
        Route::post('/videosmanage', [videosManageController::class, 'store'])->name('videos.store');
        Route::get('/videosmanage/{video}/edit', [videosManageController::class, 'edit'])->name('videos.edit');
        Route::put('/videosmanage/{video}', [videosManageController::class, 'update'])->name('videos.update');
        Route::delete('/videosmanage/{video}', [videosManageController::class, 'destroy'])->name('videos.destroy');
//    });
});
