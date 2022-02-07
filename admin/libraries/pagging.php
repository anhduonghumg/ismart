<?php
function get_pagging($num_page, $page, $base_url = "")
{
    $str_pagging = "<ul id='list-pagging' class='fl-right'>";
    if ($page > 1) {
        $page_prev = $page - 1;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$page_prev}\">Trước</a></li>";
    }
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page) $active = "class = 'active'";
        $str_pagging .= "<li {$active}><a href = \"{$base_url}&page={$i}\">{$i}</a></li>";
    }
    if ($page < $num_page) {
        $page_next = $page + 1;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$page_next}\">Sau</a></li>";
    }
    $str_pagging .= "</ul>";
    return $str_pagging;
}


function pagging($num_page, $page, $base_url = "")
{
    $str_pagging = "<ul id='list-pagging' class='fl-right'>";

    if ($page > 1) {
        $page_prev = $page - 1;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$page_prev}\">Trước</a></li>";
    }

    if ($page > 3) {
        $first = 1;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$first}\">{$first}</a></li>";
    }

    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page) $active = "class = 'active'";
        if ($i > $page - 3 && $i < $page + 3) {
            $str_pagging .= "<li {$active}><a href = \"{$base_url}&page={$i}\">{$i}</a></li>";
        }
    }

    if ($page < $num_page - 3) {
        $end = $num_page;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$end}\">{$end}</a></li>";
    }

    if ($page < $num_page) {
        $page_next = $page + 1;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$page_next}\">Sau</a></li>";
    }

    $str_pagging .= "</ul>";
    return $str_pagging;
}
