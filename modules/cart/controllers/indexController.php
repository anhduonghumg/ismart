<?php

function construct()
{
  load_model('index');
  load('lib', 'validation');
  load('lib', 'email');
  load('helper', 'format');
}

function indexAction()
{
  load_view('index');
}

function checkoutAction()
{
  global $error;
  $error = array();
  if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
  }

  if (empty($id)) {
    if (isset($_POST['btn-order'])) {
      // CUSTOMERS INFO
      if (empty($_POST['fullname'])) {
        $error['fullname'] = "Không được để trống họ tên.";
      } else {
        $fullname = $_POST['fullname'];
      }

      if (empty($_POST['email'])) {
        $error['email'] = "Không được để trống email.";
      } else {
        if (!is_email($_POST['email'])) {
          $error['email'] = "Email không đúng định dạng.Email thiếu một '@'.";
        } else {
          $email = $_POST['email'];
        }
      }

      if (empty($_POST['address'])) {
        $error['address'] = "Không được để trống địa chỉ.";
      } else {
        $address = $_POST['address'];
      }

      if (empty($_POST['note'])) {
        $note = null;
      } else {
        $note = $_POST['note'];
      }

      if (empty($_POST['payment-method'])) {
        $error['payment-method'] = "Hãy chọn cách thanh toán.";
      } else {
        $payment = $_POST['payment-method'];
      }

      if (empty($_POST['phone'])) {
        $error['phone'] = "Không được để trống số điện thoại.";
      } else {
        if (!is_phone($_POST['phone'])) {
          $error['phone'] = "Không đúng định dạng.Số điện thoại là gồm 10 chữ số,bắt đầu bằng 09|03|07|08|05.";
        } else {
          $phone = $_POST['phone'];
        }
      }

      $total_order = $_SESSION['cart']['info']['num_order'];
      $total_spend = $_SESSION['cart']['info']['total'];

      // ORDER INFO
      if (empty($error)) {
        // $_SESSION['cart']['customer_info'] = array(
        //   'fullname' => $fullname,
        //   'email' => $email,
        //   'address' => $address,
        //   'phone' => $phone,
        //   'total_order' => $total_order,
        //   'total_spend' => $total_spend,
        //   'note' => $note,
        //   'payment' => $payment,
        // );
        // receiveOderAction();
        if (!customer_exits($fullname, $email, $phone)) {
          $data = array(
            'fullname' => $fullname,
            'email' => $email,
            'address' => $address,
            'phone' => $phone,
            'total_order' => $total_order,
            'total_spend' => $total_spend,
          );
          add_customer($data);
        } else {
          $customer = get_customer($fullname, $email, $phone);
          $customer_id = $customer['customer_id'];
          $customer_total_order = $customer['total_order'];
          $customer_total_spend = $customer['total_spend'];

          $data_update = array(
            'total_order' => $customer_total_order + $total_order,
            'total_spend' => $customer_total_spend + $total_spend
          );
          update_customer($customer_id, $data_update);
        }

        // ORDER
        $customer = get_customer($fullname, $email, $phone);
        $customer_id = $customer['customer_id'];
        foreach ($_SESSION['cart']['buy'] as $key => $value) {
          $product[$key]['id'] = $value['id'];
          $product[$key]['name'] = $value['product_name'];
          $product[$key]['qty'] = $value['qty'];
        }
        $order_code = strtoupper("#" . substr(md5(time()), 22));
        $total_item = $_SESSION['cart']['info']['num_order'];
        $total_price = $_SESSION['cart']['info']['total'];
        $time = time();
        $data_order = array(
          'order_code' => $order_code,
          'customer_id' => $customer_id,
          'product' => json_encode($product),
          'note' => $note,
          'payment' => $payment,
          'total_item' => $total_item,
          'total_price' => $total_price,
          'time_order' => $time,
          'status' => '1',
        );
        add_order($data_order);

        // UPDATE NUM PRODUCT
        foreach ($_SESSION['cart']['buy'] as $key => $value) {
          $product_id = $value['id'];
          $product = get_product_by_id($product_id);
          $data_product = array(
            'product_num' => $product['product_num'] - $value['qty'],
          );
          update_num_product($product_id, $data_product);
        }
        $content = mail_customer($order_code, $fullname, $phone, $payment);
        send_mail($email, $fullname, "[Ismart.com]-Thông báo đặt hàng thành công {$order_code}", $content);
        unset($_SESSION['cart']);
        redirect("?mod=cart&action=thank");
      }
    }
  } else {
  }

  load_view('checkout');
}

// function receiveOderAction()
// {
//   if (isset($_SESSION['cart'])) {
//     // Thông tin đặt hàng
//     if (!empty($_SESSION['cart']['customer_info'])) {
//       $fullname = $_SESSION['cart']['customer_info']['fullname'];
//       $email = $_SESSION['cart']['customer_info']['email'];
//       $phone = $_SESSION['cart']['customer_info']['phone'];
//       $total_order = $_SESSION['cart']['customer_info']['total_order'];
//       $total_spend = $_SESSION['cart']['customer_info']['total_spend'];
//       $address = $_SESSION['cart']['customer_info']['address'];
//       $note = $_SESSION['cart']['customer_info']['note'];
//       $payment = $_SESSION['cart']['customer_info']['payment'];

