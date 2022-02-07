<?php get_header(); ?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <?php foreach ($list_product as &$item) { ?>
                    <ul class="list-item clearfix">
                        <li>
                            <a href="?" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="<?php echo $item['url_cat_product'] ?>" title=""><?php echo get_title($item['product_cat_id']); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo $item['url_product'] ?>" title=""><?php echo $item['product_name'] ?></a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
        <?php if (!empty($list_product)) { ?>
            <div class="main-content fl-right">
                <div class="section" id="detail-product-wp">
                    <?php foreach ($list_product as &$item) { ?>
                        <div class="section-detail clearfix">
                            <div class="thumb-wp fl-left">
                                <a href="<?php echo $item['thumbnail']; ?>" title="" id="main-thumb">
                                    <img id="zoom" src="<?php echo $item['thumbnail']; ?>" width="300px" data-zoom-image="<?php echo $item['thumbnail']; ?>" />
                                </a>
                                <div id="list-thumb">
                                    <?php foreach ($list_thumb as &$thumb) { ?>
                                        <a href="" data-image="<?php echo $item['thumbnail']; ?>">
                                            <img id="zoom" src="<?php echo $thumb['thumbnail']; ?>" />
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="thumb-respon-wp fl-left">
                                <img src="<?php echo $item['thumbnail']; ?>" alt="">
                            </div>
                            <div class="info fl-right">
                                <h3 class="product-name"><?php echo $item['product_name']; ?></h3>
                                <div class="desc">
                                    <p>Bộ vi xử lý :Intel Core i505200U 2.2 GHz (3MB L3)</p>
                                    <p>Cache upto 2.7 GHz</p>
                                    <p>Bộ nhớ RAM :4 GB (DDR3 Bus 1600 MHz)</p>
                                    <p>Đồ họa :Intel HD Graphics</p>
                                    <p>Ổ đĩa cứng :500 GB (HDD)</p>
                                </div>
                                <div class="num-product">
                                    <span class="title">Sản phẩm: </span>
                                    <span class="status"><?php echo inventory_status($item['product_status']); ?></span>
                                </div>
                                <p class="price"><?php echo currency_format($item['price']); ?></p>
                                <div id="num-order-wp">
                                    <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                    <input type="text" name="num-order" value="1" id="num-order">
                                    <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                </div>
                                <a href="<?php echo $item['friendly_add_cart']; ?>" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail" id="product-content">
                        <p value='1'><?php echo $item['product_content']; ?></p>
                    </div>
                    <div class="view-more">
                        <a href="" id="view-more-content">Xem thêm</a>
                    </div>
                </div>
                <?php if (!empty($list_product_similar)) { ?>
                    <div class="section" id="same-category-wp">
                        <div class="section-head">
                            <h3 class="section-title">Cùng chuyên mục</h3>
                        </div>
                        <div class="section-detail">
                            <ul class="list-item">
                                <?php foreach ($list_product_similar as &$item) { ?>
                                    <li data-id=<?php echo $item['product_id']; ?>>
                                        <a href="<?php echo $item['friendly_detail'] ?>" title="" class="thumb">
                                            <img src="<?php echo $item['thumbnail']; ?>">
                                        </a>
                                        <a href="<?php echo $item['friendly_detail']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                        <div class="price">
                                            <span class="new" data-price="<?php echo $item['price'] ?>"><?php echo currency_format($item['price']); ?></span>
                                            <span class="old"><?php echo currency_format($item['promotion']); ?></span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="<?php echo $item['friendly_add_cart']; ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="<?php echo $item['friendly_buy_now']; ?>" title="" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <?php get_sidebar('detail'); ?>
    </div>
</div>
<?php get_footer(); ?>