<?php

use App\Http\Controllers\APIAuthController;
use App\Http\Controllers\ConsultUserController;
use Illuminate\Http\Request;
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


Route::post('/register', [APIAuthController::class, 'register'])->name('api.register');
Route::post('/login', [APIAuthController::class, 'login'])->name('api.login');


Route::middleware('auth.api')->group( function() {
    Route::get('/logout', [APIAuthController::class, 'logout']);
    Route::get('/user/me', [ConsultUserController::class, 'consult']);
});


