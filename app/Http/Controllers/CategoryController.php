<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('category_access'), 403);

        $categories = Category::all();

        return view('category.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $categories = Category::all();

        return view('category.show', compact('categories', 'category'));
    }

    public function create()
    {
        abort_if(Gate::denies('category_create'), 403);

        return view('category.create');
    }


    public function store(CreateCategoryRequest $request)
    {
        abort_if(Gate::denies('category_create'), 403);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect(route('categories.index'))->withSuccess('Category created successfully');
    }

    public function edit(Category $category)
    {
        abort_if(Gate::denies('category_edit'), 403);

        return view('category.create', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        abort_if(Gate::denies('category_edit'), 403);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect(route('categories.index'))->withSuccess('Category updated successfully');
    }

    public function destroy(Category $category)
    {
        abort_if(Gate::denies('category_delete'), 403);

        $category->delete();

        return redirect(route('categories.index'))->withSuccess('Category deleted successfully');
    }
}
