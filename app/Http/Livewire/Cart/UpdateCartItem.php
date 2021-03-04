<?php

namespace App\Http\Livewire\Cart;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class UpdateCartItem extends Component
{
    public $itemId;

    public function mount($itemId)
    {
        $this->itemId = $itemId;
    }

    public function decrease()
    {
        $cartItem = $this->getCartItem();

        if ($cartItem->qty === 1) {
            return null;
        }

        Cart::update($cartItem->rowId,  $cartItem->qty - 1);
    }

    public function increase()
    {
        $product = Product::findOrFail($this->itemId);
        $cartItem = $this->getCartItem();

        if ($product->quantity === 0) {
            session()->flash('error', 'Product '. $product->name . ' is just sold out.');
            $this->redirect(route('cart.index'));
        }

        if ($product->quantity <= $cartItem->qty) {
            Cart::update($cartItem->rowId, $product->quantity);
            return;
        }

        Cart::update($cartItem->rowId, $cartItem->qty + 1);
    }

    public function remove()
    {
        $cartItem = $this->getCartItem();
         Cart::remove($cartItem->rowId);
         return $this->redirect(route('cart.index'));
    }

    protected function getCartItem()
    {
        $cartItems = Cart::search(function ($cartItem, $rowId){
            return $cartItem->id === $this->itemId;
        });

        foreach ($cartItems as $item) {
            return $item;
        }
    }

    public function render()
    {
        $cartItem = $this->getCartItem();
        $this->emit('UpdateCartItem');

        return view('livewire.cart.update-cart-item', [
            'cartItem' => $cartItem
        ]);
    }
}
