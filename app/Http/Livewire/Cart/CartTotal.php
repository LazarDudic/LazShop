<?php

namespace App\Http\Livewire\Cart;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartTotal extends Component
{
    protected $listeners = ['UpdateCartItem' => 'render'];

    public function render()
    {
        $subtotal = Cart::subtotal();
        $shipping = priceFormat(shipping($subtotal));
        $tax      = Cart::tax();
        $total    = priceFormat(Cart::total() + $shipping);

        return view('livewire.cart.cart-total',
            compact('subtotal', 'shipping', 'tax', 'total')
        );
    }
}
