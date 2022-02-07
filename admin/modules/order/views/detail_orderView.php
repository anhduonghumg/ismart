<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <?php if (!empty($detail_order)) { ?>
            <div id="content" class="detail-exhibition fl-right">
                <?php foreach ($detail_order as &$item) { ?>
                    <div class="section" id="info">
                        <div class="order-info">
                            <div class="section-head">
                                <h3 class="section-title">Thông tin đơn hàng</h3>
                            </div>
                            <ul class="list-item">
                                <li>
                                    <h3 class="title">Mã đơn hàng</h3>
                                    <span class="detail"><?php echo $item['order_code']; ?></span>
                                </li>
                                <li>
                                    <h3 class="title">Địa chỉ nhận hàng</h3>
                                    <span class="detail"><?php echo $item['address']; ?></span>
                                </li>
                                <li>
                                    <h3 class="title">Thông tin vận chuyển</h3>
                                    <span class="detail"><?php echo $item['payment']; ?></span>
                                </li>
                                <form method="POST" action="">
                                    <li>
                                        <h3 class="title">Tình trạng đơn hàng</h3>
                                        <select name="status">
                                            <option value='1' <?php if ($item['status'] == '1') {
                                                                    echo 'selected';
                                                                } ?>>Chờ duyệt</option>
                                            <option value='2' <?php if ($item['status'] == '2') {
                                                                    echo 'selected';
                                                                } ?>>Đang vận chuyển</option>
                                            <option value='3' <?php if ($item['status'] == '3') {
                                                                    echo 'selected';
                                                                } ?>>Thành công</option>
                                            <option value='4' <?php if ($item['status'] == '4') {
                                                                    echo 'selected';
                                                                } ?>>Hủy đơn</option>
                                        </select>
                                        <input type="submit" name="sm_status" value="Cập nhật">
                                    </li>
                                </form>
                            </ul>
                        </div>
                        <div class="note">
                            <div class="section-head">
                                <h3 class="section-title">NOTE</h3>
                            </div>
                            <h5>Khách hàng</h5>
                            <p class="date-note"><?php echo get_date($item['time_order']) ?>: <span class="note-customer"><?php echo $item['note']; ?></span></p>
                            <h5>Quản trị</h5>
                            <p class="date-note"><?php if ($item['admin_note'] != null) echo get_date($item['time_note']) ?>: <span class="note-admin"><?php echo $item['admin_note']; ?></span></p>
                        </div>
                        <div class="add-note">
                            <form method="POST">
                                <div class="section-head">
                                    <h3 class="section-title">ADD NOTE</h3>
                                </div>
                                <textarea name="note" id="" cols="35" rows="5"></textarea>
                                <input type="submit" class="sm_note" name="sm_note" value="Thêm ghi chú">
                            </form>
                        </div>
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
                                                    <img src="<?php echo $item['product_thumb']; ?>" alt="">
                                                </div>
                                            </td>
                                            <td class="thead-text"><?php echo $item['product_name'] ?></td>
                                            <td class="thead-text"><?php echo currency_format($item['price']) ?></td>
                                            <td class="thead-text"><?php echo $item['qty'] ?></td>
                                            <td class="thead-text"><?php echo currency_format($item['sub_total']); ?></td>
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
                                    <span class="total-fee"><?php echo get_num_order() ?> sản phẩm</span>
                                    <span class="total"><?php echo currency_format(get_total_order()) ?> </span>
                                </li>
                            </ul>
                        </div>
                    </div>
            </div>
        <?php } ?>
    </div>
</div>
</div>
<?php
get_footer();
?>