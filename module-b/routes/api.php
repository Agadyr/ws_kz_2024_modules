<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\v1\PlaceController;
use App\Http\Controllers\v1\ScheduleController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'place'], static function () {
        Route::get('/all', [PlaceController::class, 'getPlaces']);
        Route::get('/{id}', [PlaceController::class, 'index']);

        Route::middleware(AdminMiddleware::class)->group(function () {
            Route::post('/', [PlaceController::class, 'create']);
            Route::post('/{id}', [PlaceController::class, 'update']);
            Route::delete('/{id}', [PlaceController::class, 'delete']);
        });
    });

    Route::group(['prefix' => 'schedule'], static function () {
        Route::middleware(AdminMiddleware::class)->group(function () {
            Route::get('/all', [ScheduleController::class, 'getSchedules']);
            Route::post('/', [ScheduleController::class, 'create']);
            Route::post('/{id}', [ScheduleController::class, 'update']);
        });
    });
});
