@extends('layouts.auth', ['title' => 'Category'])

@section('content')
    <div class="container p-4">
        <h1>{{ isset($category) ? 'Update Category' : 'Create Category'}}</h1>
        <hr>
        @include('partials.messages')
        <form action="{{ isset($category)
                                        ? route('categories.update', $category->slug)
                                        : route('categories.store') }}"
              method="POST"
        >
            @if(isset($category))
                @method('PATCH')
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
