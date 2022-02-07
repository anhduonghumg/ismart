<?php

function status($field)
{
    $list_status = array(
        '1' => 'Chờ duyệt',
        '2' => 'Đã đăng',
        '3' => 'Thùng rác'
    );
    if (array_key_exists($field, $list_status))
        return $list_status[$field];
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

function get_name_category($field)
{
    $list_status = array(
        '1' => 'Điện thoại',
        '2' => 'Máy tính bảng',
        '2' => 'Laptop'
    );
    if (array_key_exists($field, $list_status))
        return $list_status[$field];
}
