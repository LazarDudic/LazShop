<?php

namespace Tests;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker, RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->artisan('db:seed', ['--class' => 'RoleSeeder']);
        $this->artisan('db:seed', ['--class' => 'PermissionSeeder']);
    }

    public function admin()
    {
        $email = $this->faker->email;

        User::factory()->create([
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $email,
            'role_id' => 1,
            'password' => 'password',
        ]);

        return $this->actingAs(User::where('email', $email)->first());
    }

    public function user()
    {
        return User::factory()->create();
    }

    public function buyer()
    {
        $email = $this->faker->email;

        User::factory()->create([
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $email,
            'role_id' => 3,
            'password' => 'password',
        ]);

        return $this->actingAs(User::where('email', $email)->first());
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
            'image'       => null,
            'category_id' => $this->category()->id,
        ]);

        return Product::where('name', $name)->first();
    }
}
