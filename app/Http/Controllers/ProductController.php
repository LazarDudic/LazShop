<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\SearchProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_access'), 403);

        $products = Product::with('createdBy', 'updatedBy', 'category')
                           ->orderByDesc('updated_at')
                           ->paginate(10);

        return view('product.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), 403);

        $categories = Category::all();

        if ($categories->count() === 0) {
            return redirect(route('categories.create'))
                ->withErrors('In order to create product you must create category first.');
        }

        return view('product.create', compact('categories'));
    }

    public function store(CreateProductRequest $request)
    {
        abort_if(Gate::denies('product_create'), 403);

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
        $reviews = Review::with('user')
                         ->where('product_id', $product->id)
                         ->latest()
                         ->paginate(5);

        return view('product.show', compact('product', 'categories', 'reviews'));
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), 403);

        $categories = Category::all();

        return view('product.create', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        abort_if(Gate::denies('product_edit'), 403);

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
        abort_if(Gate::denies('product_delete'), 403);

        $product->deleteImage();
        $product->delete();
        return redirect(route('products.index'))->withSuccess('Product deleted successfully.');
    }

    public function search(SearchProductRequest $request)
    {
        abort_if(Gate::denies('product_access'), 403);

        $products = Product::with('createdBy', 'updatedBy', 'category')
                           ->where('name', 'like', '%' . $request->search . '%')
                           ->orWhereHas('category', function($query) use ($request) {
                               $query->where('name', 'like', '%' . $request->search . '%');
                           })
                           ->orWhereHas('createdBy', function($query) use ($request) {
                               $query->whereRaw('concat(first_name, " ", last_name) like ?',
                                   ['%' . $request->search . '%']);
                           })
                           ->orderBy($request->sort_field, $request->sort_direction)
                           ->paginate(10)
                           ->withQueryString();

        return view('product.index', compact('products'));
    }

    public function deleteImage(Product $product)
    {
        $product->deleteImage();
        $product->image = null;
        $product->save();

        return back()->withSuccess('Product image removed successfully.');
    }
}
