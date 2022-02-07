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
        $item['checkout'] = "?mod=cart&action=checkout";
        $item['add_cart'] = "?mod=cart&action=add_cart&id={$item['product_id']}";
    }
    return $result;
}

function get_list_blog($start, $num_per_page, $where = '', $order_by = '')
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    if (!empty($order_by)) {
        $order_by = "ORDER BY {$order_by}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_pages`{$where} {$order_by} LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['page_detail'] = "?mod=page&action=detail&id={$item['page_id']}";
        $item['thumbnail'] = "admin/{$item['page_thumb']}";
        $item['friendly_detail'] = "{$item['slug']}-{$item['page_id']}.html";
    }
    return $result;
}

function get_page_detail($id)
{
    $result = db_fetch_array("SELECT * FROM `tbl_pages` WHERE `page_id`={$id}");
    return $result;
}
