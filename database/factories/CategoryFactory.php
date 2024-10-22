<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word, // Generar un nombre de categoría aleatorio
            'description' => $this->faker->sentence, // Generar una descripción aleatoria
            'is_active' => $this->faker->boolean, // Activar o desactivar aleatoriamente la categoría
        ];
    }
}
