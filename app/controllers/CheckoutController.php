<?php
class CheckoutController
{
    private $category;
    private $product;
    private $checkoutModel;
    private $data = [];

    function __construct()
    {
        $this->product = new ProductModel();
        $this->checkoutModel = new CheckoutModel();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = []; // Tạo giỏ hàng nếu chưa tồn tại
        }
    }

    // Phương thức hiển thị giỏ hàng
    public function view($view, $data)
    {
        // require_once './app/views/header.php';
        require_once './app/views/' . $view . '.php';
    }

    // Hiển thị giỏ hàng
    public function viewCheckout()
    {
        $this->data['cart'] = $_SESSION['cart'];
        $this->view('checkout', $this->data);
    }

    // Xử lý logic thanh toán
    public function processCheckout($userId, $cart, $paymentMethod)
    {

        $totalAmount = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    
        // Tạo đơn hàng
        $orderId = $this->checkoutModel->createOrder($userId, $totalAmount, 'Chưa thanh toán', 'Đang chuẩn bị hàng');
        if (!$orderId) {
            return "Không thể tạo đơn hàng!";
        }
    
        // Lưu chi tiết sản phẩm vào `order_details`
        $this->checkoutModel->addOrderDetails($orderId, $cart);
    
        // Xóa giỏ hàng (session)
        unset($_SESSION['cart']);
    
        // Thông báo thành công và chuyển hướng
        echo ('<script>
            alert("Đặt hàng thành công!");
            window.location.href = "index.php?page=orderSuccess";
        </script>');
    }
}
