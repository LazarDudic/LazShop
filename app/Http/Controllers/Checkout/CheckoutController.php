<?php

namespace App\Http\Controllers\Checkout;

use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function index()
    {
        if (empty(Cart::count())) {
            return redirect(route('cart.index'))->withErrors('You cannot proceed to checkout if cart is empty');
        }
        $cart = cartNumbers();
        $intent = auth()->user()->createSetupIntent();
        $address = auth()->user()->address;

        return view('checkout', compact('intent', 'address', 'cart'));
    }

    protected function requestedItemsAreNotAvailable()
    {
        foreach (Cart::content() as $row) {
            if (($row->model->quantity - $row->qty) < 0) {
                return $row->model->name;
            }
        }

        return false;
    }

    protected function storeOrderDetails($transactionId = null, $status = 'unpaid')
    {
        $user = auth()->user();
        $cart = cartNumbers();

        $order = Order::create([
            'total'          => $cart['total'],
            'subtotal'       => $cart['subtotal'],
            'tax'            => $cart['tax'],
            'shipping'       => $cart['shipping'],
            'status'         => $status,
            'email'          => $user->email,
            'transaction_id' => $transactionId,
            'user_id'        => $user->id
        ]);

        OrderAddress::create([
            'order_id' => $order->id,
            'address'  => $user->address->address,
            'city'     => $user->address->city,
            'state'    => $user->address->state,
            'country'  => $user->address->country,
            'zipcode'  => $user->address->zipcode,
        ]);

        foreach (Cart::content() as $row) {
            OrderItem::create([
                'product_name' => $row->model->name,
                'product_id'   => $row->model->id,
                'unit_price'   => $row->model->price,
                'order_id'     => $order->id,
                'quantity'     => $row->qty,
            ]);
        }

        return $order;
    }
}
