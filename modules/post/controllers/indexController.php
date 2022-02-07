<?php
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('lib', 'menu');
    load('helper', 'format');
}

function indexAction()
{
    load_view('index');
}
