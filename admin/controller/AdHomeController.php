<?php
class AdHomeController
{
    private $category;
    private $product;
    private $data;

    // Constructor: Khởi tạo model
    public function __construct()
    {
        $this->category = new CategoryModel();
        $this->product = new ProductModel();
        $this->data = []; // Chuẩn bị mảng dữ liệu chung
    }

    // Hàm hỗ trợ render view
    public function renderViewAdmin($view, $data = [])
    {
        extract($data); // Tạo các biến từ mảng dữ liệu
        $view = 'views/' . $view . '.php';
        require_once $view; // Gọi file view
    }

    // Hàm chuẩn bị danh mục (tái sử dụng)
    private function prepareCategories()
    {
        $this->data['dsdm'] = $this->category->getCate();
    }

    // Hiển thị form thêm sản phẩm
    public function addpro()
    {
        $this->prepareCategories(); // Lấy danh sách danh mục
        $this->renderViewAdmin('addpro', $this->data); // Hiển thị view thêm sản phẩm
    }

    // Hiển thị danh sách sản phẩm và danh mục
    public function home()
    {
        $this->prepareCategories(); // Lấy danh sách danh mục
        $this->data['dssp'] = $this->product->getAllPro(); // Lấy danh sách sản phẩm
        $this->renderViewAdmin('product', $this->data); // Hiển thị view sản phẩm
    }
}
