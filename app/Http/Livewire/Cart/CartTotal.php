<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;

class CartTotal extends Component
{
    protected $listeners = [
        'UpdateCartItem'  => 'render',
        'AddDiscountCode' => 'render',
        'RemoveDiscount'  => 'render',
    ];

    public function render()
    {
        $cart = cartNumbers();

        return view('livewire.cart.cart-total',
            compact('cart')
        );
    }
}
