<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <a href="?mod=order&action=list_order">Quay lại</a>
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Kết quả tìm kiếm</h3>
                </div>
            </div>
            <?php if (!empty($list_search)) { ?>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="filter-wp clearfix">
                            <ul class="post-status fl-left">
                                <li class="all"><a href="">Tìm được <span class="count">(<?php echo $num_row; ?>)</span> kết quả</a></li>
                            </ul>
                            <!-- <form method="GET" class="form-s fl-right">
                                <input type="hidden" name="mod" value="page">
                                <input type="hidden" name="action" value="search">
                                <input type="text" name="s" id="s">
                                <input type="submit" name="sm_s" value="Tìm kiếm">
                            </form> -->
                        </div>
                        <div class="action">
                            <form method="POST" action="" class="form-actions">
                                <select name="actions">
                                    <option>Tác vụ</option>
                                    <option value="1">Chờ duyệt</option>
                                    <option value="2">Vận chuyển</option>
                                    <option value="3">Thành công</option>
                                    <option value="4">Hủy đơn</option>
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
                                            foreach ($list_search as &$item) {
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
                <p>Không tìm thấy kết quả nào.Click vào đây để quay lại <a href="?mod=order&action=list_order">Quay lại.</a></p>
            <?php } ?>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging" class="fl-right">
                        <?php echo get_pagging($num_page, $page, "?mod=order&action=search&s={$key}&sm_s=Tìm+kiếm"); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>