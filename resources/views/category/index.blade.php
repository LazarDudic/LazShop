@extends('layouts.auth', ['title' => 'Categories'])

@section('content')
    <div class="container p-4">
        <h1>Categories</h1>
        <hr>
        @include('partials.messages')

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Categories Table
                @can('category_create')
                    <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm float-right">Create</a>
                @endcan

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Products</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Products</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->products_count }}</td>
                            <td class="d-flex">
                                <a href="{{ route('categories.show', $category->slug) }}"
                                   class="btn btn-secondary btn-sm mr-2" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('category_edit')
                                <a href="{{ route('categories.edit', $category->slug) }}"
                                   class="btn btn-info btn-sm mr-2" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endcan
                                @can('category_delete')
                                <form action="{{ route('categories.destroy', $category->slug) }}" method="POST"
                                    onsubmit="return confirm('You\'ll delete all products which belongs to this category as well.Are you sure?')">
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
                            <h2 class="text-center">No category found.</h2>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $categories->links() }}
            </div>
        </div>
    </div>

@endsection
