<?php

function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('lib', 'menu');
    load('lib', 'pagging');
    load('helper', 'string');
    load('helper', 'format');
}
function indexAction()
{
    if (isset($_GET['s']) && !empty($_GET['s'])) {
        $key = $_GET['s'];
        $data['key'] = $key;
        $data['num_row'] = get_num_rows('tbl_products', "`product_name` LIKE '%$key%'");
        $num_per_page = 20;
        $data['num_page'] = ceil($data['num_row'] / $num_per_page);
        $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($data['page'] - 1) * $num_per_page;

        $list_search = get_search_by_key($data['key'], $start, $num_per_page);
        $data['list_search'] = $list_search;
    }

    $category_product = get_list_category();
    $data['category_product'] = $category_product;
    $brand_product = get_list_brand();
    $data['brand_product'] = $brand_product;

    load_view('index', $data);
}

function filterAction()
{
    if (isset($_POST['action'])) {
        $key = $_POST['s'];
        $query = "SELECT * FROM `tbl_products` WHERE `product_name` LIKE '%$key%'";

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

        $list_search_filter = get_search_filter($query);
        $total_product = count($list_search_filter);

        if (!empty($list_search_filter)) {
            foreach ($list_search_filter as &$item) {
                $price = currency_format($item['price']);
                $promotion = currency_format($item['promotion']);
                $output .= "<li>
                        <a href='{$item['url_product_detail']}' title='' class='thumb'>
                            <img src='{$item['thumbnail']}'>
                        </a>
                        <a href='{$item['url_product_detail']}' title='' class='product-name'>{$item['product_name']}</a>
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
            'total_product' => $total_product,
            // 'query' => $query
            // 'pagging' => $pagging,
        );
        $show_data = json_encode($result);
        echo $show_data;
    }
}

function autocompleteAction()
{
    if (isset($_POST['s'])) {
        $input_text = $_POST['s'];
        $list_search = get_list_search($input_text);

        $result = array(
            'list_search' => $list_search,
            'input_text' => $input_text
        );
        $show_data = json_encode($result);
        echo $show_data;
    }
}

