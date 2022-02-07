<?php get_header() ?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&action=add_new" title="" id="add-new" class="fl-left dis">Thêm mới</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('users') ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form action="" method="POST" id="form-update">
                        <label for="fullname">Tên hiển thị</label>
                        <input type="text" name="fullname" id="fullname" value="<?php echo info_user('fullname') ?>">
                        <?php echo form_error('fullname'); ?>
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" placeholder="admin" readonly="readonly" value="<?php echo info_user('username') ?>">
                        <?php echo form_error('username'); ?>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo info_user('email') ?>">
                        <?php echo form_error('email'); ?>
                        <label for="phone">Số điện thoại</label>
                        <input type="tel" name="phone" id="phone" value="<?php echo info_user('phone') ?>">
                        <?php echo form_error('phone'); ?>
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"><?php echo info_user('address') ?></textarea>
                        <?php echo form_error('address'); ?>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                        <?php echo form_error('update'); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>