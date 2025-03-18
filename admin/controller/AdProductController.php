<?php
class AdProductController
{
    private $product;

    public function __construct()
    {
        $this->product = new ProductModel();
    }

    public function renderView($view, $data = null)
    {
        extract($data);
        require_once 'views/' . $view . '.php';
    }

    public function addPro()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Chỉ lưu tên ảnh mà không di chuyển tệp
            $pro_image = '';
            if (!empty($_FILES['pro_image']['name'])) {
                // Lấy tên tệp ảnh
                $pro_image = basename($_FILES['pro_image']['name']);
            }

            // Dữ liệu từ form
            $data = [
                'pro_name' => $_POST['pro_name'] ?? '',
                'pro_price' => $_POST['pro_price'] ?? '',
                'cate_id' => $_POST['cate_id'] ?? '',
                'pro_image' => $pro_image,  // Chỉ lưu tên ảnh vào cơ sở dữ liệu
                'pro_description' => $_POST['pro_description'] ?? '',
            ];

            // Kiểm tra dữ liệu trước khi thêm vào cơ sở dữ liệu
            if (empty($data['pro_name']) || empty($data['pro_price']) || empty($data['cate_id'])) {
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = 'Vui lòng điền đầy đủ thông tin sản phẩm.';
                header("Location: index.php?page=addpro");
                exit;
            }

            // Thêm sản phẩm vào database
            $result = $this->product->addPro($data);
            if ($result) {
                $_SESSION['status'] = 'success';
                $_SESSION['message'] = 'Thêm sản phẩm thành công.';
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = 'Thêm sản phẩm không thành công.';
            }

            header("Location: index.php?page=product");
            exit;
        } else {
            // Lấy danh mục sản phẩm
            $categories = $this->getAllCategories();
            $this->renderView('addpro', ['categories' => $categories]);
        }
    }


    public function delPro()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $pro_id = $_GET['id'];
            $product = $this->product->getIdPro($pro_id);  // Kiểm tra sự tồn tại của sản phẩm

            if ($product) {
                $result = $this->product->deletePro($pro_id);
                if ($result) {
                    $_SESSION['status'] = 'success';
                    $_SESSION['message'] = 'Xóa sản phẩm thành công.';
                } else {
                    $_SESSION['status'] = 'error';
                    $_SESSION['message'] = 'Xóa sản phẩm không thành công.';
                }
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = 'Sản phẩm không tồn tại.';
            }
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Không có sản phẩm để xóa.';
        }

        header("Location: index.php?page=product");
        exit;
    }


    public function getAllCategories()
    {
        return $this->product->getAllCategories();
    }

    public function editPro()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pro_id = $_POST['pro_id'];
            $pro_image = $_POST['current_image']; // Giữ ảnh cũ nếu không tải ảnh mới

            // Xử lý ảnh mới nếu có
            if (!empty($_FILES['pro_image']['name'])) {
                $uploadDir = 'uploads/products/';
                $pro_image = basename($_FILES['pro_image']['name']);
                $targetFile = $uploadDir . $pro_image;

                // Kiểm tra upload ảnh mới
                if (move_uploaded_file($_FILES['pro_image']['tmp_name'], $targetFile)) {
                    // Thành công, giữ ảnh mới
                } else {
                    $_SESSION['status'] = 'error';
                    $_SESSION['message'] = 'Tải ảnh lên không thành công.';
                    header("Location: index.php?page=editpro&id={$pro_id}");
                    exit;
                }
            }

            // Dữ liệu cần cập nhật
            $data = [
                'pro_id' => $pro_id,
                'pro_name' => $_POST['pro_name'],
                'pro_price' => is_numeric($_POST['pro_price']) ? (float)$_POST['pro_price'] : 0,
                'cate_id' => $_POST['cate_id'],
                'pro_image' => $pro_image,
                'pro_description' => trim($_POST['pro_description']),
            ];

            // Kiểm tra giá sản phẩm hợp lệ
            if ($data['pro_price'] <= 0) {
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = 'Giá sản phẩm không hợp lệ.';
                header("Location: index.php?page=editpro&id={$pro_id}");
                exit;
            }

            // Gọi phương thức cập nhật từ model
            $result = $this->product->updatePro($data);

            if ($result) {
                $_SESSION['status'] = 'success';
                $_SESSION['message'] = 'Cập nhật sản phẩm thành công.';
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = 'Cập nhật sản phẩm không thành công.';
            }

            header("Location: index.php?page=product");
            exit;
        } else {
            $pro_id = $_GET['id'] ?? null;
            $product = $this->product->getIdPro($pro_id);
            $categories = $this->getAllCategories();
            $this->renderView('editpro', ['product' => $product, 'categories' => $categories]);
        }
    }

    public function variants()
    {
        // Lấy id sản phẩm từ URL
        $pro_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Lấy các biến thể của sản phẩm từ model
        $productModel = new ProductModel();
        $variants = $productModel->getVariantsByProId($pro_id);

        // Truyền dữ liệu vào view
        require_once('views/variants.php');
    }


    public function addVariant()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Xử lý việc thêm biến thể
            $data = [
                'variant_size' => $_POST['variant_size'] ?? '',
                'variant_price' => $_POST['variant_price'] ?? '',
                'variant_material' => $_POST['variant_material'] ?? '',
                'variant_discounted_price' => $_POST['variant_discounted_price'] ?? '',
                'pro_id' => $_POST['pro_id'] ?? '',
            ];

            $result = $this->product->addVariant($data);
            if ($result) {
                header("Location: index.php?page=variants&id=" . $data['pro_id']);
            } else {
                header("Location: index.php?page=addvariant&status=error");
            }
            exit;
        } else {
            // Khi là GET request, render form thêm biến thể
            $this->renderView('addvariant');
        }
    }
}
