<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;

// Página principal (tienda)
Route::get('/', [ProductController::class, 'index']);

Auth::routes();

// Rutas del panel admin
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // CRUD Productos
        Route::resource('products', AdminProductController::class);

        // CRUD Categorías
        Route::resource('categories', CategoryController::class)->except(['show']);
    });
