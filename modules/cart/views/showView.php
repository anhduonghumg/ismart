<?php get_header(); ?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="gio-hang.html" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php if (!empty($list_buy)) { ?>
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="info-cart-wp">
                <div class="section-detail table-responsive">
                    <form action="?mod=cart&action=update" method="POST">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Mã sản phẩm</td>
                                    <td>Ảnh sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Giá sản phẩm</td>
                                    <td>Số lượng</td>
                                    <td colspan="2">Thành tiền</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list_buy as &$item) { ?>
                                    <tr>
                                        <td><?php echo $item['code']; ?></td>
                                        <td>
                                            <a href="<?php echo $item['friendly_url'] ?>" title="" class="thumb">
                                                <img src="<?php echo $item['product_thumb']; ?>" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo $item['friendly_url'] ?>" title="" class="name-product"><?php echo $item['product_name'] ?></a>
                                        </td>
                                        <td><?php echo currency_format($item['price']); ?></td>
                                        <td>
                                            <input type="number" min='1' max='10' data-id="<?php echo $item['id']; ?>" name="qty[<?php echo $item['id']; ?>]" value="<?php echo $item['qty'] ?>" class="num-order">
                                        </td>
                                        <td id="sub-total-<?php echo $item['id']; ?>"><?php echo currency_format($item['sub_total']); ?></td>
                                        <td>
                                            <a href="xoa/<?php echo $item['id'] ?>" data-del=<?php echo $item['id']; ?> title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <p id="total-price" class="fl-right">Tổng giá: <span><?php echo currency_format(get_total_cart()) ?></span></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <div class="fl-right">
                                                <!-- <input type="submit" id="update-cart" name="btn_update_cart" value="Cập nhập giỏ hàng"> -->
                                                <a href="thanhtoan.html" title="" id="checkout-cart">Thanh toán</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
            <div class="section" id="action-cart-wp">
                <div class="section-detail">
                    <p class="title">Click vào <span>“Thanh toán”</span> để hoàn tất mua hàng.</p>
                    <a href="?" title="" id="buy-more">Mua tiếp</a><br />
                    <a href="xoa-tat-ca" title="" id="delete-cart">Xóa giỏ hàng</a>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <p class="empty">Không có sản phẩm nào trong giỏ hàng.<a href="?">Tiếp tục mua sắm!<a></p>
    <?php } ?>
</div>
<?php get_footer(); ?>