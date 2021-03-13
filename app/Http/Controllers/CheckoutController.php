<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

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

    public function purchase(Request $request)
    {
        if ($itemName = $this->requestedItemsAreNotAvailable()) {
            return redirect(route('cart.index'))
                ->withErrors('Item '.$itemName.' is sold out or available quantity is less then requested.');
        }

        $user = auth()->user();
        $cart = cartNumbers();

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($request->payment_method);
            $stripe = $user->charge($cart['total'] * 100, $request->payment_method, [
                'description' => 'Order from ' . env('app_name'),
            ]);

        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        $this->storeOrderDetails($stripe, $cart);

        session()->forget('coupon');

        $this->decreaseProductsQuantity();

        Cart::destroy();

        return redirect(route('user-orders.index'))->with('success', 'The order placed successfully! Thank you!');
    }

    private function requestedItemsAreNotAvailable()
    {
        foreach (Cart::content() as $row) {
            if (($row->model->quantity - $row->qty) < 0) {
                return $row->model->name;
            }
        }

        return false;
    }

    private function storeOrderDetails($stripe, $cart)
    {
        $user = auth()->user();

        $order = Order::create([
            'total_price'    => $cart['total'],
            'status'         => 'paid',
            'email'          => $user->email,
            'transaction_id' => $stripe->id,
            'user_id'        => $user->id
        ]);

        OrderAddress::create([
            'order_id' => $order->id,
            'address' => $user->address->address,
            'city' => $user->address->city,
            'state' => $user->address->state,
            'country' => $user->address->country,
            'zipcode' => $user->address->zipcode,
        ]);

        foreach (Cart::content() as $row) {
            OrderItem::create([
                'product_name' => $row->model->name,
                'product_id' => $row->model->id,
                'unit_price' => $row->model->price,
                'order_id' => $order->id,
                'quantity' => $row->model->quantity,
            ]);
        }
    }

    private function decreaseProductsQuantity()
    {
        foreach (Cart::content() as $row) {
            $qty = $row->model->quantity - $row->qty;
            $row->model->update([
                'quantity' => $qty
            ]);
        }
    }
}
