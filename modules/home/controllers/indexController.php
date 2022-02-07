<?php

function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('lib', 'menu');
    load('helper', 'format');
}

function indexAction()
{
    $list_product_featured = get_list_product("`featured` = '1'");
    $list_product_phone = get_list_product_phone("tbl_products.product_cat_id=tbl_product_cat.product_cat_id AND tbl_product_cat.parent_id ='1'");
    $list_product_laptop = get_list_product_laptop("tbl_products.product_cat_id=tbl_product_cat.product_cat_id AND tbl_product_cat.parent_id ='3'");
    $list_product_tablet = get_list_product_tablet("tbl_products.product_cat_id=tbl_product_cat.product_cat_id AND tbl_product_cat.parent_id ='2'");
    $list_product_best_seller = get_list_product("`best_sell` = '1'");
    $category_product = get_list_category();


    $data['list_product_featured'] = $list_product_featured;
    $data['list_product_phone'] = $list_product_phone;
    $data['list_product_laptop'] = $list_product_laptop;
    $data['list_product_tablet'] = $list_product_tablet;
    $data['list_product_best_seller'] = $list_product_best_seller;
    $data['category_product'] = $category_product;

    load_view('index', $data);
}
