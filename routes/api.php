<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;
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

Route::get('/index', [UserApiController::class, 'index']);
Route::post('/register', [UserApiController::class, 'register']);
Route::post('/login', 'App\Http\Controllers\UserApiController@login');
Route::get('/show/{id}', [UserApiController::class, 'show']);
Route::post('/book', [UserApiController::class, 'booking']);
Route::get('/schedules', [UserApiController::class, 'getSchedules']);
Route::get('/user_account', [UserApiController::class, 'getLoggedInUser'])->middleware(['auth:api']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
