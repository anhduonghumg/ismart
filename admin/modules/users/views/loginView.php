<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/reset.css">
    <link rel="stylesheet" href="public/style.css">

    <title>Trang đăng nhập</title>
</head>

<body>
    <div id="wp-form-login">
        <h1 class="page-title">Đăng nhập</h1>
        <form id="form-login" action="" method="POST">
            <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" placeholder="Username">
            <?php echo form_error('username') ?>
            <input type="password" name="password" id="password" placeholder="Password" autocomplete="password">
            <?php echo form_error('password') ?>
            <input type="submit" name="btn-login" id="btn-login" value="ĐĂNG NHẬP">
            <?php echo form_error('account') ?>
        </form>
        <a href="<?php echo base_url('?mod=users&action=lost_pass'); ?>" id="lost-pass">Quên mật khẩu</a>
        <a href="<?php echo base_url('?mod=home'); ?>" id="back-to-ismart">Quay lại ismart</a>
    </div>
</body>

</html>