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
    // /((09|03|07|08|05)+([0-9]{8})\b)/g
    $partten = "/^(09|03|07|08|05)+([0-9]{8})$/";
    if (!preg_match($partten, $phone, $matchs)) {
        return false;
    }
    return true;
}
function form_error($lable_field)
{
    global $error;
    if (!empty($error[$lable_field])) return "<p class = 'error'>{$error[$lable_field]}</p>";
}

function set_value($lable_field)
{
    global $$lable_field;
    if (!empty($$lable_field)) return $$lable_field;
}
