<?php
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

function add_newAction()
{
    global $error, $username, $password, $email, $fullname;
    // echo send_mail('hotboydanhtinh9999@gmail.com', 'Nguyễn Anh Dương', 'Kích hoạt tài khoản', "<a href='http://unitop.vn'>Kích hoạt</a>");
    if (isset($_POST['btn-add'])) {
        $error = array();
        #.Kiểm tra fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống họ và tên";
        } else {
            $fullname = $_POST['fullname'];
        }
        #.Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }
        #.Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }
        #.Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }

        #.Kết luận
        if (empty($error)) {
            if (!user_exists($username, $email)) {
                $active_token = md5($username . time());
                $reg_date = time();
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'active_token' => $active_token,
                    'reg_date' => $reg_date
                );
                add_user($data);
                echo "Đăng ký thành công,bạn cần kích hoạt tài khoản này trong vòng 24h nếu trong 24h bạn chưa kích hoạt tài khoản sẽ bị xóa!";
                $link_active = base_url("?mod=users&action=active&active_token={$active_token}");
                $content = "<p>Chào bạn {$fullname}</p>
                <p>Bạn vui lòng click vào đường link này để kích hoạt tài khoản: {$link_active}</p>
                <p>Nếu không phải bạn vui lòng bỏ qua email này</p>
                <p>Team support NAD-Global</p>";

                send_mail('hotboydanhtinh9999@gmail.com', 'Nguyễn Anh Dương', 'Kích hoạt tài khoản PHP MASTER', $content);
                // Thông báo
                // redirect("?mod=users&action=login");
            } else {
                $error['account'] = "Email hoặc username đã tồn tại trên hệ thống";
            }
        }
    }
    load_view('add_new');
}

function loginAction()
{
    // echo time();
    // echo date("d/m/Y h:m:s");
    global $error, $username, $password, $status;
    if (isset($_POST['btn-login'])) {
        $error = array();

        #.Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }
        #.Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }
        #.Kết luận
        if (empty($error)) {
            if (check_login($username, $password)) {
                // lưu trữ phiên đăng nhập 
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;

                $data = array(
                    'status' => '1'
                );
                update_last_login($data, user_login());
                // Chuyển hướng vào hệ thốnng
                redirect("");
            } else {
                $error['account'] = "Username hoặc password không đúng.Xin vui lòng nhập lại!";
            }
        }
    }

    load_view('login');
}

function logoutAction()
{

    $data = array(
        'status' => '0'
    );
    update_last_login($data, user_login());

    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);

    redirect("?mod=users&action=login");
}

function resetAction()
{

    /* Thay đổi mật khẩu
    * B1: Tạo giao diện
    * B2: Validation form
    * B3: Xác thực mật khẩu của tài khoản
    * B4: Cập nhập mật khẩu mới
     */

    global $pass_old, $pass_new, $confirm_pass, $error, $success;
    if (isset($_POST['btn-submit'])) {
        $error = array();
        $success = array();
        // Mật khẩu cũ
        if (empty($_POST['pass-old'])) {
            $error['pass-old'] = "Không được để trống mật khẩu!";
        } else {
            if (!is_password($_POST['pass-old'])) {
                $error['pass-old'] = "Mật khẩu không đúng định dạng vui lòng nhập lại!";
            } else {
                $pass_old = md5($_POST['pass-old']);
            }
        }
        // Mật khẩu mới
        if (empty($_POST['pass-new'])) {
            $error['pass-new'] = "Không được để trống mật khẩu!";
        } else {
            if (!is_password($_POST['pass-new'])) {
                $error['pass-new'] = "Mật khẩu không đúng định dạng vui lòng nhập lại!";
            } else {
                $pass_new = md5($_POST['pass-new']);
            }
        }
        // Xác nhận lại mật khẩu mới
        if (empty($_POST['confirm-pass'])) {
            $error['confirm-pass'] = "Không được để trống mật khẩu!";
        } else {
            if (!is_password($_POST['confirm-pass'])) {
                $error['confirm-pass'] = "Mật khẩu không đúng định dạng vui lòng nhập lại!";
            } else {
                $confirm_pass = md5($_POST['confirm-pass']);
            }
        }

        // Kết luận
        if (empty($error)) {

            // Xác thực mật khẩu cũ
            if (check_pass($pass_old, user_login())) {
                if ($pass_new == $confirm_pass) {
                    $data = array(
                        'password' => $pass_new
                    );
                    update_pass(user_login(), $data);
                    $success['reset_pass'] = "Đổi mật khẩu thành công!";
                } else {
                    $error['confim-pass'] = "Mật khẩu mới không khớp.Vui lòng nhập lại";
                }
            } else {
                $error['reset_pass'] = "Thay đổi mật khẩu thất bại!";
            }
        }
    }
    load_view('reset');
}


function lost_passAction()
{
    load_view('reset');
}

function updateAction()
{
    /* Cập nhập thông tin tài khoản 
    * B1: Tạo giao diện
    * B2: Validation form
    * B3: Load lại thông tin cũ
    * B4: Cập nhập thông tin mới
    */
    global $error, $username, $fullname, $phone, $email, $address;
    if (isset($_POST['btn-submit'])) {
        // show_array($_POST);
        $error = array();
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
            update_info_user(user_login(), $data);
        } else {
            $error['update'] = "Cập nhập thất bại";
        }
    }
    load_view('update');
}
