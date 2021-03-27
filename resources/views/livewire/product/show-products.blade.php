<div class="col-lg-9 my-5">
    <div class="form-row">
        <div class="col">
            <select wire:model="sortField" class="form-control">
                <option value="created_at">Newest</option>
                <option value="price_low" >Price(Low to High)</option>
                <option value="price_high">Price(High to Low)</option>
                <option value="rating">Rating</option>
                <option value="orders">Orders</option>
            </select>
        </div>
        <div class="col">
            <input wire:model.debounce.300ms="search" type="search" class="form-control" placeholder="Search...">
        </div>
    </div>

    <div class="row mt-3">
        @forelse($products as $product)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="{{ route('products.show', $product->id) }}">
                        <img class="card-img-top rounded" height="200" width="200"
                             src="{{ imagePath($product->image) }}" alt="{{ $product->name }}">
                    </a>
                    <div class="card-body">
                        <h6 class="card-title">
                            <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                        </h6>
                        <h5 class="text-success">${{ $product->price }}</h5>
{{--                        <span class="text-secondary">({{ $product->quantity }}) peaces available.</span>--}}
                        <span class="text-secondary">({{ $product->orderItems->count() }}) orders.</span>
                        <!-- AddToCartButton -->
                        <livewire:cart.add-to-cart-button :product="$product" :key="time().$product->id"/>
                        <!-- AddToCartButton end -->

                    </div>
                    <div class="card-footer">
                        <span class="text-warning">{{ ratingStars($product->rating) }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <h1 class="text-center">No product found.</h1>
            </div>
        @endforelse
    </div>
    @if($products->count() == $take)
        <div class="text-center">
            <button wire:click="seeMore()" class="btn btn-primary">See More</button>
        </div>
    @endif
</div>
