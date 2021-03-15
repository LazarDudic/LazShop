<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;

class RemoveDiscount extends Component
{
    public function remove()
    {
        session()->forget('coupon');
        $this->emit('RemoveDiscount');
    }
    public function render()
    {
        return view('livewire.cart.remove-discount');
    }
}
