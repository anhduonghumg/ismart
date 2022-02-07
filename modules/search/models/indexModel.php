<?php
function get_list_search($key)
{
    $result = db_fetch_array("SELECT * From `tbl_products` WHERE `product_name` LIKE '%$key%' ORDER BY `price` DESC LIMIT 10");
    foreach ($result as &$item) {
        $item['url_product_detail'] = "?mod=product&action=detail&id={$item['product_id']}";
        $item['thumbnail'] = "admin/{$item['product_thumb']}";
        $item['friendly_detail'] = "{$item['slug']}/{$item['product_id']}";
    }
    return $result;
}

function get_list_category($where = "")
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat` {$where}");
    foreach ($result as &$item) {
        $item['url_name_product'] = "?mod=product&cat_id={$item['product_cat_id']}";
    }
    return $result;
}

function get_list_brand()
{
    $result = db_fetch_array("SELECT * FROM `tbl_brand`");
    return $result;
}

function get_search_by_key($key, $start, $num_per_page)
{
    $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE  `product_name` LIKE '%$key%' LIMIT {$start},{$num_per_page}");
    foreach ($result as &$item) {
        $item['thumbnail'] = "admin/{$item['product_thumb']}";
        $item['url_product_detail'] = "?mod=product&action=detail&id={$item['product_id']}";
        $item['buy_now'] = "?mod=order&action=buy_now&id={$item['product_id']}";
        $item['add_cart'] = "?mod=cart&action=add_cart&id={$item['product_id']}";
        $item['num_row'] = db_num_rows("SELECT * FROM `tbl_products` WHERE `product_name` LIKE '%$key%'");
    }
    return $result;
}

function get_search_filter($query)
{
    $result = db_fetch_array($query);
    foreach ($result as &$item) {
        $item['thumbnail'] = "admin/{$item['product_thumb']}";
        $item['url_product_detail'] = "?mod=product&action=detail&id={$item['product_id']}";
        $item['buy_now'] = "?mod=order&action=buy_now&id={$item['product_id']}";
        $item['add_cart'] = "?mod=cart&action=add_cart&id={$item['product_id']}";
    }
    return $result;
}

function get_num_row($query)
{
    $result = db_num_rows($query);
    return $result;
}

// function render_list_filter($list_search_filter)
// {
//     $output = "";
//     if (!empty($list_search_filter)) {
//         foreach ($list_search_filter as &$item) {
//             $price = currency_format($item['price']);
//             $promotion = currency_format($item['promotion']);
//             $output .= "<li>
//                     <a href='{$item['product_id']}' title='' class='thumb'>
//                         <img src='{$item['thumbnail']}'>
//                     </a>
//                     <a href='?page=detail_product' title='' class='product-name'>{$item['product_name']}</a>
//                     <div class='price'>
//                         <span class='new'>{$price}</span>
//                         <span class='old'>{$promotion}</span>
//                     </div>
//                     <div class='action clearfix'>
//                         <a href='{$item['add_cart']}' title='Thêm giỏ hàng' class='add-cart fl-left'>Thêm giỏ hàng</a>
//                         <a href='{$item['buy_now']}' title='Mua ngay' class='buy-now fl-right'>Mua ngay</a>
//                     </div>
//                     </li>";
//         }
//     } else {
//         $output = "<h3>Không tìm thấy kết quả nào.</h3>";
//     }
//     return $output;
// }
