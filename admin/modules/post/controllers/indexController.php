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

function add_postAction()
{
    global $error, $success, $post_desc, $post_title, $slug, $post_content, $post_thumb, $post_cat;
    if (isset($_POST['btn-submit'])) {
        $error = array();
        $success = array();

        #.Title
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tiêu đề";
        } else {
            if (is_exists('tbl_posts', 'post_title', $_POST['title'])) {
                $error['title'] = "Trang đã tồn tại!";
            } else {
                $post_title = $_POST['title'];
            }
        }
        #.Slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống slug";
        } else {
            if (is_exists('tbl_posts', 'slug', $_POST['slug'])) {
                $error['slug'] = "Slug đã tồn tại!";
            } else {
                $slug = create_slug($_POST['slug']);
            }
        }
        #.Desc
        if (!empty($_POST['desc'])) {
            $post_desc = $_POST['desc'];
        }
        #.Content 
        if (!empty($_POST['content'])) {
            $post_content = $_POST['content'];
        }

        #.Post_thumb 
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "Size hoặc kiểu ảnh không đúng";
            } else {
                $post_thumb = upload_image("public/images/uploads/posts/", $type);
            }
        } else {
            $error['upload_image'] = "Upload không thàng công";
        }

        #.Post_cat
        if (empty($_POST['parent-Cat'])) {
            $error['post_cat'] = "Bạn chưa chọn danh mục.";
        } else {
            $post_cat = $_POST['parent-Cat'];
        }
        #.Kết luận
        if (empty($error)) {
            $creator = user_login();
            $create_date = time();
            $data = array(
                'post_title' => $post_title,
                'slug' => $slug,
                'post_desc' => $post_desc,
                'post_content' => $post_content,
                'create_date' => $create_date,
                'creator' => $creator,
                'post_thumb' => $post_thumb,
                'post_cat_id' => $post_cat
            );
            addPost($data);
            $success['add_post'] = "Thêm thành công!";
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

    $get_list_cat = get_list_cat();
    $list_cat = data_tree($get_list_cat);
    $data['list_cat'] =  $list_cat;

    load_view("add_post", $data);
}

