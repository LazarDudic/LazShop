@extends('layouts.auth', ['title' => 'Products'])

@section('content')
    <div class="container-fluid p-4">
        <h1>Products</h1>
        <hr>
        @include('partials.messages')

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Products Table
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm float-right">Create</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Status</th>
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
                                <td>{!! substr($product->description, 0, 20) !!}</td>
                                <td class="p-1">
                                    <img src="{{ imagePath($product->image) }}" alt="{{ $product->name }}"
                                        width="80" height="70">
                                </td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    {!! $product->status
                                            ? '<p class="badge badge-success">Active</p>'
                                            : '<p class="badge badge-danger">Draft</p>'
                                    !!}
                                </td>
                                <td>{{ $product->created_by }}</td>
                                <td>{{ $product->updated_by }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="btn btn-info btn-sm mr-2" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure?')">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm" type="submit" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h2 class="text-center">No product found.</h2>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection