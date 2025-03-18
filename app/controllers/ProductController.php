<?php
class ProductController
{
    private $category;
    private $product;
    private $data = [];
    function __construct()
    {
        $this->category = new CategoryModel();
        $this->product = new ProductModel();
    }
    public function view($view, $data)
    {
        // $this->data['randProduct-list'] = $data['randProduct-list'] ?? [];
        // // Kiểm tra dữ liệu
        // echo "<pre>";
        // print_r($this->data['randProduct-list']);
        // echo "</pre>";

        // require_once './app/views/header.php';
        require_once './app/views/' . $view . '.php';
    }

    // Xử lý giỏ hàng
    public function addToCart()
    {
        $pro_id = $_GET['pro_id'] ?? 0;
        if ($pro_id > 0) {
            $product = $this->product->getProById($pro_id);
            if (!empty($product)) {
                if (isset($_SESSION['cart'][$pro_id])) {
                    $_SESSION['cart'][$pro_id]['quantity'] += 1;
                } else {
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


    function viewProduct()
    {
        $current_page = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
        if ($current_page < 1) $current_page = 1;

        $items_per_page = 12;
        $offset = ($current_page - 1) * $items_per_page;

        $this->data['categories'] = $this->category->getCate();
        $this->data['product_list'] = $this->product->getAllPro($items_per_page, $offset);

        $total_items = $this->product->getTotalProducts();
        $total_pages = ceil($total_items / $items_per_page);

        $this->data['total_pages'] = $total_pages;
        $this->data['current_page'] = $current_page;

        $this->view('product', $this->data);
    }

    public function filterProductsByCategory()
{
    // Lấy tham số từ URL
    $categoryId = $_GET['category_id'] ?? null;
    $minPrice = $_GET['min_price'] ?? null;
    $maxPrice = $_GET['max_price'] ?? null;
    $sortOrder = $_GET['sort_order'] ?? null;

    // Kiểm tra nếu không có categoryId thì thông báo lỗi
    if (!$categoryId) {
        echo "Danh mục không hợp lệ.";
        return;
    }

    try {
        // Lọc sản phẩm dựa trên các điều kiện đã cung cấp
        $products = $this->product->filterProducts($categoryId, $minPrice, $maxPrice, $sortOrder);

        // Lấy tất cả danh mục để hiển thị
        $categories = $this->category->getCate();

        // Kiểm tra nếu không có sản phẩm
        if (empty($products)) {
            echo "Không có sản phẩm nào trong danh mục này.";
            return;
        }

        // Truyền dữ liệu vào view
        $this->data['products'] = $products;
        $this->data['categories'] = $categories;
        $this->view('filterProducts', $this->data);
    } catch (Exception $e) {
        // Ghi log lỗi và thông báo cho người dùng
        error_log("Lỗi khi lọc sản phẩm: " . $e->getMessage());
        echo "Đã xảy ra lỗi khi xử lý.";
    }
}

}
