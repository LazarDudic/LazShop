<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Order;

class UserOrderController extends Controller
{
    public function index()
    {
         $orders = auth()->user()->orders()
                                ->with('address', 'orderItemsAndRelatedProduct')
                                ->where('user_id', auth()->id())
                                ->get();

        return view('account.order.index', compact('orders'));
    }

    public function show(Order $userOrder)
    {
        abort_if($userOrder->notFromThisUser(), 403);

        return view('account.order.show' , [
            'order' => $userOrder
        ]);
    }
}
