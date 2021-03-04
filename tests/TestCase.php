<?php

namespace Tests;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\FakeUsers;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker, RefreshDatabase, FakeUsers;

    public function setUp() : void
    {
        parent::setUp();

        $this->artisan('db:seed', ['--class' => 'RoleSeeder']);
        $this->artisan('db:seed', ['--class' => 'PermissionSeeder']);
    }

    public function category()
    {
        return Category::factory()->create();
    }

    public function product()
    {
        $name = $this->faker->unique()->name;
        $this->admin()->post(route('products.store'), [
            'name'        => $name,
            'description' => $this->faker->paragraph(3),
            'status'      => rand(0, 1),
            'price'       => rand(1 * 10, 500 * 10) / 10,
            'quantity'    => rand(1, 100),
            'image'       => null,
            'category_id' => $this->category()->id,
        ]);

        return Product::where('name', $name)->first();
    }
}
