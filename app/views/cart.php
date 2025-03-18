<?php
$cart = isset($data['cart']) ? $data['cart'] : null;
$total_price = isset($data['total_price']) ? $data['total_price'] : 0;
?>
<div class="cart_header">
    <h2>Giỏ hàng của bạn</h2>
</div>
<table class="cart_table">
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($cart)) : ?>
            <?php foreach ($cart as $cartKey => $item) : ?>
                <tr>
                    <td>
                        <img src="public/layout/image/products/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="product_image">
                        <span><?= $item['name'] . ' (' . (!empty($item['size']) ? $item['size'] : 'M') . ')' ?></span>
                    </td>
                    <td><?= number_format($item['price'], 0, ',', '.') ?>đ</td>
                    <td class="product_quantity">
                        <input type="number" value="<?= $item['quantity']; ?>" min="1"
                            onchange="updateQuantity('<?= urlencode($cartKey); ?>', this.value)">
                    </td>
                    <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ</td>
                    <td class="remove_item">
                        <a href="index.php?page=cart&action=remove&cartKey=<?= urlencode($cartKey); ?>">X</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5">Giỏ hàng trống.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<div class="cart_footer">
    <span>Tổng tiền:</span>
    <strong><?= number_format($total_price, 0, ',', '.') ?>đ</strong>
</div>
<?php
$isCartEmpty = empty($_SESSION['cart']);
$isUserLoggedIn = isset($_SESSION['user']); // Kiểm tra nếu người dùng đã đăng nhập
?>
<div class="cart_button">
    <button class="continue_shopping" onclick="window.location.href='index.php?page=product'">Tiếp tục mua hàng</button>
    <button class="pay" 
        <?= $isCartEmpty || !$isUserLoggedIn ? 'disabled style="cursor:not-allowed; opacity:0.5;"' : ''; ?>>
        <a href="<?= $isCartEmpty || !$isUserLoggedIn ? '#' : 'index.php?page=checkout'; ?>" 
           style="<?= $isCartEmpty || !$isUserLoggedIn ? 'pointer-events:none; color:gray;' : ''; ?>">
           Tiến hành thanh toán
        </a>
    </button>
</div>
</div>

<script>
    function updateQuantity(cartKey, quantity) {
        // Kiểm tra số lượng hợp lệ
        if (quantity < 1) {
            alert("Số lượng phải lớn hơn 0.");
            return;
        }

        // Gửi yêu cầu đến server để cập nhật số lượng sản phẩm
        var url = 'index.php?page=cart&action=update&cartKey=' + encodeURIComponent(cartKey) + '&quantity=' + quantity;

        // Điều hướng lại trang để cập nhật trên server
        window.location.href = url;
    }
</script>
