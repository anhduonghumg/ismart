<?php get_header(); ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form enctype="multipart/form-data" method="POST">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?php echo set_value('page_title') ?>">
                        <?php echo form_error('title') ?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo set_value('slug') ?>">
                        <?php echo form_error('slug') ?>
                        <label for="desc">Mô tả</label>
                        <textarea name="desc" id="desc" class="ckeditor" ?><?php echo set_value('page_desc') ?></textarea>
                        <?php echo form_error('desc') ?>
                        <label for="content">Nội dung</label>
                        <textarea name="content" id="content" class="ckeditor"><?php echo set_value('page_content') ?></textarea>
                        <?php echo form_error('content') ?>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="upload-image">
                        </div>
                        <?php echo form_error('upload_image') ?>
                        <?php echo form_success('upload_image'); ?>
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm trang mới</button>
                        <?php echo form_success('add_page') ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>