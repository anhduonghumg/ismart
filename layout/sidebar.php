<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <?php echo menuTree($category_product); ?>
        </div>
    </div>
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <?php if (!empty($list_product_best_seller)) { ?>
            <div class="section-detail">
                <ul class="list-item">
                    <?php foreach ($list_product_best_seller as &$item) { ?>
                        <li class="clearfix">
                            <a href="<?php echo $item['friendly_detail']; ?>" title="" class="thumb fl-left">
                                <img src="<?php echo $item['thumbnail']; ?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="<?php echo $item['friendly_detail']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($item['price']); ?></span>
                                    <span class="old"><?php echo currency_format($item['promotion']); ?></span>
                                </div>
                                <a href="<?php echo $item['friendly_buy_now']; ?>" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>