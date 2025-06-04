<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

//Un usuario tiene que estar logueado para usar la web
Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:cliente'])->group(function () {
        Route::get('/', [ProductController::class, 'showProduct'])->name('index');
    });

    //Restrincción para que sólo entren admin y empleados
    Route::middleware(['role:admin|empleado'])->group(function () {
        //Admin
        Route::get('/admin', function () {
            return view('admin');
        })->name('admin');

        //Productos
        Route::get('/admin/productos', [ProductController::class, 'index'])->name('showProducts');
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/admin/productos/create', [ProductController::class, 'create'])->name('createProduct');
            Route::post('/admin/productos', [ProductController::class, 'store'])->name('storeProduct');
            Route::get('/admin/productos/{id}/edit', [ProductController::class, 'edit'])->name('editProduct');
            Route::put('/admin/productos/{id}', [ProductController::class, 'update'])->name('updateProduct');
            Route::delete('/admin/productos/{id}', [ProductController::class, 'destroy'])->name('deleteProduct');
            Route::get('/admin/productos/{id}', [ProductController::class, 'edit']);
        });

        //Usuarios
        Route::get('/admin/usuarios', [UserController::class, 'index'])->name('showUsers');
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/admin/usuarios/create', [UserController::class, 'create'])->name('createUser');
            Route::post('/admin/usuarios', [UserController::class, 'store'])->name('storeUser');
            Route::get('/admin/usuarios/{id}/edit', [UserController::class, 'edit'])->name('editUser');
            Route::get('/admin/usuarios/{id}', [UserController::class, 'edit']);
            Route::put('/admin/usuarios/{id}', [UserController::class, 'update'])->name('updateUser');
            Route::delete('/admin/usuarios/{id}', [UserController::class, 'destroy'])->name('deleteUser');
        });

        //Categorías
        Route::get('/admin/categorias', [CategoryController::class, 'index'])->name('showCategories');
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/admin/categorias/create', [CategoryController::class, 'create'])->name('createCategory');
            Route::post('/admin/categorias', [CategoryController::class, 'store'])->name('storeCategory');
            Route::get('/admin/categorias/{id}/edit', [CategoryController::class, 'edit'])->name('editCategory');
            Route::get('/admin/categorias/{id}', [CategoryController::class, 'edit']);
            Route::put('/admin/categorias/{id}', [CategoryController::class, 'update'])->name('updateCategory');
            Route::delete('/admin/categorias/{id}', [CategoryController::class, 'destroy'])->name('deleteCategory');
        });

        //Gestión pedidos
        Route::get('/admin/pedidos', [OrderController::class, 'index'])->name('showOrders');
        Route::delete('/admin/pedidos/{id}', [OrderController::class, 'destroy'])->name('deleteOrder');
    });

        //Carrito
    Route::middleware(['role:cliente'])->group(function () {
        Route::get('/cart', [CartController::class, 'getCart'])->name('cart.get');
        Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
        Route::get('/shopping-cart', [CartController::class, 'showCart'])->name('shopping.cart');
        Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

        //Confirmar el pedido
        Route::post('/order/confirm', [OrderController::class, 'store'])->name('order.confirm');

        //Factura
        Route::get('/pedido/{pedido}/factura', [OrderController::class, 'factura'])->name('pedido.factura');

        //Ver productos por categoría
        Route::get('/productos/categoria/{id}', [ProductController::class, 'showByCategory'])->name('products.byCategory');
    });
});

// Ruta para login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Ruta para logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta para register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

