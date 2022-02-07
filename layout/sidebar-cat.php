<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <?php echo menuTree($category_product); ?>
        </div>
    </div>
    <div class="section" id="filter-product-wp">
        <div class="section-head">
            <h3 class="section-title text-center">Bộ Lọc</h3>
        </div>
        <div class="section-detail">
            <form method="GET" action="">
                <input type="hidden" name="mod" value="product">
                <input type="hidden" name="action" value="filter">
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Hiển Thị</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="radio" name="show" value="5"></td>
                            <td>5 sản phẩm</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="show" value="20"></td>
                            <td>20 sản phẩm</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="show" value="50"></td>
                            <td>50 sản phẩm</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="show" value="1000"></td>
                            <td>Tất cả sản phẩm</td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Giá</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="radio" name="r-price" value='1'></td>
                            <td>Dưới 5 triệu</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" value='2'></td>
                            <td>Từ 5-10 triệu</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" value='3'></td>
                            <td>Từ 10-20 triệu</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" value='4'></td>
                            <td>Từ 20-40 triệu</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" value='5'></td>
                            <td>Trên 40 triệu</td>
                        </tr>
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
                                    <td><input type="radio" name="r-brand" value="<?php echo $item['brand_id']; ?>"></td>
                                    <td><?php echo $item['name'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php } ?>
                </table>
                <input type="submit" class="filter-submit" name="btn-submit" value="Lọc">
            </form>
        </div>
    </div>
</div>