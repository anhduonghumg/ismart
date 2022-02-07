<?php
get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Kết quả tìm kiếm</h3>
                </div>
            </div>
            <?php
            if (!empty($list_search)) {
            ?>
                <div class="section" id="detail-page">
                    <a href="?mod=post&action=list_post">Trở về trang chính</a>
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
                        <div class="table-responsive">
                            <form method="POST" class="form-actions">
                                <select name="actions">
                                    <option>Tác vụ</option>
                                    <option value="1">Gỡ</option>
                                    <option value="2">Bỏ vào thủng rác</option>
                                    <option value="3">Duyệt bài</option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng">

                                <table class="table list-table-wp">
                                    <thead>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">STT</span></td>
                                            <td><span class="thead-text">Tiêu đề</span></td>
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
                                        foreach ($list_search as &$item) {
                                            $temp++;
                                        ?>

                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $item['page_id'] ?>"></td>
                                                <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="" title=""><?php echo $item['post_title']; ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="<?php echo $item['url_update']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="<?php echo $item['url_delete']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td class="status"><span class="tbody-text"><?php echo status($item['post_status']); ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['creator']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo time_format($item['create_date']) ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['editor']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo time_format($item['edit_date']) ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">STT</span></td>
                                            <td><span class="thead-text">Tiêu đề</span></td>
                                            <td><span class="thead-text">Trạng thái</span></td>
                                            <td><span class="thead-text">Người tạo</span></td>
                                            <td><span class="thead-text">Ngày tạo</span></td>
                                            <td><span class="thead-text">Người sửa</span></td>
                                            <td><span class="thead-text">Ngày sửa</span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                <?php } else {
                ?>
                    <p>Không tìm thấy kết quả nào.Click vào đây để quay lại <a href="?mod=post&action=list_post">Quay lại.</a></p>
                <?php } ?>
                </div>

                <div class="section" id="paging-wp">
                    <div class="section-detail clearfix">
                        <?php echo get_pagging($num_page, $page, "?mod=page&action=search&s={$key}&sm_s=Tìm+kiếm"); ?>
                    </div>
                </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>s