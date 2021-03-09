<?php

namespace App\Http\Controllers;

use App\Http\Requests\Coupon\CreateCouponRequest;
use App\Http\Requests\Coupon\UpdateCouponRequest;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();

        return view('coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('coupon.create');
    }

    public function store(CreateCouponRequest $request)
    {
        Coupon::create($request->validated());

        return redirect(route('coupons.index'))->withSuccess('Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        return view('coupon.create', compact('coupon'));
    }

    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->validated());

        return redirect(route('coupons.index'))->withSuccess('Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect(route('coupons.index'))->withSuccess('Coupon deleted successfully.');
    }
}
