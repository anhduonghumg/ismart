<?php
/*============================CATAGORY============================*/

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

function exist_cat($slug, $title)
{
    $check = db_num_rows("SELECT * FROM `tbl_product_cat` WHERE `slug` = '{$slug}' OR `product_cat_name` = '{$title}'");
    if ($check > 0)
        return true;
    return false;
}

function get_list_cat()
{
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat`");
    return $result;
}
function get_brand()
{
    $result = db_fetch_array("SELECT * FROM `tbl_brand`");
    return $result;
}

function get_list_product_cat($start, $num_per_page, $where = '')
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat` {$where} LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['url_update'] = "?mod=product&controller=cat&action=update_cat&id={$item['product_cat_id']}";
        $item['url_delete'] = "?mod=product&controller=cat&action=delete_cat&id={$item['product_cat_id']}";
    }
    return $result;
}
function get_list_product_by_code($code)
{
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_code` = '{$code}'");
    return $result;
}
function get_list_product_cat_by_id($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_product_cat` WHERE `product_cat_id` = {$id}");
    return $result;
}

function add_thumb($data)
{
    return db_insert('tbl_thumb', $data);
}
function add_product_cat($data)
{
    return db_insert('tbl_product_cat', $data);
}

function update_post_cat($data, $id)
{
    return db_update('tbl_product_cat', $data, "`product_cat_id` = {$id}");
}

function delete_cat($id)
{
    return db_delete('tbl_product_cat', "`product_cat_id` = {$id}");
}
/*============================END-CATAGORY============================*/

/*============================LIST-PRODUCT================================*/
function show_cat_product($field)
{
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat`");
    foreach ($result as $item) {
        if ($field == $item['product_cat_id'])
            return get_name_category($item['parent_id']);
    }
}

function get_list_product($start, $num_per_page, $where = '')
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_products` {$where} LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['url_update'] = "?mod=product&action=update_product&id={$item['product_id']}";
        $item['url_delete'] = "?mod=product&action=delete_product&id={$item['product_id']}";
    }
    return $result;
}

function getAllProduct($key, $start, $num_per_page)
{

    $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_id` LIKE '%$key%' OR `product_name` LIKE '%$key%' OR `product_code` LIKE '%$key%' OR  `creator` LIKE '%$key%' OR `create_date` LIKE '%$key%' LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['url_update'] = "?mod=product&action=update&id={$item['product_id']}";
        $item['url_delete'] = "?mod=product&action=delete&id={$item['product_id']}";
        $item['url_post'] = "?mod=product&action=post&id={$item['product_id']}";
        $item['url_restore'] = "?mod=product&action=restore&id={$item['product_id']}";
        $item['num_row'] = db_num_rows("SELECT * FROM `tbl_products` WHERE `product_id` LIKE '%$key%' OR `product_name` LIKE '%$key%' OR `product_code` LIKE '%$key%' OR  `creator` LIKE '%$key%' OR `create_date` LIKE '%$key%'");
    }
    return $result;
}

function get_list_product_by_id($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = {$id}");
    return $result;
}
function get_list_thumb_by_id($id)
{
    $result = db_fetch_array("SELECT * FROM `tbl_thumb` WHERE `product_id` = {$id}");
    return $result;
}

function get_url_old_thumb($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = {$id}");
    return $result['product_thumb'];
}

function get_checked($id, $field = '')
{
    $check = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_id` = {$id}");
    foreach ($check as &$item) {
        if ($item[$field] == '1') {
            return "checked = 'checked'";
        }
    }
}

function update_product($data, $id)
{
    return db_update('tbl_products', $data, "`product_id` = {$id}");
}

function delete_product($id)
{
    return db_delete('tbl_products', "`product_id` = {$id}");
}
function delete_thumb($id)
{
    return db_delete('tbl_thumb', "`product_id` = {$id}");
}

function get_list_laptop()
{
    $result = db_fetch_array("SELECT * FROM `tbl_products`,`tbl_product_cat` WHERE tbl_products.product_cat_id=tbl_product_cat.product_cat_id AND tbl_product_cat.parent_id = '3'");
    return $result;
}
function get_list_phone()
{
    $result = db_fetch_array("SELECT * FROM `tbl_products`,`tbl_product_cat` WHERE tbl_products.product_cat_id=tbl_product_cat.product_cat_id AND tbl_product_cat.parent_id = '1'");
    return $result;
}
function get_list_tablet()
{
    $result = db_fetch_array("SELECT * FROM `tbl_products`,`tbl_product_cat` WHERE tbl_products.product_cat_id=tbl_product_cat.product_cat_id AND tbl_product_cat.parent_id = '2'");
    return $result;
}
/*============================END-LIST-PRODUCT============================*/

/*============================ADD-PRODUCT============================*/
function is_exists($table, $key, $value)
{
    $check = db_num_rows("SELECT * FROM `{$table}` WHERE `{$key}` = '{$value}'");
    if ($check > 0)
        return true;
    return false;
}
function add_product($data)
{
    return db_insert('tbl_products', $data);
}
/*============================END-ADD-PRODUCT============================*/

/*============================List-Brand============================*/
function get_list_brand($start, $num_per_page, $where = "", $order_by = "")
{

    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    if (!empty($order_by)) {
        $order_by = "ORDER BY {$order_by}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_brand` {$where} {$order_by} LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['url_update'] = "?mod=product&controller=brand&action=update_brand&id={$item['brand_id']}";
        $item['url_delete'] = "?mod=product&controller=brand&action=delete_brand&id={$item['brand_id']}";
    }
    return $result;
}

function brand_exists($field)
{
    $check = db_num_rows("SELECT * FROM `tbl_brand` WHERE `name`= '{$field}'");
    if ($check > 0)
        return true;
    return false;
}

function add_brand($data)
{
    return db_insert('tbl_brand', $data);
}

function update_brand($data, $id)
{
    return db_update('tbl_brand', $data, "`brand_id`={$id}");
}
function delete_brand($id)
{
    return db_delete('tbl_brand', "`brand_id`={$id}");
}
/*============================END-List-Brand============================*/
