<?php

namespace Tests\Feature;

use App\Http\Livewire\Cart\AddToCartButton;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Livewire;
use Tests\TestCase;

class CartTest extends TestCase
{
    /** @test */
    public function item_can_be_removed_from_cart()
    {
        $this->artisan('db:seed', ['--class' => 'DatabaseSeeder']);

        $product = Product::find(1);

        Livewire::test(AddToCartButton::class, ['product' => $product])
                ->call('addToCart');

        foreach (Cart::content() as $item) {
            $rowId = $item->rowId;
        }
        $this->delete(route('cart.destroy', $rowId))
            ->assertSessionHas('success');

        $this->assertEquals(0, Cart::count());
    }
}
