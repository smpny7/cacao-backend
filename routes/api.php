<?php

use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * --------------------------------------------------------------------------
 * 毎日0時に定期呼び出しされるエンドポイント
 * --------------------------------------------------------------------------
 */
Route::middleware('token:api')->group(function () {
    Route::get('/cron', [RoomController::class, 'cron']);
});


/**
 * --------------------------------------------------------------------------
 * アプリケーションから呼び出されるエンドポイント
 * --------------------------------------------------------------------------
 */
Route::middleware('auth:api')->group(function () {
    /** ================================================================================ */
    /** 部屋名を自身の認証情報を使用して取得する */
    Route::get('/getRoomName', [RoomController::class, 'getRoomName']);

    /** 部屋名を部屋のIDを使用して取得する */
    Route::post('/getRoomNameFromID', [RoomController::class, 'getRoomNameFromID']);
    /** ================================================================================ */

    /** ================================================================================ */
    /** 学生が部屋に入っているかを確認する */
    Route::post('/status', [StudentController::class, 'status']);

    /** 学生が部屋に入室する */
    Route::post('/enter', [StudentController::class, 'enter']);

    /** 学生が部屋を退室する */
    Route::post('/leave', [StudentController::class, 'leave']);
    /** ================================================================================ */
});
