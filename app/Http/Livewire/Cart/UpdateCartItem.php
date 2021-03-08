<?php

namespace App\Http\Livewire\Cart;

use App\Models\Product;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class UpdateCartItem extends Component
{
    public $itemId;
    public $cartItemQuantity;

    public function mount($itemId)
    {
        $this->itemId = $itemId;
    }

    public function updateCartItemQuantity(CartItem $cartItem)
    {
        $product = Product::findOrFail($this->itemId);

        if (empty($this->cartItemQuantity) || $this->cartItemQuantity < 1) {
            $this->cartItemQuantity = $cartItem->qty;
        }

        if ($product->quantity === 0) {
            Cart::remove($cartItem->rowId);
            session()->flash('error', 'Product '. $product->name . ' is just sold out.');
            return $this->redirect(route('cart.index'));
        }

        if ($product->quantity < $this->cartItemQuantity) {
            $this->cartItemQuantity = $product->quantity;
        }

        Cart::update($cartItem->rowId, $this->cartItemQuantity);
    }

    public function decrease()
    {
        $this->cartItemQuantity -= 1;
    }

    public function increase()
    {
        $this->cartItemQuantity += 1;
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
        $this->updateCartItemQuantity($cartItem);
        $this->emit('UpdateCartItem');

        return view('livewire.cart.update-cart-item', [
            'cartItem' => $cartItem
        ]);
    }
}
