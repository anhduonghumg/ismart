<?php
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('lib', 'pagging');
    load('helper', 'format');
}
function indexAction()
{
    load_view("index");
}

function list_productAction()
{
    #.pagging
    $data['num_row'] = get_num_rows('tbl_products');
    $num_per_page = 5;
    $data['num_page'] = ceil($data['num_row'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $list_product = get_list_product($start, $num_per_page);

    if (isset($_POST['sm_action'])) {
        if (isset($_POST['checkItem'])) {
            isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
            foreach ($_POST['checkItem'] as $id) {
                $action = $_POST['actions'];
                $list_product = get_list_product_by_id($id);
                if ($action == '1' && $list_product['product_status'] == '2') {
                    $data = array(
                        'product_status' => '1'
                    );
                    update_product($data, $id);
                } elseif ($action == '1' && $list_product['product_status'] == '3') {
                    $old_thumb = $list_product['product_thumb'];
                    $new_thumb = str_replace('trash/', '', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'product_status' => '1',
                        'product_thumb' => $new_thumb
                    );
                    update_product($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '2') {
                    $old_thumb = $list_product['product_thumb'];
                    $new_thumb = str_replace('products', 'products/trash', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'product_status' => '3',
                        'product_thumb' => $new_thumb
                    );
                    update_product($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '3' && $list_product['product_status'] != '2' && $list_product['product_status'] != '3') {
                    $approved = user_login();
                    $approval_date = time();
                    $data = array(
                        'product_status' => '2',
                        'approved' => $approved,
                        'approval_date' => $approval_date
                    );
                    update_product($data, $id);
                }
                redirect("?mod=product&action=list_product{$pages}");
            }
        }
    }

    if (isset($_POST['sm_filter'])) {
        if (isset($_POST['filter'])) {
            $filter = $_POST['filter'];
            if ($filter == 'laptop') {
                $list_product = get_list_laptop();
            } elseif ($filter == 'phone') {
                $list_product = get_list_phone();
            } elseif ($filter == 'tablet') {
                $list_product = get_list_tablet();
            }
        }
    }

    $data['list_product'] = $list_product;
    load_view('list_product', $data);
}
function pendingAction()
{
    $data['num_row'] = get_num_rows('tbl_products', "`product_status`='1'");
    $num_per_page = 5;
    $data['num_page'] = ceil($data['num_row'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $list_product = get_list_product($start, $num_per_page, "`product_status`='1'");
    $data['list_product'] = $list_product;
    if (isset($_POST['sm_action'])) {
        if (isset($_POST['checkItem'])) {
            isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
            foreach ($_POST['checkItem'] as $id) {
                $action = $_POST['actions'];
                $list_product = get_list_product_by_id($id);
                if ($action == '2') {
                    $old_thumb = $list_product['product_thumb'];
                    $new_thumb = str_replace('products', 'products/trash', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'product_status' => '3',
                        'product_thumb' => $new_thumb
                    );
                    update_product($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '3' && $list_product['product_status'] != '2' && $list_product['product_status'] != '3') {
                    $approved = user_login();
                    $approval_date = time();
                    $data = array(
                        'product_status' => '2',
                        'approved' => $approved,
                        'approval_date' => $approval_date
                    );
                    update_product($data, $id);
                }
                redirect("?mod=product&action=list_product{$pages}");
            }
        }
    }

    load_view("pending", $data);
}

function publishedAction()
{
    #.pagging
    $data['num_row'] = get_num_rows('tbl_products', "`product_status`='2'");
    $num_per_page = 5;
    $data['num_page'] = ceil($data['num_row'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $list_product = get_list_product($start, $num_per_page, "`product_status`='2'");
    $data['list_product'] = $list_product;

    if (isset($_POST['sm_action'])) {
        if (isset($_POST['checkItem'])) {
            isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
            foreach ($_POST['checkItem'] as $id) {
                $action = $_POST['actions'];
                $list_product = get_list_product_by_id($id);
                if ($action == '1' && $list_product['product_status'] == '2') {
                    $data = array(
                        'product_status' => '1'
                    );
                    update_product($data, $id);
                } elseif ($action == '1' && $list_product['product_status'] == '3') {
                    $old_thumb = $list_product['product_thumb'];
                    $new_thumb = str_replace('trash/', '', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'product_status' => '1',
                        'product_thumb' => $new_thumb
                    );
                    update_product($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '2') {
                    $old_thumb = $list_product['product_thumb'];
                    $new_thumb = str_replace('products', 'products/trash', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'product_status' => '3',
                        'product_thumb' => $new_thumb
                    );
                    update_product($data, $id);
                    delete_image($old_thumb);
                }
                redirect("?mod=product&action=list_product{$pages}");
            }
        }
    }

    load_view('published', $data);
}

function trashAction()
{
    #.pagging
    $data['num_row'] = get_num_rows('tbl_products', "`product_status`='3'");
    $num_per_page = 5;
    $data['num_page'] = ceil($data['num_row'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $list_product = get_list_product($start, $num_per_page, "`product_status`='3'");
    $data['list_product'] = $list_product;

    if (isset($_POST['sm_action'])) {
        if (isset($_POST['checkItem'])) {
            isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
            foreach ($_POST['checkItem'] as $id) {
                $action = $_POST['actions'];
                $list_product = get_list_product_by_id($id);
                if ($action == '1' && $list_product['product_status'] == '2') {
                    $data = array(
                        'product_status' => '1'
                    );
                    update_product($data, $id);
                } elseif ($action == '1' && $list_product['product_status'] == '3') {
                    $old_thumb = $list_product['product_thumb'];
                    $new_thumb = str_replace('trash/', '', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'product_status' => '1',
                        'product_thumb' => $new_thumb
                    );
                    update_product($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '4') {
                    $thumb = $list_product['product_thumb'];
                    delete_product($id);
                    delete_image($thumb);
                }
                redirect("?mod=product&action=list_product{$pages}");
            }
        }
    }

    load_view('trash', $data);
}

function searchAction()
{
    if (isset($_GET['s']) && !empty($_GET['s'])) {
        $key = $_GET['s'];

        $data['key'] = $key;
        $data['num_row'] = get_num_rows('tbl_products', "`product_id` LIKE '%$key%' OR `product_name` LIKE '%$key%' OR `product_code` LIKE '%$key%' OR  `creator` LIKE '%$key%' OR `create_date` LIKE '%$key%'");
        $num_per_page = 5;
        $data['num_page'] = ceil($data['num_row'] / $num_per_page);
        $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($data['page'] - 1) * $num_per_page;

        $list_search = getAllProduct($data['key'], $start, $num_per_page);
    } else {
        redirect("?mod=product&action=list_product");
    }
    if (isset($_POST['sm_action'])) {
        if (isset($_POST['checkItem'])) {
            isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
            foreach ($_POST['checkItem'] as $id) {
                $action = $_POST['actions'];
                $list_product = get_list_product_by_id($id);
                if ($action == '1' && $list_product['product_status'] == '2') {
                    $data = array(
                        'product_status' => '1'
                    );
                    update_product($data, $id);
                } elseif ($action == '1' && $list_product['product_status'] == '3') {
                    $old_thumb = $list_product['product_thumb'];
                    $new_thumb = str_replace('trash/', '', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'product_status' => '1',
                        'product_thumb' => $new_thumb
                    );
                    update_product($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '2') {
                    $old_thumb = $list_product['product_thumb'];
                    $new_thumb = str_replace('products', 'products/trash', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'product_status' => '3',
                        'product_thumb' => $new_thumb
                    );
                    update_product($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '3' && $list_product['product_status'] != '2' && $list_product['product_status'] != '3') {
                    $approved = user_login();
                    $approval_date = time();
                    $data = array(
                        'product_status' => '2',
                        'approved' => $approved,
                        'approval_date' => $approval_date
                    );
                    update_product($data, $id);
                }
                redirect("?mod=product&action=list_product{$pages}");
            }
        }
    }
    $data['list_search'] = $list_search;
    load_view('search', $data);
}
function add_productAction()
{
    global $error, $success;
    if (isset($_POST['btn-submit'])) {
        $error = array();
        $success = array();

        #.product_name
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Không được để trống tên sản phẩm";
        } else {
            if (is_exists('tbl_products', 'product_name', $_POST['product_name'])) {
                $error['product_name'] = "Tên sản phẩm đã tồn tại!";
            } else {
                $product_name = $_POST['product_name'];
            }
        }

        #.slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống slug";
        } else {
            if (is_exists('tbl_products', 'slug', $_POST['slug'])) {
                $error['slug'] = "Slug đã tồn tại!";
            } else {
                $slug = create_slug($_POST['slug']);
            }
        }

        #.product_code
        if (empty($_POST['product_code'])) {
            $error['product_code'] = "Không được để trồng mã sản phẩm";
        } else {
            if (is_exists('tbl_products', 'product_code', $_POST['product_code'])) {
                $error['product_code'] = "Mã sản phẩm đã tồn tại!";
            } else {
                $product_code = $_POST['product_code'];
            }
        }

        #.price
        if (empty($_POST['price'])) {
            $error['price'] = "Không được để trống giá sản phẩm";
        } else {
            $price = $_POST['price'];
        }

        #.product_num
        if (empty($_POST['product_num'])) {
            $error['product_num'] = "Không được để trống số lượng sản phẩm";
        } else {
            $product_num = $_POST['product_num'];
        }

        #.desc
        if (!empty($_POST['desc'])) {
            $product_desc = $_POST['desc'];
        }

        #.content
        if (!empty($_POST['content'])) {
            $product_content = $_POST['content'];
        }

        #.parent_id
        if (empty($_POST['parent_id'])) {
            $error['product_cat'] = "Bạn chưa chọn danh mục!";
        } else {
            $parent_id = $_POST['parent_id'];
        }
        #brand
        if (empty($_POST['brand'])) {
            $error['brand'] = "Bạn chưa chọn thương hiệu!";
        } else {
            $brand = $_POST['brand'];
        }

        #.inventory_status
        if (empty($_POST['inventory_status'])) {
            $error['inventory_status'] = "Bạn chưa chọn trạng thái kho hàng!";
        } else {
            $inventory_status = $_POST['inventory_status'];
        }

        #.featured
        if (isset($_POST['featured'])) {
            $featured = $_POST['featured'];
        } else {
            $featured = '0';
        }

        #.best-sell
        if (isset($_POST['best-sell'])) {
            $best_sell = $_POST['best-sell'];
        } else {
            $best_sell = '0';
        }

        #.upload_file
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "Size hoặc kiểu ảnh không đúng";
            } else {
                $product_thumb = upload_image("public/images/uploads/products/", $type);
            }
        } else {
            $error['upload_image'] = "Upload không thàng công";
        }

        #.Kết luận
        if (empty($error)) {
            $creator = user_login();
            $create_date = time();
            $data = array(
                'product_name' => $product_name,
                'slug' => $slug,
                'product_code' => $product_code,
                'product_content' => $product_content,
                'product_desc' => $product_desc,
                'product_num' => $product_num,
                'price' => $price,
                'brand_id' => $brand,
                'inventory_status' => $inventory_status,
                'best_sell' => $best_sell,
                'featured' => $featured,
                'create_date' => $create_date,
                'creator' => $creator,
                'product_thumb' => $product_thumb,
                'product_cat_id' => $parent_id,
            );
            add_product($data);

            // add-list-thumb
            $list_product_by_code = get_list_product_by_code($product_code);
            foreach ($_FILES["list-thumb"]["tmp_name"] as $key => $value) {
                $file_name = "public/images/uploads/products/sub/" . $_FILES["list-thumb"]["name"][$key];
                $file_tmp = $_FILES["list-thumb"]["tmp_name"][$key];
                $data_thumb = array(
                    'product_id' => $list_product_by_code["product_id"],
                    'url_thumb' => $file_name,
                );
                move_uploaded_file($file_tmp, $file_name);
                add_thumb($data_thumb);
            }

            $success['add_product'] = "Thêm sản phẩm thành công";
        }
    }

    if (isset($_POST['btn-upload-thumb'])) {
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "Size hoặc kiểu ảnh không đúng";
            } else {
                upload_image("public/images/uploads/", $type);
                $success['upload_image'] = "Upload ảnh thành công";
            }
        } else {
            $error['upload_image'] = "Không có ảnh upload";
        }
    }

    $get_list_product = get_list_cat();
    $list_cat = data_tree($get_list_product);
    $list_brand = get_brand();
    $data['list_cat'] = $list_cat;
    $data['list_brand'] = $list_brand;

    load_view('add_product', $data);
}

function update_productAction()
{
    $id = (int)$_GET['id'];
    $get_list_cat = get_list_cat();
    $list_cat = data_tree($get_list_cat);
    $list_product = get_list_product_by_id($id);
    $list_brand = get_brand();

    global $error, $success;

    if (isset($_POST['btn-submit'])) {
        $error = array();
        $success = array();

        #.product_name
        if (empty($_POST['product_name'])) {
            $product_name = $list_product['product_name'];
        } else {
            $product_name = $_POST['product_name'];
        }

        #.slug
        if (empty($_POST['slug'])) {
            $slug = $list_product['slug'];
        } else {
            $slug = create_slug($_POST['slug']);
        }

        // #.product_code
        // if (empty($_POST['product_code'])) {
        //     $error['product_code'] = "Không được để trồng mã sản phẩm";
        // } else {
        //     if (is_exists('tbl_products', 'product_code', $_POST['product_code'])) {
        //         $error['product_code'] = "Mã sản phẩm đã tồn tại!";
        //     } else {
        //         $product_code = $_POST['product_code'];
        //     }
        // }

        #.price
        if (empty($_POST['price'])) {
            $error['price'] = "Không được để trống giá sản phẩm";
        } else {
            $price = $_POST['price'];
        }

        #.promotion
        if (empty($_POST['price'])) {
            $promotion = $list_product['promotion'];
        } else {
            $promotion = $_POST['promotion'];
        }

        #.product_num
        if (empty($_POST['product_num'])) {
            $product_num = 0;
        } else {
            $product_num = $_POST['product_num'];
        }

        #.desc
        if (!empty($_POST['desc'])) {
            $product_desc = $_POST['desc'];
        } else {
            $product_desc = $list_product['product_desc'];
        }

        #.content
        if (!empty($_POST['content'])) {
            $product_content = $_POST['content'];
        } else {
            $product_content = $list_product['product_content'];
        }

        #.parent_id
        if (empty($_POST['parent_id'])) {
            $parent_id = $list_product['product_cat_id'];
        } else {
            $parent_id = $_POST['parent_id'];
        }
        #brand
        if (empty($_POST['brand'])) {
            $error['brand'] = "Bạn chưa chọn thương hiệu!";
        } else {
            $brand = $_POST['brand'];
        }

        #.inventory_status
        if (empty($_POST['inventory_status'])) {
            $inventory_status = $list_product['inventory_status'];
        } else {
            $inventory_status = $_POST['inventory_status'];
        }

        #.featured
        if (isset($_POST['featured'])) {
            $featured = $_POST['featured'];
        } else {
            $featured = '0';
        }

        #.best-sell
        if (isset($_POST['best-sell'])) {
            $best_sell = $_POST['best-sell'];
        } else {
            $best_sell = '0';
        }

        #.upload_file
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "Size hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = get_url_old_thumb($id);
                if (delete_image($old_thumb)) {
                    $product_thumb = upload_image("public/images/uploads/products/", $type);
                }
            }
        } else {
            $product_thumb = $list_product['product_thumb'];
        }


        #.Kết luận
        if (empty($error)) {
            $editor = user_login();
            $edit_date = time();
            $data = array(
                'product_name' => $product_name,
                'slug' => $slug,
                // 'product_code' => $product_code,
                'product_content' => $product_content,
                'product_desc' => $product_desc,
                'product_num' => $product_num,
                'price' => $price,
                'brand_id' => $brand,
                'promotion' => $promotion,
                'inventory_status' => $inventory_status,
                'best_sell' => $best_sell,
                'featured' => $featured,
                'editor' => $editor,
                'edit_date' => $edit_date,
                'product_thumb' => $product_thumb,
                'product_cat_id' => $parent_id,
            );
            update_product($data, $id);
            redirect("?mod=product&action=list_product");
        }
    }

    if (isset($_POST['btn-upload-thumb'])) {
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "Size hoặc kiểu ảnh không đúng";
            } else {
                upload_image("public/images/uploads/", $type);
                $success['upload_image'] = "Upload ảnh thành công";
            }
        } else {
            $error['upload_image'] = "Không có ảnh upload";
        }
    }

    $data['list_product'] = $list_product;
    $data['list_cat'] = $list_cat;
    $data['list_brand'] = $list_brand;

    load_view('update_product', $data);
}

function delete_productAction()
{
    $id = (int)$_GET['id'];
    $list_product = get_list_product_by_id($id);
    $list_thumb = get_list_thumb_by_id($id);
    if (!empty($list_product)) {
        delete_product($id);
        delete_image($list_product['product_thumb']);
    }
    if (!empty($list_thumb)) {
        foreach ($list_thumb as &$item) {
            unlink($item['url_thumb']);
        }
        delete_thumb($id);
    }
    redirect("?mod=product&action=list_product");
}
