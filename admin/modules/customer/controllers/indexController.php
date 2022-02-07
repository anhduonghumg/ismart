<?php

function construct()
{
  load_model('index');
  load('helper', 'format');
  load('lib', 'pagging');
}

function indexAction()
{
  load_view('index');
}

function list_customerAction()
{
  #.pagging
  $data['num_row'] = get_num_rows('tbl_customers', '', '`total_spend` DESC');
  $num_per_page = 10;
  $data['num_page'] = ceil($data['num_row'] / $num_per_page);
  $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $start = ($data['page'] - 1) * $num_per_page;

  if (isset($_POST['sm_action'])) {
    if (isset($_POST['checkAll'])) {
      isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
      foreach ($_POST['checkAll'] as &$id) {
        $action = $_POST['actions'];
        if ($action == '1') {
          delete_customer($id);
        }
        redirect("?mod=customer&action=list_customer{$pages}");
      }
    }
  }

  $list_customers = get_list_customers($start, $num_per_page);
  $data['list_customers'] = $list_customers;

  load_view('list_customer', $data);
}


function searchAction()
{
  if (isset($_GET['s']) && !empty($_GET['s'])) {
    $key = $_GET['s'];
    $data['key'] = $key;
    $data['num_row'] = get_num_rows('tbl_customers', " `fullname` LIKE '%$key%' OR  `email` LIKE '%$key%' OR `address` LIKE '%$key%'");
    $num_per_page = 5;
    $data['num_page'] = ceil($data['num_row'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $list_search = get_all_customer($data['key'], $start, $num_per_page);
  } else {
    redirect("?mod=customer&action=list_customer");
  }

  if (isset($_POST['sm_action'])) {
    if (isset($_POST['checkAll'])) {
      isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
      foreach ($_POST['checkAll'] as &$id) {
        $action = $_POST['actions'];
        if ($action == '1') {
          delete_customer($id);
        }
        redirect("?mod=customer&action=list_customer{$pages}");
      }
    }
  }
  $data['list_search'] = $list_search;
  load_view('search', $data);
}
