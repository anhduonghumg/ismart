<?php
get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?mod=users&controller=team&action=add_user" title="" name="btn-add-user" id="add-new" class="fl-left">Thêm mới</a>
                <h3 id="index" class="fl-left">NHÓM QUẢN TRỊ</h3>
            </div>
        </div>
        <?php get_sidebar('users'); ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <?php
                global $list_users, $list_roles, $num_page, $page, $num_row, $num_per_page, $time;
                if (!empty($list_users)) {
                ?>
                    <div class="section-detail">

                        <div class="filter-wp clearfix">
                            <ul class="post-status fl-left">
                                <li class="all"><a href="">Tất cả <span class="count">(<?php echo $num_row; ?>)</span> thành viên quản trị</a></li>
                            </ul>
                            <form method="GET" class="form-s fl-right">
                                <input type="hidden" name="mod" value="users">
                                <input type="hidden" name="controller" value="team">
                                <input type="text" name="s" id="s" value="<?php if (isset($_GET['s'])) echo $_GET['s']; ?>">
                                <input type="submit" name="sm_s" value="Tìm kiếm">
                            </form>
                        </div>
                        <div class="actions">
                            <!-- <form method="POST" action="" class="form-actions">
                                <select name="actions">
                                    <option value="">Tác vụ</option>
                                    <option value="0">Xóa</option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng">
                            </form> -->
                        </div>
                        <div class="table-responsive">
                            <form method="POST" action="" class="form-actions">
                                <select name="actions">
                                    <option>Tác vụ</option>
                                    <option value="0">Xóa</option>
                                </select>
                                <input type="submit" class="btn-action" name="sm_action" value="Áp dụng">
                                <form method="POST" action="" class="form-role">
                                    <select name="new_role">
                                        <option selected='selected'>Đổi thành...</option>
                                        <option value="1">Quản lí</option>
                                        <option value="2">Biên tập viên</option>
                                        <option value="3">Cộng tác viên</option>
                                    </select>
                                    <input type="submit" name="sm_change" value="Thay đổi">
                                    <table class="table list-table-wp">
                                        <thead>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="thead-text">ID</span></td>
                                                <td><span class="thead-text">Họ tên</span></td>
                                                <td><span class="thead-text">Vị trí</span></td>
                                                <td><span class="thead-text">Trạng thái</span></td>
                                                <td><span class="thead-text">Người tạo</span></td>
                                                <td><span class="thead-text">Thời gian</span></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $temp = 0;
                                            foreach ($list_users as &$user) {
                                                $user['url_update'] = "?mod=users&controller=team&action=edit_user&id={$user['user_id']}";
                                                $user['url_delete'] = "?mod=users&controller=team&action=delete_user&id={$user['user_id']}";
                                            ?>
                                                <tr>
                                                    <td><input type="checkbox" name="id[]" class="checkItem" value="<?php echo $user['user_id']; ?>"></td>
                                                    <td><span class="tbody-text"><?php echo $user['user_id']; ?></span></td>
                                                    <td class="clearfix">
                                                        <div class="tb-title fl-left">
                                                            <a href="" title=""><?php echo $user['fullname']; ?></a>
                                                        </div>
                                                        <ul class="list-operation fl-right">
                                                            <li><a href="<?php echo $user['url_update']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                            <li><a href="<?php echo $user['url_delete']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </td>
                                                    <td><span class="tbody-text"><?php echo show_role($user['role']); ?></span></td>
                                                    <td><span class="tbody-text"><?php echo show_status($user['status']); ?></span></td>
                                                    <td><span class="tbody-text"><?php echo info_user('fullname'); ?></span></td>
                                                    <td><span class="tbody-text"><?php echo date("d/m/Y h:m:s", $user['created_date']); ?></span></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="thead-text">ID</span></td>
                                                <td><span class="thead-text">Họ tên</span></td>
                                                <td><span class="thead-text">Vị trí</span></td>
                                                <td><span class="thead-text">Trạng thái</span></td>
                                                <td><span class="thead-text">Người tạo</span></td>
                                                <td><span class="thead-text">Thời gian</span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </form>
                            </form>
                            <p class="num_rows">Có <?php echo $num_row; ?> thành viên</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <?php echo get_pagging($num_page, $page, "?mod=users&controller=team"); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end content  -->
<?php
get_footer();
?>