<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\IndexController;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\RegisterController;
use \App\Http\Controllers\VerificationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->middleware('auth');

Route::middleware('guest')->group(function (Router $router) {
    $router->prefix('login')->group(function (Router $router) {
        $router->get('', [LoginController::class, 'show'])->name('login');
        $router->post('', [LoginController::class, 'login'])->name('login-submit');
    });
    $router->prefix('register')->group(function (Router $router) {
        $router->get('register', [RegisterController::class, 'show'])->name('register');
        $router->post('register', [RegisterController::class, 'register'])->name('register-submit');
    });
    $router->post('validate-email', [RegisterController::class, 'validateEmail'])->name('register-validate-email');
    $router->get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
});

Route::get('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
