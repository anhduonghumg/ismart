<?php

function get_list_post_by_id($id)
{
    $list = db_fetch_row("SELECT * FROM `tbl_posts` WHERE `post_id` = {$id}");
    return $list;
}

function is_exists($table, $key, $value)
{
    $check = db_num_rows("SELECT * FROM `{$table}` WHERE `{$key}` = '{$value}'");
    if ($check > 0)
        return true;
    return false;
}

function getAllPost($key, $start, $num_per_page)
{
    $result = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `post_id` LIKE '%$key%' OR `post_title` LIKE '%$key%' OR `creator` LIKE '%$key%' OR `create_date` LIKE '%$key%' LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['url_update'] = "?mod=post&action=update&id={$item['post_id']}";
        $item['url_delete'] = "?mod=post&action=delete&id={$item['post_id']}";
        $item['url_post'] = "?mod=post&action=post&id={$item['post_id']}";
        $item['url_restore'] = "?mod=post&action=restore&id={$item['post_id']}";
        $item['num_row'] = db_num_rows("SELECT * FROM `tbl_posts` WHERE `post_id` LIKE '%$key%' OR `post_title` LIKE '%$key%' OR `creator` LIKE '%$key%' OR `create_date` LIKE '%$key%'");
    }
    return $result;
}

function get_list_cat()
{
    $result = db_fetch_array("SELECT * FROM `tbl_post_cat`");
    return $result;
}

function add_post_cat($data)
{
    return db_insert('tbl_post_cat', $data);
}

function update_post_cat($data, $id)
{
    return db_update('tbl_post_cat', $data, "`post_cat_id` = {$id}");
}

function update_post($data, $id)
{
    return db_update('tbl_posts', $data, "`post_id` = {$id}");
}

function delete_cat($id)
{
    return db_delete('tbl_post_cat', "`post_cat_id` = {$id}");
}
function delete_post($id)
{
    return db_delete('tbl_posts', "`post_id` = {$id}");
}

function data_tree($data, $parent_id = 0, $level = 0)
{
    $result = array();
    foreach ($data as $item) {
        if ($item['parent_id'] == $parent_id) {
            $item['level'] = $level;
            $result[] = $item;
            unset($data[$item['post_cat_id']]);
            $child = data_tree($data, $item['post_cat_id'], $level + 1);
            $result = array_merge($result, $child);
        }
    }
    return $result;
}

function exist_cat($slug, $title)
{
    $check = db_num_rows("SELECT * FROM `tbl_post_cat` WHERE `slug` = '{$slug}' OR `post_cat_title` = '{$title}'");
    if ($check > 0)
        return true;
    return false;
}

function get_list_post_cat($start, $num_per_page, $where = '')
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_post_cat` {$where} LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['url_update'] = "?mod=post&controller=cat&action=update&id={$item['post_cat_id']}";
        $item['url_delete'] = "?mod=post&controller=cat&action=delete&id={$item['post_cat_id']}";
    }
    return $result;
}

function get_list_post_cat_by_id($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_post_cat` WHERE `post_cat_id` = {$id}");
    return $result;
}

function addPost($data)
{
    return db_insert("tbl_posts", $data);
}

function get_list_post($start, $num_per_page, $where = '')
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_posts` {$where} LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['url_update'] = "?mod=post&action=update&id={$item['post_id']}";
        $item['url_delete'] = "?mod=post&action=delete&id={$item['post_id']}";
        // $item['url_post'] = "?mod=post&action=post&id={$item['page_id']}";
        // $item['url_restore'] = "?mod=page&action=restore&id={$item['page_id']}";
    }
    return $result;
}

function show_cat_post($field)
{
    $result = db_fetch_array("SELECT * FROM `tbl_post_cat`");
    foreach ($result as $item) {
        if ($field == $item['post_cat_id'])
            return $item['post_cat_title'];
    }
}

function get_url_old_thumb($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_posts` WHERE `post_id` = {$id}");
    return $result['post_thumb'];
}
