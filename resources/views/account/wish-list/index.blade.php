@extends('layouts.auth', ['title' => 'Wish List'])

@section('content')
    <div class="container-fluid p-4">
        <h1>Wish List</h1>
        <hr>
        @include('partials.messages')

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Wish List
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Status</th>
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
                                <td>
                                    {!! $product->status
                                            ? '<p class="badge badge-success">Active</p>'
                                            : '<p class="badge badge-danger">Sold Out</p>'
                                    !!}
                                </td>
                                <td class="d-flex">
                                    <a href="{{ route('products.show', $product->id) }}"
                                       class="btn btn-secondary btn-sm mr-2" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('wish-list.destroy', $product->id) }}" method="POST"
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
