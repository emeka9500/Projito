<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function() {
    return view('auth.login');
});
Route::get('/register', function() {
    return view('auth.register');
});

Route::post('/register', [AuthController::class, 'store']);
    

