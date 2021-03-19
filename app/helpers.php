<?php

use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;

if (! function_exists('imagePath')) {
    function imagePath($imagePath)
    {
        if (is_null($imagePath)) {
            return asset('storage/no_image.png');
        }

        return asset('storage/' . $imagePath);
    }
}

if (! function_exists('shipping')) {
    function shipping($productPrice)
    {
        return $productPrice * (config('app.shipping') / 100);
    }
}

if (! function_exists('priceFormat')) {
    function priceFormat($price, $decimals = 2)
    {
        if (! is_numeric($price)) {
            $price = str_replace(',', '', $price);
        }

        return number_format($price, $decimals, '.', '');
    }
}

if (! function_exists('cartNumbers')) {
    function cartNumbers()
    {
        $subtotal = Cart::subtotal();
        $discount = 0;

        if (session()->has('coupon')) {
            $coupon = Coupon::where('code', session()->get('coupon'))->first();
            $discount = priceFormat($coupon->discount());
            $subtotal = priceFormat($subtotal - $discount);
        }

        $shipping = priceFormat(shipping($subtotal));
        $tax = priceFormat($subtotal * (config('cart.tax') / 100));
        $total = priceFormat($subtotal + $shipping + $tax);


        return collect([
            'tax'      => $tax,
            'shipping' => $shipping,
            'discount' => $discount,
            'subtotal' => $subtotal,
            'total'    => $total,
        ]);
    }

    if (! function_exists('orderStatusColor')) {
        function orderStatusColor($orderStatus)
        {
            switch ($orderStatus) {
                case 'paid':
                    return 'info';
                case 'shipped':
                    return 'primary';
                case 'delivered':
                    return 'success';
                case 'refunded':
                    return 'secondary';
                case 'dispute':
                    return 'danger';
            }

            return 'secondary';
        }
    }

    if (! function_exists('ratingStars')) {
        function ratingStars($rating)
        {
            $rating = round($rating, 0, PHP_ROUND_HALF_EVEN);

            for ($i = 1; $i <= 5; $i++) {
                if ($rating >= $i) {
                    echo '<i class="fas fa-star"></i>';
                } else {
                    echo '<i class="far fa-star"></i>';
                }
            }
        }
    }

}
