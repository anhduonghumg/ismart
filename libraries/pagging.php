<?php
function get_pagging($num_page, $page, $base_url = "")
{
    $str_pagging = "<ul id='list-pagging' class='fl-right'>";
    if ($page > 1) {
        $page_prev = $page - 1;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$page_prev}\">Trước</a></li>";
    }
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page) $active = "class = 'active'";
        $str_pagging .= "<li {$active}><a href = \"{$base_url}&page={$i}\">{$i}</a></li>";
    }
    if ($page < $num_page) {
        $page_next = $page + 1;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$page_next}\">Sau</a></li>";
    }
    $str_pagging .= "</ul>";
    return $str_pagging;
}


function pagging($num_page, $page, $base_url = "")
{
    $str_pagging = "<ul id='list-item'>";

    if ($page > 1) {
        $page_prev = $page - 1;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$page_prev}\">Trước</a></li>";
    }

    if ($page > 3) {
        $first = 1;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$first}\">{$first}</a></li>";
    }

    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page) $active = "class = 'active'";
        if ($i > $page - 3 && $i < $page + 3) {
            $str_pagging .= "<li {$active}><a href = \"{$base_url}&page={$i}\">{$i}</a></li>";
        }
    }

    if ($page < $num_page - 3) {
        $end = $num_page;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$end}\">{$end}</a></li>";
    }

    if ($page < $num_page) {
        $page_next = $page + 1;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$page_next}\">Sau</a></li>";
    }

    $str_pagging .= "</ul>";

    return $str_pagging;
}

function pagging_ajax($num_page, $page, $base_url = "", $friendly_url = "")
{
    if (empty($friendly_url)) {
        if ($num_page == 1) {
            return "";
        } else {
            $str_pagging = "<ul id='list-item'>";
            if ($page > 1) {
                $page_prev = $page - 1;
                $str_pagging .= "<li class='page-item' data-page='{$page_prev}'><a class='page-link' href = \"{$base_url}&page={$page_prev}\">Trước</a></li>";
            }

            if ($page > 3) {
                $first = 1;
                $str_pagging .= "<li class='page-item' data-page='{$first}'><a href = \"{$base_url}&page={$first}\">{$first}</a></li>";
            }

            for ($i = 1; $i <= $num_page; $i++) {
                $active = "";
                if ($i == $page) $active = "active";
                if ($i > $page - 3 && $i < $page + 3) {
                    $str_pagging .= "<li class='page-item {$active}' data-page='{$i}'><a href = \"{$base_url}&page={$i}\">{$i}</a></li>";
                }
            }

            if ($page < $num_page - 3) {
                $end = $num_page;
                $str_pagging .= "<li class='page-item' data-page='{$end}'><a href = \"{$base_url}&page={$end}\">{$end}</a></li>";
            }

            if ($page < $num_page) {
                $page_next = $page + 1;
                $str_pagging .= "<li class='page-item' data-page='{$page_next}'><a href = \"{$base_url}&page={$page_next}\">Sau</a></li>";
            }

            $str_pagging .= "</ul>";
            return $str_pagging;
        }
    }else{
        if ($num_page == 1) {
            return "";
        } else {
            $str_pagging = "<ul id='list-item'>";
            if ($page > 1) {
                $page_prev = $page - 1;
                $str_pagging .= "<li class='page-item' data-page='{$page_prev}'><a class='page-link' href = \"{$friendly_url}-p{$page_prev}\">Trước</a></li>";
            }

            if ($page > 3) {
                $first = 1;
                $str_pagging .= "<li class='page-item' data-page='{$first}'><a href = \"{$friendly_url}-p{$first}\">{$first}</a></li>";
            }

            for ($i = 1; $i <= $num_page; $i++) {
                $active = "";
                if ($i == $page) $active = "active";
                if ($i > $page - 3 && $i < $page + 3) {
                    $str_pagging .= "<li class='page-item {$active}' data-page='{$i}'><a href = \"{$friendly_url}-p{$i}\">{$i}</a></li>";
                }
            }

            if ($page < $num_page - 3) {
                $end = $num_page;
                $str_pagging .= "<li class='page-item' data-page='{$end}'><a href = \"{$friendly_url}-p{$end}\">{$end}</a></li>";
            }

            if ($page < $num_page) {
                $page_next = $page + 1;
                $str_pagging .= "<li class='page-item' data-page='{$page_next}'><a href = \"{$friendly_url}-p{$page_next}\">Sau</a></li>";
            }

            $str_pagging .= "</ul>";
            return $str_pagging;
        }
    }
}
// function pagging_filter($num_page, $page, $base_url = "")
// {

