<?php

function is_username($username)
{
    $partten = "/^[A-Za-z0-9_\.]{3,32}$/";
    if (!preg_match($partten, $username, $matchs)) {
        return false;
    }
    return true;
}

function is_password($password)
{
    $partten = "/^([\w_\.!@#$%^&*()]+){5,32}$/";
    if (!preg_match($partten, $password, $matchs)) {
        return false;
    }
    return true;
}

function is_email($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}
function is_phone($phone)
{
    $partten = "/^([0-9]){10}$/";
    if (!preg_match($partten, $phone, $matchs))
        return false;
    return true;
}
// function is_number($number)
// {
//     $partten = "/\d/";
//     if (!preg_match($partten, $number, $matchs))
//         return false;
//     return true;
// }
function is_image($file_type, $file_size)
{
    $type_allow = array('png', 'jpg', 'gif', 'jpeg');

    if (!in_array(strtolower($file_type), $type_allow)) {
        return false;
    } else {
        if ($file_size > 29000000) {
            return false;
        }
    }
    return true;
}
function form_error($lable_field)
{
    global $error;
    if (!empty($error[$lable_field])) return "<p class = 'error'>{$error[$lable_field]}</p>";
}
function form_success($lable_field)
{
    global $success;
    if (!empty($success[$lable_field])) return "<p class = 'error'>{$success[$lable_field]}</p>";
}
function set_value($lable_field)
{
    global $$lable_field;
    if (!empty($$lable_field)) return $$lable_field;
}

function phpAlert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
