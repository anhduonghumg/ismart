<?php
function is_exists($table, $key, $value)
{
    $check = db_num_rows("SELECT * FROM `{$table}` WHERE `{$key}` = '{$value}'");
    if ($check > 0)
        return true;
    return false;
}

function addPage($data)
{
    return db_insert("tbl_pages", $data);
}

function get_list_page($start = 1, $num_per_page = 3, $where = '')
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_pages` {$where} LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['url_update'] = "?mod=page&action=update&id={$item['page_id']}";
        $item['url_delete'] = "?mod=page&action=delete&id={$item['page_id']}";
        $item['url_post'] = "?mod=page&action=post&id={$item['page_id']}";
        $item['url_restore'] = "?mod=page&action=restore&id={$item['page_id']}";
    }
    return $result;
}
function get_list_publish()
{
    $result = db_fetch_array("SELECT * FROM `tbl_pages` WHERE `status` = '2'");
    return $result;
}

function get_list_page_by_id($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_pages` WHERE `page_id` = {$id}");
    return $result;
}
function get_url_old_thumb($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_pages` WHERE `page_id` = {$id}");
    return $result['page_thumb'];
}

function update_page($data, $id)
{
    return db_update('tbl_pages', $data, "`page_id` = {$id}");
}

function delete_page($id)
{
    return db_delete('tbl_pages', "`page_id` = {$id}");
}

function getAllPage($key, $start, $num_per_page)
{
    $result = db_fetch_array("SELECT * FROM `tbl_pages` WHERE `page_id` LIKE '%$key%' OR `page_title` LIKE '%$key%' OR `creator` LIKE '%$key%' OR `create_date` LIKE '%$key%' LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['url_update'] = "?mod=page&action=update&id={$item['page_id']}";
        $item['url_delete'] = "?mod=page&action=delete&id={$item['page_id']}";
        $item['url_post'] = "?mod=page&action=post&id={$item['page_id']}";
        $item['url_restore'] = "?mod=page&action=restore&id={$item['page_id']}";
        $item['num_row'] = db_num_rows("SELECT * FROM `tbl_pages` WHERE `page_id` LIKE '%$key%' OR `page_title` LIKE '%$key%' OR `creator` LIKE '%$key%' OR `create_date` LIKE '%$key%'");
    }
    return $result;
}

function get_num_rows_search($key)
{
    $result = db_num_rows("SELECT * FROM `tbl_pages` WHERE `page_id` LIKE '%$key%' OR `page_title` LIKE '%$key%' OR `creator` LIKE '%$key%' OR `create_date` LIKE '%$key%'");
    return $result;
}


function search_item($table, $search_by, $s, $start, $num_per_page)
{
    if (!empty($s)) {
        $result = db_fetch_array("SELECT * FROM `{$table}` WHERE {$search_by} LIKE '%{$s}%' LIMIT {$start} , {$num_per_page}");
        if (!empty($result)) {
            foreach ($result as &$item) {
                $item['url_update'] = "?mod=page&action=update&id={$item['page_id']}";
                $item['url_delete'] = "?mod=page&action=delete&id={$item['page_id']}";
                $item['url_post'] = "?mod=page&action=post&id={$item['page_id']}";
                $item['url_restore'] = "?mod=page&action=restore&id={$item['page_id']}";
            }
            return $result;
        }
    }

    return false;
}
