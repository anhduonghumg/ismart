<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
                </div>
            </div>
            <?php if (!empty($list_customers)) { ?>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="filter-wp clearfix">
                            <ul class="post-status fl-left">
                                <li class="all"><a href="">Tất cả <span class="count">(<?php echo get_num_rows("tbl_customers"); ?>)</span></a></li>
                            </ul>
                            <form method="GET" class="form-s fl-right">
                                <input type="hidden" name="mod" value="customer">
                                <input type="hidden" name="action" value="search">
                                <input type="text" name="s" id="s">
                                <input type="submit" name="sm_s" value="Tìm kiếm">
                            </form>
                        </div>
                        <div class="actions">
                            <form method="POST" action="" class="form-actions">
                                <select name="actions">
                                    <option value="0">Tác vụ</option>
                                    <option value="1">Xóa</option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng">
                                <div class="table-responsive">
                                    <table class="table list-table-wp">
                                        <thead>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="thead-text">STT</span></td>
                                                <td><span class="thead-text">Họ và tên</span></td>
                                                <td><span class="thead-text">Số điện thoại</span></td>
                                                <td><span class="thead-text">Email</span></td>
                                                <td><span class="thead-text">Địa chỉ</span></td>
                                                <td><span class="tfoot-body">Tổng sản phẩm</span></td>
                                                <td><span class="tfoot-body">Tổng tiền</span></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $temp = 0;
                                            foreach ($list_customers as &$item) {
                                                $temp++; ?>
                                                <tr>
                                                    <td><input type="checkbox" name="checkItem" class="checkItem" value=<?php echo $item['customer_id']; ?>></td>
                                                    <td><span class="tbody-text"><?php echo $temp; ?></span></td>
                                                    <td>
                                                        <div class="tb-title fl-left">
                                                            <a href="" title="<?php echo $item['fullname']; ?>"><?php echo $item['fullname']; ?></a>
                                                        </div>
                                                        <ul class="list-operation fl-right">
                                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </td>
                                                    <td><span class="tbody-text"><?php echo $item['phone'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $item['email'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $item['address'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $item['total_order'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo currency_format($item['total_spend']); ?></span></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="tfoot-body">STT</span></td>
                                                <td><span class="tfoot-body">Họ và tên</span></td>
                                                <td><span class="tfoot-body">Số điện thoại</span></td>
                                                <td><span class="tfoot-body">Email</span></td>
                                                <td><span class="tfoot-body">Địa chỉ</span></td>
                                                <td><span class="tfoot-body">Tổng sản phẩm</span></td>
                                                <td><span class="tfoot-body">Tổng tiền</span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging" class="fl-right">
                        <?php echo pagging($num_page, $page, "?mod=customer&action=list_customer"); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>