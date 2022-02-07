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

function add_widgetAction()
{
    load_view('add_widget');
}

function list_widgetAction()
{
    load_view('list_widget');
}
