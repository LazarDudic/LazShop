<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        return view('product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        if ($categories->count() === 0) {
            return redirect(route('categories.create'))->withErrors('In order to create product you must create category first.');
        }

        return view('product.create', compact('categories'));
    }

    public function store(CreateProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('product', 'public');
        }

        Product::create($data);

        return redirect(route('products.index'))->withSuccess('Product created successfully.');
    }

    public function show(Product $product)
    {
        $categories = Category::all();

        return view('product.show', compact('product', 'categories'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('product.create', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $product->deleteImage();
            $data['image'] = $request->image->store('product', 'public');
        }

        $product->update($data);

        return redirect(route('products.index'))->withSuccess('Product updated successfully.');

    }

    public function destroy(Product $product)
    {
        $product->deleteImage();
        $product->delete();
        return redirect(route('products.index'))->withSuccess('Product deleted successfully.');
    }

    public function deleteImage(Product $product)
    {
        $product->deleteImage();
        $product->image = null;
        $product->save();

        return back()->withSuccess('Product image removed successfully.');
    }
}
