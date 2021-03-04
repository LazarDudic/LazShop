@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            @include('partials.sidebar')
            <!-- sidebar -->

            <div class="col-lg-9 ">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex">
                            <img src="{{ imagePath($product->image) }}" alt="{{ $product->name }}" width="400">
                            <div class="offset-1">
                                <h3 class="card-title ">{{ $product->name }}</h3>
                                <h4 class="text-success">${{ $product->price }}</h4>
                                <!-- AddToCartButton -->
                                <livewire:cart.add-to-cart-button :product="$product"/>
                                <!-- AddToCartButton end -->
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
