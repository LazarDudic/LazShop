@extends('layouts.auth', ['title' => 'Orders'])

@section('content')
    <div class="container p-4">
        <h1>Your Orders</h1>
        <hr>
        @include('partials.messages')

            <div class="card-body">
                @foreach($orders as $order)
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <span>Order Placed: {{ $order->created_at }}</span>
                            <div>
                                <span class="text-capitalize badge badge-info">Status:  {{ $order->status }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                        @foreach($order->orderItemsAndRelatedProduct as $orderItem)
                            <div class="d-lg-flex justify-content-between align-items-center">
                                <img src="{{ imagePath(optional($orderItem->product)->image) }}" alt="" height="80">
                                <h5 class="card-title">{{ $orderItem->product_name }} </h5>
                                <p>Unit Price: <span class="text-success">${{ $orderItem->unit_price }}</span></p>
                                <p>Quantity: {{ $orderItem->quantity }}</p>
                            </div>
                            @if(optional($orderItem->product)->quantity && optional($orderItem->product)->status)
                                <a href="{{ route('products.show', $orderItem->product_id) }}"
                                   class="btn btn-primary btn-sm mt-2">Buy again</a>

                                    @if(in_array($order->status, ['delivered', 'refunded']))
                                        <a href="{{ route('products.show', $orderItem->product_id) }}"
                                           class="btn btn-success btn-sm mt-2">Leave Review</a>
                                    @endif
                            @else
                                <div class="badge badge-danger">Sold Out</div>
                            @endif
                            <hr>
                        @endforeach

                            <div class="d-flex justify-content-between">
                                <h4>Total Paid: ${{ $order->total }}</h4>
                                <div>
                                    <a href="{{ route('user-orders.show', $order->id) }}" class="btn btn-info
                                    btn-sm">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                {{ $orders->links() }}
            </div>
    </div>

@endsection
