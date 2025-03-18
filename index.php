<?php
// session_start();
// require_once('./app/models/database.php');
// require_once('./app/models/CategoryModel.php');
// require_once('./app/models/UserModel.php');
// require_once('./app/controllers/HomeController.php');
// require_once('./app/controllers/UserController.php');
// require_once('./admin/controllers/AdCategoryController.php');
// require_once('./admin/controllers/AdProductController.php');
// require_once('./admin/controllers/AdHomeController.php');
// require_once('./admin/controllers/AdUserController.php');
// require_once('./app/views/header.php');
// $data = new Database();
// if (isset($_GET['page'])) {
//     $page = $_GET['page'];
//     switch ($page) {
//         case 'detail':
//             $detail = new AdProductController();
//             break;
//         case 'category':
//             $viewcate = new AdCategoryController();
//             $viewcate->viewCate();
//             break;
//         case 'addcate':
//             $viewadd = new AdCategoryController();
//             $viewadd->viewAddCate();
//             $addcate = new AdCategoryController();
//             $addcate->addCate();
//             break;
//         case 'delcate':
//             $delcate = new AdCategoryController();
//             $delcate->delCate();
//             break;
//         case 'editcate':
//             $viewedit = new AdCategoryController();
//             $viewedit->viewEditCate();
//             $editcate = new AdCategoryController();
//             $editcate->editCate();
//             break;
//         case 'addpro':
//             $addpro = new AdHomeController();
//             $addpro->addpro();
//             $addPro = new AdProductcontroller();
//             $addPro->addPro();
//             break;
//         case 'editpro':
//             $viewedit = new AdProductcontroller();
//             $viewedit->viewEdit();
//             $editpro = new AdProductcontroller();
//             $editpro->editPro();
//             break;
//         case 'delpro':
//             $delpro = new AdProductcontroller();
//             $delpro->delPro();
//             break;
//         case 'user':
//             $viewuser = new AdUserController();
//             $viewuser->viewUser();
//             break;
//         case 'adduser':
//             $adduser = new AdUserController();
//             $adduser->addUser();
//             break;
//         case 'deluser':
//             $deluser = new AdUserController();
//             $deluser->delUser();
//             break;
//         case 'edituser':
//             $viewedit = new AdUserController();
//             $viewedit->viewEditUser();
//             $edituser = new AdUserController();
//             $edituser->editUser();
//             break;
//         default:
//             $home = new AdHomeController();
//             $home->home();
//             break;
//     }
// } else {
//     $home = new HomeController();
//     $home->home();
// }
// require_once('./app/views/footer.php');


$pageTitles = [
    'home' => 'Trang chủ',
    'product' => 'Sản Phẩm',
    'filterProducts' => 'Lọc Sản Phẩm',
    'logout' => 'Đăng Xuất',
    'register' => 'Đăng Ký',
    'login' => 'Đăng Nhập',
    'profile' => 'Hồ Sơ Cá Nhân',
    'cart' => 'Giỏ Hàng',
    'detail' => 'Chi Tiết Sản Phẩm',
    'checkout' => 'Thanh toán',
];

require_once('./app/models/database.php');
require_once('./app/models/CategoryModel.php');
require_once('./app/models/ProductModel.php');
require_once('./app/models/UserModel.php');
require_once('./app/models/CommentModel.php');
require_once('./app/models/CheckoutModel.php');
require_once('./app/models/SearchModel.php');
require_once('./app/controllers/HomeController.php');
require_once('./app/controllers/ProductController.php');
require_once('./app/controllers/DetailController.php');
require_once('./app/controllers/CartController.php');
require_once('./app/controllers/UserController.php');
require_once('./app/controllers/CheckoutController.php');
require_once('./app/controllers/SearchController.php');

session_start();
$homeCtr = new HomeController();
$homeCtr->getCategoriesForHead();

// Kiểm tra nếu đang là trang tìm kiếm và dừng ngay lập tức nếu đúng
if (isset($_GET['page']) && $_GET['page'] === 'search') {
    $search = new SearchController();
    $search->search();  // Xử lý tìm kiếm
    exit(); // Dừng thực thi và không render thêm header/footer nữa
}

// Kiểm tra nếu có tham số page trong URL
if (isset($_GET['page'])) {
    $page = $_GET['page'];

    // Xóa session cũ (nếu có)
    if (isset($_SESSION['title'])) {
        unset($_SESSION['title']);
    }

    // Cập nhật session với title của trang hiện tại
    $title = isset($pageTitles[$page]) ? $pageTitles[$page] : $pageTitles['home'];
    $_SESSION['title'] = $title;

    // Render các trang khác
    switch ($page) {
        case 'checkout':
            $checkout = new CheckoutController();
            $checkout->viewCheckout();
            break;
        case 'processCheckout':
            $checkoutController = new CheckoutController();
            if (isset($_SESSION['user'])) {
                $userId = $_SESSION['user']['user_id'];
                $cart = $_SESSION['cart'];
                $paymentMethod = isset($_POST['payment']) ? $_POST['payment'] : '';
                $result = $checkoutController->processCheckout($userId, $cart, $paymentMethod);
                echo $result;
            } else {
                header("Location: login.php");
                exit();
            }
            break;
        case 'product':
            $product = new ProductController();
            $product->viewProduct();
            break;
        case 'filterProducts':
            $product = new ProductController();
            $product->filterProductsByCategory();
            break;
        case 'logout':
            $logout = new UserController();
            $logout->logout();
            break;
        case 'register':
            $register = new UserController();
            $register->addUser();
            break;
        case 'login':
            $login = new UserController();
            $login->signinUser();
            break;
        case 'profile':
            $profile = new UserController();
            $profile->viewprofile();
            break;
        case 'cart':
            $cart = new CartController();
            $cart->viewCart();
            break;
        case 'detail':
            $detail = new DetailController();
            $detail->viewDetail();
            $detail->addComment();
            break;
        case 'home':
        default:
            // Render trang chủ nếu không có trang nào được xác định
            $home = new HomeController();
            $home->home();
            break;
    }
} else {
    // Nếu không có tham số page, tự động hiển thị trang chủ
    $home = new HomeController();
    $home->home();
}

// Chỉ load footer khi không phải là trang tìm kiếm
if (!isset($_GET['page']) || $_GET['page'] !== 'search') {
    require_once('./app/views/footer.php');
}