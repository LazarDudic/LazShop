<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::content();

        return view('cart.index', compact('cartItems'));
    }

    public function destroy($id)
    {
        Cart::remove($id);
        return back()->withSuccess('Item removed successfully.');
    }
}
