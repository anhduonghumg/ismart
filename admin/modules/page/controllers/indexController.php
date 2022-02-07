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
    global $list_pages, $num_row, $page, $num_per_page, $start, $num_page;

    $num_row = get_num_rows('tbl_pages');
    // Số lượng bản ghi trên trang
    $num_per_page = 3;
    // Tổng số bản ghi
    $total_row = $num_row;
    // Số lượng trang
    $num_page = ceil($total_row / $num_per_page);
    // Lấy trang hiện tại
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    // Chỉ số bản ghi bắt đầu
    $start = ($page - 1) * $num_per_page;

    $list_pages = get_list_page($start, $num_per_page);

    if (isset($_POST['sm_action'])) {
        if (isset($_POST['checkItem'])) {
            isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : null;
            foreach ($_POST['checkItem'] as $id) {
                $action = $_POST['actions'];
                $list_pages = get_list_page_by_id($id);
                if ($action == '1' && $list_pages['status'] == '2') {
                    $data = array(
                        'status' => '1',
                    );
                    update_page($data, $id);
                } elseif ($action == '1' && $list_pages['status'] == '3') {
                    $old_thumb = $list_pages['page_thumb'];
                    $new_thumb = str_replace('trash/', '', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'status' => '1',
                        'page_thumb' => $new_thumb
                    );
                    update_page($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '2') {
                    $old_thumb = $list_pages['page_thumb'];
                    $new_thumb = str_replace('pages', 'pages/trash', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'status' => '3',
                        'page_thumb' => $new_thumb
                    );
                    update_page($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '3' && $list_pages['status'] != '2' && $list_pages['status'] != '3') {
                    $approved = user_login();
                    $approval_date = time();
                    $data = array(
                        'status' => '2',
                        'approved' => $approved,
                        'approval_date' => $approval_date
                    );
                    update_page($data, $id);
                }
                redirect("?mod=page&action=index{$pages}");
            }
        }
    }

    load_view('list_page');
}

function searchAction()
{
    global $list_search, $key, $num_row, $page, $num_per_page, $start, $num_page;

    if (isset($_GET['s']) && !empty($_GET['s'])) {

        $key = $_GET['s'];

        $num_row = get_num_rows('tbl_pages', "`page_id` LIKE '%$key%' OR `page_title` LIKE '%$key%' OR `creator` LIKE '%$key%' OR `create_date` LIKE '%$key%'");
        // Số lượng bản ghi trên trang
        $num_per_page = 3;
        // Tổng số bản ghi
        $total_row = $num_row;
        // Số lượng trang
        $num_page = ceil($total_row / $num_per_page);
        // Lấy trang hiện tại
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        // Chỉ số bản ghi bắt đầu
        $start = ($page - 1) * $num_per_page;

        $list_search = getAllPage($key, $start, $num_per_page);
    }

    if (isset($_POST['sm_action'])) {
        if (isset($_POST['checkItem'])) {
            isset($_GET['page']) ? $pages = "&s={$key}&sm_s=Tìm+kiếm&page={$_GET['page']}" : null;
            foreach ($_POST['checkItem'] as $id) {
                $action = $_POST['actions'];
                $list_pages = get_list_page_by_id($id);
                if ($action == '1' && $list_pages['status'] == '2') {
                    $data = array(
                        'status' => '1',
                    );
                    update_page($data, $id);
                } elseif ($action == '1' && $list_pages['status'] == '3') {
                    $old_thumb = $list_pages['page_thumb'];
                    $new_thumb = str_replace('trash/', '', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'status' => '1',
                        'page_thumb' => $new_thumb
                    );
                    update_page($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '2') {
                    $old_thumb = $list_pages['page_thumb'];
                    $new_thumb = str_replace('pages', 'pages/trash', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'status' => '3',
                        'page_thumb' => $new_thumb
                    );
                    update_page($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '3' && $list_pages['status'] != '2' && $list_pages['status'] != '3') {
                    $approved = user_login();
                    $approval_date = time();
                    $data = array(
                        'status' => '2',
                        'approved' => $approved,
                        'approval_date' => $approval_date
                    );
                    update_page($data, $id);
                }
                redirect("?mod=page&action=search{$pages}");
            }
        }
    }
    $data['list_search'] = $list_search;
    load_view('search_page', $data);
}

function list_pageAction()
{
    load_view('list_page');
}

function publishedAction()
{
    global $list_publish, $num_row, $num_per_page, $page, $start, $num_page;
    $num_row = get_num_rows('tbl_pages', "`status` = '2'");
    // Số lượng bản ghi trên trang
    $num_per_page = 3;
    // Tổng số bản ghi
    $total_row = $num_row;
    // Số lượng trang
    $num_page = ceil($total_row / $num_per_page);
    // Lấy trang hiện tại
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    // Chỉ số bản ghi bắt đầu
    $start = ($page - 1) * $num_per_page;

    $list_publish = get_list_page($start, $num_per_page, "`status` = '2'");
    if (isset($_POST['sm_action'])) {
        if (isset($_POST['checkItem'])) {
            isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
            foreach ($_POST['checkItem'] as $id) {
                $action = $_POST['actions'];
                $list_pages = get_list_page_by_id($id);
                if ($action == '1' && $list_pages['status'] == '2') {
                    $data = array(
                        'status' => '1',
                    );
                    update_page($data, $id);
                } elseif ($action == '2') {
                    $old_thumb = $list_pages['page_thumb'];
                    $new_thumb = str_replace('pages', 'pages/trash', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'status' => '3',
                        'page_thumb' => $new_thumb
                    );
                    update_page($data, $id);
                    delete_image($old_thumb);
                }
                redirect("?mod=page&action=published{$pages}");
            }
        }
    }

    load_view('published');
}

function pendingAction()
{
    global $list_pending, $num_row, $num_per_page, $page, $start, $num_page;
    $num_row = get_num_rows('tbl_pages', "`status` = '1'");
    // Số lượng bản ghi trên trang
    $num_per_page = 3;
    // Tổng số bản ghi
    $total_row = $num_row;
    // Số lượng trang
    $num_page = ceil($total_row / $num_per_page);
    // Lấy trang hiện tại
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    // Chỉ số bản ghi bắt đầu
    $start = ($page - 1) * $num_per_page;

    $list_pending = get_list_page($start, $num_per_page, "`status` = '1'");
    if (isset($_POST['sm_action'])) {
        if (isset($_POST['checkItem'])) {
            isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
            foreach ($_POST['checkItem'] as $id) {
                $action = $_POST['actions'];
                $list_pages = get_list_page_by_id($id);
                if ($action == '1' && $list_pages['status'] == '1') {
                    $approved = user_login();
                    $approval_date = time();
                    $data = array(
                        'status' => '2',
                        'approved' => $approved,
                        'approval_date' => $approval_date
                    );
                    update_page($data, $id);
                } elseif ($action == '2') {
                    $old_thumb = $list_pages['page_thumb'];
                    $new_thumb = str_replace('pages', 'pages/trash', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'status' => '3',
                        'page_thumb' => $new_thumb
                    );
                    update_page($data, $id);
                    delete_image($old_thumb);
                }
                redirect("?mod=page&action=pending{$pages}");
            }
        }
    }

    load_view('pending');
}

function trashAction()
{
    global $list_trash, $num_row, $num_per_page, $page, $start, $num_page;

    $num_row = get_num_rows('tbl_pages', "`status` = '3'");
    // Số lượng bản ghi trên trang
    $num_per_page = 3;
    // Tổng số bản ghi
    $total_row = $num_row;
    // Số lượng trang
    $num_page = ceil($total_row / $num_per_page);
    // Lấy trang hiện tại
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    // Chỉ số bản ghi bắt đầu
    $start = ($page - 1) * $num_per_page;

    $list_trash = get_list_page($start, $num_per_page, "`status` = '3'");
    if (isset($_POST['sm_action'])) {
        if (isset($_POST['checkItem'])) {
            isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
            foreach ($_POST['checkItem'] as $id) {
                $action = $_POST['actions'];
                $list_pages = get_list_page_by_id($id);
                if ($action == '1' && $list_pages['status'] == '3') {
                    $old_thumb = $list_pages['page_thumb'];
                    $new_thumb = str_replace('trash/', '', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'status' => '1',
                        'page_thumb' => $new_thumb
                    );
                    update_page($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '2') {
                    $page_thumb = $list_pages['page_thumb'];
                    $data = array(
                        'status' => '3',
                    );
                    update_page($data, $id);
                    delete_image($page_thumb);
                }
                redirect("?mod=page&action=trash{$pages}");
            }
        }
    }

    load_view('trash');
}

function add_pageAction()
{
    global $error, $success, $page_desc, $page_title, $slug, $page_content, $page_thumb;
    if (isset($_POST['btn-submit'])) {
        $error = array();
        $success = array();

        #.Title
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tiêu đề";
        } else {
            if (is_exists('tbl_pages', 'page_title', $_POST['title'])) {
                $error['title'] = "Trang đã tồn tại!";
            } else {
                $page_title = $_POST['title'];
            }
        }
        #.Slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống slug";
        } else {
            if (is_exists('tbl_pages', 'slug', $_POST['slug'])) {
                $error['slug'] = "Slug đã tồn tại!";
            } else {
                $slug = create_slug($_POST['slug']);
            }
        }
        #.Desc
        if (!empty($_POST['desc'])) {
            $page_desc = $_POST['desc'];
        }
        #.Content 
        if (!empty($_POST['content'])) {
            $page_content = $_POST['content'];
        }

        #.Page_thumb 
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "Size hoặc kiểu ảnh không đúng";
            } else {
                $page_thumb = upload_image("public/images/uploads/pages/", $type);
            }
        } else {
            $error['upload_image'] = "Upload không thàng công";
        }

        #.Kết luận
        if (empty($error)) {
            $creator = user_login();
            $create_date = time();
            $data = array(
                'page_title' => $page_title,
                'slug' => $slug,
                'page_desc' => $page_desc,
                'page_content' => $page_content,
                'create_date' => $create_date,
                'creator' => $creator,
                'page_thumb' => $page_thumb
            );
            addPage($data);
            $success['add_page'] = "Thêm thành công!";
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
    load_view('add_page');
}

function updateAction()
{
    $id = (int)$_GET['id'];
    $list_pages = get_list_page_by_id($id);
    $data['list_pages'] = $list_pages;
    global $error, $success;
    if (isset($_POST['btn-submit'])) {
        $error = array();
        $success = array();

        #.Title
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tiêu đề";
        } else {
            if (is_exists('tbl_pages', 'page_title', $_POST['title'])) {
                $error['title'] = "Trang đã tồn tại!";
            } else {
                $page_title = $_POST['title'];
            }
        }
        #.Slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống slug";
        } else {
            if (is_exists('tbl_pages', 'slug', $_POST['slug'])) {
                $error['slug'] = "Slug đã tồn tại!";
            } else {
                $slug = create_slug($_POST['slug']);
            }
        }
        #.Desc
        if (!empty($_POST['desc'])) {
            $page_desc = $_POST['desc'];
        }
        #.Content 
        if (!empty($_POST['content'])) {
            $page_content = $_POST['content'];
        }

        #.Page_thumb 
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "Size hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = get_url_old_thumb($id);
                if (delete_image($old_thumb)) {
                    $page_thumb = upload_image("public/images/uploads/pages/", $type);
                }
            }
        } else {
            $page_thumb = $list_pages['page_thumb'];
        }

        #.Kết luận
        if (empty($error)) {
            $editor = user_login();
            $edit_date = time();
            $data = array(
                'page_title' => $page_title,
                'slug' => $slug,
                'page_desc' => $page_desc,
                'page_content' => $page_content,
                'edit_date' => $edit_date,
                'editor' => $editor,
                'page_thumb' => $page_thumb
            );
            update_page($data, $id);
            redirect("?mod=page&action=index");
        }
    }

    load_view('edit_page', $data);
}

function deleteAction()
{
    $id = (int)$_GET['id'];
    $list_pages = get_list_page_by_id($id);
    if (!empty($list_pages)) {
        delete_page($id);
        delete_image($list_pages['page_thumb']);
    }
    redirect("?mod=page&action=index");
}
function postAction()
{
    $id = (int)$_GET['id'];
    $list_pages = get_list_page_by_id($id);
    if (!empty($list_pages) && $list_pages['status'] = '1') {
        $approved = user_login();
        $approval_date = time();
        $data = array(
            'status' => '2',
            'approved' => $approved,
            'approval_date' => $approval_date
        );
        update_page($data, $id);
    }
    redirect("?mod=page&action=pending");
}
function restoreAction()
{
    $id = (int)$_GET['id'];
    $list_pages = get_list_page_by_id($id);
    if (!empty($list_pages) && $list_pages['status'] == '3') {
        $old_thumb = $list_pages['page_thumb'];
        $new_thumb = str_replace('trash/', '', $old_thumb);
        copy($old_thumb, $new_thumb);
        $data = array(
            'status' => '1',
            'page_thumb' => $new_thumb
        );
        update_page($data, $id);
        delete_image($old_thumb);
    }
    redirect("?mod=page&action=trash");
}
