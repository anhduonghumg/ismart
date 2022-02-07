<?php

function get_product_by_id($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = {$id}");
    return $result;
}
function get_list_buy_cart()
{
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart']['buy'] as &$item) {
            $item['url_delete_cart'] = "?mod=cart&action=delete&id={$item['id']}";
        }
        return $_SESSION['cart']['buy'];
    }
    return false;
}
function customer_exits($fullname, $email, $phone)
{
    $check_user = db_num_rows("SELECT * FROM `tbl_customers` WHERE `email` = '{$email}' AND `fullname` = '{$fullname}' AND `phone`={$phone}");
    if ($check_user > 0)
        return true;
    return false;
}
function get_customer($fullname, $email, $phone)
{
    $result = db_fetch_row("SELECT * FROM `tbl_customers` WHERE `email` = '{$email}' AND `fullname` = '{$fullname}' AND `phone`={$phone}");
    return $result;
}

function add_customer($data)
{
    return db_insert('tbl_customers', $data);
}
function add_order($data)
{
    return db_insert('tbl_order', $data);
}
function update_customer($id, $data)
{
    return db_update('tbl_customers', $data, "`customer_id`={$id}");
}
function update_num_product($id, $data)
{
    return db_update('tbl_products', $data, "`product_id`={$id}");
}
// function customer_exits($email)
// {
//     $check = db_num_rows("SELECT * FROM `tbl_customers` WHERE `email` = '{$email}'");
//     // echo $check_user;
//     if ($check > 0)
//         return true;
//     return false;
// }
// function add_customer($order, $email)
// {
//     if (!customer_exits())
//         return db_insert('tbl_customers', $order);
// }
// function get_info_cart()
// {
//     if (!empty($_SESSION['cart']['buy'])) {
//         foreach ($_SESSION['cart']['buy'] as &$item) {
//             return $item;
//         }
//     }
// }
// function get_info_order()
// {

//     if (isset($_SESSION['cart'])) {
//         if (!empty($_SESSION['cart']['buy'])) {
//             foreach ($_SESSION['cart']['buy'] as &$item) {
//                 return $item;
//             }
//         }
//     }
// }
