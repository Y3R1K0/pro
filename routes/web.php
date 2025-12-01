<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\HomeController; // Asegúrate de incluir este controlador
use App\Http\Controllers\CartController;

// Página principal (tienda)
Route::get('/', [ProductController::class, 'index']);

// Autenticación
Auth::routes();

// Página de Home después de iniciar sesión
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rutas del panel admin
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard de Admin
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // CRUD Productos
        Route::resource('products', AdminProductController::class);

        // CRUD Categorías
        Route::resource('categories', CategoryController::class)->except(['show']);
    });

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index'); // Ver carrito
    Route::post('/add/{id}', [CartController::class, 'add'])->name('cart.add'); // Agregar producto al carrito
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove'); // Eliminar producto
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout'); // Proceder al pago
});
