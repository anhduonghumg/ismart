<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo base_url(); ?>" target="_self" />
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="public/js/jquery_ui/jquery-ui.css" />
    <!-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css"> -->
</head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0" nonce="3LwOkBH8"></script>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="trangchu.html" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="sanpham.html" title="">Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="tintuc.html" title="">Blog</a>
                                </li>
                                <li>
                                    <a href="gioithieu.html" title="">Giới thiệu</a>
                                </li>
                                <li>
                                    <a href="kiemtradonhang.html" title="">Kiểm tra đơn hàng</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">         
                    <div class="wp-inner">
                        <a href="?" title="" id="logo" class="fl-left"><img src="public/images/logo.png" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="GET" action="tim-kiem" enctype="application/x-www-form-urlencoded">
                                <!-- <input type="hidden" name="mod" value="search">
                                <input type="hidden" name="action" value="index"> -->
                                <input type="text" name="s" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!" autocomplete="off">
                                <button type="submit" id="sm-s">Tìm kiếm</button>
                            </form>
                            <div class="autocomplete-search">
                                <ul id="show-list">
                                  
                                </ul>
                            </div>
                            <div id="loading" class="hidden">Loading&#8230;</div>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0987.654.321</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="giohang.html" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num"><?php echo get_num_order_cart() ?></span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <a href="giohang.html" id="btn-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num"><?php echo get_num_order_cart() ?></span>
                                </a>
                                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart']['buy'])) { ?>
                                    <div id="dropdown">
                                        <p class="desc">Có <span><?php echo get_num_order_cart() ?> sản phẩm</span> trong giỏ hàng</p>
                                        <ul class="list-cart">
                                            <?php foreach ($_SESSION['cart']['buy'] as &$item) { ?>
                                                <li class="clearfix">
                                                    <a href='<?php echo $item['friendly_url'] ?>' title="" class="thumb fl-left">
                                                        <img src="<?php echo $item['product_thumb']  ?>" alt="">
                                                    </a>
                                                    <div class="info fl-right">
                                                        <a href="<?php echo $item['friendly_url'] ?>" title="" class="product-name"><?php echo $item['product_name'] ?></a>
                                                        <p class="price"><?php echo currency_format($item['price']); ?></p>
                                                        <p class="qty">Số lượng: <span><?php echo $item['qty'] ?></span></p>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                        <div class="total-price clearfix">
                                            <p class="title fl-left">Tổng:</p>
                                            <p class="price fl-right"><?php echo currency_format(get_total_cart()) ?></p>
                                        </div>
                                        <div class="action-cart clearfix">
                                            <a href="giohang.html" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                            <a href="thanhtoan.html" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>