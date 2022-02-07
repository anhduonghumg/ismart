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

function list_catAction()
{

    #.pagging
    $data['num_row'] = get_num_rows('tbl_product_cat');
    $num_per_page = 10;
    $data['num_page'] = ceil($data['num_row'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $list_product_cat = get_list_product_cat($start, $num_per_page);
    $data['list_product_cat'] = data_tree($list_product_cat);

    load_view("list_cat", $data);
}

function add_catAction()
{
    global $error, $success, $title, $parent_cat, $slug;
    if (isset($_POST['btn-submit'])) {
        $error = array();
        $success = array();
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tên danh mục";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống slug";
        } else {
            $slug = create_slug($_POST['slug']);
        }

        if (empty($_POST['parent-Cat'])) {
            $parent_cat = 0;
        } else {
            $parent_cat = $_POST['parent-Cat'];
        }

        if (empty($error)) {
            $time = time();
            $creator = user_login();
            $data = array(
                'product_cat_name' => $title,
                'slug' => $slug,
                'parent_id' => $parent_cat,
                'creator' => $creator,
                'created_date' => $time
            );
            if (!exist_cat($slug, $title)) {
                add_product_cat($data);
                $success['add_cat'] = "Thêm thành công";
            } else {
                $error['exist_cat'] = "Danh mục đã tồn tại.";
            }
        } else {
            $error['add_cat'] = "Thêm thất bại";
        }
    }

    $get_list_cat = get_list_cat();
    $list_cat = data_tree($get_list_cat);
    $data['list_cat'] =  $list_cat;

    load_view("add_cat", $data);
}

function update_catAction()
{
    $id = (int)$_GET['id'];
    global $error, $success, $title, $slug;
    if (isset($_POST['btn-submit'])) {
        $error = array();
        $success = array();
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tên danh mục";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống slug";
        } else {
            $slug = create_slug($_POST['slug']);
        }

        if (empty($error)) {
            $data = array(
                'product_name' => $title,
                'slug' => $slug
            );
            if (!exist_cat($slug, $title)) {
                update_post_cat($data, $id);
                redirect("?mod=product&controller=cat&action=list_cat");
            } else {
                $error['exist_cat'] = "Danh mục đã tồn tại.";
            }
        } else {
            $error['update_cat'] = "Cập nhập thất bại";
        }
    }

    $list_product_cat_by_id = get_list_product_cat_by_id($id);
    $data['list_product_cat_by_id'] = $list_product_cat_by_id;

    load_view("update_cat", $data);
}

function delete_catAction()
{
    $id = (int)$_GET['id'];
    delete_cat($id);
    redirect("?mod=product&controller=cat&action=list_cat");
}
