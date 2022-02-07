<?php

function get_list_category($where = "")
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat` {$where}");
    foreach ($result as &$item) {
        $item['url_name_product'] = "?mod=product&cat_id={$item['product_cat_id']}";
    }
    return $result;
}
function get_list_brand($where = "")
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_brand` {$where}");
    return $result;
}

function get_list_thumb($id)
{
    $result = db_fetch_array("SELECT * FROM `tbl_thumb` WHERE `product_id`={$id}");
    foreach ($result as &$item) {
        $item['thumbnail'] = "admin/{$item['url_thumb']}";
    }
    return $result;
}
function get_list_product($order_by = '')
{
    if (!empty($order_by)) {
        $order_by = "ORDER BY {$order_by}";
    }
    $result = db_fetch_array("SELECT * from `tbl_products` {$order_by}");
    foreach ($result as &$item) {
        $item['thumbnail'] = "admin/{$item['product_thumb']}";
        $item['url_detail_product'] = "?mod=product&action=detail&id={$item['product_id']}";
        $item['checkout'] = "?mod=cart&action=checkout&id={$item['product_id']}";
        $item['add_cart'] = "?mod=cart&action=add_cart&id={$item['product_id']}";
        $item['buy_now'] = "?mod=order&action=buy_now&id={$item['product_id']}";
    }
    return $result;
}
function get_list_product_best_sell($where = "")
{
    $start = 8;
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_products` {$where} LIMIT {$start}");
    foreach ($result as &$item) {
        $item['thumbnail'] = "admin/{$item['product_thumb']}";
        $item['product_detail'] = "?mod=product&action=detail&id={$item['product_id']}";
        $item['checkout'] = "?mod=cart&action=checkout&id={$item['product_id']}";
        $item['add_cart'] = "?mod=cart&action=add_cart&id={$item['product_id']}";
        $item['buy_now'] = "?mod=order&action=buy_now&id={$item['product_id']}";
        $item['friendly_detail'] = "{$item['slug']}/{$item['product_id']}.html";
        $item['friendly_add_cart'] = "them-vao-gio/{$item['product_id']}.html";
        $item['friendly_buy_now'] = "mua-ngay/{$item['product_id']}.html";
    }
    return $result;
}
function get_list_product_by_id($id)
{
    $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_id` = {$id}");
    foreach ($result as &$item) {
        $item['thumbnail'] = "admin/{$item['product_thumb']}";
        $item['add_cart'] = "?mod=cart&action=add_cart&id={$item['product_id']}";
        $item['url_product'] = "?mod=product&action=detail&id={$id}";
        $item['url_cat_product'] = "?mod=product&controller=category&cat_id={$item['product_cat_id']}";
        $item['buy_now'] = "?mod=order&action=buy_now&id={$item['product_id']}";
        $item['friendly_add_cart'] = "them-vao-gio/{$item['product_id']}.html";
    }
    return $result;
}
function get_product_by_id($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = {$id}");
    return $result;
}

