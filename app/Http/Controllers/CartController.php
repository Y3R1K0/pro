<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    // Mostrar carrito
    public function index()
    {
        return view('cart.index');  // Vista del carrito
    }

    // Añadir al carrito vía AJAX
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = Session::get('cart', []);

        $currentQuantityInCart = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;

        if ($currentQuantityInCart >= $product->stock) {
            return response()->json([
                'error' => 'No hay suficiente stock disponible. Stock actual: ' . $product->stock,
                'totalQuantity' => array_sum(array_column($cart, 'quantity')),
            ], 400);
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'totalQuantity' => array_sum(array_column($cart, 'quantity')),
        ]);
    }

    // Quitar producto del carrito
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        if(isset($cart[$id])){
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        return redirect()->route('cart.index');
    }

    // Vaciar carrito (opcional)
    public function clear()
    {
        Session::forget('cart');
        return redirect()->route('cart.index');
    }

    // Método para checkout - Puedes implementarlo según tu lógica
    public function checkout()
    {
        // Añade aquí la lógica de pago o resumen final
        return view('cart.checkout'); // crea esta vista o redirige a donde corresponda
    }
}