<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

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
}
