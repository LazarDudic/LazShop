@extends('layouts.auth', ['title' => 'Order'])

@section('content')
    <div class="container p-4">
        <h1>Order</h1>
        <hr>
        <div class="card">
            <div class="card-header">
                <h1></h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Order ID</th>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th>Transaction ID</th>
                            <td>{{ $order->transaction_id }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td class="text-capitalize">{{ $order->status }}</td>
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <td>${{ $order->total }}</td>
                        </tr>
                        <tr>
                            <th>Customer</th>
                            <td>{{ $order->user->fullName() }}</td>
                        </tr>
                        <tr>
                            <th><h5 class="text-secondary">Ordered Items:</h5></th>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <th>Name</th>
                            <th>Product Id</th>
                        </tr>
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->quantity }}</td>
                                <td><a href="{{ route('products.show',$item->product_id ) }}">{{ $item->product_name
                                }}</a></td>
                                <th>{{ $item->product_id }}</th>

                            </tr>
                        @endforeach
                        <tr>
                            <th><h5 class="text-secondary">Send to:</h5></th>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td>{{ $order->address->country }}</td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td>{{ $order->address->state }}</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>{{ $order->address->city }}</td>
                        </tr>
                        <tr>
                            <th>Zipcode</th>
                            <td>{{ $order->address->zipcode }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $order->address->address }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <hr>

    </div>

@endsection




