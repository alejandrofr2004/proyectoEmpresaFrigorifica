<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', [ProductController::class, 'showProduct'])->name('index');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/admin/productos', [ProductController::class, 'index'])->name('showProducts');

Route::get('/admin/productos/create', [ProductController::class, 'create'])->name('createProduct');
Route::post('/admin/productos', [ProductController::class, 'store'])->name('storeProduct');

Route::get('/admin/productos/{id}/edit', [ProductController::class, 'edit'])->name('editProduct');
Route::put('/admin/productos/{id}', [ProductController::class, 'update'])->name('updateProduct');

Route::delete('/admin/productos/{id}', [ProductController::class, 'destroy'])->name('deleteProduct');

//Organizar todas por cosas, esto es categorías
Route::get('/admin/categorias', [CategoryController::class, 'index'])->name('showCategories');
Route::get('/admin/categorias/create', [CategoryController::class, 'create'])->name('createCategory');
Route::post('/admin/categorias', [CategoryController::class, 'store'])->name('storeCategory');
Route::get('/admin/categorias/{id}/edit', [CategoryController::class, 'edit'])->name('editCategory');
Route::put('/admin/categorias/{id}', [CategoryController::class, 'update'])->name('updateCategory');
Route::delete('/admin/categorias/{id}', [CategoryController::class, 'destroy'])->name('deleteCategory');



Route::get('/shop', function () {
    return view('shoppingCart');
});
//Hacer un nuevo archivo para meter estas rutas
Route::get('/productos/categoria/{id}', [ProductController::class, 'showByCategory'])->name('products.byCategory');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Ruta para procesar el formulario de login
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Ruta para logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

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
