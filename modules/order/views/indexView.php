<?php
get_header();
?>
<div class="wp-check">
    <form action="" method="POST">
        <h1 class="check-title">Kiểm tra đơn hàng của bạn</h1>
        <!-- <input type="hidden" name="mod" value="order">
        <input type="hidden" name="action" value="result"> -->
        <input type="text" class="order-code" placeholder="Nhập mã đơn hàng của bạn" name="s">
        <?php echo form_error('s'); ?>
        <input type="submit" name="btn-check" class='btn-check' value="Tra cứu">
    </form>
</div>
<!-- end content  -->
<?php
get_footer();
?>