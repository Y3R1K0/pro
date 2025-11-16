<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Charmander Chibi',
            'category' => 'pokemon',
            'description' => 'Figura impresa en 3D...',
            'price' => 35.00,
            'image' => 'img/pokemon/charmander/charmander_chibi_1.jpg',
            'image2' => 'img/pokemon/charmander/charmander_chibi_2.jpg',
            'image3' => 'img/pokemon/charmander/charmander_chibi_3.jpg',
        ]);
    }
}
