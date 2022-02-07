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

function detail_orderAction()
{
  load_view('detail_order');
}

function list_orderAction()
{
  #.pagging
  $data['num_row'] = get_num_rows('tbl_order', '', '`time_order` DESC');
  $num_per_page = 10;
  $data['num_page'] = ceil($data['num_row'] / $num_per_page);
  $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $start = ($data['page'] - 1) * $num_per_page;

  $list_order = get_list_order($start, $num_per_page);
  $data['list_order'] = $list_order;
  if (isset($_POST['sm_action'])) {
    if (isset($_POST['checkItem'])) {
      isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
      foreach ($_POST['checkItem'] as $id) {
        $action = $_POST['actions'];
        $list_order = get_list_order_by_id($id);
        if ($action == '1' && $list_order['status'] != '1') {
          $data = array(
            'status' => '1'
          );
          update_order($data, $id);
        } elseif ($action == '2' && $list_order['status'] != '2') {
          $data = array(
            'status' => '2',
          );
          update_order($data, $id);
        } elseif ($action == '3' && $list_order['status'] != '3') {
          $data = array(
            'status' => '3'
          );
          update_order($data, $id);
        } elseif ($action == '4' && $list_order['status'] != '4') {
          $data = array(
            'status' => '4'
          );
          update_order($data, $id);
        } elseif ($action == '5' && $list_order['status'] != '5') {
          $data = array(
            'status' => '5'
          );
          update_order($data, $id);
        }
        redirect("?mod=order&action=list_order{$pages}");
      }
    }
  }
  load_view('list_order', $data);
}

function pendingAction()
{
  #.pagging
  $data['num_row'] = get_num_rows('tbl_order', "`status` = '1'", '`time_order` DESC');
  $num_per_page = 10;
  $data['num_page'] = ceil($data['num_row'] / $num_per_page);
  $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $start = ($data['page'] - 1) * $num_per_page;

  $list_order = get_list_order($start, $num_per_page, "`status` = '1'");
  $data['list_order'] = $list_order;
  if (isset($_POST['sm_action'])) {
    if (isset($_POST['checkItem'])) {
      isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
      foreach ($_POST['checkItem'] as $id) {
        $action = $_POST['actions'];
        $list_order = get_list_order_by_id($id);

        if ($action == '2' && $list_order['status'] != '2') {
          $data = array(
            'status' => '2',
          );
          update_order($data, $id);
        } elseif ($action == '5' && $list_order['status'] != '5') {
          $data = array(
            'status' => '5'
          );
          update_order($data, $id);
        }
        redirect("?mod=order&action=pending{$pages}");
      }
    }
  }
  load_view('pending', $data);
}

function transportAction()
{
  #.pagging
  $data['num_row'] = get_num_rows('tbl_order', "`status` = '2'", '`time_order` DESC');
  $num_per_page = 10;
  $data['num_page'] = ceil($data['num_row'] / $num_per_page);
  $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $start = ($data['page'] - 1) * $num_per_page;

  $list_order = get_list_order($start, $num_per_page, "`status` = '2'");
  $data['list_order'] = $list_order;
  if (isset($_POST['sm_action'])) {
    if (isset($_POST['checkItem'])) {
      isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
      foreach ($_POST['checkItem'] as $id) {
        $action = $_POST['actions'];
        $list_order = get_list_order_by_id($id);
        if ($action == '3' && $list_order['status'] != '3') {
          $data = array(
            'status' => '3',
          );
          update_order($data, $id);
        } elseif ($action == '5' && $list_order['status'] != '5') {
          $data = array(
            'status' => '5'
          );
          update_order($data, $id);
        }
        redirect("?mod=order&action=transport{$pages}");
      }
    }
  }
  load_view('transport', $data);
}

function successAction()
{
  #.pagging
  $data['num_row'] = get_num_rows('tbl_order', "`status` = '3'", '`time_order` DESC');
  $num_per_page = 10;
  $data['num_page'] = ceil($data['num_row'] / $num_per_page);
  $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $start = ($data['page'] - 1) * $num_per_page;

  $list_order = get_list_order($start, $num_per_page, "`status` = '3'");
  $data['list_order'] = $list_order;
  if (isset($_POST['sm_action'])) {
    if (isset($_POST['checkItem'])) {
      isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
      foreach ($_POST['checkItem'] as $id) {
        $action = $_POST['actions'];
        $list_order = get_list_order_by_id($id);
        if ($action == '5' && $list_order['status'] != '5') {
          $data = array(
            'status' => '5'
          );
          update_order($data, $id);
        }
        redirect("?mod=order&action=success{$pages}");
      }
    }
  }
  load_view('success', $data);
}

