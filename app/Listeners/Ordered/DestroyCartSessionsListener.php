<?php

namespace App\Listeners\Ordered;

use App\Events\Ordered;
use Gloudemans\Shoppingcart\Facades\Cart;

class DestroyCartSessionsListener
{


    /**
     * Handle the event.
     *
     * @param  Ordered  $event
     * @return void
     */
    public function handle(Ordered $event)
    {
        session()->forget('coupon');

        Cart::destroy();
    }
}
