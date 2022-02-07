<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/reset_pass.css">
    <title>Khôi phục mật khẩu</title>
</head>

<body>
    <div id="form-reset-pass">
        <h1 class="page-title">KHÔI PHỤC MẬT KHẨU</h1>
        <form id="reset-pass" action="" method="POST">
            <input type="email" name="email" id="email" value="<?php set_value('email'); ?>" placeholder="Email">
            <?php echo form_error('email'); ?>
            <input type="submit" name="btn-reset" id="btn-reset" value="GỬI YÊU CẦU">
            <?php echo form_error('account'); ?>
        </form>
        <a href="<?php echo base_url("?mod=users&action=login") ?>" id="btn-login">Đăng nhập</a>
        <a href="<?php echo base_url("?mod=users&action=reg") ?>" id="btn-reg">Đăng ký</a>
    </div>
</body>

</html>