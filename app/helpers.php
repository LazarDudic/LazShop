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
