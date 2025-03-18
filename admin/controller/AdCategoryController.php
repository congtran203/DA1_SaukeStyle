<?php
class AdCategoryController
{
    public $data = [];
    public $category;

    public function __construct()
    {
        $this->category = new CategoryModel();
    }

    private function renderView($view, $data = [])
    {
        require_once 'views/' . $view . '.php';
    }

    // Hiển thị danh mục
    public function viewCate()
    {
        $this->data['danhMuc'] = $this->category->getCate();
        $this->renderView('category', $this->data);
    }

    // Hiển thị form chỉnh sửa danh mục
    public function viewEditCate()
    {
        $cate_id = $_GET['cate_id'] ?? null;
        if ($cate_id) {
            $this->data['cate'] = $this->category->getIdCate($cate_id);
            if (!$this->data['cate']) {
                echo '<script>alert("Không tìm thấy danh mục"); location.href="index.php?page=category";</script>';
                return;
            }
            $this->renderView('editcate', $this->data);
        } else {
            echo '<script>alert("ID danh mục không hợp lệ"); location.href="index.php?page=category";</script>';
        }
    }

    // Xử lý chỉnh sửa danh mục
    public function editCate()
    {
        if (isset($_POST['editcate'])) {
            $data = [
                'cate_id' => $_POST['cate_id'] ?? null,
                'cate_name' => $_POST['cate_name'] ?? null,
                'cate_image' => $_POST['image_old'] ?? null, // Giữ nguyên ảnh cũ nếu không có ảnh mới
            ];

            // Kiểm tra nếu có ảnh mới
            if (isset($_FILES['cate_image']) && $_FILES['cate_image']['error'] == UPLOAD_ERR_OK) {
                $uploaded_image = $this->uploadImage($_FILES['cate_image']);
                if ($uploaded_image) {
                    $data['cate_image'] = $uploaded_image;
                }
            }

            if ($this->category->updateCate($data)) {
                echo '<script>alert("Cập nhật danh mục thành công"); location.href="index.php?page=category";</script>';
            } else {
                echo '<script>alert("Cập nhật danh mục thất bại");</script>';
            }
        }
    }

    // Hiển thị form thêm danh mục
    public function viewAddCate()
    {
        $this->renderView('addcate');
    }

    // Xử lý thêm danh mục
    public function addCate()
    {
        if (isset($_POST['addcate'])) {
            $data = [
                'cate_name' => $_POST['cate_name'] ?? null,
                'cate_image' => null, // Mặc định không có ảnh
            ];

            // Kiểm tra và upload ảnh nếu có
            if (isset($_FILES['cate_image']) && $_FILES['cate_image']['error'] == UPLOAD_ERR_OK) {
                $uploaded_image = $this->uploadImage($_FILES['cate_image']);
                if ($uploaded_image) {
                    $data['cate_image'] = $uploaded_image;
                } else {
                    echo "Lỗi khi tải ảnh lên!";
                }
            }

            if ($this->category->insertCate($data)) {
                echo '<script>alert("Thêm danh mục thành công"); location.href="index.php?page=category";</script>';
            } else {
                echo '<script>alert("Thêm danh mục thất bại");</script>';
            }
        }
    }

    // Xóa danh mục
    public function delCate()
    {
        $cate_id = $_GET['cate_id'] ?? null;
        if ($cate_id) {
            if ($this->category->deleteCate($cate_id)) {
                echo '<script>alert("Xóa danh mục thành công"); location.href="index.php?page=category";</script>';
            } else {
                echo '<script>alert("Xóa danh mục thất bại");</script>';
            }
        } else {
            echo '<script>alert("ID danh mục không hợp lệ");</script>';
        }
    }

    // Hàm xử lý upload ảnh
    private function uploadImage($file)
    {
        $upload_dir = 'uploads/images/';
        $file_name = basename($file['name']);
        $target_file = $upload_dir . $file_name;

        // Kiểm tra nếu file là ảnh
        $check = getimagesize($file['tmp_name']);
        if ($check === false) {
            echo "File không phải là ảnh.";
            return null;
        }

        // Kiểm tra kích thước ảnh
        if ($file['size'] > 5000000) {  // 5MB
            echo "Ảnh quá lớn.";
            return null;
        }

        // Kiểm tra nếu file đã tồn tại
        if (file_exists($target_file)) {
            echo "Ảnh đã tồn tại.";
            return null;
        }

        // Di chuyển ảnh vào thư mục lưu trữ
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            return $file_name;
        } else {
            echo "Lỗi khi tải ảnh lên.";
            return null;
        }
    }
}
