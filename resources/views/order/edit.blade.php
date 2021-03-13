@extends('layouts.auth', ['title' => 'Update Order'])

@section('content')
    <div class="container p-4">
        <h1>Update Order</h1>
        <hr>
        @include('partials.messages')
        <form action="{{ route('orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <form class="form-inline">
                <label class="my-1 mr-2" >Status</label>
                <select class="custom-select my-1 mr-sm-2" name="status">
                    <option value="paid" {{ $order->status == 'paid' ? 'selected': '' }}>
                        Paid
                    </option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected': '' }}>
                        Shipped
                    </option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected': '' }}>
                        Delivered
                    </option>
                    <option value="dispute" {{ $order->status == 'dispute' ? 'selected': '' }}>
                        Dispute
                    </option>
                    <option value="refunded" {{ $order->status == 'refunded' ? 'selected': '' }}>
                        Refunded
                    </option>
                </select>

                <h3>Send to:</h3>
                <div class="form-group">
                    <label for="">Country</label>
                    <input type="text" name="country" class="form-control" placeholder="Country"
                           value="{{ old('country') ?? $order->address->country }}">
                </div>
                <div class="form-group">
                    <label for="">State</label>
                    <input type="text" name="state" class="form-control" placeholder="State"
                           value="{{ old('state') ?? $order->address->state }}">
                </div>
                <div class="form-group">
                    <label for="">City</label>
                    <input type="text" name="city" class="form-control" placeholder="City"
                           value="{{ old('city') ?? $order->address->city  }}">
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Address"
                           value="{{ old('address') ?? $order->address->address  }}">
                </div>
                <div class="form-group">
                    <label for="">Zipcode</label>
                    <input type="text" name="zipcode" class="form-control" placeholder="Zipcode"
                           value="{{ old('zipcode') ?? $order->address->zipcode }}">
                </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>

    </div>

@endsection




