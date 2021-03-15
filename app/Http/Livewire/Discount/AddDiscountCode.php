<?php

namespace App\Http\Livewire\Discount;

use App\Models\Coupon;
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
        $this->validate();

        $coupon = Coupon::where('code', $this->discountCode)->first();

        if (! $coupon) {
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
