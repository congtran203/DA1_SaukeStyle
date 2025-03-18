<?php
class AddHomeController
{
    public $data = [];
    public $products;

    public function __construct()
    {
        $this->products = new ProductModel();
    }

    // Render view với dữ liệu đã được xử lý
    public function renderView($data, $view)
    {
        if (!empty($data)) {
            extract($data); // Giải nén mảng dữ liệu
        }
        $viewPath = './view/' . $view . '.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo "View không tồn tại!";
        }
    }

    // Hiển thị chi tiết sản phẩm
    public function viewDetail()
    {
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

        // Nếu id không hợp lệ, không thực hiện tìm kiếm sản phẩm
        if ($id > 0) {
            $spct = $this->products->getIdPro($id);
            if (is_array($spct)) {
                $this->data['spct'] = $spct;
                $this->renderView($this->data, 'detail');
            } else {
                echo "Không tìm thấy sản phẩm!";
            }
        } else {
            echo "ID sản phẩm không hợp lệ!";
        }
    }
}
