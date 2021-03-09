<?php

namespace Tests\Feature;

use App\Models\Coupon;
use Tests\TestCase;

class CouponTest extends TestCase
{
    /** @test */
    public function coupon_can_be_created()
    {
        $this->admin()->post(route('coupons.store'), [
            'code' => 'ABC123',
            'type' => 'percent',
            'amount' => 5,
            'expiry_date' => today()->addDays(10)
        ]);

        $this->assertEquals(1, Coupon::all()->count());
    }

    /** @test */
    public function coupon_can_be_updated()
    {
        $this->admin()->post(route('coupons.store'), [
            'code' => 'ABC123',
            'type' => 'percent',
            'amount' => 5,
            'expiry_date' => today()->addDays(10)
        ]);

        $coupon = Coupon::find(1);

        $this->admin()->patch(route('coupons.update', $coupon->id), [
            'code' => 'ABC456',
            'type' => 'percent',
            'amount' => 5,
            'expiry_date' => today()->addDays(10)
        ]);

        $coupon = Coupon::find(1);

        $this->assertEquals('ABC456', $coupon->code);
    }

    /** @test */
    public function coupon_can_be_deleted()
    {
        $this->admin()->post(route('coupons.store'), [
            'code' => 'ABC123',
            'type' => 'percent',
            'amount' => 5,
            'expiry_date' => today()->addDays(10)
        ]);

        $coupon = Coupon::find(1);

        $this->admin()->delete(route('coupons.destroy', $coupon->id));

        $this->assertEquals(0, Coupon::all()->count());
    }
}
