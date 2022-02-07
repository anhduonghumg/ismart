<?php

function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('lib', 'menu');
    load('lib', 'pagging');
    load('lib', 'select');
    load('helper', 'format');
    load('helper', 'string');
}

function indexAction()
{
    $id = isset($_GET['cat_id']) ? (int)$_GET['cat_id'] : NULL;
    $parent_id = isset($_GET['parent_id']) ? (int)$_GET['parent_id'] : NULL;

    if ($parent_id == 0) {
        $data['num_row'] = db_num_rows("SELECT * FROM tbl_products,tbl_product_cat WHERE tbl_products.product_cat_id=tbl_product_cat.product_cat_id AND tbl_product_cat.parent_id={$id}");
        $num_per_page = 20;
        $data['num_page'] = ceil($data['num_row'] / $num_per_page);
        $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($data['page'] - 1) * $num_per_page;
        $list_product = get_list_product_by_category($start, $num_per_page, "tbl_products.product_cat_id=tbl_product_cat.product_cat_id AND tbl_product_cat.parent_id={$id}", "tbl_products.price");
    } else {
        $data['num_row'] = db_num_rows("SELECT * FROM tbl_products,tbl_product_cat WHERE tbl_products.product_cat_id=tbl_product_cat.product_cat_id AND tbl_product_cat.product_cat_id={$id} AND tbl_product_cat.parent_id={$parent_id}");
        $num_per_page = 20;
        $data['num_page'] = ceil($data['num_row'] / $num_per_page);
        $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($data['page'] - 1) * $num_per_page;
        $list_product = get_list_product_by_category($start, $num_per_page, "tbl_products.product_cat_id=tbl_product_cat.product_cat_id AND tbl_product_cat.product_cat_id={$id} AND tbl_product_cat.parent_id={$parent_id}", "tbl_products.price");
    }

    $data['list_product'] = $list_product;
    $category_product = get_list_category();
    $data['category_product'] = $category_product;
    $brand_product = get_list_brand();
    $data['brand_product'] = $brand_product;
    $title = get_title($id);
    $data['title'] = $title;
    $list_product_best_seller = get_list_product_best_sell("`best_sell` = '1'");
    $data['list_product_best_seller'] = $list_product_best_seller;

    load_view('category_product', $data);
}

function filter_catAction()
{
    if (isset($_POST['action'])) {
        $id = (int)$_POST['cat_id'];
        $parent_id = (int)$_POST['parent_id'];

        $query = "SELECT * FROM `tbl_products`,`tbl_product_cat` WHERE tbl_products.product_cat_id=tbl_product_cat.product_cat_id ";
        if ($parent_id == 0) {
            $query .= "AND tbl_product_cat.parent_id={$id} ";
        } else {
            $query .= "AND tbl_product_cat.product_cat_id={$id} AND tbl_product_cat.parent_id={$parent_id} ";
        }
        if (isset($_POST['minimum_price'], $_POST['maximum_price']) && !empty($_POST['minimum_price']) && !empty($_POST['maximum_price'])) {
            $query .= "AND `price` BETWEEN " . $_POST['minimum_price'] . " AND " . $_POST['maximum_price'] . " ";
        }
        if (isset($_POST['brand'])) {
            $brand_filter = implode("','", $_POST['brand']);
            $query .= "AND `brand_id`IN('" . $brand_filter . "')";
        }
        $query = "SELECT * FROM `tbl_products`,`tbl_product_cat` WHERE tbl_products.product_cat_id=tbl_product_cat.product_cat_id AND tbl_product_cat.parent_id={$parent_id}";

        if (isset($_POST['select'])) {
            $select = $_POST['select'];
            $az = '1';
            $za = "2";
            $ct = '3';
            $tc = '4';
            if ($select == $az) {
                $query .= "ORDER BY `tbl_products.product_name` ASC" . " ";
            } elseif ($select == $za) {
                $query .= "ORDER BY `tbl_products.product_name` DESC" . " ";
            } elseif ($select == $ct) {
                $query .= "ORDER BY `tbl_products.price` DESC" . " ";
            } elseif ($select == $tc) {
                $query .= "ORDER BY `tbl_products.price` ASC" . " ";
            } else {
                $query .= '';
            }
        }

        $output = "";

        $list_search_filter = get_search_filter($query);

        if (!empty($list_search_filter)) {
            foreach ($list_search_filter as &$item) {
                $price = currency_format($item['price']);
                $promotion = currency_format($item['promotion']);
                $output .= "<li>
                        <a href='{$item['product_id']}' title='' class='thumb'>
                            <img src='{$item['thumbnail']}'>
                        </a>
                        <a href='?page=detail_product' title='' class='product-name'>{$item['product_name']}</a>
                        <div class='price'>
                            <span class='new'>{$price}</span>
                            <span class='old'>{$promotion}</span>
                        </div>
                        <div class='action clearfix'>
                            <a href='{$item['add_cart']}' title='Thêm giỏ hàng' class='add-cart fl-left'>Thêm giỏ hàng</a>
                            <a href='{$item['buy_now']}' title='Mua ngay' class='buy-now fl-right'>Mua ngay</a>
                        </div>
                        </li>";
            }
        } else {
            $output = "<h3>Không tìm thấy kết quả nào.</h3>";
        }


        $result = array(
            'output' => $output,
            // 'total_product' => $total_product,
            'query' => $query,
            // 'pagging' => $pagging,
        );
        $show_data = json_encode($result);
        echo $show_data;
    }
}
