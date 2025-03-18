<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/layout/css/home.css">
</head>

<body>
    <img class="banner-home" src="public/layout/image/banner/BANNER_3.jpg" alt="Banner">
    <div class="container">
        <!-- MENU ITEM -->
        <div class="menu_container">
            <div class="img_menu">
                <?php
                $listcate = $data['categories'] ?? [];
                if (!empty($listcate)) {
                    foreach ($listcate as $cate) {
                        echo '<div class="item">
                            <a href="index.php?page=product&cate_id=' . $cate['cate_id'] . '" class="img_rotate"><img src="public/layout/image/categories/' . $cate['cate_image'] . '" alt=" ' . htmlspecialchars($cate['cate_name']) . ' "></a> 
                            <p>' . htmlspecialchars($cate['cate_name']) . '</p>
                        </div>';
                    }
                } else {
                    echo '<li>Không có danh mục nào.</li>';
                }
                ?>
            </div>
        </div>

        <!-- SẢN PHẨM NỔI BẬT -->
        <div class="spec_menu_item">
            <div class="col_1">
                <div class="box_item_1">
                    <a href="#" class="col_1_item_1"><img src="public/layout/image/home/aokhoacgalaxy.webp" alt="Visionary jacket" width="307px" height="307px"></a>
                    <p>Visionary jacket</p>
                    <h6>Visionary</h6>
                    <p class="product-price">450,000đ</p>
                </div>
            </div>
            <div class="col_2">
                <div class="col_2_row_1">
                    <div class="parallelogram">
                        <span class="text">NỔI BẬT NHẤT</span>
                    </div>
                    <div class="col_2_row_1_menu">
                        <a href="#">Áo</a>
                        <a href="#">Quần</a>
                        <a href="#">Balo</a>
                        <a href="#">Áo khoác</a>
                        <a href="#">T-shirt</a>
                        <a href="#">Phụ kiện</a>
                        <a href="#">Xem tất cả</a>
                    </div>
                </div>
                <div class="col_2_row_2">
                    <?php
                    $randProduct_list = $data['randProduct-list'] ?? [];
                    if (!empty($randProduct_list)) {
                        foreach ($randProduct_list as $item) {
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
                </div>
            </div>
        </div>

        <!-- BANNER MENU 2 -->
        <div class="row_3_menu_2">
            <div class="row_3_col_1">
                <img src="public/layout/image/banner/BANNER.jpg" alt="">
                <div class="info">
                    <h3>Phong Cách</h3>
                </div>
            </div>
            <div class="row_3_col_2">
                <img src="public/layout/image/banner/BANNER_2.jpg" alt="">
                <div class="info">
                    <h3>Ai sợ đi về</h3>
                </div>
            </div>
        </div>

        <!-- SẢN PHẨM HOT -->
        <div class="hot_menu_item">
            <div class="hot_col_1">
                <div class="hot_col_1_row_1">
                    <div class="parallelogram">
                        <span class="text">SẢN PHẨM HOT</span>
                    </div>
                    <div class="hot_col_1_row_1_menu">
                        <a href="#">Áo</a>
                        <a href="#">Quần</a>
                        <a href="#">Balo</a>
                        <a href="#">Áo khoác</a>
                        <a href="#">T-shirt</a>
                        <a href="#">Phụ kiện</a>
                        <a href="#">Xem tất cả</a>
                    </div>
                </div>
                <div class="hot_col_1_row_2">
                    <?php
                    $hotProduct_list = $data['hotProduct-list'] ?? [];
                    if (!empty($hotProduct_list)) {
                        foreach ($hotProduct_list as $item) {
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
                        echo '<li>Không có sản phẩm nào.</li>';
                    }
                    ?>
                </div>
            </div>
            <div class="hot_col_2">
                <div class="hot_box_item_2">
                    <a href="#" class="hot_col_2_item_2"><img src="public/layout/image/home/balo4.jpg" alt="Balo 01" width="307px" height="307px"></a>
                    <p>Balo siêu to 01</p>
                    <h6>Balo</h6>
                    <p class="product-price">450,000đ</p>
                </div>
            </div>
        </div>

        <!-- BANNER MENU 3 -->
        <div class="row_4_menu_3">
            <div class="row_4_menu_3_box">
                <a href="#">
                    <img src="public\layout\image\banner\BANNER.jpg" alt="" width="100%">
                </a>
            </div>
        </div>

        <!-- MENU SẢN PHẨM MỚI -->
        <div class="container_new_product">
            <div class="new_product_row_1">
                <div class="parallelogram">
                    <span class="text">SẢN PHẨM MỚI</span>
                </div>
            </div>
            <div class="new_product_row_2">
                <?php
                $newProduct_list = $data['newProduct-list'] ?? [];
                if (!empty($newProduct_list)) {
                    foreach ($newProduct_list as $item) {
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
                    echo '<li>Không có sản phẩm nào.</li>';
                }
                ?>
            </div>
        </div>

        <!-- TIPS -->
        <div class="container_tips">
            <div class="tips_row_1">
                <div class="parallelogram">
                    <span class="text">MẸO VẶT HAY</span>
                </div>
            </div>
            <div class="tips_row_2">
                <div class="tips_col">
                    <div class="tips_image_box">
                        <a href="#"><img src="public/layout/image/home/tips_1_image.png" alt=""></a>
                        <h6>07/07/2024</h6>
                        <h6>Đăng bởi: Dặng Danh</h6>
                    </div>
                    <div class="tips_content">
                        <div class="tips_title">Mẹo bảo quản & vệ sinh quần áo</div>
                        <div class="tips_des">Đối với quần áo thun - Khi xử lý các vết bẩn thông thường, bạn chỉ cần ...</div>
                    </div>
                </div>
                <div class="tips_col">
                    <div class="tips_image_box">
                        <a href="#"><img src="public/layout/image/home/tips_1_image.png" alt=""></a>
                        <h6>07/07/2024</h6>
                        <h6>Đăng bởi: Dặng Danh</h6>
                    </div>
                    <div class="tips_content">
                        <div class="tips_title">Mẹo bảo quản & vệ sinh quần áo</div>
                        <div class="tips_des">Đối với quần áo thun - Khi xử lý các vết bẩn thông thường, bạn chỉ cần ...</div>
                    </div>
                </div>
                <div class="tips_col">
                    <div class="tips_image_box">
                        <a href="#"><img src="public/layout/image/home/tips_1_image.png" alt=""></a>
                        <h6>07/07/2024</h6>
                        <h6>Đăng bởi: Dặng Danh</h6>
                    </div>
                    <div class="tips_content">
                        <div class="tips_title">Mẹo bảo quản & vệ sinh quần áo</div>
                        <div class="tips_des">Đối với quần áo thun - Khi xử lý các vết bẩn thông thường, bạn chỉ cần ...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>