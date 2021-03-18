<?php

namespace App\Http\Controllers;

use App\Http\Requests\Coupon\CreateCouponRequest;
use App\Http\Requests\Coupon\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Support\Facades\Gate;

class CouponController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('coupon_access'), 403);

        $coupons = Coupon::paginate(15);

        return view('coupon.index', compact('coupons'));
    }

    public function create()
    {
        abort_if(Gate::denies('coupon_create'), 403);

        return view('coupon.create');
    }

    public function store(CreateCouponRequest $request)
    {
        abort_if(Gate::denies('coupon_create'), 403);

        Coupon::create($request->validated());

        return redirect(route('coupons.index'))->withSuccess('Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        abort_if(Gate::denies('coupon_edit'), 403);

        return view('coupon.create', compact('coupon'));
    }

    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        abort_if(Gate::denies('coupon_edit'), 403);

        $coupon->update($request->validated());

        return redirect(route('coupons.index'))->withSuccess('Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        abort_if(Gate::denies('coupon_delete'), 403);

        $coupon->delete();

        return redirect(route('coupons.index'))->withSuccess('Coupon deleted successfully.');
    }
}
