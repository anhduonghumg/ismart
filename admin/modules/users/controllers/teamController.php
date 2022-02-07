<?php

function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('lib', 'pagging');
}

function indexAction()
{
    /* Hiển thị danh sách thành viên
     * B1: Chuẩn bị csdl
     * B2: Tạo giao diện
     * B3: Đổ dữ liệu vào giao diện
     * B4: Tạo thanh phân trang
     * B5: Xử Lý các tác vụ
     * B6: Xử lý thanh tìm kiếm
    */

    global $list_users, $list_roles, $num_row, $num_page, $page, $num_per_page, $start;

    $num_row = get_num_rows('tbl_users');
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

    $list_users = get_list_users($start, $num_per_page);

    $list_roles = get_list_roles();

    if (check_role(user_login())) {
        if (isset($_POST['sm_change'])) {
            if (isset($_POST['id'])) {
                foreach ($_POST['id'] as $id) {
                    $new_role = $_POST['new_role'];
                    $data = array(
                        'role' => $new_role
                    );
                    update_user($data, $id);
                    redirect("?mod=users&controller=team");
                }
            }
        }
        if (isset($_POST['sm_action'])) {
            if (isset($_POST['id'])) {
                foreach ($_POST['id'] as $id) {
                    $action = $_POST['actions'];
                    if ($action == '0') {
                        delete_user($id);
                    }
                    redirect("?mod=users&controller=team");
                }
            }
        }
    }

    if (isset($_GET['s']) && !empty($_GET['s'])) {
        $keyword = $_GET['s'];
        $list_users = getAll($keyword);
    }

    load_view('teamIndex');
}
function add_userAction()
{
    /* Thêm mới thành viên
    * B1: Tạo giao diện
    * B2: Kiểm tra quyền tài khoản
    * B3: Validation form
    * B4: Thêm thành viên mới
     */
    if (check_role(user_login())) {
        global $error, $fullname, $username, $password, $email, $phone, $address, $role, $success;
        if (isset($_POST['btn-add'])) {
            $error = array();
            $success = array();
            // họ và tên
            if (empty($_POST['fullname'])) {
                $error['fullname'] = "Không được để trống họ tên";
            } else {
                $fullname = $_POST['fullname'];
            }
            // tên đăng nhập
            if (empty($_POST['username'])) {
                $error['username'] = "Không được để trống tên đăng nhập";
            } else {
                if (!is_username($_POST['username'])) {
                    $error['username'] = "Tên đăng nhập không đúng định dạng";
                } else {
                    $username = $_POST['username'];
                }
            }

            // mật khẩu
            if (empty($_POST['password'])) {
                $error['password'] = "Không được để trống mật khẩu";
            } else {
                if (!is_password($_POST['password'])) {
                    $error['password'] = "Mật khẩu không đúng định dạng";
                } else {
                    $password = md5($_POST['password']);
                }
            }
            // email
            if (empty($_POST['email'])) {
                $error['email'] = "Không được để trống email";
            } else {
                if (!is_email($_POST['email'])) {
                    $error['email'] = "Email không đúng định dạng";
                } else {
                    $email = $_POST['email'];
                }
            }
            //phone
            if (empty($_POST['phone'])) {
                $error['phone'] = "Không được để trống số điện thoại";
            } else {
                if (!is_phone($_POST['phone'])) {
                    $error['phone'] = "Số điện thoại không đúng định dạng";
                } else {
                    $phone = $_POST['phone'];
                }
            }
            // địa chỉ
            if (empty($_POST['address'])) {
                $error['address'] = "Không được để trống địa chỉ";
            } else {
                $address = $_POST['address'];
            }
            // phân quyền
            if (empty($_POST['role'])) {
                $error['role'] = "Bạn chưa chọn quyền thành viên";
            } else {
                $role = $_POST['role'];
            }

            // kết luận
            if (empty($error) && !check_user($username, $email)) {
                // Kiểm tra quyền tài khoản => role == 1
                // thêm thành viên
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'role' => $role
                );
                add_user($data);
                $success['add_users'] = "Thêm thành công!";
            } else {
                $error['add_users'] = "Thêm thất bại!Tên đăng nhập hoặc email đã tồn tại!";
            }
        }
        load_view('add_new');
    } else {
        echo "Bạn không có quyền này!.<a href = '?mod=users&controller=team'>Click vào đây để quay lại!</a>";
    }
}

function edit_userAction()
{
    global $error, $fullname, $phone, $email, $address, $success;
    $id = (int)$_GET['id'];

    if (isset($_POST['btn-submit'])) {
        // show_array($_POST);
        $error = array();
        $success = array();
        //Tên hiển thị
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Tên hiển thị không được để trống";
        } else {
            $fullname = $_POST['fullname'];
        }
        //Số điện thoại
        if (empty($_POST['phone'])) {
            $error['phone'] = "Số điện thoại không được để trống";
        } else {
            if (!is_phone($_POST['phone'])) {
                $error['phone'] = "Số điện thoại gồm 10 số";
            } else {
                $phone = $_POST['phone'];
            }
        }
        //email
        if (empty($_POST['email'])) {
            $error['email'] = "Email không được để trống";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }
        // Địa chỉ
        if (empty($_POST['address'])) {
            $error['address'] = "Địa chỉ không được để trống";
        } else {
            $address = $_POST['address'];
        }

        if (empty($error)) {
            // Cập nhập thông tin
            $data = array(
                'fullname' => $fullname,
                'phone' => $phone,
                'email' => $email,
                'address' => $address
            );
            update_user($data, $id);
            redirect("?mod=users&controller=team");
        } else {
            $success['update'] = "Cập nhập thành công";
            $error['update'] = "Cập nhập thất bại";
        }
    }
    load_view('edit');
}

function delete_userAction()
{
    $id = (int)$_GET['id'];
    delete_user($id);
    redirect("?mod=users&controller=team");
}
