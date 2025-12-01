<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all(); // Trae todos los productos de la base de datos
        return view('welcome', compact('products')); // Pasa los productos a la vista
    }
        public function show($id) {
        $product = Product::findOrFail($id); // Obtiene solo el producto con ese ID
        return view('product.show', compact('product')); // Pasa $product (singular) a la vista
    }

}