function list_postAction()
{
    #.pagging
    $data['num_row'] = get_num_rows('tbl_posts');
    $num_per_page = 3;
    $data['num_page'] = ceil($data['num_row'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $list_post = get_list_post($start, $num_per_page);
    $data['list_post'] = $list_post;

    if (isset($_POST['sm_action'])) {
        if (isset($_POST['checkItem'])) {
            isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
            foreach ($_POST['checkItem'] as $id) {
                $action = $_POST['actions'];
                $list_post = get_list_post_by_id($id);
                if ($action == '1' && $list_post['post_status'] == '2') {
                    $data = array(
                        'post_status' => '1'
                    );
                    update_post($data, $id);
                } elseif ($action == '1' && $list_post['post_status'] == '3') {
                    $old_thumb = $list_post['post_thumb'];
                    $new_thumb = str_replace('trash/', '', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'post_status' => '1',
                        'post_thumb' => $new_thumb
                    );
                    update_post($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '2') {
                    $old_thumb = $list_post['post_thumb'];
                    $new_thumb = str_replace('posts', 'posts/trash', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'post_status' => '3',
                        'post_thumb' => $new_thumb
                    );
                    update_post($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '3' && $list_post['post_status'] != '2' && $list_post['post_status'] != '3') {
                    $approved = user_login();
                    $approval_date = time();
                    $data = array(
                        'post_status' => '2',
                        'approved' => $approved,
                        'approval_date' => $approval_date
                    );
                    update_post($data, $id);
                }
                redirect("?mod=post&action=list_post{$pages}");
            }
        }
    }
    load_view("list_post", $data);
}

function searchAction()
{
    if (isset($_GET['s']) && !empty($_GET['s'])) {

        $key = $_GET['s'];

        $data['key'] = $key;
        $data['num_row'] = get_num_rows('tbl_posts', "`post_id` LIKE '%$key%' OR `post_title` LIKE '%$key%' OR `creator` LIKE '%$key%' OR `create_date` LIKE '%$key%'");
        $num_per_page = 3;
        $data['num_page'] = ceil($data['num_row'] / $num_per_page);
        $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($data['page'] - 1) * $num_per_page;

        $list_search = getAllPost($data['key'], $start, $num_per_page);
    } else {
        redirect("?mod=post&action=list_post");
    }

    if (isset($_POST['sm_action'])) {
        if (isset($_POST['checkItem'])) {
            isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
            foreach ($_POST['checkItem'] as $id) {
                $action = $_POST['actions'];
                $list_post = get_list_post_by_id($id);
                if ($action == '1' && $list_post['post_status'] == '2') {
                    $data = array(
                        'post_status' => '1'
                    );
                    update_post($data, $id);
                } elseif ($action == '1' && $list_post['post_status'] == '3') {
                    $old_thumb = $list_post['post_thumb'];
                    $new_thumb = str_replace('trash/', '', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'post_status' => '1',
                        'post_thumb' => $new_thumb
                    );
                    update_post($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '2') {
                    $old_thumb = $list_post['post_thumb'];
                    $new_thumb = str_replace('posts', 'posts/trash', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'post_status' => '3',
                        'post_thumb' => $new_thumb
                    );
                    update_post($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '3' && $list_post['post_status'] != '2' && $list_post['post_status'] != '3') {
                    $approved = user_login();
                    $approval_date = time();
                    $data = array(
                        'post_status' => '2',
                        'approved' => $approved,
                        'approval_date' => $approval_date
                    );
                    update_post($data, $id);
                }
                redirect("?mod=post&action=list_post{$pages}");
            }
        }
    }
    $data['list_search'] = $list_search;
    load_view("search", $data);
}

function updateAction()
{
    global $error, $success;
    $id = (int)$_GET['id'];
    $list_post = get_list_post_by_id($id);
    $list_cat = get_list_cat();
    $get_list_cat = data_tree($list_cat);

    $data['list_post'] = $list_post;
    $data['list_cat'] = $get_list_cat;

    if (isset($_POST['btn-submit'])) {
        $error = array();
        $success = array();

        #.Title
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tiêu đề";
        } else {
            $post_title = $_POST['title'];
        }
        #.Slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống slug";
        } else {
            $slug = create_slug($_POST['slug']);
        }

        #.Desc
        if (!empty($_POST['desc'])) {
            $post_desc = $_POST['desc'];
        }
        #.Content 
        if (!empty($_POST['content'])) {
            $post_content = $_POST['content'];
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
                    $post_thumb = upload_image("public/images/uploads/posts/", $type);
                }
            }
        } else {
            $post_thumb = $list_post['post_thumb'];
        }

        #.catagory
        if (empty($_POST['parent-Cat'])) {
            $parent_cat = $list_post['post_cat_id'];
        } else {
            $parent_cat = $_POST['parent-Cat'];
        }


        #.Kết luận
        if (empty($error)) {
            $editor = user_login();
            $edit_date = time();
            $data = array(
                'post_title' => $post_title,
                'slug' => $slug,
                'post_desc' => $post_desc,
                'post_content' => $post_content,
                'edit_date' => $edit_date,
                'editor' => $editor,
                'post_thumb' => $post_thumb,
                'post_cat_id' => $parent_cat
            );
            update_post($data, $id);
            redirect("?mod=post&action=list_post");
        }
    }

    load_view("update_post", $data);
}

function deleteAction()
{
    $id = (int)$_GET['id'];
    $list_post = get_list_post_by_id($id);
    if (!empty($list_post)) {
        delete_post($id);
        delete_image($list_post['post_thumb']);
    }
    redirect("?mod=post&action=list_post");
}


function pendingAction()
{
    #.pagging
    $data['num_row'] = get_num_rows('tbl_posts');
    $num_per_page = 3;
    $data['num_page'] = ceil($data['num_row'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $list_post = get_list_post($start, $num_per_page, "post_status='1'");
    $data['list_post'] = $list_post;

    if (isset($_POST['sm_action'])) {
        if (isset($_POST['checkItem'])) {
            isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
            foreach ($_POST['checkItem'] as $id) {
                $action = $_POST['actions'];
                $list_post = get_list_post_by_id($id);
                if ($action == '2') {
                    $old_thumb = $list_post['post_thumb'];
                    $new_thumb = str_replace('posts', 'posts/trash', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'post_status' => '3',
                        'post_thumb' => $new_thumb
                    );
                    update_post($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '3' && $list_post['post_status'] != '2' && $list_post['post_status'] != '3') {
                    $approved = user_login();
                    $approval_date = time();
                    $data = array(
                        'post_status' => '2',
                        'approved' => $approved,
                        'approval_date' => $approval_date
                    );
                    update_post($data, $id);
                }
                redirect("?mod=post&action=list_post{$pages}");
            }
        }
    }
    load_view("pending", $data);
}

function trashAction()
{
    #.pagging
    $data['num_row'] = get_num_rows('tbl_posts');
    $num_per_page = 3;
    $data['num_page'] = ceil($data['num_row'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $list_post = get_list_post($start, $num_per_page, "post_status='3'");
    $data['list_post'] = $list_post;

    if (isset($_POST['sm_action'])) {
        if (isset($_POST['checkItem'])) {
            isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
            foreach ($_POST['checkItem'] as $id) {
                $action = $_POST['actions'];
                $list_post = get_list_post_by_id($id);
                if ($action == '1' && $list_post['post_status'] == '2') {
                    $data = array(
                        'post_status' => '1'
                    );
                    update_post($data, $id);
                } elseif ($action == '1' && $list_post['post_status'] == '3') {
                    $old_thumb = $list_post['post_thumb'];
                    $new_thumb = str_replace('trash/', '', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'post_status' => '1',
                        'post_thumb' => $new_thumb
                    );
                    update_post($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '4') {
                    $thumb = $list_post['post_thumb'];
                    delete_post($id);
                    delete_image($thumb);
                }
                redirect("?mod=post&action=list_post{$pages}");
            }
        }
    }
    load_view("trash", $data);
}

function publishAction()
{
    #.pagging
    $data['num_row'] = get_num_rows('tbl_posts');
    $num_per_page = 3;
    $data['num_page'] = ceil($data['num_row'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $list_post = get_list_post($start, $num_per_page, "post_status='2'");
    $data['list_post'] = $list_post;

    if (isset($_POST['sm_action'])) {
        if (isset($_POST['checkItem'])) {
            isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
            foreach ($_POST['checkItem'] as $id) {
                $action = $_POST['actions'];
                $list_post = get_list_post_by_id($id);
                if ($action == '1' && $list_post['post_status'] == '2') {
                    $data = array(
                        'post_status' => '1'
                    );
                    update_post($data, $id);
                } elseif ($action == '1' && $list_post['post_status'] == '3') {
                    $old_thumb = $list_post['post_thumb'];
                    $new_thumb = str_replace('trash/', '', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'post_status' => '1',
                        'post_thumb' => $new_thumb
                    );
                    update_post($data, $id);
                    delete_image($old_thumb);
                } elseif ($action == '2') {
                    $old_thumb = $list_post['post_thumb'];
                    $new_thumb = str_replace('posts', 'posts/trash', $old_thumb);
                    copy($old_thumb, $new_thumb);
                    $data = array(
                        'post_status' => '3',
                        'post_thumb' => $new_thumb
                    );
                    update_post($data, $id);
                    delete_image($old_thumb);
                }
                redirect("?mod=post&action=list_post{$pages}");
            }
        }
    }
    load_view("publish", $data);
}
