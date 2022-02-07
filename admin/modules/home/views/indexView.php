<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page menu-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="list_bock">
                <ul>
                    <li>
                        <div class="box-1">
                            <div class="content">
                                <h2>Đơn hàng thành công</h2>
                                <p><?php echo $order_success; ?></p>
                                <p>Đơn hàng giao dịch</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="box-2">
                            <div class="content">
                                <h2>Đang xử lý</h2>
                                <p><?php echo $order_pending ?></p>
                                <p>Đơn hàng giao dịch thành công</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="box-3">
                            <div class="content">
                                <h2>Doanh số</h2>
                                <p><?php echo currency_format($renvenue) ?></p>

                                <p>Doanh số hệ thống</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="box-4">
                            <div class="content">
                                <h2>Đơn hàng hủy</h2>
                                <p><?php echo $order_cancel ?></p>
                                <p>Số đơn bị hủy trong hệ thống</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="table-responsive">
                <?php if (!empty($list_order)) { ?>
                    <table class="table list-table-wp">
                        <thead>
                            <h1 style="font-weight: bold;font-size:18px">ĐƠN HÀNG MỚI</h1>
                            <tr>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Mã</span></td>
                                <td><span class="thead-text">Khách hàng</span></td>
                                <td><span class="thead-text">Số lượng sản phẩm</span></td>
                                <td><span class="thead-text">Giá trị</span></td>
                                <td><span class="thead-text">Thời gian</span></td>
                                <td><span class="thead-text">Trạng thái</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $temp = 0;
                            foreach ($list_order as $order) {
                                $temp++;
                            ?>

                                <tr>
                                    <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                                    <td><span class="tbody-text"><?php echo $order['order_code'] ?></h3></span>
                                    <td><span class="tbody-text"><?php echo get_fullname_customer($order['customer_id']) ?></span></td>
                                    <td><span class="tbody-text"><?php echo $order['total_item'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo currency_format($order['total_price']) ?></span></td>
                                    <td><span class="tbody-text"><?php echo time_format($order['time_order']) ?></span></td>
                                    <td><span class="tbody-text"><?php echo status_order($order['status']) ?></span></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Mã</span></td>
                                <td><span class="thead-text">Khách hàng</span></td>
                                <td><span class="thead-text">Số lượng</span></td>
                                <td><span class="thead-text">Giá trị</span></td>
                                <td><span class="thead-text">Thời gian</span></td>
                                <td><span class="thead-text">Trạng thái</span></td>
                            </tr>
                        </tfoot>
                    </table>
                <?php } else { ?>
                    <p>Chưa có đơn hàng nào.</p>
                <?php } ?>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <ul id="list-paging" class="fl-right">
                        <?php echo pagging($num_page, $page, "?mod=home&action=index"); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>