<?php

namespace App\Http\Livewire\Cart;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddToCartButton extends Component
{
    public Product $product;

    public function addToCart()
    {
        Cart::add($this->product->id, $this->product->name, 1, $this->product->price)
            ->associate('App\Models\Product');

        $this->emit('updateCartCount');
    }

    public function render()
    {
        return view('livewire.cart.add-to-cart-button');
    }

}
