<?php
get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách bài viết đã đăng</h3>
                    <a href="?mod=post&action=add_post" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <?php if (!empty($list_post)) { ?>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="filter-wp clearfix">
                            <ul class="post-status fl-left">
                                <li class="all"><a href="?mod=post&action=list_post">Tất cả <span class="count">(<?php echo get_num_rows('tbl_posts'); ?>)</span></a> |</li>
                                <li class="publish"><a href="?mod=post&action=publish">Đã đăng <span class="count">(<?php echo get_num_post('tbl_posts', "post_status='2'"); ?>)</span></a> |</li>
                                <li class="pending"><a href="?mod=post&action=pending">Chờ xét duyệt <span class="count">(<?php echo get_num_waiting('tbl_posts', "post_status='1'"); ?>)</span></a></li>
                                <li class="trash"><a href="?mod=post&action=trash">Thùng rác <span class="count">(<?php echo get_num_trash('tbl_posts', "post_status='3'"); ?>)</span></a></li>
                            </ul>
                            <form method="GET" class="form-s fl-right">
                                <input type="text" name="s" id="s">
                                <input type="submit" name="sm_s" value="Tìm kiếm">
                            </form>
                        </div>
                        <div class="actions">
                            <form method="POST" action="" class="form-actions">
                                <select name="actions">
                                    <option>Tác vụ</option>
                                    <option value="1">Gỡ bài</option>
                                    <option value="2">Bỏ vào thủng rác</option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng">

                                <div class="table-responsive">
                                    <table class="table list-table-wp">
                                        <thead>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="thead-text">STT</span></td>
                                                <td><span class="thead-text">Tiêu đề</span></td>
                                                <td><span class="thead-text">Danh mục</span></td>
                                                <td><span class="thead-text">Trạng thái</span></td>
                                                <td><span class="thead-text">Người tạo</span></td>
                                                <td><span class="thead-text">Ngày tạo</span></td>
                                                <td><span class="thead-text">Người sửa</span></td>
                                                <td><span class="thead-text">Ngày sửa</span></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $temp = 0;
                                            foreach ($list_post as &$item) {
                                                $temp++;
                                            ?>
                                                <tr>
                                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $item['post_id'] ?>"></td>
                                                    <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                                    <td class="clearfix">
                                                        <div class="tb-title fl-left">
                                                            <a href="" title=""><?php echo $item['post_title']; ?></a>
                                                        </div>
                                                        <ul class="list-operation fl-right">
                                                            <li><a href="<?php echo $item['url_update'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                            <li><a href="<?php echo $item['url_delete'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </td>
                                                    <td><span class="tbody-text"><?php echo show_cat_post($item['post_cat_id']); ?></span></td>
                                                    <td><span class="tbody-text"><?php echo status($item['post_status']); ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $item['creator'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo time_format($item['create_date']); ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $item['editor'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo time_format($item['edit_date']) ?></span></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="thead-text">STT</span></td>
                                                <td><span class="thead-text">Tiêu đề</span></td>
                                                <td><span class="thead-text">Danh mục</span></td>
                                                <td><span class="thead-text">Trạng thái</span></td>
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
                <div class="section" id="paging-wp">
                    <div class="section-detail clearfix">
                        <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                        <?php echo get_pagging($num_page, $page, "?mod=post&action=list_post"); ?>
                    </div>
                </div>
            <?php } else { ?>
                <p>Không có bài viết nào.Bấm vào đây để <a href="?mod=post&action=list_post">quay lại</a></p>
            <?php } ?>
        </div>
    </div>
</div>
<!-- end content  -->
<?php
get_footer();
?>