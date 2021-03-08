<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /** @test */
    public function category_can_be_created()
    {
        $this->admin()->post(route('categories.store'), [
            'name' => $this->faker->paragraph
        ]);

        $this->assertEquals(1, Category::all()->count());
    }

    /** @test */
    public function category_can_be_updated()
    {
        $category = $this->category();
        $response = $this->admin()->post(route('categories.update', $category->slug), [
            'name' => $category->name . '1'
        ]);

        $response->assertSee('Category updated successfully.');
    }

    /** @test */
    public function name_must_be_unique()
    {
        $category = $this->category();
        $categoryNew = $this->category();

        $response = $this->admin()->patch(route('categories.update', $category->slug), [
            'name' => $categoryNew->name
        ]);

        $response->assertSessionHasErrors('name');
    }


}
