<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function index()
    {
        $products = auth()->user()->wishListProducts;

        return view('account.wish-list.index', compact('products'));

    }

    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if (! auth()->user()->wishList->contains('product_id', $product->id)) {
            WishList::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id
            ]);
        }

        return back()->withSuccess('Item '.$product->name.' added to Wish List.');
    }

    public function destroy($id)
    {
        WishList::where('user_id', auth()->id())
                ->where('product_id', $id)
                ->firstOrFail()
                ->delete();

        return back()->withSuccess('Item removed from Wish List.');
    }
}
