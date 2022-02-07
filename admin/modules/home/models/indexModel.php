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

function get_total_order_pending()
{
    $pending = 1;
    $total = db_num_rows("SELECT * FROM `tbl_order` WHERE tbl_order.status = '{$pending}'");
    return $total;
}

function get_total_order_cancel()
{
    $cancel = 4;
    $total = db_num_rows("SELECT * FROM `tbl_order` WHERE tbl_order.status = '{$cancel}'");
    return $total;
}

function get_total_order_success()
{
    $success = 3;
    $total = db_num_rows("SELECT * FROM `tbl_order` WHERE tbl_order.status = '{$success}'");
    return $total;
}

function get_total_revenue()
{
    $success = 3;
    $renvenue = array();
    $total = db_fetch_array("SELECT tbl_order.total_price FROM `tbl_order` WHERE tbl_order.status = '{$success}'");
    foreach ($total as $price) {
        $renvenue[] = $price['total_price'];
    }
    return array_sum($renvenue);
}
