<div class="col-lg-3 my-5">
    <div class="list-group">
        @forelse($categories as $category)
            <a href="#" class="list-group-item">{{ $category->name }}</a>
        @empty
            <a href="{{ route('categories.index') }}" class="list-group-item">Add Categories</a>
        @endforelse
    </div>

</div>

