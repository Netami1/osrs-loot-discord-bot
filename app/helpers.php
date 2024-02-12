<?php

if (!function_exists('kmb')) {
    function kmb($number)
    {
        if ($number < 10000) {
            return $number;
        }

        if ($number >= 1000000000) {
            $number = $number / 1000000000;
            $suffix = 'b';
        } elseif ($number >= 1000000) {
            $number = $number / 1000000;
            $suffix = 'm';
        } else {
            $number = $number / 1000;
            $suffix = 'k';
        }

        return number_format($number, 2) . $suffix;
    }
}

if (!function_exists('kmbToInt')) {
    function kmbToInt($numberString)
    {
        $multiplier = 1;

        if (str_contains($numberString, 'k')) {
            $multiplier = 1000;
        }

        if (str_contains($numberString, 'm')) {
            $multiplier = 1000000;
        }

        if (str_contains($numberString, 'b')) {
            $multiplier = 1000000000;
        }

        $cleanedNumber = preg_replace('/[^0-9.]/', '', $numberString);

        // Convert the string to a float and multiply by the multiplier
        $convertedNumber = floatval($cleanedNumber) * $multiplier;

        // Round to the nearest integer
        return round($convertedNumber);
    }
}
