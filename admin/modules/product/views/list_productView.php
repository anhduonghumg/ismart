<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?mod=product&action=add_product" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <?php if (!empty($list_product)) { ?>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="filter-wp clearfix">
                            <ul class="post-status fl-left">
                                <li class="all"><a href="?mod=product&action=list_product">Tất cả <span class="count">(<?php echo get_num_rows('tbl_products'); ?>)</span></a> |</li>
                                <li class="publish"><a href="?mod=product&action=published">Đã đăng <span class="count">(<?php echo get_num_rows('tbl_products', "`product_status` = '2'") ?>)</span></a> |</li>
                                <li class="pending"><a href="?mod=product&action=pending">Chờ xét duyệt<span class="count">(<?php echo get_num_rows('tbl_products', "`product_status` = '1'") ?>)</span></a> |</li>
                                <li class="pending"><a href="?mod=product&action=trash">Thùng rác<span class="count">(<?php echo get_num_rows('tbl_products', "`product_status` = '3'") ?>)</span></a></li>
                            </ul>
                            <form method="GET" class="form-s fl-right">
                                <input type="hidden" name="mod" value="product">
                                <input type="hidden" name="action" value="search">
                                <input type="text" name="s" id="s">
                                <input type="submit" name="sm_s" value="Tìm kiếm">
                            </form>
                        </div>
                        <div class="actions">
                            <form method="POST" action="" class="form-actions">
                                <select name="actions">
                                    <option>Tác vụ</option>
                                    <option value="3">Công khai</option>
                                    <option value="1">Chờ duyệt</option>
                                    <option value="2">Bỏ vào thủng rác</option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng">
                                <select name="filter" class="filter">
                                    <option>Lọc theo</option>
                                    <option value="laptop">Laptop</option>
                                    <option value="phone">Điện thoại</option>
                                    <option value="tablet">Máy tính bảng</option>
                                </select>
                                <input class="btn_filter" type="submit" name="sm_filter" value="Lọc">
                                <div class="table-responsive">
                                    <table class="table list-table-wp">
                                        <thead>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="thead-text">STT</span></td>
                                                <td><span class="thead-text">Mã sản phẩm</span></td>
                                                <td><span class="thead-text">Hình ảnh</span></td>
                                                <td><span class="thead-text">Tên sản phẩm</span></td>
                                                <td><span class="thead-text">Giá</span></td>
                                                <td><span class="thead-text">Danh mục</span></td>
                                                <td><span class="thead-text">Trạng thái</span></td>
                                                <td><span class="thead-text">Kho</span></td>
                                                <td><span class="thead-text">Người tạo</span></td>
                                                <td><span class="thead-text">Ngày tạo</span></td>
                                                <td><span class="thead-text">Người sửa</span></td>
                                                <td><span class="thead-text">Ngày sửa</span></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $temp = 0;
                                            foreach ($list_product as &$item) {
                                                $temp++;
                                            ?>
                                                <tr>
                                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $item['product_id'] ?>"></td>
                                                    <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                                    <td><span class="tbody-text"><?php echo $item['product_code']; ?></h3></span>
                                                    <td>
                                                        <div class="tbody-thumb">
                                                            <img src="<?php echo $item['product_thumb']; ?>" alt="">
                                                        </div>
                                                    </td>
                                                    <td class="clearfix">
                                                        <div class="tb-title fl-left">
                                                            <a href="" title=""><?php echo $item['product_name']; ?></a>
                                                        </div>
                                                        <ul class="list-operation fl-right">
                                                            <li><a href="<?php echo $item['url_update'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                            <li><a href="<?php echo $item['url_delete'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </td>
                                                    <td><span class="tbody-text"><?php echo currency_format($item['price']); ?></span></td>
                                                    <td><span class="tbody-text"><?php echo show_cat_product($item['product_cat_id']) ?></span></td>
                                                    <td><span class="tbody-text"><?php echo status($item['product_status']); ?></span></td>
                                                    <td><span class="tbody-text"><?php echo inventory_status($item['inventory_status']); ?>(<?php echo $item['product_num'] ?>)</span></td>
                                                    <td><span class="tbody-text"><?php echo $item['creator'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo time_format($item['create_date']) ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $item['editor'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo time_format($item['edit_date']) ?></span></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="thead-text">STT</span></td>
                                                <td><span class="thead-text">Mã sản phẩm</span></td>
                                                <td><span class="thead-text">Hình ảnh</span></td>
                                                <td><span class="thead-text">Tên sản phẩm</span></td>
                                                <td><span class="thead-text">Giá</span></td>
                                                <td><span class="thead-text">Danh mục</span></td>
                                                <td><span class="thead-text">Trạng thái</span></td>
                                                <td><span class="thead-text">Kho</span></td>
                                                <td><span class="thead-text">Người tạo</span></td>
                                                <td><span class="thead-text">Ngày tạo</span></td>
                                                <td><span class="thead-text">Người sửa</span></td>
                                                <td><span class="thead-text">Ngày sửa</span></td>
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
                    <?php echo pagging($num_page, $page, "?mod=product&action=list_product"); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end content  -->
<?php
get_footer();
?>