function cancelAction()
{
  #.pagging
  $data['num_row'] = get_num_rows('tbl_order', "`status` = '4'", '`time_order` DESC');
  $num_per_page = 10;
  $data['num_page'] = ceil($data['num_row'] / $num_per_page);
  $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $start = ($data['page'] - 1) * $num_per_page;

  $list_order = get_list_order($start, $num_per_page, "`status` = '4'");
  $data['list_order'] = $list_order;
  if (isset($_POST['sm_action'])) {
    if (isset($_POST['checkItem'])) {
      isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
      foreach ($_POST['checkItem'] as $id) {
        $action = $_POST['actions'];
        $list_order = get_list_order_by_id($id);
        if ($action == '5' && $list_order['status'] != '5') {
          $data = array(
            'status' => '5'
          );
          update_order($data, $id);
        }
        redirect("?mod=order&action=cancel{$pages}");
      }
    }
  }
  load_view('cancel', $data);
}

function trashAction()
{
  #.pagging
  $data['num_row'] = get_num_rows('tbl_order', "`status` = '5'", '`time_order` DESC');
  $num_per_page = 10;
  $data['num_page'] = ceil($data['num_row'] / $num_per_page);
  $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $start = ($data['page'] - 1) * $num_per_page;

  $list_order = get_list_order($start, $num_per_page, "`status` = '5'");
  $data['list_order'] = $list_order;
  if (isset($_POST['sm_action'])) {
    if (isset($_POST['checkItem'])) {
      isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
      foreach ($_POST['checkItem'] as $id) {
        $action = $_POST['actions'];
        $list_order = get_list_order_by_id($id);
        if ($action == '6') {
          delete_order($id);
        }
        redirect("?mod=order&action=trash{$pages}");
      }
    }
  }
  load_view('trash', $data);
}
function searchAction()
{
  if (isset($_GET['s']) && !empty($_GET['s'])) {
    $key = $_GET['s'];

    $data['key'] = $key;
    $data['num_row'] = get_num($key);
    $num_per_page = 5;
    $data['num_page'] = ceil($data['num_row'] / $num_per_page);
    $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($data['page'] - 1) * $num_per_page;

    $list_search = getAllOrder($data['key'], $start, $num_per_page);
  } else {
    redirect("?mod=order&action=list_order");
  }

  if (isset($_POST['sm_action'])) {
    if (isset($_POST['checkItem'])) {
      isset($_GET['page']) ? $pages = "&page={$_GET['page']}" : NULL;
      foreach ($_POST['checkItem'] as $id) {
        $action = $_POST['actions'];
        $list_order = get_list_order_by_id($id);
        if ($action == '1' && $list_order['status'] != '1') {
          $data = array(
            'status' => '1'
          );
          update_order($data, $id);
        } elseif ($action == '2' && $list_order['status'] != '2') {
          $data = array(
            'status' => '2',
          );
          update_order($data, $id);
        } elseif ($action == '3' && $list_order['status'] != '3') {
          $data = array(
            'status' => '3'
          );
          update_order($data, $id);
        } elseif ($action == '4' && $list_order['status'] != '4') {
          $data = array(
            'status' => '4'
          );
          update_order($data, $id);
        } elseif ($action == '5' && $list_order['status'] != '5') {
          $data = array(
            'status' => '5'
          );
          update_order($data, $id);
        }
        redirect("?mod=order&action=search{$pages}");
      }
    }
  }
  $data['list_search'] = $list_search;
  load_view('search', $data);
}

function detailAction()
{
  $id = isset($_GET['id']) ? $_GET['id'] : null;
  $detail_order = get_detail_order($id);
  $data['detail_order'] = $detail_order;
  $list_product_order = get_product_order($id);
  $data['list_product_order'] = $list_product_order;

  if (isset($_POST['sm_note'])) {
    if (!empty($_POST['note'])) {
      $note = $_POST['note'];
    } else {
      $note = $_POST['note'];
    }
    $data = array(
      'time_note' => time(),
      'admin_note' => $note
    );
    add_note($data, $id);
    redirect("?mod=order&action=detail&id={$id}");
  }

  if (isset($_POST['sm_status'])) {
    if (!empty($_POST['status'])) {
      $status = $_POST['status'];
    } else {
      $status = $_POST['status'];
    }
    $data_status = array(
      'status' => $status
    );
    update_status($data_status, $id);
    redirect("?mod=order&action=detail&id={$id}");
  }

  load_view('detail_order', $data);
}
