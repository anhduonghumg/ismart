<?php
function currency_format($number, $suffix = 'đ')
{
    return number_format($number) . $suffix;
}

function get_date($timestamp)
{
    if (!empty($timestamp)) {
        $format = "%d/%m/%y";
        return strftime($format, $timestamp);
    }
}
