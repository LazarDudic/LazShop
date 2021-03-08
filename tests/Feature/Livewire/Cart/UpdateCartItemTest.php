<?php

namespace Tests\Feature\Livewire\Cart;

use App\Http\Livewire\Cart\AddToCartButton;
use App\Http\Livewire\Cart\UpdateCartItem;
use App\Models\Product;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateCartItemTest extends TestCase
{
    private $product;
    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'DatabaseSeeder']);

        $this->product = Product::find(1);
        Livewire::test(AddToCartButton::class, ['product' => $this->product])
                ->call('addToCart');
    }

    /** @test */
    function cart_page_contains_update_cart_item_livewire_component()
    {
        $this->get(route('cart.index'))->assertSeeLivewire('cart.update-cart-item');
    }

    /** @test */
    public function product_can_be_increased_and_decreased()
    {
        Livewire::test(UpdateCartItem::class, ['itemId' => $this->product->id])
                ->call('increase')
                ->assertSet('cartItemQuantity', 2);

        Livewire::test(UpdateCartItem::class, ['itemId' => $this->product->id])
                ->call('decrease')
                ->assertSet('cartItemQuantity', 1);
    }

    /** @test */
    public function UpdateCartItem_is_emitted()
    {
        Livewire::test(UpdateCartItem::class, ['itemId' => $this->product->id])
            ->assertEmitted('UpdateCartItem');
    }

    /** @test */
    public function item_quantity_can_be_min_1()
    {
        Livewire::test(UpdateCartItem::class, ['itemId' => $this->product->id])
                ->set('cartItemQuantity', -1)
                ->assertSet('cartItemQuantity', 1);
    }

    /** @test */
    public function max_item_quantity_is_product_quantity()
    {
        Livewire::test(UpdateCartItem::class, ['itemId' => $this->product->id])
                ->set('cartItemQuantity', $this->product->quantity + 10)
                ->assertSet('cartItemQuantity', $this->product->quantity);
    }

}
