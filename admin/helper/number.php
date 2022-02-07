<?php


function get_num_rows($table, $where = '', $order_by = '')
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    if (!empty($order_by)) {
        $order_by = "ORDER BY {$order_by}";
    }
    $result = db_num_rows("SELECT * FROM `{$table}` {$where} {$order_by}");
    return $result;
}


function get_num_post($table, $where = '')
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_num_rows("SELECT * FROM `{$table}` {$where}");
    return $result;
}

function get_num_waiting($table, $where = '')
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    return db_num_rows("SELECT * FROM `{$table}` {$where}");
}

function get_num_trash($table, $where = '')
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    return db_num_rows("SELECT * FROM `{$table}` {$where}");
}
