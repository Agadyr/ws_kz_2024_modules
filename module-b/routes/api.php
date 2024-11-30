<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\AuthController;

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

Route::get('/test', [AuthController::class, 'test']);
Route::get('/', function () {
    return response()->json('sadfasdf');
});
