<?php

namespace App\Http\Livewire\Cart;

use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartTotal extends Component
{
    protected $listeners = [
        'UpdateCartItem' => 'render',
        'AddDiscountCode' => 'render',
        ];

    public function getSubtotal()
    {
        if (session()->has('coupon')) {
            $coupon = Coupon::where('code', session()->get('coupon'))->first();

            return $coupon->discount();
        }

        return Cart::subtotal();
    }

    public function render()
    {
        $subtotal = priceFormat($this->getSubtotal());
        $shipping = priceFormat(shipping($subtotal));
        $tax      = Cart::tax();
        $total    = $subtotal + $shipping + $tax;

        return view('livewire.cart.cart-total',
            compact('subtotal', 'shipping', 'tax', 'total')
        );
    }
}
