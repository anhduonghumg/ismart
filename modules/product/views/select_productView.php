<?php get_header(); ?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?mod=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?mod=product" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="wp-content">
                <div class="section" id="list-product-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title fl-left">Tất cả các sản phẩm</h3>
                        <div class="filter-wp fl-right">
                            <p class="desc">Hiển thị tất cả <?php echo $num_row ?> sản phẩm</p>
                            <div class="form-filter">
                                <form method="GET" action="">
                                    <input type="hidden" name="mod" value="product">
                                    <input type="hidden" name="action" value="select">
                                    <select name="select-filter" class="select-filter">
                                        <option value="0">Sắp xếp</option>
                                        <option value="1">Từ A-Z</option>
                                        <option value="2">Từ Z-A</option>
                                        <option value="3">Giá cao xuống thấp</option>
                                        <option value="4">Giá thấp lên cao</option>
                                    </select>
                                    <button type="submit" class='btn-submit' name="btn-submit" value='submit'>Lọc</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($list_product)) { ?>
                        <div class="section-detail" id="data-section">
                            <ul class="list-item clearfix">
                                <?php foreach ($list_product as &$item) { ?>
                                    <li data-id=<?php echo $item['product_id']; ?>>
                                        <a href="<?php echo $item['url_detail_product'] ?>" title="" class="thumb">
                                            <img src="<?php echo $item['thumbnail']; ?>">
                                        </a>
                                        <a href="?mod=product&action=detail" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                        <div class="price">
                                            <span class="new" data-price="<?php echo $item['price'] ?>"><?php echo currency_format($item['price']); ?></span>
                                            <span class="old"><?php echo currency_format($item['promotion']); ?></span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="<?php echo $item['add_cart'] ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="<?php echo $item['buy_now'] ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
                <div class="section" id="paging-wp">
                    <div id="paging_data" class="section-detail">
                        <?php
                        // global $select_filter;
                        echo pagging_ajax($num_page, $page, $url);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php get_sidebar("cat"); ?>
    </div>
</div>
<?php get_footer(); ?>