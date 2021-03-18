<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\SearchOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Jobs\SendEmail;
use App\Mail\OrderShipped;
use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_access'), 403);

        $orders = Order::with('orderItems', 'address', 'user')
                       ->orderByDesc('created_at')
                       ->paginate(20)
                       ->withQueryString();;

        return view('order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_access'), 403);

        return view('order.show', compact('order'));
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), 403);

        return view('order.edit', compact('order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        abort_if(Gate::denies('order_edit'), 403);

        $order->update([
            'status' => $request->status
        ]);

        Shipping::updateOrCreate([
            'order_id' => $order->id
        ], [
            'order_id'         => $order->id,
            'order_address_id' => $order->address->id,
            'shipped_at'       => $request->shipped_at,
            'deliver_at'       => $request->deliver_at,
        ]);

        if ($request->status == 'shipped') {
            $email = new OrderShipped($order);
            $emailJob = (new SendEmail($email))->delay(now()->addSeconds(5));
            dispatch($emailJob);
        }

        return back()->withSuccess('Order updated successfully');
    }

    public function search(SearchOrderRequest $request)
    {
        abort_if(Gate::denies('order_access'), 403);

        $orders = Order::with('orderItems', 'address', 'user')
                       ->where('transaction_id', $request->search)
                       ->orWhereHas('user', function($query) use ($request) {
                           $query->whereRaw('concat(first_name, " ", last_name) like ?',
                               ['%' . $request->search . '%']);
                       })
                       ->when($request->sort_status, function($query) use ($request) {
                           $query->where('status', $request->sort_status);
                       })
                       ->orderByDesc('created_at')
                       ->paginate(20)
                       ->withQueryString();

        return view('order.index', compact('orders'));
    }
}
