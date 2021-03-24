<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\Http\Request;
use App\Events\Ordered;

class StripeCheckoutController extends CheckoutController
{
    public function purchase(Request $request)
    {
        if ($itemName = $this->requestedItemsAreNotAvailable()) {
            return redirect(route('cart.index'))
                ->withErrors('Item ' . $itemName . ' is sold out or available quantity is less then requested.');
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

        $order = $this->storeOrderDetails($stripe->id, 'paid');

        event(new Ordered($order));

        return redirect(route('user-orders.index'))->with('success', 'The order placed successfully! Thank you!');
    }
}
