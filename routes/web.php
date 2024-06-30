<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/rank', function () {
    return view('rank');
});
Route::get('/vote', function () {
    return view('vote');
});
Route::get('/stats', function () {
    return view('stats');
});
Route::get('/admin/auth', [AuthController::class, 'gateway']);
Route::post('/admin/auth', [AuthController::class, 'gateway']);
Route::group(['prefix' => 'admin', 'middleware' => AdminAuth::class], function () {
    Route::get('/judge', function () {
        return view('judge');
    });
    Route::get('/edit', function () {
        return view('admin_edit');
    });
    Route::get('/stats', function () {
        return view('admin_stats');
    });
    Route::get('/rank', function () {
        return view('admin_rank');
    });
});
