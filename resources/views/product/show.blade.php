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
                                <span class="text-secondary mb-4">({{ $product->quantity }}) peaces available.</span>
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
                        <h5 class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</h5>
                        4.0 stars

                    </div>

                </div>
                <!-- /.card -->

            </div>
            <!-- /.col-lg-9 -->

        </div>

    </div>
@endsection
