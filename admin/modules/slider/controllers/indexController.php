<?php

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction()
{
    load_view('index');
}

function add_sliderAction()
{
    load_view('add_slider');
}

function list_sliderAction()
{
    load_view('list_slider');
}
