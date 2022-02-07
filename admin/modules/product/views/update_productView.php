<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <?php echo form_success('add_product'); ?>
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhập sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form enctype="multipart/form-data" method="POST">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name" value="<?php echo $list_product['product_name']; ?>">
                        <?php echo form_error('product_name'); ?>
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" value="<?php echo $list_product['slug']; ?>">
                        <?php echo form_error('slug'); ?>
                        <?php echo form_error('product_code'); ?>
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="price" id="price" value="<?php echo $list_product['price']; ?>">
                        <?php echo form_error('price'); ?>
                        <label for="price">Giá Khuyến mãi</label>
                        <input type="text" name="promotion" id="promotion" value="<?php echo $list_product['promotion']; ?>">
                        <?php echo form_error('promotion'); ?>
                        <label for="product_num">Số lượng trong kho</label>
                        <input type="text" name="product_num" id="product_num" value="<?php echo $list_product['product_num']; ?>">
                        <?php echo form_error('product_num'); ?>
                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="desc" id="desc"><?php echo $list_product['product_desc'] ?></textarea>
                        <label for="content">Chi tiết</label>
                        <textarea name="content" id="content" class="ckeditor"><?php echo $list_product['product_content']; ?></textarea>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img src="<?php echo $list_product['product_thumb']; ?>" id="upload-image">
                        </div>
                        <?php echo form_error('upload_image'); ?>
                        <?php echo form_success('upload_image'); ?>
                        <label>Thương hiệu</label>
                        <select name="brand">
                            <option value="">-- Chọn thương hiệu --</option>
                            <?php foreach ($list_brand as &$item) { ?>
                                <option value="<?php echo $item['brand_id']; ?>"><?php echo $item['name'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('brand'); ?>
                        <label>Danh mục sản phẩm</label>
                        <select name="parent_id">
                            <option value="">--Chọn danh mục--</option>
                            <?php foreach ($list_cat as &$item) { ?>
                                <option value="<?php echo $item['product_cat_id']; ?>"><?php echo str_repeat('---', $item['level']) . $item['product_cat_name'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('product_cat'); ?>
                        <label>Trạng thái kho hàng</label>
                        <select name="inventory_status">
                            <option value="">-- Chọn danh mục --</option>
                            <option value="1">Còn hàng</option>
                            <option value="2">Hết hàng</option>
                            <option value="3">Chờ hàng</option>
                        </select>
                        <?php echo form_error('inventory_status'); ?>
                        <label>Sản phẩm</label>
                        <input type="checkbox" name="best-sell" id="best-sell" value="1" <?php echo get_checked($list_product['product_id'], 'best_sell'); ?>>Bán chạy</input>
                        <input type="checkbox" name="featured" id="featured" value="1" <?php echo get_checked($list_product['product_id'], 'featured'); ?>>Nổi bật</input>
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