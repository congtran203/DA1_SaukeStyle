<?php
class SearchController
{
    private $product;
    private $search;
    private $cate;
    private $data = [];

    public function __construct()
    {
        $this->product = new ProductModel();
        $this->search = new SearchModel();
        $this->cate = new CategoryModel();
    }

    public function view($view)
    {
        require_once './app/views/' . $view . '.php';
    }

    public function search()
    {
        // Khởi tạo biến $input rỗng
        $input = '';
    
        // Kiểm tra đầu vào từ form tìm kiếm (có thể là GET hoặc POST)
        if (!empty($_POST['input'])) {
            // Nếu gửi qua POST
            $input = trim($_POST['input']); // Xóa khoảng trắng dư thừa
        } elseif (!empty($_GET['query'])) {
            // Nếu gửi qua GET
            $input = trim($_GET['query']);
        }
    
        if (!empty($input)) {
            // Thực hiện tìm kiếm nếu có đầu vào
            $this->data['products'] = $this->search->searchPro($input);
    
            // Kiểm tra nếu request là AJAX
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                // Render kết quả cho yêu cầu AJAX mà không cần render lại trang đầy đủ
                require_once './app/views/search.php';
                return;
            }
    
            // Nếu không phải AJAX, render trang tìm kiếm với kết quả
            $this->view('search');
        } else {
            // Trường hợp không có đầu vào từ người dùng
            $this->data['message'] = "Vui lòng nhập từ khóa tìm kiếm.";
    
            // Kiểm tra request AJAX
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                // Trả về thông báo lỗi cho yêu cầu AJAX
                echo "<p>Vui lòng nhập từ khóa tìm kiếm.</p>";
                return;
            }
    
            // Nếu không phải AJAX, render trang tìm kiếm với thông báo
            $this->view('search');
        }
    }    
}
