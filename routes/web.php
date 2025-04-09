<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'showProduct']);

Route::get('/admin', function () {
    return view('indexBootstrap');
});
Route::get('/shop', function () {
    return view('shoppingCart');
});
/*Route::get('/category', function () {
    return view('categoryProducts');
});*/
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

/* Lógica a seguir para el login y el register
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Ruta para procesar el inicio de sesión (puedes omitirla si usas las predeterminadas de Laravel)
Route::post('/login', [LoginController::class, 'login']);

// Ruta para cerrar sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta para la página de registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Ruta para procesar el registro (puedes omitirla si usas las predeterminadas de Laravel)
Route::post('/register', [RegisterController::class, 'register']);
*/
