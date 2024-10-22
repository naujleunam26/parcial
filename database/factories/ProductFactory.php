<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'stock' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 5, 100), // precios entre 5 y 100
            'available' => $this->faker->boolean(),
            'release_date' => $this->faker->date(),
            'category_id' => Category::inRandomOrder()->first()->id,  // Seleccionar una categoría aleatoria
            'attributes' => json_encode([
                'color' => $this->faker->safeColorName(),
                'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
                'weight' => $this->faker->randomFloat(2, 0.1, 10) // peso en kg
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