//     $str_pagging = "<ul id='list-item'>";
//     if ($page > 1) {
//         $page_prev = $page - 1;
//         $str_pagging .= "<li class='page-item' data-page='{$page_prev}'><a class='page-link' href = \"{$base_url}&page={$page_prev}\">Trước</a></li>";
//     }

//     if ($page > 3) {
//         $first = 1;
//         $str_pagging .= "<li class='page-item' data-page='{$first}'><a href = \"{$base_url}&page={$first}\">{$first}</a></li>";
//     }

//     for ($i = 1; $i <= $num_page; $i++) {
//         $active = "";
//         if ($i == $page) $active = "active";
//         if ($i > $page - 3 && $i < $page + 3) {
//             $str_pagging .= "<li class='page-item {$active}' data-page='{$i}'><a href = \"{$base_url}&page={$i}\">{$i}</a></li>";
//         }
//     }

//     if ($page < $num_page - 3) {
//         $end = $num_page;
//         $str_pagging .= "<li class='page-item' data-page='{$end}'><a href = \"{$base_url}&page={$end}\">{$end}</a></li>";
//     }

//     if ($page < $num_page) {
//         $page_next = $page + 1;
//         $str_pagging .= "<li class='page-item' data-page='{$page_next}'><a href = \"{$base_url}&page={$page_next}\">Sau</a></li>";
//     }

//     $str_pagging .= "</ul>";
//     return $str_pagging;
// }

function render_list_product($list_product)
{
    if (!empty($list_product)) {
        $str = "";
        foreach ($list_product as &$item) {
            $price = currency_format($item['price']);
            $promotion = currency_format($item['promotion']);
            // $item['thumbnail'] = "admin/{$item['product_thumb']}";
            // $item['url_detail_product'] = "?mod=product&action=detail";
            // $item['checkout'] = "?mod=cart&action=checkout";
            // $item['add_cart'] = "?mod=cart&action=add_cart";

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

function render_pagging($num_page, $page, $base_url = "")
{
    $str_pagging = "<ul id='list-item'>";
    if ($page > 1) {
        $page_prev = $page - 1;
        $str_pagging .= "<li class='page-item' data-page='{$page_prev}'><a class='page-link' href = \"{$base_url}&page={$page_prev}\">Trước</a></li>";
    }

    if ($page > 3) {
        $first = 1;
        $str_pagging .= "<li class='page-item' data-page='{$first}'><a href = \"{$base_url}&page={$first}\">{$first}</a></li>";
    }

    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page) $active = "active";
        if ($i > $page - 3 && $i < $page + 3) {
            $str_pagging .= "<li class='page-item {$active}' data-page='{$i}'><a href = \"{$base_url}&page={$i}\">{$i}</a></li>";
        }
    }

    if ($page < $num_page - 3) {
        $end = $num_page;
        $str_pagging .= "<li class='page-item' data-page='{$end}'><a href = \"{$base_url}&page={$end}\">{$end}</a></li>";
    }

    if ($page < $num_page) {
        $page_next = $page + 1;
        $str_pagging .= "<li class='page-item' data-page='{$page_next}'><a href = \"{$base_url}&page={$page_next}\">Sau</a></li>";
    }

    $str_pagging .= "</ul>";
    return $str_pagging;
}
