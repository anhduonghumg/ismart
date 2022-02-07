<?php

function get_price($field)
{
    $list_status = array(
        '1' => "`price` < 5000000",
        '2' => "`price` >= 5000000 AND `price` <= 10000000",
        '3' => "`price` >= 10000000 AND `price` <= 20000000",
        '4' => "`price` >= 20000000 AND `price` <= 40000000",
        '5' => "`price` > 40000000"
    );
    if (array_key_exists($field, $list_status))
        return $list_status[$field];
}
function get_select($field)
{
    $list_select = array(
        '1' => "`product_name` ASC",
        '2' => "`product_name` DESC",
        '3' => "`price` DESC",
        '4' => "`price` ASC"
    );
    if (array_key_exists($field, $list_select))
        return $list_select[$field];
}

function get_title($field)
{
    $list_title = array(
        '1' => 'Điện thoại',
        '2' => 'Máy tính bảng',
        '3' => 'Laptop',
        '6' => 'Samsung',
        '7' => 'Iphone',
        '8' => "Xiaomi",
        '9' => 'Ipad',
        '10' => 'Galaxxy tab',
        '11' => 'Macbook',
        '12' => 'Surface'
    );
    if (array_key_exists($field, $list_title))
        return $list_title[$field];
}
function show($field)
{
    $num_per_page = 20;
    if ($field != NULL)
        return $field;
    return $num_per_page;
}
function url_filter($show, $price, $brand)
{
    if ($price != NULL) {
        return "?mod=product&action=filter&r-price={$price}&btn-submit=submit";
    } elseif ($brand != NULL) {
        return "?mod=product&action=filter&r-brand={$brand}&btn-submit=submit";
    } elseif ($show != NUll) {
        return "?mod=product&action=filter&show={$show}&btn-submit=submit";
    }
}

function PriceBrand($price, $brand)
{
    if ($price != NULL) {
        $prices = get_price($price);
        return "{$prices}";
    } elseif ($brand != NULL) {
        return "`brand_id`={$brand}";
    }
}

function PriceBrand2($price, $brand)
{
    if ($price != NULL) {
        $prices = get_price($price);
        return "AND {$prices}";
    } elseif ($brand != NULL) {
        return "AND `brand_id`={$brand}";
    }
}


function inventory_status($field)
{
    $list_status = array(
        '1' => 'Còn hàng',
        '2' => 'Hết hàng',
        '3' => 'Chờ hàng'
    );
    if (array_key_exists($field, $list_status))
        return $list_status[$field];
}

function status_order($field)
{
    $list_status = array(
        '1' => 'Chờ duyệt',
        '2' => 'Đang vận chuyển',
        '3' => 'Thành công',
        '4' => 'Hủy đơn',
        '5' => 'Thùng rác'
    );
    if (array_key_exists($field, $list_status))
        return $list_status[$field];
}
