<?php
get_header();
?>
<div id="main-content-wp" class="change-pass-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users$controller&action=add_user" title="" id="add-new" class="fl-left dis">Thêm mới</a>
            <h3 id="index" class="fl-left">Thay đổi mật khẩu</h3>
        </div>
    </div>
    <?php get_sidebar('users') ?>
    <div id="content" class="fl-right">
        <div class="section" id="detail-page">
            <div class="section-detail">
                <form method="POST">
                    <label for="pass-old">Mật khẩu cũ</label>
                    <input type="password" name="pass-old" id="pass-old">
                    <?php echo form_error('pass-old') ?>
                    <label for="pass-new">Mật khẩu mới</label>
                    <input type="password" name="pass-new" id="pass-new">
                    <?php echo form_error('pass-new') ?>
                    <label for="confirm-pass">Xác nhận mật khẩu</label>
                    <input type="password" name="confirm-pass" id="confirm-pass">
                    <?php echo form_error('confirm-pass') ?>
                    <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                    <?php echo form_error('confim-pass') ?>
                    <?php echo form_error('reset_pass') ?>
                    <?php echo form_success('reset_pass') ?>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php
get_footer();
?>