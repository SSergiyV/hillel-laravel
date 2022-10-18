<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->name(),
            'description' => fake()->paragraph(rand(1, 5)),
            'short_description' => fake()->words(5, true),
            'SKU' => fake()->unique()->ean8(),
            'price' => fake()->randomFloat(2, 10, 100),
            'discount' => fake()->numberBetween(0, 50),
            'in_stock' => fake()->numberBetween(1, 20),
            'thumbnail' => fake()->imageUrl(category: 'cars', randomize: true),
        ];
    }
}
