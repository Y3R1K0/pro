<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'image2' => 'nullable|image',
            'image3' => 'nullable|image',
        ]);

        // Guardar imágenes
        foreach (['image', 'image2', 'image3'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('uploads/products', 'public');
            }
        }

        Product::create($data);

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'image2' => 'nullable|image',
            'image3' => 'nullable|image',
        ]);

        foreach (['image', 'image2', 'image3'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('uploads/products', 'public');
            }
        }

        $product->update($data);

        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index');
    }
}
