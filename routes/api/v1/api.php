<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\RubricController;
use App\Http\Controllers\api\v1\SubscribeController;

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

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::apiResource('rubrics', RubricController::class);

    Route::get('userSubs', [SubscribeController::class, 'usersBySubscriptions']);
    Route::get('subsByUser', [SubscribeController::class, 'subscriptionsByUser']);

    Route::post('subscribe', [SubscribeController::class, 'subscribe']);
    Route::post('unsubscribe', [SubscribeController::class, 'unsubscribeOne']);
    Route::post('unsubscribeAll', [SubscribeController::class, 'unsubscribeAll']);
});