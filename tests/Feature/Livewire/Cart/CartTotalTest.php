<?php

namespace Tests\Feature\Livewire\Cart;

use App\Http\Livewire\Cart\AddToCartButton;
use App\Http\Livewire\Cart\CartTotal;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Livewire;
use Tests\TestCase;

class CartTotalTest extends TestCase
{
    /** @test */
    function cart_page_contains_cart_total_livewire_component()
    {
        $this->get(route('cart.index'))->assertSeeLivewire('cart.cart-total');
    }

    /** @test */
    public function displays_subtotal_tax_shipping_and_total()
    {
        $this->artisan('db:seed', ['--class' => 'DatabaseSeeder']);

        $product = Product::find(1);

        Livewire::test(AddToCartButton::class, ['product' => $product])
                ->call('addToCart');

        $subtotal = Cart::subtotal();
        $shipping = priceFormat(shipping($subtotal));
        $tax      = Cart::tax();
        $total    = priceFormat(Cart::total() + $shipping);

        Livewire::test(CartTotal::class)
            ->assertSee($subtotal)
            ->assertSee($shipping)
            ->assertSee($tax)
            ->assertSee($total);
    }
}
