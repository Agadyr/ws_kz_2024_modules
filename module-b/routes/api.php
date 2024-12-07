<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\v1\PlaceController;
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
        Route::get('/{id}', [PlaceController::class, 'getCurrentPlace']);

        Route::middleware(AdminMiddleware::class)->group(function () {
            Route::post('/', [PlaceController::class, 'createPlace']);

        });
    });
});

Route::middleware(['auth:api', AdminMiddleware::class])->get('/test', function () {
    return response()->json('just');
});
