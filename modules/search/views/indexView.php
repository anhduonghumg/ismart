<?php get_header(); ?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?" title="">Tìm kiếm</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php if (!empty($list_search)) { ?>
            <div class="main-content fl-right">
                <div class="section" id="list-product-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title fl-left">Tìm kiếm</h3>
                        <div class="filter-wp fl-right">
                            <p class="desc">Hiển thị <span class='total_product'><?php echo $num_row; ?></span> sản phẩm</p>
                            <div class="form-filter">
                                <form method="POST" action="">
                                    <select name="select" class="filter_select">
                                        <option value="0">Sắp xếp</option>
                                        <option value="1">Từ A-Z</option>
                                        <option value="2">Từ Z-A</option>
                                        <option value="3">Giá cao xuống thấp</option>
                                        <option value="4">Giá thấp lên cao</option>
                                    </select>
                                    <!-- <button type="submit">Lọc</button> -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix filter_data">
                            <?php foreach ($list_search as &$item) { ?>
                                <li>
                                    <a href="<?php echo $item['url_product_detail'] ?>" title="" class="thumb">
                                        <img src="<?php echo $item['thumbnail']; ?>">
                                    </a>
                                    <a href="<?php echo $item['url_product_detail'] ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price']); ?></span>
                                        <span class="old"><?php echo currency_format($item['promotion']); ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="<?php echo $item['add_cart']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="<?php echo $item['buy_now']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="section" id="paging-wp">
                    <div class="section-detail">
                        <?php echo pagging_ajax($num_page, $page, "?mod=search&action=index&s={$key}"); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php echo get_sidebar('search') ?>
    </div>
</div>
</div>
<?php get_footer(); ?>