function get_list_product_similar($id)
{
    $product = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = {$id}");
    $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_cat_id`={$product['product_cat_id']} AND `brand_id`={$product['brand_id']} AND NOT `product_id`={$id}");
    foreach ($result as &$item) {
        $item['thumbnail'] = "admin/{$item['product_thumb']}";
        $item['add_cart'] = "?mod=cart&action=add_cart&id={$item['product_id']}";
        $item['url_product'] = "?mod=product&action=detail&id={$item['product_id']}";
        $item['url_cat_product'] = "?mod=product&controller=category&cat_id={$item['product_cat_id']}";
        $item['checkout'] = "?mod=cart&action=checkout&id={$item['product_id']}";
        $item['friendly_detail'] = "{$item['slug']}/{$item['product_id']}.html";
        $item['friendly_add_cart'] = "them-vao-gio/{$item['product_id']}.html";
        $item['friendly_buy_now'] = "mua-ngay/{$item['product_id']}.html";
    }
    return $result;
}

function get_search_filter($query)
{
    $result = db_fetch_array($query);
    foreach ($result as &$item) {
        $item['thumbnail'] = "admin/{$item['product_thumb']}";
        $item['buy_now'] = "?mod=order&action=buy_now&id={$item['product_id']}";
        $item['add_cart'] = "?mod=cart&action=add_cart&id={$item['product_id']}";
        $item['url_product_detail'] = "?mod=product&action=detail&id={$item['product_id']}";
        $item['friendly_detail'] = "{$item['slug']}/{$item['product_id']}.html";
        $item['friendly_add_cart'] = "them-vao-gio/{$item['product_id']}.html";
        $item['friendly_buy_now'] = "mua-ngay/{$item['product_id']}.html";
    }
    return $result;
}

function get_cat_by_id($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = {$id}");
    return $result['product_cat_id'];
}

function get_list_product_by_select($start, $num_per_page, $order_by)
{
    if (!empty($order_by)) {
        $order_by = "ORDER BY {$order_by}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_products` {$order_by} LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['thumbnail'] = "admin/{$item['product_thumb']}";
        $item['url_detail_product'] = "?mod=product&action=detail&id={$item['product_id']}";
        $item['checkout'] = "?mod=cart&action=checkout&id={$item['product_id']}";
        $item['add_cart'] = "?mod=cat&action=add_cart&id={$item['product_id']}";
        $item['buy_now'] = "?mod=order&action=buy_now&id={$item['product_id']}";
    }
    return $result;
}

function get_list_all_product($start, $num_per_page, $where = '', $order_by = '')
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    if (!empty($order_by)) {
        $order_by = "ORDER BY {$order_by}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_products` {$where} {$order_by} LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['thumbnail'] = "admin/{$item['product_thumb']}";
        $item['url_detail_product'] = "?mod=product&action=detail&id={$item['product_id']}";
        $item['checkout'] = "?mod=cart&action=checkout&id={$item['product_id']}";
        $item['add_cart'] = "?mod=cart&action=add_cart&id={$item['product_id']}";
        $item['buy_now'] = "?mod=order&action=buy_now&id={$item['product_id']}";
        $item['friendly_detail'] = "{$item['slug']}/{$item['product_id']}.html";
        $item['friendly_add_cart'] = "them-vao-gio/{$item['product_id']}.html";
        $item['friendly_buy_now'] = "mua-ngay/{$item['product_id']}.html";
    }
    return $result;
}
function get_list_product_by_category($start, $num_per_page, $where = '', $order_by = '')
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    if (!empty($order_by)) {
        $order_by = "ORDER BY {$order_by}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_products`,`tbl_product_cat` {$where} {$order_by} LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['thumbnail'] = "admin/{$item['product_thumb']}";
        $item['url_detail_product'] = "?mod=product&action=detail&id={$item['product_id']}";
        $item['checkout'] = "?mod=cart&action=checkout&id={$item['product_id']}";
        $item['add_cart'] = "?mod=cart&action=add_cart&id={$item['product_id']}";
        $item['buy_now'] = "?mod=order&action=buy_now&id={$item['product_id']}";
    }
    return $result;
}
function num_row_product($table = "", $where = "", $order_by = "")
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    if (!empty($order_by)) {
        $order_by = "ORDER BY {$order_by}";
    }
    $result = db_num_rows("SELECT * FROM {$table} {$where} {$order_by}");
    return $result;
}
function get_num_row_product($id, $order_by = "")
{
    if (!empty($order_by)) {
        $order_by = "ORDER BY {$order_by}";
    }
    $result = db_num_rows("SELECT * FROM `tbl_products`,`tbl_product_cat` WHERE tbl_products.product_cat_id=tbl_product_cat.product_cat_id AND tbl_product_cat.parent_id={$id} {$order_by}");
    return $result;
}

function is_category_product($field)
{
    $phone = 1;
    $tablet = 2;
    $laptop = 3;
    if ($field == $phone || $field == $tablet || $field == $laptop)
        return true;
    return false;
}
