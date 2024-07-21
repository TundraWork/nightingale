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
        Route::get('getCurrentStatus', [CommonController::class, 'getCurrentStatus']);
        Route::post('submitScore', [JudgesController::class, 'submitScore']);
    });
    Route::prefix('guests')->namespace('Guests')->middleware(ApiAuth::class)->group(function () {
        Route::get('getTeams', [CommonController::class, 'getTeams']);
        Route::get('getCurrentStatus', [CommonController::class, 'getCurrentStatus']);
        Route::post('submitVote', [GuestsController::class, 'submitVote']);
        Route::get('collectScore', [GuestsController::class, 'collectScore']);
        Route::get('collectAllScores', [GuestsController::class, 'collectAllScores']);
        Route::get('collectAllVotes', [GuestsController::class, 'collectAllVotes']);
    });
    Route::prefix('admin')->namespace('Admin')->middleware(AdminAuth::class)->group(function () {
        Route::post('clearSingers', [CommonController::class, 'clearSingers']);
        Route::post('addSingers', [CommonController::class, 'addSingers']);
        Route::get('getSingers', [CommonController::class, 'getSingers']);

        Route::post('clearSongs', [CommonController::class, 'clearSongs']);
        Route::post('addSongs', [CommonController::class, 'addSongs']);
        Route::get('getSongs', [CommonController::class, 'getSongs']);

        Route::post('clearTeams', [CommonController::class, 'clearTeams']);
        Route::post('addTeams', [CommonController::class, 'addTeams']);
        Route::get('getTeams', [CommonController::class, 'getTeams']);

        Route::post('setCurrentStatus', [CommonController::class, 'setCurrentStatus']);
        Route::get('getCurrentStatus', [CommonController::class, 'getCurrentStatus']);

        Route::get('collectScore', [AdminController::class, 'collectScore']);
        Route::get('collectAllScores', [AdminController::class, 'collectAllScores']);

        Route::post('switchVoteOpen', [AdminController::class, 'switchVoteOpen']);
        Route::post('clearAllVotes', [AdminController::class, 'clearAllVotes']);
        Route::get('collectAllVotes', [AdminController::class, 'collectAllVotes']);
    });
    Route::any('{any}', function(){
        return response()->json(['code' => 404, 'message' => 'invalid endpoint'], 404);
    })->where('any', '.*');
});
