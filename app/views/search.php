<?php if (isset($this->data['products']) && !empty($this->data['products'])): ?>
    <div class="product-list">
        <?php foreach ($this->data['products'] as $product): ?>
            <div class="product__box">
                <div class="product__image">
                    <a href="index.php?page=detail&id=<?= $product['pro_id'] ?>&cate_id=<?= $product['cate_id'] ?>">
                        <img src="public/layout/image/products/<?= htmlspecialchars($product['pro_image']) ?>" alt="<?= htmlspecialchars($product['pro_name']) ?>" />
                    </a>
                    <div class="product__icons">
                        <i class="bx bx-show"></i>
                        <a href="index.php?pro_id=<?= $product['pro_id'] ?>"><i class="bx bx-cart-alt"></i></a>
                    </div>
                </div>
                <div class="product__details">
                    <h3 class="product__name"><?= htmlspecialchars($product['pro_name']) ?></h3>
                    <p class="product__price"><?= number_format($product['pro_price']) ?>đ</p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Không tìm thấy sản phẩm!</p>
<?php endif; ?>
