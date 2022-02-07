<?php

function select_product($list_product)
{
    if (!empty($list_product)) {
        $str = "";
        foreach ($list_product as &$item) {
            $price = currency_format($item['price']);
            $promotion = currency_format($item['promotion']);

            $str .= "<li>
            <a href='{$item['url_detail_product']}' title='' class='thumb'>
                <img src='{$item['thumbnail']}'>
            </a>
            <a href='{$item['url_detail_product']}' title='' class='product-name'>{$item['product_name']}</a>
            <div class='price'>
                <span class='new'>{$price}</span>
                <span class='old'>{$promotion}</span>
            </div>
            <div class='action clearfix'>
                <a href='{$item['add_cart']}' title='Thêm giỏ hàng' class='add-cart fl-left'>Thêm giỏ hàng</a>
                <a href='{$item['checkout']}' title='Mua ngay' class='buy-now fl-right'>Mua ngay</a>
            </div>
        </li>";
        }
        return $str;
    }
}
