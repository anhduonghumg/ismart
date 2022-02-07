<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <?php echo menuTree($category_product); ?>
        </div>
        <div class="section" id="filter-product-wp">
            <div class="section-head">
                <h3 class="section-title text-center">Bộ Lọc</h3>
            </div>
            <div class="section-detail">
                <!-- <table>
                    <thead>
                        <tr>
                            <td colspan="2">Hiển Thị</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="show" value="5" class="commom_selector show"></td>
                            <td>5 sản phẩm</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="show" value="20" class="commom_selector show"></td>
                            <td>20 sản phẩm</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="show" value="50" class="commom_selector show"></td>
                            <td>50 sản phẩm</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="show" value="1000" class="commom_selector show"></td>
                            <td>Tất cả sản phẩm</td>
                        </tr>
                    </tbody>
                </table> -->
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Khoảng Giá</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <input type="hidden" id="hidden_minimum_price" value="0">
                            <input type="hidden" id="hidden_maximum_price" value="100000000">
                            <td>
                                <p id="price_show">Từ 500 nghìn - 100 triệu</p>
                                <div id="price_range"></div>
                            </td>

                        </tr>

                        <!-- <tr>
                                <td><input type="checkbox" name="r-price" value='2' class="commom_selector price"></td>
                                <td>Từ 5-10 triệu</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="r-price" value='3' class="commom_selector price"></td>
                                <td>Từ 10-20 triệu</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="r-price" value='4' class="commom_selector price"></td>
                                <td>Từ 20-40 triệu</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="r-price" value='5' class="commom_selector price"></td>
                                <td>Trên 40 triệu</td>
                            </tr> -->
                    </tbody>
                </table>
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Thương Hiệu</td>
                        </tr>
                    </thead>
                    <?php if (!empty($brand_product)) { ?>
                        <tbody>
                            <?php foreach ($brand_product as &$item) { ?>
                                <tr>
                                    <td width="28px"><input type="checkbox" class="commom_selector brand" name="r-brand" value="<?php echo $item['brand_id']; ?>"></td>
                                    <td style="text-transform: capitalize;"><?php echo $item['name'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="?page=detail_product" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>