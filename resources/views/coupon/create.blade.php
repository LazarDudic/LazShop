@extends('layouts.auth', ['title' => 'Coupon'])

@section('content')
    <div class="container p-4">
        <h1>{{ isset($coupon) ? 'Update Coupon' : 'Create Coupon'}}</h1>
        <hr>
        @include('partials.messages')
        <form action="{{ isset($coupon)
                                      ? route('coupons.update', $coupon->id)
                                      : route('coupons.store') }}"
              method="POST"
        >
            @if(isset($coupon))
                @method('PATCH')
            @endif
            @csrf
            <div class="form-group">
                <label for="">Code</label>
                <input type="text" name="code" class="form-control" placeholder="Code"
                       value="{{ old('code') ?? $coupon->code ?? '' }}">
            </div>
            <div class="form-group">
                <label for="">Type</label>
                <select class="form-control" name="type">
                    <option value="fixed">Fixed</option>
                    <option value="percent">Percent</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Amount <span class="text-secondary small">(currency or percentage)</span></label>
                <input type="number" name="amount" class="form-control" min="1"
                       value="{{ old('amount') ?? $coupon->amount ?? '' }}">
            </div>
            <div class="form-group">
                <label for="">Expiry Date</label>
                <input type="date" name="expiry_date" class="form-control"
                       value="{{ old('expiry_date') ?? $coupon->expiry_date ?? '' }}">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

@endsection
