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
        if ($this->itemQuantityIsAvailable()) {
            Cart::add($this->product->id, $this->product->name, 1, $this->product->price,)
                ->associate('App\Models\Product');

            $this->emit('updateCartCount');
        }
    }

    public function render()
    {
        return view('livewire.cart.add-to-cart-button');
    }


    private function itemQuantityIsAvailable()
    {
        $cartItem =  $this->getCartItem();

        if ($this->product->quantity === 0) {
            if (! is_null($cartItem)) {
                Cart::remove($cartItem->rowId);
            }
            session()->flash('error', 'Product '.$this->product->name.' is just sold out.');
            return $this->redirect(route('home.index'));
        }

        if (is_null($cartItem)) {
            return true;
        }

        if ($this->product->quantity < $cartItem->qty) {
            session()->flash('error',
                'Product '.$this->product->name.' has only '. $this->product->quantity. ' peaces left');

            Cart::update($cartItem->rowId, $this->product->quantity);
            return $this->redirect(route('cart.index'));
        }

        return $cartItem->qty === $this->product->quantity ? false : true;
    }

    private function getCartItem()
    {
        $cartItems = Cart::search(function($cartItem, $rowId) {
            return $cartItem->id === $this->product->id;
        });

        $cartItem = null;
        foreach ($cartItems as $item) {
            $cartItem = $item;
        }

        return $cartItem;
    }
}
