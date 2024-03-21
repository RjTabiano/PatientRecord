<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;
use App\Models\Image;

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
Route::post('/store-image', [UserApiController::class, 'storeImage'])->name('store.image');
Route::get('/index', [UserApiController::class, 'index']);
Route::post('/register', [UserApiController::class, 'register']);
Route::post('/login', 'App\Http\Controllers\UserApiController@login');
Route::get('/show/{id}', [UserApiController::class, 'show']);
Route::post('/book', [UserApiController::class, 'booking'])->middleware('auth:sanctum');
Route::get('/schedules', [UserApiController::class, 'getSchedules'])->middleware('auth:sanctum');
Route::get('/user_account', [UserApiController::class, 'getLoggedInUser'])->middleware('auth:sanctum');
Route::get('/booked', [UserApiController::class, 'getBooking'])->middleware('auth:sanctum');
Route::get('/getImage', [UserApiController::class, 'getUserImage'])->middleware('auth:sanctum');
Route::post('/textMsg', [UserApiController::class, 'text_message']);

Route::get('/images/{imageId}', function ($imageId) {
    $image = Image::find($imageId);
    
    if (!$image) {
        return Response::json(['error' => 'Image not found'], 404);
    }

    return Response::make(base64_decode($image->data), 200, [
        'Content-Type' => 'image/png',
        'Content-Length' => strlen(base64_decode($image->data)),
    ]);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');