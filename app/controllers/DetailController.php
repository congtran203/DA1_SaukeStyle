<?php
class DetailController
{
    private $category;
    private $product;
    private $comment;
    private $user;
    private $data = [];
    function __construct()
    {
        $this->category = new CategoryModel();
        $this->product = new ProductModel();
        $this->comment = new CommentModel();
        $this->user = new UserModel();
    }
    public function view($data)
    {
        // require_once './app/views/header.php';
        require_once './app/views/detail.php';
    }

    public function addToCart()
    {
        // Kiểm tra nếu có dữ liệu gửi từ form
        if (isset($_POST['addToCart'])) {
            // Lấy dữ liệu từ các thẻ input hidden
            $pro_id = isset($_POST['pro_id']) ? (int)$_POST['pro_id'] : 0;
            $variant_id = isset($_POST['variant_id']) ? (int)$_POST['variant_id'] : null;
            $name = isset($_POST['name']) ? trim($_POST['name']) : '';
            $price = isset($_POST['price']) ? (int)$_POST['price'] : 0;
            $size = isset($_POST['size']) ? trim($_POST['size']) : '';
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

            // Kiểm tra và ép kiểu quantity thành số nếu không phải số hợp lệ
            if (!is_numeric($quantity) || $quantity < 1) {
                $quantity = 1;
            }

            // Kiểm tra nếu `pro_id` hợp lệ
            if ($pro_id > 0) {
                // Lấy thông tin sản phẩm từ database
                $product = $this->product->getProById($pro_id);

                // Nếu tìm thấy sản phẩm
                if (!empty($product)) {
                    // Tạo một khóa duy nhất cho sản phẩm trong giỏ hàng
                    $cartKey = $pro_id;
                    if ($variant_id !== null) {
                        $cartKey .= "_variant_" . $variant_id; // Thêm variant_id vào khóa nếu có
                    }

                    // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
                    if (isset($_SESSION['cart'][$cartKey])) {
                        // Nếu không có variant_id thì tăng số lượng
                        if ($variant_id === null) {
                            $_SESSION['cart'][$cartKey]['quantity'] += $quantity;
                        } else {
                            // Nếu có variant_id thì thêm sản phẩm như một item mới
                            $_SESSION['cart'][$cartKey]['quantity'] = $quantity; // Không tăng số lượng, giữ nguyên
                        }
                    } else {
                        // Thêm sản phẩm mới vào giỏ hàng
                        $_SESSION['cart'][$cartKey] = [
                            'id' => $product['pro_id'],
                            'name' => $name,
                            'price' => $price,
                            'image' => $product['pro_image'],
                            'quantity' => $quantity,
                            'size' => $size,
                            'variant_id' => $variant_id,
                        ];
                    }

                    // Thông báo thêm sản phẩm vào giỏ hàng
                    echo ('<script>alert("Sản phẩm đã được thêm vào giỏ hàng!")</script>');
                } else {
                    echo ('<script>alert("Sản phẩm không tồn tại!")</script>');
                }
            }
        }
    }



    public function viewDetail()
    {
        $this->data['categories'] = $this->category->getCate();
        if (isset($_GET['id']) && isset($_GET['cate_id'])) {
            $id = $_GET['id'];
            $cate_id = $_GET['cate_id'];
        } else {
            $id = 0;
            $cate_id = 0;
        }

        if (isset($_GET['variant_id'])) {
            $variant_id = $_GET['variant_id'];
        } else {
            $variant_id = 0;
        }

        $variant = $this->product->getVariantById($variant_id);
        $productByCate =  $this->product->getProByIdCate($cate_id);
        $pro_detail = $this->product->getProById($id);
        $pro_variants = $this->product->getProVariants($id);
        $commentList = $this->comment->getCommentsByProId($id);
        $users = $this->user->getAllUser();
        $this->addToCart();
        if (is_array($pro_detail)) {
            $this->data['pro_detail'] = $pro_detail;
            $this->data['pro_variants'] = $pro_variants; 
            $this->data['variant'] = $variant;           
            $this->data['productByCate'] = $productByCate;
            $this->data['comment-list'] = $commentList;
            $this->data['users'] = $users;
            $this->view($this->data);
        } else {
            echo 'Không tìm thấy sản phẩm';
        }
    }

    public function addComment(){
        if(isset($_POST['postComment'])){
            $data['pro_id'] = $_POST['pro_id'];
            $data['content'] = $_POST['content'];
            $data['user_id'] = $_SESSION['user']['user_id'];
            if (!empty($data['content'])) {
                $this->comment->insertComment($data);
            } else {
                echo '<script>alert("Nội dung bình luận không được để trống.");</script>';
            }
        } 
    }
}
