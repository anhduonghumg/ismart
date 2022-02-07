<?php

function construct()
{
  load_model('index');
  load('helper', 'format');
  load('helper', 'string');
  load('lib', 'validation');
}

function checkAction()
{
  global $error;
  if (isset($_POST['btn-check'])) {
    $error = array();
    if (empty($_POST['s'])) {
      $error['s'] = "Bạn chưa nhập mã đơn hàng.";
    } else {
      if (!check_order_code($_POST['s'])) {
        $error['s'] = "Mã đơn hàng không tồn tại.Vui lòng nhập lại!";
      } else {
        $s = $_POST['s'];
      }
    }

    if (empty($error)) {
      $_SESSION['order_code'] = $s;
      redirect("thongtindonhang.html");
    }
  }

  load_view('index');
}

function buy_nowAction()
{
  $id = isset($_GET['id']) ? $_GET['id'] : null;
  add_cart($id);
  redirect("thanhtoan.html");
}
function resultAction()
{
  if (isset($_SESSION['order_code'])) {
    $order_code = $_SESSION['order_code'];
    $order = get_order_customer($order_code);
    $data['order'] = $order;
    $list_product_order = get_product_order($order_code);
    $data['list_product_order'] = $list_product_order;
    $get_num_order = get_num_order($order_code);
    $data['get_num_order'] = $get_num_order;
    $get_total_order = get_total_order($order_code);
    $data['get_total_order'] = $get_total_order;
  }

  load_view('order', $data);
}
