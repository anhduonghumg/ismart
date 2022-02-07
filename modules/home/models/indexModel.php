<?php
function data_tree($data, $parent_id = 0, $level = 0)
{
    $result = array();
    foreach ($data as $item) {
        if ($item['parent_id'] == $parent_id) {
            $item['level'] = $level;
            $result[] = $item;
            unset($data[$item['product_cat_id']]);
            $child = data_tree($data, $item['product_cat_id'], $level + 1);
            $result = array_merge($result, $child);
        }
    }
    return $result;
}

function get_list_product_laptop($where = "")
{
    $start = 8;
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_products`,`tbl_product_cat` {$where} LIMIT {$start}");
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
function get_list_product_phone($where = "")
{
    $start = 8;
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_products`,`tbl_product_cat` {$where} LIMIT {$start}");
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
function get_list_product_tablet($where = "")
{
    $start = 8;
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_products`,`tbl_product_cat` {$where} LIMIT {$start}");
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
function get_list_product($where = "")
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

function get_list_category($where = "")
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat` {$where}");
    foreach ($result as &$item) {
        $item['url_name_product'] = "?mod=product&id={$item['product_cat_id']}";
    }
    return $result;
}
