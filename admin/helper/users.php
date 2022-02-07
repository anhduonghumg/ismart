<?php
// function check_login($username, $password)
// {
//     global $list_users;
//     foreach ($list_users as $user) {
//         if ($username == $user['username'] && $password == $user['passwrod']) {
//             return true;
//         }
//         return false;
//     }
// }

// Trả về true nếu đã login
function is_login()
{
    if (isset($_SESSION['is_login']))
        return true;
    return false;
}

// Trả về username của người login
function user_login()
{
    if (!empty($_SESSION['user_login'])) {
        return $_SESSION['user_login'];
    }
    return false;
}


// Trả về thông tin của tài khoản login
function info_user($field = 'id')
{
    $list_users = db_fetch_array("SELECT * FROM `tbl_users`");
    if (isset($_SESSION['is_login'])) {
        foreach ($list_users as $user) {
            if ($_SESSION['user_login'] == $user['username']) {
                if (array_key_exists($field, $user)) {
                    return $user[$field];
                }
            }
        }
    }
}

function show_role($role)
{
    $list_role = array(
        '1' => 'Quản lý',
        '2' => 'Biên tập viên',
        '3' => 'Cộng tác viên',
    );
    if (array_key_exists($role, $list_role)) {
        return $list_role[$role];
    }
}

function show_status($field)
{
    $list_status = array(
        '0' => 'Không hoạt động',
        '1' => 'Đang hoạt động'
    );
    if (array_key_exists($field, $list_status))
        return $list_status[$field];
}


