<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\UpdateOrderRequest;
use App\Jobs\SendEmail;
use App\Mail\OrderShipped;
use App\Models\Order;
use App\Models\Shipping;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems', 'address', 'user')->get();

        return view('order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('order.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('order.edit', compact('order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {

        $order->update([
            'status' => $request->status
        ]);

        Shipping::updateOrCreate([
            'order_id' => $order->id
        ],[
            'order_id' => $order->id,
            'order_address_id' => $order->address->id,
            'shipped_at' => $request->shipped_at,
            'deliver_at' => $request->deliver_at,
            ]);

        if ($request->status == 'shipped') {
            $email = new OrderShipped($order);
            $emailJob = (new SendEmail($email))->delay(now()->addSeconds(5));
            dispatch($emailJob);
        }

        return back()->withSuccess('Order updated successfully');
    }

}
