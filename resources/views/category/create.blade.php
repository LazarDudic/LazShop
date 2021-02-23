@extends('layouts.auth', ['title' => 'Category'])

@section('content')
    <div class="container p-4">
        <h1>{{ isset($category) ? 'Update Category' : 'Create Category'}}</h1>
        <hr>
        @include('partials.messages')
            @if(isset($category))
                <form action="{{ route('categories.update', $category->slug) }}" method="POST">
                @method('PATCH')
            @else
                <form action="{{ route('categories.store') }}" method="POST">
            @endif
            @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Product Name"
                       value="{{ old('name') ?? $category->name ?? '' }}">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

@endsection
