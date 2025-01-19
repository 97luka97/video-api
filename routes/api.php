<?php

use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('video', VideoController::class)->only(['index', 'store', 'show', 'destroy'])->middleware("api.token");

Route::prefix('video')->group(function () {
    Route::get('/{video}/stream', [VideoController::class, 'serveVideo'])->name('video.stream');
    Route::get('/{video}/thumbnail', [VideoController::class, 'serveThumbnail'])->name('video.thumbnail');
});

