<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Order;

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

        return back()->withSuccess('Order updated successfully');
    }

}
