<?php

function get_list_customers($start, $num_per_page, $where = '')
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_customers` {$where} ORDER BY `total_spend` DESC  LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['delete'] = "?mod=customer&action=delete&id={$item['customer_id']}";
    }
    return $result;
}

function  delete_customer($id)
{
    return db_delete('tbl_customers', "`customer_id`={$id}");
}

function get_all_customer($key, $start, $num_per_page)
{
    $result = db_fetch_array("SELECT * FROM `tbl_customers` WHERE  `fullname` LIKE '%$key%' OR  `email` LIKE '%$key%' OR `address` LIKE '%$key%' LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['num_row'] = db_num_rows("SELECT * FROM `tbl_customers` WHERE  `fullname` LIKE '%$key%' OR  `email` LIKE '%$key%' OR `address` LIKE '%$key%' LIMIT {$start},{$num_per_page}");
    }
    return $result;
}
