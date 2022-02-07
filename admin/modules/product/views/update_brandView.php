<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <?php echo form_success('update_brand'); ?>
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhập thương hiệu</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="title">Tên thương hiệu</label>
                        <input type="text" name="title" id="title">
                        <?php echo form_error('name_brand'); ?>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhập thương hiệu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>