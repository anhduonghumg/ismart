<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/reg.css">

    <title>Trang đăng ký</title>
</head>

<body>
    <div id="wp-form-reg">
        <h1 class="page-title">Đăng ký tài khoản</h1>
        <form id="form-reg" action="" method="POST">
            <input type="text" name="fullname" id="fullname" value="<?php echo set_value('fullname') ?>" placeholder="Fullname">
            <?php echo form_error('fullname'); ?>
            <input type="text" name="email" id="email" value="<?php echo set_value('email') ?>" placeholder="Email">
            <?php echo form_error('email'); ?>
            <input type="text" name="username" id="username" value="<?php echo set_value('username') ?>" placeholder="Username">
            <?php echo form_error('username'); ?>
            <input type="password" name="password" id="password" value="<?php echo set_value('password') ?>" placeholder="Password" autocomplete="password">
            <?php echo form_error('password'); ?>
            <input type="submit" name="btn-reg" id="btn_reg" value="Đăng ký">
            <?php echo form_error('account'); ?>
        </form>
        <a href="<?php echo base_url("?mod=users&action=login") ?>" id="lost-past">Đăng nhập</a>
    </div>

</body>