<?php

if (!function_exists('getOrdinal')) {
    function getOrdinal($number)
    {
        $suffix = 'th';
        if ($number % 100 >= 11 && $number % 100 <= 13) {
            $suffix = 'th';
        } else {
            switch ($number % 10) {
                case 1:
                    $suffix = 'st';
                    break;
                case 2:
                    $suffix = 'nd';
                    break;
                case 3:
                    $suffix = 'rd';
                    break;
                default:
                    $suffix = 'th';
                    break;
            }
        }
        return $number . $suffix;
    }

}

?>
