@extends('layouts.app', ['title' => 'Cart'])

@section('content')
<!--Section: Block Content-->
<div class="container pt-5">

    <!--Grid row-->
    <div class="row">

        <!--Grid column-->
        <div class="col-lg-8">
        @include('partials.messages')
            <!-- Card -->
            <div class="mb-3">
                <div class="pt-4 wish-list">
                @foreach($cartItems as $item)
                    <div class="row mb-4">
                        <div class="col-md-5 col-lg-3 col-xl-3">
                            <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                                <a href="{{ route('products.show', $item->id) }}">
                                    <div class="mask">
                                        <img class="img-fluid w-100"
                                             src="{{ imagePath($item->model->image) }}">
                                        <div class="mask rgba-black-slight"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-9 col-xl-9">
                            <div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5>{{ $item->name }} </h5>
                                    </div>
                                </div>

                                <!-- CartUpdate -->
                                <livewire:cart.update-cart-item :item-id="$item->id" />
                                <!-- CartUpdate end -->

                                <div class="d-flex justify-content-between">
                                    <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link btn-sm text-uppercase">
                                            <i class="fas fa-trash-alt mr-1"></i> Remove item
                                        </button>
                                    </form>
                                    @can('view-wish-list-button', $item->id)
                                        <form action="{{ route('wish-list.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-link btn-sm text-uppercase">
                                                <i class="fas fa-heart mr-1"></i> Add to wish list
                                            </button>
                                        </form>
                                    @endcannot
                                </div>
                            </div>
                        </div>
                    </div>
                        <hr>
                    @endforeach

                </div>
            </div>
            <!-- Card -->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4">

            <!-- Cart Total -->
            <livewire:cart.cart-total />
            <!-- Cart Total End -->

            <!-- Add Discount Code -->
            <livewire:discount.add-discount-code />
            <!-- Add Discount Code End -->

        </div>
        <!--Grid column-->

    </div>
    <!-- Grid row -->

</div>
<!--Section: Block Content-->
@endsection
