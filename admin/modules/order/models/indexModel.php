<?php

function get_list_users()
{
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}

function get_list_order($start, $num_per_page, $where = '')
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_order` {$where} ORDER BY `time_order` DESC  LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['url_detail'] = "?mod=order&action=detail&id={$item['order_id']}";
    }
    return $result;
}

function get_fullname_customer($id)
{
    $get_name = db_fetch_row("SELECT tbl_customers.fullname FROM `tbl_order`,`tbl_customers` WHERE tbl_order.customer_id = tbl_customers.customer_id AND tbl_customers.customer_id = {$id}");
    return $get_name['fullname'];
}
function get_detail_order($id)
{
    $result = db_fetch_array("SELECT * FROM `tbl_order`,`tbl_customers` WHERE tbl_order.customer_id = tbl_customers.customer_id AND `order_id` = {$id}");
    return $result;
}

function get_id($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = {$id}");
    return $result;
}

function get_product_order($id)
{
    $order = get_list_order_by_id($id);
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

function get_order($id)
{
    $result = db_fetch_array("SELECT * FROM `tbl_order` WHERE `order_id` = {$id}");
    return $result;
}

function get_list_order_by_id($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_order` WHERE `order_id` = {$id}");
    return $result;
}
function add_note($data, $id)
{
    return db_update('tbl_order', $data, "`order_id` = {$id}");
}
function update_order($data, $id)
{
    return db_update('tbl_order', $data, "`order_id` = {$id}");
}
function delete_order($id)
{
    return db_delete('tbl_order', "`order_id`= {$id}");
}

function update_status($data, $id)
{
    return db_update('tbl_order', $data, "`order_id`={$id}");
}
function getAllOrder($key, $start, $num_per_page)
{
    $result = db_fetch_array("SELECT * FROM `tbl_order`,`tbl_customers` WHERE tbl_order.customer_id = tbl_customers.customer_id AND `order_code` LIKE '%$key%' OR `fullname` LIKE '%$key%' OR  `time_order` LIKE '%$key%' LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        // $item['url_update'] = "?mod=product&action=update&id={$item['product_id']}";
        // $item['url_delete'] = "?mod=product&action=delete&id={$item['product_id']}";
        // $item['url_post'] = "?mod=product&action=post&id={$item['product_id']}";
        // $item['url_restore'] = "?mod=product&action=restore&id={$item['product_id']}";
        $item['num_row'] = db_num_rows("SELECT * FROM `tbl_order`,`tbl_customers` WHERE tbl_order.customer_id = tbl_customers.customer_id AND `order_code` LIKE '%$key%' OR `fullname` LIKE '%$key%' OR  `time_order` LIKE '%$key%' LIMIT {$start},{$num_per_page}");
    }
    return $result;
}

function get_num_order()
{
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $result = db_fetch_row("SELECT * FROM `tbl_order` WHERE `order_id` = {$id}");
    return $result['total_item'];
}

function get_total_order()
{
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $result = db_fetch_row("SELECT * FROM `tbl_order` WHERE `order_id` = {$id}");
    return $result['total_price'];
}

function update_qty_product($data, $id)
{
    return db_update('tbl_products', $data, "`product_id` = {$id}");
}

function get_num($key)
{
    $result = db_num_rows("SELECT * FROM `tbl_order`,`tbl_customers` WHERE tbl_order.customer_id = tbl_customers.customer_id AND `order_code` LIKE '%$key%' OR `fullname` LIKE '%$key%' OR  `time_order` LIKE '%$key%'");
    return $result;
}
