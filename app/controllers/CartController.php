<?php
class CartController
{
    private $category;
    private $product;
    private $data = [];

    function __construct()
    {
        $this->category = new CategoryModel();
        $this->product = new ProductModel();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = []; // Tạo giỏ hàng nếu chưa tồn tại
        }
    }

    // Phương thức hiển thị giỏ hàng
    public function view($data)
    {
        // require_once './app/views/header.php';
        require_once './app/views/cart.php';
    }


    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart()
    {
        // Lấy cartKey từ URL
        $cartKey = $_GET['cartKey'] ?? '';
    
        // Kiểm tra nếu cartKey hợp lệ và tồn tại trong giỏ hàng
        if (!empty($cartKey) && isset($_SESSION['cart'][$cartKey])) {
            unset($_SESSION['cart'][$cartKey]); // Xóa sản phẩm khỏi giỏ hàng
        }
    
        // Sau khi xóa, tính toán lại tổng tiền
        $this->calculateTotals();
    }

    // Xử lý tổng tiền của giỏ hàng
    private function calculateTotals()
    {
        $total_price = 0;
    
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as &$item) {
                // Tính thành tiền cho từng sản phẩm
                $item['total'] = $item['price'] * $item['quantity'];
                
                // Cộng dồn tổng tiền
                $total_price += $item['total'];
            }
        }
    
        // Cập nhật tổng tiền vào dữ liệu
        $this->data['cart'] = $_SESSION['cart'];
        $this->data['total_price'] = $total_price;
    }
    

    public function updateQuantity()
    {
        // Lấy cartKey và quantity từ URL
        $cartKey = $_GET['cartKey'] ?? '';
        $quantity = $_GET['quantity'] ?? 1;
    
        // Kiểm tra nếu cartKey tồn tại trong giỏ hàng
        if (!empty($cartKey) && isset($_SESSION['cart'][$cartKey])) {
            // Cập nhật số lượng sản phẩm
            $_SESSION['cart'][$cartKey]['quantity'] = (int)$quantity;
    
            // Nếu số lượng <= 0, xóa sản phẩm khỏi giỏ hàng
            if ($_SESSION['cart'][$cartKey]['quantity'] <= 0) {
                unset($_SESSION['cart'][$cartKey]);
            }
        }
    
        // Tính toán lại tổng tiền sau khi cập nhật số lượng
        $this->calculateTotals();
    }
    

    // Hiển thị giỏ hàng
    public function viewCart()
    {
        $this->data['categories'] = $this->category->getCate();
        if (isset($_GET['action']) && $_GET['action'] == 'remove') {
            $this->removeFromCart(); // Gọi hàm xóa sản phẩm
        }
        if (isset($_GET['action']) && $_GET['action'] == 'update') {
            $this->updateQuantity();  // Gọi hàm cập nhật số lượng
        }
        $this->calculateTotals();
        $this->data['cart'] = $_SESSION['cart']; // Lấy giỏ hàng từ session
        // print_r($this->data['cart']);
        $this->view($this->data);
    }
}
