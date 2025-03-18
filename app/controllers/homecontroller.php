<?php
class HomeController
{
    private $category;
    private $product;
    private $data = [];
    function __construct()
    {
        $this->category = new CategoryModel();
        $this->product = new ProductModel();
    }
    public function view($view,$data)
    {
        // $this->data['randProduct-list'] = $data['randProduct-list'] ?? [];
        // // Kiểm tra dữ liệu
        // echo "<pre>";
        // print_r($this->data['randProduct-list']);
        // echo "</pre>";

        // require_once './app/views/header.php';
        require_once './app/views/'.$view.'.php';
    }

    function getCategoriesForHead(){
        $listcate = $this->category->getCate();
        require_once './app/views/header.php';
    }
    
    // Xử lý giỏ hàng
    public function addToCart()
    {
        // Lấy `pro_id` từ URL
        $pro_id = $_GET['pro_id'] ?? 0;
        if ($pro_id > 0) {
            // Lấy thông tin sản phẩm từ database
            $product = $this->product->getProById($pro_id); // Giả sử có hàm này trong model
            // print_r($product);
            if (!empty($product)) {
                if (isset($_SESSION['cart'][$pro_id])) {
                    // Tăng số lượng sản phẩm nếu đã có trong giỏ hàng
                    $_SESSION['cart'][$pro_id]['quantity'] += 1;
                } else {
                    // Thêm sản phẩm mới vào giỏ hàng
                    $_SESSION['cart'][$pro_id] = [
                        'id' => $product['pro_id'],
                        'name' => $product['pro_name'],
                        'price' => $product['pro_price'],
                        'image' => $product['pro_image'],
                        'quantity' => 1,
                    ];
                }
            }
            echo ('<script>alert("Sản phẩm đã được thêm vào giỏ hàng!")</script>');
        }
    }


    function home()
    {
        $this->addToCart();
        $this->data['categories'] = $this->category->getCate();
        $this->data['randProduct-list'] = $this->product->getRandPro();
        $this->data['hotProduct-list'] = $this->product->getHotPro();
        $this->data['newProduct-list'] = $this->product->getNewPro();
        $this->view('home',$this->data);
    }
}
