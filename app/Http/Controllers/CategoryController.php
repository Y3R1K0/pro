<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|unique:categories,name',
            'image' => 'required|image',
        ]);

        // Crear slug basado en el nombre de categoría
        $slug = Str::slug($request->name);
        
        // Crear carpeta
        $folder = "categories/{$slug}";
        $imagePath = $request->file('image')->store($folder, 'public');

        Category::create([
            'name'  => $request->name,
            'slug'  => $slug,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.categories.index');
    }
}

