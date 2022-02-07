<?php get_header();
?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&controller=team" title="" id="add-new" class="fl-left">Quay lại</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <div id="sidebar" class="fl-left">
            <ul id="list-cat">
                <li>
                    <a href="" title="">Đổi mật khẩu</a>
                </li>
                <li>
                    <a href="" title="">Thoát</a>
                </li>
            </ul>
        </div>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="display-name">Tên hiển thị</label>
                        <input type="text" name="fullname" id="fullname" value="">
                        <?php echo form_error('fullname'); ?>
                        <label for="phone">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" value="">
                        <?php echo form_error('phone'); ?>
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"></textarea>
                        <?php echo form_error('address'); ?>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                        <?php echo form_error('update'); ?>
                        <?php echo form_success('update'); ?>
                        <?php echo form_success('delete'); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>