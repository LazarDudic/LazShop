<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Discount\AddDiscountCode;
use App\Models\Coupon;
use Livewire\Livewire;
use Tests\TestCase;

class AddDiscountCodeTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();

        $this->artisan('db:seed', ['--class' => 'DatabaseSeeder']);
    }

    /** @test */
    function cart_page_contains_add_discount_code_livewire_component()
    {
        $this->get(route('cart.index'))->assertSeeLivewire('discount.add-discount-code');
    }

    /** @test */
    public function discount_code_can_be_added()
    {
        Coupon::factory()->create();

        $this->get(route('cart.index'))->assertSee('Enter discount code');

        Livewire::test(AddDiscountCode::class)
                ->set('discountCode', 'ABC123')
                ->call('addCode')
                ->assertEmitted('AddDiscountCode')
                ->assertDontSee('Enter discount code');

    }

    /** @test */
    public function entering_invalid_coupon_fails()
    {
        Livewire::test(AddDiscountCode::class)
                ->set('discountCode', 'random')
                ->call('addCode')
                ->assertHasErrors('discountCode', 'The coupon is invalid.');
    }
}
