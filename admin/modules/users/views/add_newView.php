<?php get_header(); ?>
<div id="main-content-wp" class="add-cat-page slider-page">
    <div class="wrap clearfix">
        <?php get_sidebar('users'); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm Người Dùng Mới</h3>
                </div>
            </div>
            <div id="wp-form-addNew">
                <form id="form-addNew" action="" method="POST">
                    <label for="fullname">Họ tên</label>
                    <input type="text" name="fullname" id="fullname" placeholder="fullname" value="">
                    <?php echo form_error('fullname'); ?>
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" name="username" id="username" placeholder="username" value="">
                    <?php echo form_error('username'); ?>
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" id="password" placeholder="password" value="">
                    <?php echo form_error('username'); ?>
                    <label for="role">Quyền thành viên</label>
                    <select name="role" id="role">
                        <option value="">Chọn quyền</option>
                        <option value="1">Quản lý</option>
                        <option value="2">Biên tập viên</option>
                        <option value="3">Cộng tác viên</option>
                    </select>
                    <?php echo form_error('role'); ?>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="Email" value="">
                    <?php echo form_error('email'); ?>
                    <label for="email">Điện thoại</label>
                    <input type="text" name="phone" id="phone" placeholder="phone" value="">
                    <?php echo form_error('phone'); ?>
                    <label for="address">Địa chỉ</label>
                    <textarea name="address" id="address" placeholder="Nhập địa chỉ của bạn"></textarea>
                    <?php echo form_error('address'); ?>
                    <button type="submit" name="btn-add" id="btn-add">Thêm mới</button>
                    <?php echo form_success('add_users'); ?>
                    <?php echo form_error('role'); ?>
                    <?php echo form_error('add_users'); ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>