<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng chờ duyệt</h3>
                </div>
            </div>
            <?php if (!empty($list_order)) { ?>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="filter-wp clearfix">
                            <ul class="post-status fl-left">
                                <li class="all"><a href="?mod=order&action=list_order">Tất cả <span class="count">(<?php echo get_num_rows('tbl_order'); ?>)</span></a> |</li>
                                <li class="pending"><a href="?mod=order&action=pending">Chờ xét duyệt<span class="count">(<?php echo get_num_rows('tbl_order', "`status` = '1'") ?>)</span></a> |</li>
                                <li class="transport"><a href="?mod=order&action=transport">Đang vận chuyển <span class="count">(<?php echo get_num_rows('tbl_order', "`status` = '2'") ?>)</span></a> |</li>
                                <li class="success"><a href="?mod=order&action=success">Thành công <span class="count">(<?php echo get_num_rows('tbl_order', "`status` = '3'") ?>)</span></a> |</li>
                                <li class="cancel"><a href="?mod=order&action=cancel">Hủy đơn<span class="count">(<?php echo get_num_rows('tbl_order', "`status` = '4'") ?>)</span></a> |</li>
                                <li class="trash"><a href="?mod=order&action=trash">Thùng rác<span class="count">(<?php echo get_num_rows('tbl_order', "`status` = '5'") ?>)</span></a></li>
                            </ul>
                            <form method="GET" class="form-s fl-right">
                                <input type="text" name="s" id="s">
                                <input type="submit" name="sm_s" value="Tìm kiếm">
                            </form>
                        </div>
                        <div class="action">
                            <form method="POST" action="" class="form-actions">
                                <select name="actions">
                                    <option>Tác vụ</option>
                                    <option value="2">Vận chuyển</option>
                                    <option value="5">Thùng rác</option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng">
                                <div class="table-responsive">
                                    <table class="table list-table-wp">
                                        <thead>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="thead-text">STT</span></td>
                                                <td><span class="thead-text">Mã đơn hàng</span></td>
                                                <td><span class="thead-text">Họ và tên</span></td>
                                                <td><span class="thead-text">Số sản phẩm</span></td>
                                                <td><span class="thead-text">Tổng giá</span></td>
                                                <td><span class="thead-text">Trạng thái</span></td>
                                                <td><span class="thead-text">Thời gian</span></td>
                                                <td><span class="thead-text">Chi tiết</span></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $temp = 0;
                                            foreach ($list_order as &$item) {
                                                $temp++; ?>
                                                <tr>
                                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $item['order_id']; ?>"></td>
                                                    <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                                                    <td><span class="tbody-text"><?php echo $item['order_code'] ?></h3></span>
                                                    <td>
                                                        <div class="tb-title fl-left">
                                                            <a href="" title=""><?php echo get_fullname_customer(); ?></a>
                                                        </div>
                                                        <ul class="list-operation fl-right">
                                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </td>
                                                    <td><span class="tbody-text"><?php echo $item['total_item'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo currency_format($item['total_price']) ?></span></td>
                                                    <td><span class="tbody-text"><?php echo status_order($item['status']) ?></span></td>
                                                    <td><span class="tbody-text"><?php echo time_format($item['time_order']) ?></span></td>
                                                    <td><a href="<?php echo $item['url_detail'] ?>" title="" class="tbody-text">Chi tiết</a></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="tfoot-text">STT</span></td>
                                                <td><span class="tfoot-text">Mã đơn hàng</span></td>
                                                <td><span class="tfoot-text">Họ và tên</span></td>
                                                <td><span class="tfoot-text">Số sản phẩm</span></td>
                                                <td><span class="tfoot-text">Tổng giá</span></td>
                                                <td><span class="tfoot-text">Trạng thái</span></td>
                                                <td><span class="tfoot-text">Thời gian</span></td>
                                                <td><span class="tfoot-text">Chi tiết</span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <p>Không có đơn hàng nào.Bấm vào đây để quay lại <a href="?mod=order&action=list_order">danh sách đơn hàng.</a></p>
            <?php } ?>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging" class="fl-right">
                        <?php echo pagging($num_page, $page, "?mod=order&action=pending"); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>