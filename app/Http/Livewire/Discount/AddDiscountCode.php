<?php

namespace App\Http\Livewire\Discount;

use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddDiscountCode extends Component
{
    public $discountCode;

    protected $listeners = [
        'RemoveDiscount' => 'render'
    ];

    protected $rules = [
        'discountCode' => ['required', 'string'],
    ];

    public function addCode()
    {
        if (Cart::count() == 0) {
            return $this->addError('discountCode', 'Coupon can not be applied if cart is empty.');
        }

        $this->validate();

        $coupon = Coupon::where('code', $this->discountCode)->first();

        if (! $coupon || $coupon->code !== $this->discountCode) {
            return $this->addError('discountCode', 'The coupon is invalid.');
        }

        $this->emit('AddDiscountCode');

        session()->put('coupon', $this->discountCode);

        $this->discountCode = '';
    }

    public function render()
    {
        return view('livewire.discount.add-discount-code');
    }
}
