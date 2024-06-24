<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Guests\GuestsController;
use App\Http\Controllers\Judges\JudgesController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\ApiAuth;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('judges')->namespace('Judges')->middleware(ApiAuth::class)->group(function () {
        Route::get('getCurrentSinger', [CommonController::class, 'getCurrentSinger']);
        Route::post('submitScore', [JudgesController::class, 'submitScore']);
    });
    Route::prefix('guests')->namespace('Guests')->middleware(ApiAuth::class)->group(function () {
        Route::get('getCurrentSinger', [CommonController::class, 'getCurrentSinger']);
        Route::post('submitScore', [GuestsController::class, 'submitScore']);
    });
    Route::prefix('admin')->namespace('Admin')->middleware(AdminAuth::class)->group(function () {
        Route::post('clearSingers', [CommonController::class, 'clearSingers']);
        Route::post('addSingers', [CommonController::class, 'addSingers']);
        Route::get('getSingers', [CommonController::class, 'getSingers']);
        Route::post('setCurrentSinger', [CommonController::class, 'setCurrentSinger']);
        Route::get('getCurrentSinger', [CommonController::class, 'getCurrentSinger']);
        Route::post('clearSongs', [CommonController::class, 'clearSongs']);
        Route::post('addSongs', [CommonController::class, 'addSongs']);
        Route::get('getSongs', [CommonController::class, 'getSongs']);
        Route::post('setCurrentSong', [CommonController::class, 'setCurrentSong']);
        Route::get('getCurrentSong', [CommonController::class, 'getCurrentSong']);
        Route::get('collectScore', [AdminController::class, 'collectScore']);
    });
    Route::fallback(function () {
        return response()->json(['code' => 404, 'message' => 'invalid endpoint'], 404);
    });
});
