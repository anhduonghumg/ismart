<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <?php echo form_success('add_post'); ?>
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Sửa bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form enctype="multipart/form-data" method="POST">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?php echo $list_post['post_title'] ?>">
                        <?php echo form_error('title'); ?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo $list_post["slug"]; ?>">
                        <?php echo form_error('slug'); ?>
                        <label for="desc">Mô tả</label>
                        <textarea name="desc" id="desc" class="ckeditor"><?php echo $list_post["post_desc"]; ?></textarea>
                        <label for="content">Nội dung</label>
                        <textarea name="content" id="content" class="ckeditor"><?php echo $list_post['post_content']; ?></textarea>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="upload-image" src="<?php echo $list_post['post_thumb'] ?>">
                        </div>
                        <?php echo form_error('upload_image'); ?>
                        <?php echo form_success('upload_image'); ?>
                        <label>Danh mục cha</label>
                        <select name="parent-Cat">
                            <option>-- Chọn danh mục --</option>
                            <?php foreach ($list_cat as &$item) { ?>
                                <option value="<?php echo $item['post_cat_id']; ?>"><?php echo str_repeat('---', $item['level']) . $item['post_cat_title'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('post_cat'); ?>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>