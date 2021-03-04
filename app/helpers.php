<?php

if (! function_exists('imagePath')) {
    function imagePath($imagePath)
    {
        if (is_null($imagePath)) {
            return asset('storage/no_image.png');
        }

        return asset('storage/'. $imagePath);
    }
}

if (! function_exists('shipping')) {
    function shipping($productPrice)
    {
        return $productPrice * (env('SHIPPING') / 100);
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

