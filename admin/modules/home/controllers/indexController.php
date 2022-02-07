<?php

function construct()
{
    load_model('index');
    load('helper', 'format');
    load('lib', 'pagging');
}

function indexAction()
{
    #.pagging
    $data['num_row'] = get_num_rows('tbl_order', '', '`time_order` DESC');
    $num_per_page = 10;
    $data['num_page'] = ceil($data['num_row'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $list_order = get_list_order($start, $num_per_page);
    $data['list_order'] = $list_order;
    $total_order_success = get_total_order_success();
    $data['order_success'] = $total_order_success;
    $total_order_cancel = get_total_order_cancel();
    $data['order_cancel'] = $total_order_cancel;
    $total_order_pending = get_total_order_pending();
    $data['order_pending'] = $total_order_pending;
    $total_revenue  = get_total_revenue();
    $data['renvenue'] = $total_revenue;


    load_view('index', $data);
}
