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
    #.pagging
    $data['num_row'] = get_num_rows('tbl_brand');
    $num_per_page = 10;
    $data['num_page'] = ceil($data['num_row'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $list_brand = get_list_brand($start, $num_per_page);
    $data['list_brand'] = $list_brand;

    load_view("list_brand", $data);
}

function add_brandAction()
{
    global $error, $success;
    $error = array();
    if (isset($_POST['btn-submit'])) {
        if (empty($_POST['title'])) {
            $error['name_brand'] = "Không được để trống tên thương hiệu.";
        } else {
            if (brand_exists($_POST['title'])) {
                $error['name_brand'] = "Tên thương hiệu đã tồn tại";
            } else {
                $name_brand = $_POST['title'];
                $slug = create_slug($_POST['title']);
            }
        }

        if (empty($error)) {
            $time = time();
            $creator = user_login();
            $data = array(
                'name' => $name_brand,
                'slug' => $slug,
                'creator' => $creator,
                'created_date' => $time
            );
            add_brand($data);
            $success['add_brand'] = "Thêm thương hiệu thành công.";
        }
    }
    load_view("add_brand");
}
function update_brandAction()
{
    global $error, $success;
    $error = array();
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if (isset($_POST['btn-submit'])) {
        if (empty($_POST['title'])) {
            $error['name_brand'] = "Không được để trống tên thương hiệu.";
        } else {
            if (brand_exists($_POST['title'])) {
                $error['name_brand'] = "Tên thương hiệu đã tồn tại";
            } else {
                $name_brand = $_POST['title'];
                $slug = create_slug($_POST['title']);
            }
        }

        if (empty($error)) {
            $data = array(
                'name' => $name_brand,
                'slug' => $slug
            );
            update_brand($data, $id);
            $success['update_brand'] = "Cập nhập thương hiệu thành công.";
        }
    }
    load_view('update_brand');
}

function delete_brandAction()
{
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    delete_brand($id);
    redirect("?mod=product&controller=brand");
}
