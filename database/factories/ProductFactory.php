<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        Product::flushEventListeners();

        return [
            'name' => $this->faker->unique()->name,
            'description' => $this->faker->paragraph(3),
            'status' => $this->faker->randomElement([0, 'on']),
            'price' => rand (1*10, 500*10) / 10,
            'quantity' => rand (0,200),
            'image' => null,
            'category_id' => rand(1,10),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
