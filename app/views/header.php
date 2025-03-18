<? require_once("./app/controllers/homecontroller.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo isset($_SESSION['title']) ? $_SESSION['title'] : 'Trang chủ'; ?> - My Website</title>
  <link rel="stylesheet" href="./public/layout/css/main.css" />

  <link
    href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
    rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <header>
    <div class="container">
      <div class="header__top row">
        <div class="header__top--logo">
          <a href="index.php">
            <img src="./public/layout/image/header/2.png" alt="logo" style="width:100px ;height:50px" />
          </a>
        </div>
        <div class="header__top--searchBar">
          <form method="GET" action="index.php?page=search">
            <input type="text" id="search" name="query" autocomplete="off" placeholder="Nhập từ khóa tìm kiếm" />
            <span class="icon--search">
              <i class="bx bx-search"></i>
            </span>
          </form>
        </div>
        <div class="header__top--user">
          <?php
          if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['role'] === 'admin') {
              echo '<span class="user-menu">
                  <a href="#" class="user-name">Xin chào,' . $_SESSION['user']['full_name'] . '</a>
                  <span class="line"><i class="bx bx-chevron-down"></i></span>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Quản lí cửa hàng</a></li>
                    <li><a class="dropdown-item" href="index.php?page=profile">Tài khoản</a></li>
                    <li><a class="dropdown-item" href="index.php?page=logout">Đăng xuất</a></li>
                  </ul>
                </span>';
            } else {
              echo '<span class="user-menu">
                <a href="#" class="user-name">Xin chào,' . $_SESSION['user']['full_name'] . '</a>
                <span class="line"><i class="bx bx-chevron-down"></i></span>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="index.php?page=profile">Tài khoản</a></li>
                  <li><a class="dropdown-item" href="index.php?page=logout">Đăng xuất</a></li>
                </ul>
                </span>';
            }
          } else {
            echo '<span>
                    <a href="index.php?page=register">ĐĂNG KÝ</a>
                    <span class="line">|</span>
                    <a href="index.php?page=login">ĐĂNG NHẬP</a>
                  </span>';
          }
          ?>
          <span class="shopping--cart">
            <a href="index.php?page=cart"><i class="bx bx-cart-alt"></i></a>
            <?php if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
              // Get the count of items in the cart
              $cart_item_count = count($_SESSION['cart']);
            } else {
              // If the cart is empty or not set, default count is 0
              $cart_item_count = 0;
            } ?>
            <span><?= $cart_item_count ?></span>
          </span>
        </div>
      </div>
      <div class="header__bottom row">
        <div class="menu__cate">
          <p onclick="toggleSubMenu()">
            <span><i class="bx bx-menu"></i></span>
            <span>DANH MỤC SẢN PHẨM</span>
          </p>
          <ul class="submenu">
            <?php
            // $listcate = $data['categories'] ?? []; // Đảm bảo luôn có giá trị mảng
            if (!empty($listcate)) {
              foreach ($listcate as $cate) {
                // Kiểm tra lại các chỉ mục mảng để chắc chắn
                echo '<li>
                        <a href="index.php?page=product&cate_id=' . $cate['cate_id'] . '"><i class="bx bxs-chevron-right"></i> ' . htmlspecialchars($cate['cate_name']) . ' </a>
                    </li>';
              }
            } else {
              echo '<li>Không có danh mục nào.</li>';
            }
            ?>
          </ul>
        </div>
        <div class="menu__main">
          <ul>
            <li><a href="index.php">TRANG CHỦ</a></li>
            <li><a href="#">GIỚI THIỆU</a></li>
            <li>
              <a href="index.php?page=product">SẢN PHẨM <i class="bx bxs-chevron-down"></i></a>
              <ul class="submenu">
                <?php
                // $listcate = $data['categories'] ?? []; // Ensure the array is not empty

                if (!empty($listcate)) {
                  foreach ($listcate as $cate) {
                    echo '<li><a href="index.php?page=filterProduct&subroute=filterByCategory&category_id=' . htmlspecialchars($cate['cate_id']) . '">' . htmlspecialchars($cate['cate_name']) . '</a></li>';
                  }
                } else {
                  echo '<li>Không có danh mục nào.</li>';
                }
                ?>
              </ul>
            </li>
            <li><a href="#">TIN TỨC</a></li>
            <li><a href="#">LIÊN HỆ</a></li>
          </ul>
        </div>
        <div class="hotline">
          <span><i class="bx bx-headphone"></i></span>
          <span>Hotline:</span>
          <span>09xxxxxxxx</span>
        </div>
      </div>
    </div>
  </header>
  <div id="searchresult"></div>


  <script>
    $(document).ready(function() {
      $("#search").keyup(function() {
        var input = $(this).val();
        if (input !== "") {
          $.ajax({
            url: "index.php?page=search",
            method: "POST",
            data: {
              input: input
            },
            headers: {
              "X-Requested-With": "XMLHttpRequest"
            }, // Xác định đây là AJAX request
            success: function(data) {
              $("#searchresult").html(data); // Hiển thị kết quả
              $("#searchresult").css("display", "block");
            },
            error: function() {
              $("#searchresult").html("<p>Lỗi khi tìm kiếm!</p>");
            },
          });
        } else {
          $("#searchresult").css("display", "none");
        }
      });
    });
  </script>