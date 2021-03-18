@extends('layouts.auth', ['title' => 'Products'])

@section('content')
    <div class="container-fluid p-4">
        <h1>Products</h1>
        <hr>
        @include('partials.messages')

        <div class="card mb-4">
            <div class="card-header d-lg-flex justify-content-between">
                <div>
                    <form action="{{ route('products.search') }}" method="GET" class="form-inline">
                        <input name="search" type="text" placeholder="search..." class="form-control mr-lg-1"
                        value="{{ request()->search }}">
                        Sort by:
                        <select name="sort_field" class="form-control ml-lg-1">
                            <option value="updated_at">Updated At</option>
                            <option value="created_at" {{ request()->sort_field === 'created_at' ? 'selected' : '' }}>
                                Created At
                            </option>
                            <option value="name" {{ request()->sort_field === 'name' ? 'selected' : '' }}>
                                Name
                            </option>
                            <option value="price" {{ request()->sort_field === 'price' ? 'selected' : '' }}>
                                Price
                            </option>
                            <option value="status" {{ request()->sort_field === 'status' ? 'selected' : '' }}>
                                Status
                            </option>
                        </select>
                        <select name="sort_direction" class="form-control">
                            <option value="desc">Descending</option>
                            <option value="asc" {{ request()->sort_direction === 'asc' ? 'selected' : '' }}>
                                Ascending
                            </option>
                        </select>
                        <button type="submit" class="btn btn-info btn ml-1">Search</button>
                    </form>
                </div>
                <div>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <th>{{ $product->id }}</th>
                                <td>{{ $product->name }}</td>
                                <td class="p-1">
                                    <img src="{{ imagePath($product->image) }}" alt="{{ $product->name }}"
                                        width="80" height="70">
                                </td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    {!! $product->status
                                            ? '<p class="badge badge-success">Active</p>'
                                            : '<p class="badge badge-danger">Draft</p>'
                                    !!}
                                </td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->createdBy->fullName() }}</td>
                                <td>
                                    @if(! is_null($product->updatedAt()))
                                        {{ $product->updatedBy->fullName() }} <br>
                                        {{ $product->updatedAt()->format('m.d - H:i') }}
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <a href="{{ route('products.show', $product->id) }}"
                                       class="btn btn-secondary btn-sm mr-2" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @can('product-edit')
                                        <a href="{{ route('products.edit', $product->id) }}"
                                           class="btn btn-info btn-sm mr-2"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('product_delete')
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                              onsubmit="return confirm('Are you sure?')">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-sm" type="submit" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <h2 class="text-center">No product found.</h2>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $products->links() }}
            </div>
        </div>
    </div>

@endsection
