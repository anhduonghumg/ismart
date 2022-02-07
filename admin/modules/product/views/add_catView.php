<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <?php echo form_success('add_cat'); ?>
            <?php echo form_error('add_cat'); ?>
            <?php echo form_error('exist_cat'); ?>
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="title">Tên danh mục</label>
                        <input type="text" name="title" id="title">
                        <?php echo form_error('title'); ?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug">
                        <?php echo form_error('slug'); ?>
                        <label>Danh mục cha</label>
                        <select name="parent-Cat">
                            <option>-- Chọn danh mục --</option>
                            <?php foreach ($list_cat as &$item) { ?>
                                <option value="<?php echo $item['product_cat_id']; ?>"><?php echo str_repeat('---', $item['level']) . $item['product_cat_name'] ?></option>
                            <?php } ?>
                        </select>
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm danh mục</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>