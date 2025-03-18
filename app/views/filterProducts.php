<?php
$listcate = $data['categories'] ?? [];
$listproduct = $data['products'] ?? [];
?>
<div class="container">
    <div class="row-product">
        <div class="product-content">
            <div class="product-sanpham">
                <h1 class="product-title">Tất cả sản phẩm</h1>
                <div class="sort-options">
                    Sắp xếp theo:
                    <form action="index.php" method="GET">
                        <input type="hidden" name="page" value="filterProducts">

                        <label for="category_id">Danh mục:</label>
                        <select name="category_id" id="category_id">
                            <?php foreach ($listcate as $category): ?>
                                <option value="<?= htmlspecialchars($category['cate_id']) ?>">
                                    <?= htmlspecialchars($category['cate_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="min_price">Giá tối thiểu:</label>
                        <input type="number" name="min_price" id="min_price" placeholder="VD: 100000" min="0">

                        <label for="max_price">Giá tối đa:</label>
                        <input type="number" name="max_price" id="max_price" placeholder="VD: 500000" max="10000000">

                        <label for="sort_order">Sắp xếp:</label>
                        <select name="sort_order" id="sort_order">
                            <option value="name_az">Theo tên A - Z</option>
                            <option value="name_za">Theo tên Z - A</option>
                            <option value="price_az">Từ giá tăng dần</option>
                            <option value="price_za">Từ giá giảm dần</option>
                        </select>

                        <button type="submit">Lọc sản phẩm</button>
                    </form>

                </div>
            </div>
            <div class="product-list">
                <?php
                if (!empty($listproduct)) {
                    foreach ($listproduct as $item) {
                        echo '<div class="product__box">
                            <div class="product__image">
                                <a href="index.php?page=detail&id=' . $item['pro_id'] . '&cate_id=' . $item['cate_id'] . '"><img src="public/layout/image/products/' . $item['pro_image'] . '" alt="Product Image" /></a>
                            <div class="product__icons">
                                <i class="bx bx-show"></i>
                                <a href="index.php?pro_id=' . $item['pro_id'] . '"><i class="bx bx-cart-alt"></i></a>
                            </div>
                            </div>
                            <div class="product__details">
                                <h3 class="product__name">' . htmlspecialchars($item['pro_name']) . '</h3>
                                <p class="product__price">' . number_format($item['pro_price']) . 'đ<span></span></p>
                            </div>
                            </div>';
                    }
                } else {
                    echo '<li>Không có san pham nào.</li>';
                }
                ?>
                <!-- <div class="page-nav">
                    <ul class="page-nav-list">
                        <?php
                        // Display previous page link
                        if ($this->data['current_page'] > 1) {
                            echo '<li><a href="index.php?page=product&page_num=' . ($this->data['current_page'] - 1) . '">Previous</a></li>';
                        }

                        // Display page number links
                        for ($i = 1; $i <= $this->data['total_pages']; $i++) {
                            $active_class = ($i == $this->data['current_page']) ? 'class="active"' : '';
                            echo '<li><a ' . $active_class . ' href="index.php?page=product&page_num=' . $i . '">' . $i . '</a></li>';
                        }

                        // Display next page link
                        if ($this->data['current_page'] < $this->data['total_pages']) {
                            echo '<li><a href="index.php?page=product&page_num=' . ($this->data['current_page'] + 1) . '">Next</a></li>';
                        }
                        ?>
                    </ul>
                </div> -->

            </div>

        </div>
    </div>
</div>