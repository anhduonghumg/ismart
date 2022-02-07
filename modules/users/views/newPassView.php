<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/newPass.css">

    <title>Thiết lập mật khẩu mới</title>
</head>

<body>
    <div id="wp-form-newPass">
        <h1 class="page-title">MẬT KHẨU MỚI</h1>
        <form id="form-newPass" action="" method="POST">
            <input type="password" name="password" id="password" placeholder="Password" autocomplete="false">
            <?php echo form_error('password') ?>
            <input type="submit" name="btn-newPass" id="btn-newPass" value="LƯU">
            <?php echo form_error('account') ?>
        </form>
        <a href="<?php echo base_url('?mod=users&action=lost_pass'); ?>" id="lost-pass">Quên mật khẩu</a>
        <a href="<?php echo base_url('?mod=users&action=reg'); ?>" id="reg">Đăng ký</a>
    </div>
</body>

</html>