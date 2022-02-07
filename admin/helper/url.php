<?php

function base_url($url = "")
{
    global $config;
    return $config['base_url'] . $url;
}
function redirect($url = "")
{
    global $config;
    $path = $config['base_url'] . $url;
    header("Location: {$path}");
}

function get_url()
{
    $show = isset($_GET['show']) ? $_GET['show'] : NULL;
    $price = isset($_GET['r-price']) ? $_GET['r-price'] : NULL;
    $brand = isset($_GET['brand']) ? $_GET['r-brand'] : NULL;
    if (!empty($show)) {
        return "show={$show}";
    } elseif (!empty($price)) {
        return "r-price={$price}";
    } elseif (!empty($brand)) {
        return "r-brand={$brand}";
    }
}

// function curPageURL()
// {

//     $pageURL = 'http';

//     if ($_SERVER['HTTPS'] == 'on') {

//         $pageURL .= 's';
//     }

//     $pageURL .= "://";

//     if ($_SERVER['SERVER_PORT'] != '80') {

//         $pageURL .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
//     } else {

//         $pageURL .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
//     }

//     return $pageURL;
// }
