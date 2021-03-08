<?php

namespace Tests\Feature\Livewire\Cart;

use App\Http\Livewire\Cart\AddToCartButton;
use App\Http\Livewire\Cart\CartNavLink;
use App\Models\Product;
use Livewire\Livewire;
use Tests\TestCase;

class CartNavLinkTest extends TestCase
{
    /** @test */
    function home_page_contains_livewire_cart_nav_link_component()
    {
        $this->get('/')->assertSeeLivewire('cart.cart-nav-link');
    }

    /** @test */
    public function displays_cart_count()
    {
        $this->artisan('db:seed', ['--class' => 'DatabaseSeeder']);

        $product = Product::find(1);

        Livewire::test(AddToCartButton::class, ['product' => $product])
                ->call('addToCart');

        Livewire::test(CartNavLink::class)
            ->assertSeeHtml('Cart <p class="badge badge-danger">1</p>');
    }
}
