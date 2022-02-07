<?php

function menuTree($menu, $parent = 0)
{
    $str_menu = "<ul class='list-item'>";
    foreach ($menu as $key => $value) {
        $value['url_product_name'] = "?mod=product&id={$value['product_cat_id']}";
        if ($value['parent_id'] == $parent) {
            $str_menu .= "<li><a href ='{$value['url_product_name']}'>" . $value['product_cat_name'] . "</a>";
            unset($value[$key]);
            $id = $value['product_cat_id'];
            $str_menu .=  "<ul class='sub-menu'>";
            foreach ($menu as $key => $value) {
                $value['url_product_name'] = "?mod=product&id={$value['product_cat_id']}";
                if ($value['parent_id'] != 0 && $value['parent_id'] == $id) {
                    $str_menu .= "<li><a href = '{$value['url_product_name']}'>" . $value['product_cat_name'] . "</a></li>";
                }
            }
            $str_menu .= "</ul>";
            $str_menu .= "</li>";
        }
    }
    $str_menu .= "</ul>";
    return $str_menu;
}

// function menuTree($menu, $parent = 0)
// {
//     $str_menu = "<ul class='list-item'>";
//     foreach ($menu as $key => $value) {
//         $value['url_product_name'] = "?mod=product&id={$value['product_cat_id']}";
//         if ($value['parent_id'] == $parent) {
//             $str_menu .= "<li><a href ='{$value['url_product_name']}'>" . $value['product_cat_name'] . "</a>";
//             unset($value[$key]);
//             $id = $value['product_cat_id'];
//             $str_menu .=  "<ul class='sub-menu'>";
//             foreach ($menu as $key => $value) {
//                 $value['url_product_name'] = "?mod=product&id={$value['product_cat_id']}";
//                 if ($value['parent_id'] != 0 && $value['parent_id'] == $id) {
//                     $str_menu .= "<li><a href = '{$value['url_product_name']}'>" . $value['product_cat_name'] . "</a></li>";
//                 }
//             }
//             $str_menu .= "</ul>";
//             $str_menu .= "</li>";
//         }
//     }
//     $str_menu .= "</ul>";
//     return $str_menu;
// }
