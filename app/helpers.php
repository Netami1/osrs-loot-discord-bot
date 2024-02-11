<?php

if (!function_exists('kmb')) {
    function kmb($number)
    {
        $suffix = '';
        if ($number >= 1000000000) {
            $number = $number / 1000000000;
            $suffix = 'b';
        } elseif ($number >= 1000000) {
            $number = $number / 1000000;
            $suffix = 'm';
        } elseif ($number >= 1000) {
            $number = $number / 1000;
            $suffix = 'k';
        }

        return number_format($number, 2) . $suffix;
    }
}
