<?php
    $cart_product = isset($data['cart']) ? $data['cart'] : null;
    $total = 0;
    foreach($cart_product as $item):
        $total += $item['price'] * $item['quantity'];
    endforeach;
?>
<div class="container row row_space_between">
    <div class="checkout_container_left">
        <div class="col-75">
            <form action="index.php?page=processCheckout" method="POST">

                <div class="row_checkout">
                    <div class="col-50">
                        <h3 style="margin-left: 90px; font-size: 20px; font-weight: bold; color: #333;">Thông tin giao hàng</h3>
                        <label for="fname"><i class="fa fa-user"></i> Họ và tên</label>
                        <input class="input_text" type="text" id="fname" value="<?=$_SESSION['user']['full_name']?>" name="firstname">
                        <label for="email"><i class="fa fa-envelope"></i> Email</label>
                        <input class="input_text" type="text" id="email" value="<?=$_SESSION['user']['email']?>" name="email">
                        <label for="adr"><i class="fa fa-address-card-o"></i> Địa chỉ</label>
                        <input class="input_text" type="text" id="adr" value="<?=$_SESSION['user']['address']?>" name="address" required>
                        <label for="number"><i class="fa fa-institution"></i> Số điện thoại</label>
                        <input class="input_text" type="text" id="number" value="<?=$_SESSION['user']['phone']?>" name="number" placeholder="+84">
                    </div>
                </div>

                <div class="payment-options">
                    <h3>Phương thức thanh toán</h3>
                    <label>
                        <input type="radio" name="payment" value="credit_card" checked> Thanh toán bằng thẻ
                    </label>
                    <label>
                        <input type="radio" name="payment" value="cash_on_delivery"> Thanh toán khi nhận hàng
                    </label>
                    <label>
                        <input type="radio" name="payment" value="momo"> Thanh toán qua Momo
                    </label>
                </div>
                <input type="submit" value="Tiến hành thanh toán" class="btns"
                    style="width: 70%; margin-left: 120px;">
            </form>
        </div>
    </div>

    <div class="checkout_container_right">
        <div class="col-25">
            <div class="container_checkout">
                <h4>Giỏ hàng <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?=count($cart_product)?></b></span></h4>
                <?php foreach($cart_product as $item): ?>
                    <div class="products-item">
                        <span>
                            <?= $item['name'] ?> 
                            (<?= isset($item['size']) ? $item['size'] : 'S' ?>) 
                            * <?= $item['quantity'] ?>
                        </span>
                        <span class="price"><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ</span>
                    </div>
                <?php endforeach; ?>
                <hr>
                <p>Tổng <span class="price" style="color:black"><b><?=number_format($total, 0, ',', '.') ?>đ</b></span></p>
            </div>
        </div>
    </div>
</div>