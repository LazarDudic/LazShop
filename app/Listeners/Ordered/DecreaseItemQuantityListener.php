<?php

namespace App\Listeners\Ordered;

use App\Events\Ordered;
use Gloudemans\Shoppingcart\Facades\Cart;

class DecreaseItemQuantityListener
{
    /**
     * Handle the event.
     *
     * @param  Ordered  $event
     * @return void
     */
    public function handle(Ordered $event)
    {
        foreach (Cart::content() as $row) {
            $qty = $row->model->quantity - $row->qty;
            $row->model->update([
                'quantity' => $qty
            ]);
        }
    }
}
