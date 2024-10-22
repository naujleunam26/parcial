<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
       // Crear 10 categorías antes de los productos
       Category::factory(10)->create();

       // Ahora crear 50 productos, los cuales estarán relacionados con las categorías
       Product::factory(50)->create();
    }
}
