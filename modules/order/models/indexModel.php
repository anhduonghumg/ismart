<?php

function get_order_customer($order_code)
{
    $result = db_fetch_array("SELECT * FROM `tbl_order`,`tbl_customers` WHERE tbl_order.customer_id = tbl_customers.customer_id AND tbl_order.order_code = '{$order_code}'");
    return $result;
}

function check_order_code($field)
{
    $check = db_fetch_array("SELECT * FROM `tbl_order`");
    foreach ($check as &$item) {
        if ($field == $item['order_code'])
            return true;
    }
    return false;
}

function get_id($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = {$id}");
    return $result;
}
function get_order_by_order_code($order_code)
{
    $result = db_fetch_row("SELECT * FROM `tbl_order` WHERE `order_code` = '{$order_code}'");
    return $result;
}

function get_product_order($order_code)
{
    $order = get_order_by_order_code($order_code);
    $product = json_decode($order['product']);
    foreach ($product as &$item) {
        $product_order[] = (array)$item;
    }
    foreach ($product_order as $item) {
        $product_id = $item['id'];
        $product_tmp = get_id($product_id);
        $product_tmp['qty'] = $item['qty'];
        $product_tmp['sub_total'] = $product_tmp['qty'] * $product_tmp['price'];
        $list_product_order[] = $product_tmp;
    }
    return $list_product_order;
}

function get_product_by_id($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = {$id}");
    return $result;
}

function get_num_order($order_code)
{
    $result = db_fetch_row("SELECT * FROM `tbl_order` WHERE `order_code` = '{$order_code}'");
    return $result['total_item'];
}

function get_total_order($order_code)
{
    $result = db_fetch_row("SELECT * FROM `tbl_order` WHERE `order_code` = '{$order_code}'");
    return $result['total_price'];
}
