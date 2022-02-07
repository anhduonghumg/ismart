<?php

function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('lib', 'menu');
    load('lib', 'pagging');
    load('helper', 'format');
}

function indexAction()
{
    #pagging
    $data['num_row'] = get_num_rows('tbl_pages');
    $num_per_page = 20;
    $data['num_page'] = ceil($data['num_row'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $category_product = get_list_category();
    $data['category_product'] = $category_product;
    $list_product_best_seller = get_list_product("`best_sell` = '1'");
    $data['list_product_best_seller'] = $list_product_best_seller;
    $list_blog = get_list_blog($start, $num_per_page);
    $data['list_blog'] = $list_blog;

    load_view('blog', $data);
}

function detailAction()
{
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $category_product = get_list_category();
    $data['category_product'] = $category_product;
    $list_product_best_seller = get_list_product("`best_sell` = '1'");
    $data['list_product_best_seller'] = $list_product_best_seller;
    $page_detail = get_page_detail($id);
    $data['page_detail'] = $page_detail;

    load_view('detail_blog', $data);
}

function blogAction()
{

    load_view("blog");
}
