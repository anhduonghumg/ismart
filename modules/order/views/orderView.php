<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="detail-exhibition">
            <div class="section" id="info">
                <div class="section-head">
                    <h3 class="section-title">Thông tin đơn hàng</h3>
                </div>
                <?php foreach ($order as &$item) { ?>
                    <ul class="list-item">
                        <li>
                            <h3 class="title">Mã đơn hàng</h3>
                            <span class="detail"><?php echo $item['order_code']; ?></span>
                        </li>
                        <li>
                            <h3 class="title">Tên khách hàng</h3>
                            <span class="detail"><?php echo $item['fullname'] ?></span>
                        </li>
                        <li>
                            <h3 class="title">Địa chỉ nhận hàng</h3>
                            <span class="detail"><?php echo $item['address']; ?></span>
                        </li>
                        <li>
                            <h3 class="title">Thông tin vận chuyển</h3>
                            <span class="detail"><?php echo $item['payment'] ?></span>
                        </li>
                        <li>
                            <h3 class="title">Tình trạng đơn hàng</h3>
                            <span class="detail"><?php echo status_order($item['status']); ?></span>
                        </li>
                    </ul>
                <?php } ?>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <div class="table-responsive">
                    <table class="table info-exhibition">
                        <thead>
                            <tr>
                                <td class="thead-text">STT</td>
                                <td class="thead-text">Ảnh sản phẩm</td>
                                <td class="thead-text">Tên sản phẩm</td>
                                <td class="thead-text">Đơn giá</td>
                                <td class="thead-text">Số lượng</td>
                                <td class="thead-text">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $temp = 0;
                            foreach ($list_product_order as &$item) {
                                $temp++;
                            ?>
                                <tr>
                                    <td class="thead-text"><?php echo $temp; ?></td>
                                    <td class="thead-text">
                                        <div class="thumb">
                                            <img src="admin/<?php echo $item['product_thumb'] ?>" alt="">
                                        </div>
                                    </td>
                                    <td class="thead-text"><?php echo $item['product_name'] ?></td>
                                    <td class="thead-text"><?php echo currency_format($item['price']) ?></td>
                                    <td class="thead-text"><?php echo $item['qty'] ?></td>
                                    <td class="thead-text"><?php echo currency_format($item['sub_total']) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee"><?php echo $get_num_order ?> sản phẩm</span>
                            <span class="total"><?php echo currency_format($get_total_order); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>