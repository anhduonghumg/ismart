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
    $data['num_row'] = get_num_rows('tbl_products');
    $num_per_page = 20;
    $data['num_page'] = ceil($data['num_row'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $list_all_product = get_list_all_product($start, $num_per_page);
    $data['list_all_product'] = $list_all_product;
    $category_product = get_list_category();
    $data['category_product'] = $category_product;
    $brand_product = get_list_brand();
    $data['brand_product'] = $brand_product;

    load_view('index', $data);
}

function filterAction()
{
    if (isset($_POST['action'])) {
        $query = "SELECT * FROM `tbl_products` WHERE `product_name` IS NOT NULL ";

        if (isset($_POST['minimum_price'], $_POST['maximum_price']) && !empty($_POST['minimum_price']) && !empty($_POST['maximum_price'])) {
            $query .= "AND `price` BETWEEN " . $_POST['minimum_price'] . " AND " . $_POST['maximum_price'] . " ";
        }
        if (isset($_POST['brand'])) {
            $brand_filter = implode("','", $_POST['brand']);
            $query .= "AND `brand_id`IN('" . $brand_filter . "')";
        }
        if (isset($_POST['select'])) {
            $select = $_POST['select'];
            $az = '1';
            $za = "2";
            $ct = '3';
            $tc = '4';
            if ($select == $az) {
                $query .= "ORDER BY `product_name` ASC" . " ";
            } elseif ($select == $za) {
                $query .= "ORDER BY `product_name` DESC" . " ";
            } elseif ($select == $ct) {
                $query .= "ORDER BY `price` DESC" . " ";
            } elseif ($select == $tc) {
                $query .= "ORDER BY `price` ASC" . " ";
            } else {
                $query .= '';
            }
        }

        $output = "";

        // $page = isset($_GET['page']) ? $_GET['page'] : null;
        // $num_per_page = 3;
        // $start = ($page - 1) * $num_per_page;
        // $num_rows = $total_product;
        // $num_page = ceil($num_rows / $num_per_page);
        // $query .= "LIMIT {$start},{$num_per_page}";
        // $pagging = render_pagging($num_page, $page, "?mod=search&action=index&s={$key}");

        $list_product = get_search_filter($query);
        $total_product = count($list_product);

        if (!empty($list_product)) {
            foreach ($list_product as &$item) {
                $price = currency_format($item['price']);
                $promotion = currency_format($item['promotion']);
                $output .= "<li>
                        <a href='{$item['friendly_detail']}' title='' class='thumb'>
                            <img src='{$item['thumbnail']}'>
                        </a>
                        <a href='{$item['friendly_detail']}' title='' class='product-name'>{$item['product_name']}</a>
                        <div class='price'>
                            <span class='new'>{$price}</span>
                            <span class='old'>{$promotion}</span>
                        </div>
                        <div class='action clearfix'>
                            <a href='{$item['friendly_add_cart']}' title='Thêm giỏ hàng' class='add-cart fl-left'>Thêm giỏ hàng</a>
                            <a href='{$item['friendly_buy_now']}' title='Mua ngay' class='buy-now fl-right'>Mua ngay</a>
                        </div>
                        </li>";
            }
        } else {
            $output = "<h3>Không tìm thấy kết quả nào.</h3>";
        }

        $result = array(
            'output' => $output,
            'total_product' => $total_product,
            // 'query' => $query
            // 'pagging' => $pagging,
        );
        $show_data = json_encode($result);
        echo $show_data;
    }
}

function detailAction()
{
    $id = isset($_GET['id']) ? (int)$_GET['id'] : NULL;
    $action = isset($_GET['action']) ? $_GET['action'] : NULL;
    $product_viewed = get_product_by_id($id);

    if (!isset($_SESSION['viewed'])) {
        $_SESSION['viewed'] = array();
    }
    if ($action == 'detail') {
        $_SESSION['viewed']['product'][$id] = array(
            'id' => $product_viewed['product_id'],
            'url' => "?mod=product&action=detail&id={$id}",
            'product_name' => $product_viewed['product_name'],
            'price' => $product_viewed['price'],
            'promotion' => $product_viewed['promotion'],
            'product_thumb' => "admin/{$product_viewed['product_thumb']}",
            'code' => $product_viewed['product_code'],
            'checkout' => "?mod=product&action=checkout",
            'friendly_url' => "{$product_viewed['slug']}/{$product_viewed['product_id']}.html",
        );
        $list_product_viewed = $_SESSION['viewed']['product'];
        $data['list_product_viewed'] = $list_product_viewed;
    }

    $category_product = get_list_category();
    $data['category_product'] = $category_product;

    $list_product = get_list_product_by_id($id);
    $data['list_product'] = $list_product;
    $list_product_similar = get_list_product_similar($id);
    $data['list_product_similar'] = $list_product_similar;
    $cat_product = get_cat_by_id($id);
    $data['cat_product'] = $cat_product;
    $list_thumb = get_list_thumb($id);
    $data['list_thumb'] = $list_thumb;

    load_view("detail_product", $data);
}

// function pagination_selectAction()
// {

//     $select_filter = isset($_POST['select-filter']) ? (int)$_POST['select-filter'] : 0;
//     $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
//     $num_per_page = 20;
//     $start = ($page - 1) * $num_per_page;
//     $num_rows = get_num_rows("tbl_products");
//     $num_page = ceil($num_rows / $num_per_page);

//     if ($select_filter == 1) {
//         $list_all_product = get_list_all_product($start, $num_per_page, '', "`product_name` ASC");
//         $data['list_all_product'] = $list_all_product;
//     } elseif ($select_filter == 2) {
//         $list_all_product = get_list_all_product($start, $num_per_page, '', "`product_name` DESC");
//         $data['list_all_product'] = $list_all_product;
//     } elseif ($select_filter == 3) {
//         $list_all_product = get_list_all_product($start, $num_per_page, '', "`price` DESC");
//         $data['list_all_product'] = $list_all_product;
//     } elseif ($select_filter == 4) {
//         $list_all_product = get_list_all_product($start, $num_per_page, '', "`price` ASC");
//         $data['list_all_product'] = $list_all_product;
//     } elseif ($select_filter == 0) {
//         $list_all_product = get_list_all_product($start, $num_per_page);
//         $data['list_all_product'] = $list_all_product;
//     }
//     $pagging = render_pagging($num_page, $page, "?mod=product&action=select&select-filter={$select_filter}&btn-submit=submit");
//     $result = array(
//         'list_product' => $list_all_product,
//         'pagging' => $pagging
//     );
//     echo json_encode($result);
// }

function paginationAction()
{

    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $num_per_page = 20;
    $start = ($page - 1) * $num_per_page;
    $num_rows = get_num_rows("tbl_products");
    $num_page = ceil($num_rows / $num_per_page);

    $list_all_product = render_list_product(get_list_all_product($start, $num_per_page));
    $pagging = render_pagging($num_page, $page, "?mod=product&action=index");

    $result = array(
        'list_product' => $list_all_product,
        'pagging' => $pagging
    );
    echo json_encode($result);
}
