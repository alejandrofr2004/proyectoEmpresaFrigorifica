<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;

Route::get('/', [ProductController::class, 'showProduct'])->name('index');

Route::middleware(['role:admin|empleado'])->group(function () {
    //Admin
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');

    //Productos
    Route::get('/admin/productos', [ProductController::class, 'index'])->name('showProducts');
    Route::get('/admin/productos/create', [ProductController::class, 'create'])->name('createProduct');
    Route::post('/admin/productos', [ProductController::class, 'store'])->name('storeProduct');
    Route::get('/admin/productos/{id}/edit', [ProductController::class, 'edit'])->name('editProduct');
    Route::put('/admin/productos/{id}', [ProductController::class, 'update'])->name('updateProduct');
    Route::delete('/admin/productos/{id}', [ProductController::class, 'destroy'])->name('deleteProduct');

    //Usuarios
    Route::get('/admin/usuarios', [UserController::class, 'index'])->name('showUsers');
    Route::get('/admin/usuarios/create', [UserController::class, 'create'])->name('createUser');
    Route::post('/admin/usuarios', [UserController::class, 'store'])->name('storeUser');
    Route::get('/admin/usuarios/{id}/edit', [UserController::class, 'edit'])->name('editUser');
    Route::put('/admin/usuarios/{id}', [UserController::class, 'update'])->name('updateUser');
    Route::delete('/admin/usuarios/{id}', [UserController::class, 'destroy'])->name('deleteUser');

    //Categorías
    Route::get('/admin/categorias', [CategoryController::class, 'index'])->name('showCategories');
    Route::get('/admin/categorias/create', [CategoryController::class, 'create'])->name('createCategory');
    Route::post('/admin/categorias', [CategoryController::class, 'store'])->name('storeCategory');
    Route::get('/admin/categorias/{id}/edit', [CategoryController::class, 'edit'])->name('editCategory');
    Route::put('/admin/categorias/{id}', [CategoryController::class, 'update'])->name('updateCategory');
    Route::delete('/admin/categorias/{id}', [CategoryController::class, 'destroy'])->name('deleteCategory');
});

//Carrito
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/shopping-cart', [CartController::class, 'showCart'])->name('shopping.cart');


//Hacer un nuevo archivo para meter estas rutas
Route::get('/productos/categoria/{id}', [ProductController::class, 'showByCategory'])->name('products.byCategory');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Ruta para procesar el formulario de login
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
// Ruta para logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

