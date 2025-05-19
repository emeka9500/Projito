<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\NewPasswordController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/login', function() {
    return view('auth.login');
});
Route::get('/register', function() {
    return view('auth.register');
});

Route::post('/register', [AuthController::class, 'store']);

Route::post('/login', [AuthController::class, 'loginUser'])->name('login');
// show your profile
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AUthController::class, 'profile']);
    Route::get('/user/{id}', [AUthController::class, 'show']);
});
// send reset link
Route::post('/forgot-password', [NewPasswordController::class, 'forgotPassword']);
// reset your password
Route::post('/reset-password', [NewPasswordController::class, 'reset']);

// Store pictures
Route::post('/pictures', [PictureController::class, 'store'])
    ->middleware('auth:sanctum');

// Get user's pictures
// Route::get('/pictures', [PictureController::class, 'index'])
//     ->middleware('auth:sanctum');

// delete your picture
Route::delete('/pictures/{picture}', [PictureController::class, 'destroy'])
    ->middleware('auth:sanctum'); 

// delete your profile
Route::delete('/del-profile', [AuthController::class, 'destroy'])
    ->middleware('auth:sanctum'); // or your auth middleware
