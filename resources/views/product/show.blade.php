@extends('layouts.app', ['title' => $product->name])

@section('content')
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            @include('partials.sidebar')
            <!-- sidebar -->

            <div class="col-lg-9 mt-5">
                @include('partials.messages')
                <div class="card ">
                    <div class="card-body">
                        <div class="d-flex">
                            <img src="{{ imagePath($product->image) }}" alt="{{ $product->name }}" width="400">
                            <div class="offset-1">
                                <h3 class="card-title ">{{ $product->name }}</h3>
                                <h4 class="text-success">${{ $product->price }}</h4>
                                <span class="text-secondary mb-4">({{ $product->quantity }}) peaces available.</span><br>
                                <span class="text-secondary">({{ $product->orderItems->count() }}) orders.</span>

                                <!-- AddToCartButton -->
                                @if($product->quantity > 0)
                                    <livewire:cart.add-to-cart-button :product="$product"/>
                                @else
                                    <p class="badge badge-danger">Product unavailable.</p>
                                @endif
                                <!-- AddToCartButton end -->

                                @can('view-wish-list-button', $product->id)
                                    <div class="mt-2">
                                        <form action="{{ route('wish-list.store') }}" method="POST" >
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-link btn-sm text-uppercase">
                                                <i class="fas fa-heart mr-1"></i> Add to wish list
                                            </button>
                                        </form>
                                    </div>
                                @endcannot
                            </div>
                        </div>
                        <p class="card-text">{!! $product->description !!}</p>
                        <h4 class="text-warning">{{ ratingStars($reviews->avg('rating')) }}</h4>
                    </div>
                </div>
                <!-- /.card -->

                <!-- Create Review -->
                @auth()
                    @if(auth()->user()->isEntitledToLeaveReview($product))
                        <livewire:review.create-review :product="$product" />
                    @endif
                @endauth

                @if($reviews->count() > 0)
                <div class="card card-outline-secondary my-4">
                    <div class="card-header">
                        Product Reviews
                    </div>
                    <div class="card-body">
                        @foreach($reviews as $review)
                            <h5 class="text-warning">{{ ratingStars($review->rating) }}</h5>
                            <p>{{ $review->comment }}</p>
                            <small class="text-muted">Posted by {{ $review->user->fullName() }} on {{
                            $review->created_at->format('Y.m.d') }}</small>
                            <hr>
                        @endforeach
                    </div>
                    {{ $reviews->links() }}
                </div>
                @endif
                <!-- /.card -->

            </div>
            <!-- /.col-lg-9 -->

        </div>

    </div>
@endsection




