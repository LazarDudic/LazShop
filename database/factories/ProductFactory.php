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
        return [
            'name' => $this->faker->unique()->name,
            'description' => $this->faker->paragraph(3),
            'status' => rand(0,1),
            'price' => rand (1*10, 500*10) / 10,
            'image' => null,
            'category_id' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
