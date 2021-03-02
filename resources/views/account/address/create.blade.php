@extends('layouts.auth', ['title' => 'Address'])

@section('content')
    <div class="container p-4">
        <h1>{{ isset($userAddress) ? 'Edit Address' : 'Create Address'}}</h1>
        <hr>
        @include('partials.messages')
        <form action="{{ isset($userAddress)
                                            ? route('address.update', $userAddress->id)
                                            : route('address.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @if(isset($userAddress))
                @method('PATCH')
            @endif
            @csrf

            <div class="form-group">
                <label for="">Country</label>
                <input type="text" name="country" class="form-control" placeholder="Country"
                       value="{{ old('country') ?? $userAddress->country ?? '' }}">
            </div>
            <div class="form-group">
                <label for="">State</label>
                <input type="text" name="state" class="form-control" placeholder="State"
                       value="{{ old('state') ?? $userAddress->state ?? '' }}">
            </div>
            <div class="form-group">
                <label for="">City</label>
                <input type="text" name="city" class="form-control" placeholder="City"
                       value="{{ old('city') ?? $userAddress->city ?? '' }}">
            </div>
            <div class="form-group">
                <label for="">Address</label>
                <input type="text" name="address" class="form-control" placeholder="Address"
                       value="{{ old('address') ?? $userAddress->address ?? '' }}">
            </div>
            <div class="form-group">
                <label for="">Zipcode</label>
                <input type="text" name="zipcode" class="form-control" placeholder="Zipcode"
                       value="{{ old('zipcode') ?? $userAddress->zipcode ?? '' }}">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <hr>

    </div>

@endsection




