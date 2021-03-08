<?php

namespace Tests\Feature\Livewire\Cart;

use App\Http\Livewire\Cart\AddToCartButton;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Livewire;
use Tests\TestCase;

class AddToCartButtonTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();

        $this->artisan('db:seed', ['--class' => 'DatabaseSeeder']);
    }

    /** @test */
    function home_page_contains_livewire_component()
    {
        $this->get('/')->assertSeeLivewire('cart.add-to-cart-button');
    }

    /** @test */
    function product_page_contains_livewire_component()
    {
        $product = Product::find(1);

        $this->get(route('products.show', $product->id))->assertSeeLivewire('cart.add-to-cart-button');
    }

    /** @test */
    public function can_add_product_to_cart()
    {
        $product = Product::find(1);

        Livewire::test(AddToCartButton::class, ['product' => $product])
                ->call('addToCart')
                ->assertEmitted('updateCartCount');

        $this->assertEquals(1, Cart::count());
    }
}
