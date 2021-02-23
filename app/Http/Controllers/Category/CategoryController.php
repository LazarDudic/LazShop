<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        return view('category.index', compact('categories'));
    }


    public function create()
    {
        return view('category.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect(route('categories.index'))->withSuccess('Category created successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit(Category $category)
    {
        return view('category.create', compact('category'));
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect(route('categories.index'))->withSuccess('Category updated successfully');

    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect(route('categories.index'))->withSuccess('Category deleted successfully');
    }
}
