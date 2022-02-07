<?php

function add_cart($id)
{
    $item = get_product_by_id($id);

    #. Thêm thông tin sản phẩm vào giỏ hàng
    // kiểm tra xem giỏ hàng đã có đơn hàng nào chưa và sản phẩm đó đã tồn tại trong giỏ hàng chưa

    $qty = 1;
    if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        // nếu sãn phẩm đã có trong giỏ hàng thì + 1
        $qty = $_SESSION['cart']['buy'][$id]['qty'] + 1;
    }

    $_SESSION['cart']['buy'][$id] = array(
        'id' => $item['product_id'],
        'url' => "?mod=product&action=detail&id={$id}",
        'product_name' => $item['product_name'],
        'price' => $item['price'],
        'product_thumb' => "admin/{$item['product_thumb']}",
        'code' => $item['product_code'],
        'qty' => $qty,
        'sub_total' => $item['price'] * $qty,
        'friendly_url' => "{$item['slug']}/{$item['product_id']}.html",
    );
    // cập nhập hóa đơn 
    update_info_cart();
}

function update_info_cart()
{

    #. Cập nhập thông tin hóa đơn
    if (isset($_SESSION['cart'])) {
        $num_order = 0;
        $total = 0;
        foreach ($_SESSION['cart']['buy'] as $item) {
            $num_order += $item['qty'];
            $total += $item['sub_total'];
        }
        $_SESSION['cart']['info'] = array(
            'num_order' => $num_order,
            'total' => $total
        );
    }
}

function delete_cart($id)
{
    if (isset($_SESSION['cart'])) {
        #. Xóa sản phẩm có $id trong giỏ hàng
        if (!empty($id)) {
            unset($_SESSION['cart']['buy'][$id]);
            update_info_cart();
        } else {
            #. Xóa toàn bộ sản phẩm
            unset($_SESSION['cart']);
        }
    }
}

function update_cart($qty)
{
    foreach ($qty as $id => $new_qty) {
        $_SESSION['cart']['buy'][$id]['qty'] = $new_qty;
        $_SESSION['cart']['buy'][$id]['sub_total'] = $new_qty *  $_SESSION['cart']['buy'][$id]['price'];
    }
    update_info_cart();
}

function get_total_cart()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['total'];
    }
    return false;
}

function get_num_order_cart()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['num_order'];
    }
    return false;
}
