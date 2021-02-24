@extends('layouts.auth', ['title' => 'Product'])

@section('content')
    <div class="container p-4">
        <h1>Create Product</h1>
        <hr>
            @include('partials.messages')
            @if(isset($product))
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
            @else
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @endif
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Product Name"
                           value="{{ old('name') ?? $product->name ?? ''}}">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" rows="3">
                        {{ old('description') ?? $product->description ?? '' }}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <input name="price" type="number" class="form-control" step="any" min="0"
                           value="{{ old('price') ?? $product->price ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <div class="custom-file">
                        <input name="image"  type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose image for product</label>
                    </div>

                    @if(isset($product->image))
                        <img src="{{ imagePath($product->image) }}" alt="" width="100" class="m-2">
                        <a href="{{ route('products.delete-image', $product->id) }}" class="text-danger">
                            Delete
                        </a>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Select Category</label>
                    <select class="custom-select" name="category_id">
                        <option selected disabled>Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @if(old('category_id') || isset($product) && $product->category_id === $category->id)
                                    selected
                                @endif
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-check pt-2 pb-4">
                    <input type="hidden" name="status" value="0">
                    <input name="status" type="checkbox" class="form-check-input" id="exampleCheck1"
                        @if(old('status') || isset($product) && $product->status) checked @endif
                    >
                    <label class="form-check-label text-success" for="exampleCheck1">Published</label>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>

    <script type="application/javascript">
        document.querySelector('.custom-file-input').addEventListener('change',function(e){
            var fileName = document.getElementById("customFile").files[0].name;
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = fileName
        })
    </script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'link | codesample',
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent link',

        });
    </script>
@endsection