//       if (!customer_exits($fullname, $email, $phone)) {
//         $data = array(
//           'fullname' => $fullname,
//           'email' => $email,
//           'address' => $address,
//           'phone' => $phone,
//           'total_order' => $total_order,
//           'total_spend' => $total_spend,
//         );
//         add_customer($data);
//       } else {
//         $customer = get_customer($fullname, $email, $phone);
//         $customer_id = $customer['customer_id'];
//         $customer_total_order = $customer['total_order'];
//         $customer_total_spend = $customer['total_spend'];
//         $data_update = array(
//           'total_order' => $customer_total_order + $total_order,
//           'total_spend' => $customer_total_spend + $total_spend
//         );
//         update_customer($customer_id, $data_update);
//       }

//       // Thông tin đơn hàng 
//       $customer = get_customer($fullname, $email, $phone);
//       $customer_id = $customer['customer_id'];

//       $order_code = strtoupper("#" . substr(md5(time()), 22));
//       $total_item = $_SESSION['cart']['info']['num_order'];
//       $total_price = $_SESSION['cart']['info']['total'];
//       $time = time();
//       foreach ($_SESSION['cart']['buy'] as $value) {
//         $id = $value['id'];
//         $name = $value['product_name'];
//         $qty = $value['qty'];
//         $data_order = array(
//           'order_code' => $order_code,
//           'customer_id' => $customer_id,
//           // 'product' => json_encode($product),
//           'product_id' => $id,
//           'product_name' => $name,
//           'product_qty' => $qty,
//           'note' => $note,
//           'payment' => $payment,
//           'total_item' => $total_item,
//           'total_price' => $total_price,
//           'time_order' => $time,
//           'status' => '1',
//         );

//         add_order($data_order);
//       }
//       // UPDATE NUM PRODUCT
//       foreach ($_SESSION['cart']['buy'] as $key => $value) {
//         $product_id = $value['id'];
//         $product = get_product_by_id($product_id);
//         $data_product = array(
//           'product_num' => $product['product_num'] - $value['qty'],
//         );
//         update_num_product($product_id, $data_product);
//       }
//       $content = mail_customer($order_code, $fullname, $phone, $payment);
//       send_mail($email, $fullname, "[Ismart.com]-Thông báo đặt hàng thành công {$order_code}", $content);
//       unset($_SESSION['cart']);
//       load_view('thank');
//     }
//   }
// }


function thankAction()
{
  load_view('thank');
}
function add_cartAction()
{
  $id = isset($_GET['id']) ? (int)$_GET['id'] : NULL;

  add_cart($id);
  redirect("giohang.html");
}


function showAction()
{
  $list_buy = get_list_buy_cart();
  $data['list_buy'] = $list_buy;

  load_View('show', $data);
}

function deleteAction()
{
  $id = (int)$_GET['id'];

  delete_cart($id);
  redirect("giohang.html");
}

function delete_allAction()
{
  delete_cart($id = '');
  redirect("giohang.html");
}

function updateAction()
{
  if (isset($_POST['btn_update_cart'])) {
    update_cart($_POST['qty']);
    redirect("giohang.html");
  }
}
function update_ajaxAction()
{
  $id = $_POST['id'];
  $qty = $_POST['qty'];
  // lấy thông tin sản phẩm theo id của sản phẩm đó
  $item = get_product_by_id($id);

  // kiểm tra xem giỏ hàng đã có đơn hàng nào chưa và sản phẩm đó đã tồn tại trong giỏ hàng chưa
  if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
    // cập nhập số lượng
    $_SESSION['cart']['buy'][$id]['qty'] = $qty;

    //Cập nhập tổng tiền
    $sub_total = $qty * $item['price'];
    $_SESSION['cart']['buy'][$id]['sub_total'] = $sub_total;

    //Cập nhập lại toàn bộ giỏ hàng
    update_info_cart();

    //Lấy tổng giá trị trong giỏ hàng
    $total = get_total_cart();

    // Giá trị trả về
    $data = array(
      'sub_total' => currency_format($sub_total),
      'total' => currency_format($total)
    );

    echo json_encode($data);
  }
}

// function add_cart_ajaxAction()
// {
//   $id = $_GET['id'];
//   $item = get_product_by_id($id);

//   #. Thêm thông tin sản phẩm vào giỏ hàng
//   // kiểm tra xem giỏ hàng đã có đơn hàng nào chưa và sản phẩm đó đã tồn tại trong giỏ hàng chưa
//   $qty = 1;
//   if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
//     // nếu sãn phẩm đã có trong giỏ hàng thì + 1
//     $qty = $_SESSION['cart']['buy'][$id]['qty'] + 1;
//   }

//   $_SESSION['cart']['buy'][$id] = array(
//     'id' => $item['product_id'],
//     'url' => "?mod=product&action=detail&id={$id}",
//     'product_name' => $item['product_name'],
//     'price' => $item['price'],
//     'product_thumb' => "admin/{$item['product_thumb']}",
//     'code' => $item['product_code'],
//     'qty' => $qty,
//     'sub_total' => $item['price'] * $qty,
//   );
//   // cập nhập hóa đơn 
//   update_info_cart();
// }
// function delete_ajaxAction()
// {
//   $id = $_POST['id'];
//   if (isset($_SESSION['cart'])) {
//     if (!empty($id)) {
//       unset($_SESSION['cart']['buy'][$id]);
//       update_info_cart();
//     } else {
//       #. Xóa toàn bộ sản phẩm
//       unset($_SESSION['cart']);
//     }
//   }
// }
