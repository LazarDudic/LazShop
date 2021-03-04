<?php

namespace App\Http\Livewire\Cart;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartNavLink extends Component
{
    protected $listeners = ['updateCartCount' => 'render'];

    public function render()
    {
        return view('livewire.cart.cart-nav-link', [
            'cartCount' => Cart::content()->count()
        ]);
    }
}
