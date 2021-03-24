<?php

namespace App\Http\Controllers\Checkout;

use App\Events\Ordered;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use App\Models\Order;
use PayPalHttp\HttpException;

class PayPalCheckoutController extends CheckoutController
{

    private PayPalHttpClient $client;

    public function __construct()
    {
        $environment = new SandboxEnvironment(config('paypal.sandbox.client_id'), config('paypal.sandbox.client_secret'));
        $this->client = new PayPalHttpClient($environment);
    }


    public function purchase()
    {
        if ($itemName = $this->requestedItemsAreNotAvailable()) {
            return redirect(route('cart.index'))->withErrors('Item ' . $itemName . ' is sold out or available quantity is less then requested.');
        }
        $order = $this->storeOrderDetails();

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = $this->checkoutData($order);

        try {
            $response = $this->client->execute($request);
        }catch (HttpException $exception) {
            return redirect('checkout')->withErrors($exception->getMessage());
        }

        $order->transaction_id = $response->result->id;
        $order->save();

        foreach ($response->result->links as $link) {
            if($link->rel == 'approve') {
                return redirect($link->href);
            }
        }
    }

    public function purchaseSuccess(Order $order)
    {
        $request = new OrdersCaptureRequest($order->transaction_id);
        $request->prefer('return=representation');

        try {
            $response = $this->client->execute($request);
        }catch (HttpException $exception) {
            return redirect('checkout')->withErrors($exception->getMessage());
        }

        $order->transaction_id = $response->result->purchase_units[0]->payments->captures[0]->id;
        $order->status = 'paid';
        $order->save();

        event(new Ordered($order));

        return redirect(route('user-orders.index'))->withSuccess('The order placed successfully! Thank you!');
    }

    private function checkoutData(Order $order)
    {
        return [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => 'paypal_'. uniqid(),
                "amount" => [
                    "value" => $order->total,
                    "currency_code" => "USD"
                ]
            ]],
            "application_context" => [
                "cancel_url" => route('account'),
                "return_url" => route('paypal.success', $order->id),
            ]
        ];
    }

}
