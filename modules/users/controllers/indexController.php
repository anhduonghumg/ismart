<?php
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}
function regAction()
{
    global $error, $username, $password, $email, $fullname;
    // echo send_mail('hotboydanhtinh9999@gmail.com', 'Nguyễn Anh Dương', 'Kích hoạt tài khoản', "<a href='http://unitop.vn'>Kích hoạt</a>");
    if (isset($_POST['btn-reg'])) {
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
    load_view('reg');
}

function activeAction()
{
    $active_token = $_GET['active_token'];
    $link_login = base_url("?mod=users&action=login");
    if (check_active_token($active_token)) {
        active_user($active_token);
        echo "Bạn đã click hoạt thành công,vui lòng click vào đây để đăng nhập:<a href = '{$link_login}'>Đăng nhập</a>";
    } else {
        echo "Yêu cầu kích hoạt không thành công hoặc tài khoản đã được kích hoạt trước đó!Vui lòng click vào đây để đăng nhập:<a href = '{$link_login}'>Đăng nhập</a>";
    }
}


function loginAction()
{
    global $error, $username, $password;
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
                // Chuyển hướng vào hệ thốnng
                redirect("");
            } else {
                $error['account'] = "Username hoặc password không đúng.Xin vui lòng nhập lại!";
            }
        }
    }

    // Xóa tài khoản ko active
    $time_now = time();
    delete_user_not_active($time_now);

    load_view('login');
}

function logoutAction()
{
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&action=login");
}

function resetAction()
{
    global $error, $email, $password;
    $reset_token = $_GET['reset_token'];
    if (!empty($reset_token)) {
        // Kiểm tra mã reset_token
        if (check_reset_token($reset_token)) {
            if (isset($_POST['btn-newPass'])) {
                $error = array();
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
                #.kết luận
                if (empty($error)) {
                    $data = array('password' => $password);
                    update_pass($data, $reset_token);
                    redirect("?mod=users&action=resetOk");
                }
            }
            load_view("newPass");
        } else {
            echo "Yêu cầu lấy lại mật khẩu không hợp lệ";
        }
    } else {
        if (isset($_POST['btn-reset'])) {
            $error = array();

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
                if (check_email($email)) {
                    // Tạo mã token reset pass
                    $reset_token = md5($email . time());
                    $data = array('reset_token' => $reset_token);
                    // cập nhập lại mã reset cho user
                    update_reset_token($data, $email);
                    // Gửi link khôi phục email cho người dùng
                    $link_reset = base_url("?mod=users&action=reset&reset_token={$reset_token}");
                    $content = "<p>Bạn vui lòng lick vào link sau để khôi phục lại mật khẩu: {$link_reset}</p>
                <p>Nếu không yêu cầu của bạn,vui lòng bỏ qua email này.</p>
                <p>NAD-GLOBAL TEAM SUPPORT</p>";
                    send_mail($email, '', 'Khôi phục mật khẩu PHP-MASTER', $content);
                } else {
                    $error['account'] = "Email Không tồn tại trên hệ thống!";
                }
            }
        }

        load_view('reset');
    }
}

function resetOkAction()
{
    load_view('resetOk');
}

function lost_passAction()
{
    load_view('reset');
}
