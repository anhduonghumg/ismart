<?php

function add_user($data)
{
    return db_insert('tbl_users', $data);
}

function check_user($username, $email)
{
    $list_user = db_fetch_array("SELECT * FROM `tbl_users`");
    foreach ($list_user as $user) {
        if ($username == $user['username'] && $email == $user['email'])
            return true;
    }
    return false;
}

function get_list_users($start = 1, $num_per_page = 3, $where = '')
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_users` {$where} LIMIT {$start},{$num_per_page}");
    return $result;
}

function get_list_roles()
{
    $result = db_fetch_array("SELECT * FROM `tbl_roles`");
    return $result;
}

function get_user_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}

function get_info_user()

{
    $id = (int)$_GET['id'];
    $result = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $result;
}

function check_login($username, $password)
{
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username}' AND `password` = '{$password}'");
    if ($check > 0)
        return true;
    return false;
}

function check_email($email)
{
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `email` = '{$email}'");
    if ($check > 0)
        return true;
    return false;
}

function update_info_user($username, $data)
{
    return db_update('tbl_users', $data, "`username` = '{$username}'");
}

function  update_user($data, $id)
{
    return db_update('tbl_users', $data, "`user_id` = '{$id}'");
}

function check_pass($pass_old, $username)
{
    $check = db_fetch_array("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    foreach ($check as $item) {
        if ($pass_old == $item['password'])
            return true;
    }
    return false;
}

function update_pass($username, $data)
{
    return db_update('tbl_users', $data, "`username` = '{$username}'");
}

function update_last_login($data, $username)
{
    return db_update('tbl_users', $data, "`username` = '{$username}'");
}

function delete_user($id)
{
    return db_delete('tbl_users', "`user_id` = '{$id}'");
}

function check_role($username)
{
    $check = db_fetch_array("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    foreach ($check as $item) {
        if ($item['role'] == '1')
            return true;
    }
    return false;
}
function search($k)
{
    $search = db_fetch_array("SELECT * FROM `tbl_users` WHERE `fullname` LIKE '" . $k . "%'");
    return $search;
}
function getAll($k)
{
    $result = db_fetch_array("SELECT * FROM `tbl_users` WHERE `fullname` LIKE '%$k%' OR `username` LIKE '%$k%' OR `email` LIKE '%$k%' OR `address` LIKE '%$k%'");
    return $result;
}
