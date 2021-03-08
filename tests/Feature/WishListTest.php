<?php

namespace Tests\Feature;

use App\Http\Livewire\Cart\AddToCartButton;
use App\Models\Product;
use App\Models\WishList;
use Livewire\Livewire;
use Tests\TestCase;

class WishListTest extends TestCase
{
    private $product;
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'DatabaseSeeder']);
        $this->product = Product::find(1);

        Livewire::test(AddToCartButton::class, ['product' => $this->product])
                ->call('addToCart');
    }
    /** @test */
    public function only_auth_user_can_see_add_to_wish_list_button()
    {
        $this->get(route('cart.index'))->assertDontSee('Add to wish list');
        $this->buyer()->get(route('cart.index'))->assertSee('Add to wish list');
    }

    /** @test */
    public function item_can_be_added_to_wish_list()
    {
        $this->buyer()->post(route('wish-list.store'), [
            'product_id' => $this->product->id
        ])->assertSessionHas('success');
    }

    /** @test */
    public function item_can_be_removed_from_wish_list()
    {
        $buyer = $this->buyer();

        $buyer->post(route('wish-list.store'), [
            'product_id' => $this->product->id
        ]);

        $count = WishList::where('product_id', $this->product->id)->count();

        $this->assertEquals(1, $count);

        $buyer->post(route('wish-list.destroy', $this->product->id), [
            'product_id' => $this->product->id
        ]);

        $count = WishList::where('product_id', $this->product)->count();
        $this->assertEquals(0, $count);
    }
}
