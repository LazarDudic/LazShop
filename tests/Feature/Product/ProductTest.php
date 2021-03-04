<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /** @test */
    public function product_can_be_created()
    {
        $this->admin()->post(route('products.store'), [
            'name' => 'random name',
            'description' => $this->faker->paragraph(3),
            'status' => $this->faker->randomElement([null, 'on']),
            'price' => rand(1, 500),
            'quantity' => rand(0, 100),
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'category_id' => $this->category()->id,
        ]);
        $product =  Product::where('name', 'random name')->first();
        $this->assertTrue(boolval($product));
        Storage::disk('public')->assertExists($product->image);
    }

    /** @test */
    public function product_can_be_updated()
    {
        $product = $this->product();

        $this->admin()->patch(route('products.update', $product->id), [
            'name' => 'updated name',
            'description' => $this->faker->paragraph(3),
            'price' => rand(1, 500),
            'quantity' => rand(0, 100),
            'image' => null,
            'category_id' => $this->category()->id,
        ]);

       $this->assertEquals(1, Product::where('name', 'updated name')->count());
    }

    /** @test */
    public function product_can_be_deleted()
    {
        $product = $this->product();
        $this->admin()->delete(route('products.destroy', $product->id));

        $count = Product::where('id', $product->id)->get()->count();

        $this->assertEquals(0, $count);
    }

    /** @test */
    public function image_can_be_deleted()
    {
        $this->admin()->post(route('products.store'), [
            'name' => 'random name',
            'description' => $this->faker->paragraph(3),
            'price' => rand(1, 500),
            'quantity' => rand(1, 100),
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'category_id' => $this->category()->id,
        ]);

        $product =  Product::where('name', 'random name')->first();
        Storage::disk('public')->assertExists($product->image);

        $this->admin()->get(route('products.delete-image', $product->id));

        $product1 =  Product::where('name', 'random name')->first();
        $this->assertNull($product1->image);
        Storage::disk('public')->assertMissing($product->image);
    }
}
