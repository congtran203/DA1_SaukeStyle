<?php
class CheckoutModel extends Database
{
    // Thêm đơn hàng vào bảng `orders`
    public function createOrder($userId, $totalAmount, $paymentStatus = 'Chưa thanh toán', $deliveryStatus = 'Đang chuẩn bị hàng')
    {
        $sql = "INSERT INTO orders (order_date, total_amount, payment_status, delivery_status, user_id) 
                VALUES (NOW(), :total_amount, :payment_status, :delivery_status, :user_id)";
        $params = [
            ':total_amount' => $totalAmount,
            ':payment_status' => $paymentStatus,
            ':delivery_status' => $deliveryStatus,
            ':user_id' => $userId,
        ];
        return $this->insert($sql, $params); // Trả về `order_id` vừa tạo
    }

    // Thêm chi tiết sản phẩm vào bảng `order_details`
    public function addOrderDetails($orderId, $cart)
    {
        $sql = "INSERT INTO order_details (order_id, variant_id, pro_price, quantity, amount) 
                VALUES (:order_id, :variant_id, :pro_price, :quantity, :amount)";
        foreach ($cart as $item) {
            $params = [
                ':order_id' => $orderId,
                ':variant_id' => $item['variant_id'], // ID sản phẩm
                ':pro_price' => $item['price'],
                ':quantity' => $item['quantity'],
                ':amount' => $item['price'] * $item['quantity'], // Thành tiền
            ];
            $this->query($sql, $params); // Lưu từng sản phẩm
        }
        return true;
    }

    // Lấy thông tin đơn hàng theo ID người dùng
    public function getOrdersByUser($userId)
    {
        $sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY order_date DESC";
        return $this->getAll($sql, [':user_id' => $userId]);
    }

    // Lấy chi tiết sản phẩm của một đơn hàng
    public function getOrderDetails($orderId)
    {
        $sql = "SELECT * FROM order_details WHERE order_id = :order_id";
        return $this->getAll($sql, [':order_id' => $orderId]);
    }
}
