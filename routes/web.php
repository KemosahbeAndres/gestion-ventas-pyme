<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
Route::redirect('/', '/login');



Route::post('custom-login', [LoginController::class, 'login'])->name('login.custom');
Route::get('register', [LoginController::class, 'registration'])->name('register');
Route::post('custom-registration', [LoginController::class, 'customRegistration'])->name('register.custom');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
*/

Route::redirect('/', '/login');

Route::get('/login', function (Request $request) {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function (Request $request) {
    return view('dashboard');
})->name('dashboard');

Route::get('/register', function (Request $request) {
    return view('auth.registration');
})->name('register');

