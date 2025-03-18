<?php
$pro_detail = isset($data['pro_detail']) ? $data['pro_detail'] : null;
$pro_variants = isset($data['pro_variants']) ? $data['pro_variants'] : null;
$variant = isset($data['variant']) ? $data['variant'] : null;
$productByCate = isset($data['productByCate']) ? $data['productByCate'] : null;
$commentList = isset($data['comment-list']) ? $data['comment-list'] : null;
$users = isset($data['users']) ? $data['users'] : null;
?>
<!-- <link rel="stylesheet" href="./punlic/layout/css/detail.css"> -->
<div class="banner">
  <section class="title">
    <p><?= htmlspecialchars($pro_detail['pro_name']) ?></p>
    <ul class="breadcrumb">
      <li>
        <a href="">Trang chu</a>
        <span></span>
      </li>
      <li>
        <a href="">Danh muc</a>
        <span>></span>
      </li>
      <li>
        <a href="">Ten san pham</a>
      </li>
    </ul>
  </section>
</div>

<div class="container_detail">
  <div class="row_detail">
    <div class="left_col">
      <div class="main_image">
        <img src="public/layout/image/products/<?= $pro_detail['pro_image'] ?>" alt="">
      </div>
      <!-- <div class="others_image">
        <img src="image/detail/1.0.jpg" alt="">
        <img src="image/detail/1.1.jpg" alt="">
      </div> -->
    </div>
    <div class="right_col">
      <form action="index.php?page=detail&id=<?= $pro_detail['pro_id'] ?>&cate_id=<?= $pro_detail['cate_id'] ?>" method="post">
        <input type="hidden" value="">
        <?php
        if ($variant) {
          echo '<input type="hidden" name="variant_id" value="' . $variant['variant_id'] . '">
                    <input type="hidden" name="pro_id" value="' . $pro_detail['pro_id'] . '">';
        } else {
          echo '<input type="hidden" name="pro_id" value="' . $pro_detail['pro_id'] . '">';
        }
        ?>
        <h1><?= htmlspecialchars($pro_detail['pro_name']) ?></h1>
        <input type="hidden" name="name" value="<?= htmlspecialchars($pro_detail['pro_name']) ?>">
        <div class="info_product">
          <div class="price_box">
            <?php
            if ($variant) {
              echo '<span>' . number_format($variant['variant_price']) . 'đ</span>';
            } else {
              echo '<span>' . number_format($pro_detail['pro_price']) . 'đ </span>';
            }
            ?>
            <input type="hidden" name="price" value="<?php
                                                      if ($variant) {
                                                        echo '' . $variant['variant_price'] . '';
                                                      } else {
                                                        echo '' . $pro_detail['pro_price'] . '';
                                                      }
                                                      ?>">
          </div>
          <div class="info_box">
            <p>Kích thước:</p>
            <?php
            // print_r($pro_variants);
            if ($pro_variants) {
              foreach ($pro_variants as $item) {
                echo '<span class="btn_size"><a href="index.php?page=detail&id=' . $pro_detail['pro_id'] . '&variant_id=' . $item['variant_id'] . '&cate_id=' . $pro_detail['cate_id'] . '">' . $item['variant_size'] . '</a></span>';
              }
            } else {
              echo '<span class="btn_size"><a href="">S</a></span>';
            }
            ?>
            <input type="hidden" name="size" value="<?php
                                                    if ($variant) {
                                                      echo '' . $variant['variant_size'] . '';
                                                    } else {
                                                      echo 'S';
                                                    }
                                                    ?>">
            <p>Chất liệu: </p>
            <?php
            if ($variant) {
              echo '<span>' . htmlspecialchars($variant['variant_material']) . '</span>';
            } else {
              echo '<span>COTTON</span>';
            }
            ?>
          </div>
        </div>
        <div class="form_product">
          <div class="quantity">
            <span>Số lượng:</span>
            <div class="quantity_button">
              <input type="number" name="quantity" class="quantity_number" value="1" min="1"></input>
            </div>
          </div>
          <div class="submit_button">
            <button type="submit" name="addToCart">Thêm vào giỏ hàng</button>
          </div>
          <p>Gọi đặt mua trực tiếp: 09xxxxxxxx</p>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="container_comment">
  <h2>Bình luận</h2>
  <div class="row_comment">
    <?php if (isset($_SESSION['user'])): ?>
      <form action="index.php?page=detail&id=<?= $pro_detail['pro_id'] ?>&cate_id=<?= $pro_detail['cate_id'] ?>" method="post" class="comment_form">
        <input type="hidden" name="pro_id" value="<?= $pro_detail['pro_id'] ?>">
        <label for="">Hãy để lại bình luận</label>
        <input type="text" name="content" placeholder="Viết bình luận..." class="content_cmt">
        <button type="submit" name="postComment">Thêm bình luận</button>
      </form>
    <?php else: ?>
      <div>Hãy đăng nhập để bình luận</div>
    <?php endif; ?>
    <div class="content">
      <?php if (!empty($commentList)): ?>
        <?php foreach ($commentList as $item): ?>
          <div class="comment_item">
            <div class="comment_header">
              <?php

              foreach ($users as $user){
                if($user['user_id'] == $item['user_id']){
                  echo '<span class="username">'.$user['full_name'].'</span>
                        <span class="time">'.htmlspecialchars($item['date']).'</span>
                      </div>
                      <p class="comment_text">'. htmlspecialchars($item['content']) .'</p>
                    </div>';
                }
              }
               ?> 
        <?php endforeach; ?>
      <?php else: ?>
        <p class="no_comments">Không có bình luận.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="product__list container row">
  <div class="related_product">
    <h1>Các sản phẩm liên quan</h1>
  </div>
  <?php
  foreach ($productByCate as $item) {
    echo '<div class="product__box">
          <div class="product__image">
            <a href="index.php?page=detail&id=' . $item['pro_id'] . '&cate_id=' . $item['cate_id'] . '"><img src="public/layout/image/products/' . $item['pro_image'] . '" alt="Product Image" /></a>
            <div class="product__icons">
              <i class="bx bx-show"></i>
              <a href="index.php?pro_id=' . $item['pro_id'] . '"><i class="bx bx-cart-alt"></i></a>
            </div>
          </div>
          <div class="product__details">
            <h3 class="product__name">' . $item['pro_name'] . '</h3>
            <p class="product__price">' . number_format($item['pro_price']) . 'đ<span></span></p>
          </div>
        </div>';
  }
  ?>
</div>