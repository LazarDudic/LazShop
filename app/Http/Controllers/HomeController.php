<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::where('status', 1)
                           ->where('quantity', '>', 0)
                           ->get();
        return view('home', compact('products', 'categories'));
    }
}
