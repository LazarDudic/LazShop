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
        $this->authUser()->post(route('products.store'), [
            'name' => 'random name',
            'description' => $this->faker->paragraph(3),
            'status' => $this->faker->randomElement([null, 'on']),
            'price' => rand(1, 500),
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

        $response = $this->authUser()->patch(route('products.store', $product->id), [
            'name' => 'random name',
            'description' => $this->faker->paragraph(3),
            'price' => rand(1, 500),
            'image' => null,
            'category_id' => $this->category()->id,
            'updated_by' => $this->user()->id,
        ]);

        $response->assertSee('Product updated successfully.');
    }

    /** @test */
    public function product_can_be_deleted()
    {
        $product = $this->product();
        $this->authUser()->delete(route('products.destroy', $product->id));

        $count = Product::where('id', $product->id)->get()->count();

        $this->assertEquals(0, $count);
    }

    /** @test */
    public function image_can_be_deleted()
    {
        $this->authUser()->post(route('products.store'), [
            'name' => 'random name',
            'description' => $this->faker->paragraph(3),
            'price' => rand(1, 500),
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'category_id' => $this->category()->id,
        ]);

        $product =  Product::where('name', 'random name')->first();
        Storage::disk('public')->assertExists($product->image);

        $this->authUser()->get(route('products.image-delete', $product->id));

        $product1 =  Product::where('name', 'random name')->first();
        $this->assertNull($product1->image);
        Storage::disk('public')->assertMissing($product->image);
    }
}
