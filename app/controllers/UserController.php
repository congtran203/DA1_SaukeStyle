<?php
    class UserController{
        public $user;
        private $category;

        private $data = [];
        public function __construct()
        {
            $this->user = new UserModel();
            $this->category = new CategoryModel();
        }

        public function view($view, $data)
        {
            // require_once './app/views/header.php';
            require_once './app/views/'.$view.'.php';
        }

        public function addUser(){
            $this->data['categories'] = $this->category->getCate();
            if(isset($_POST['add'])){
                $data['fullName'] = $_POST['fullName'] ?? '';
                $data['email'] = $_POST['email'] ?? '';
                $data['password'] = $_POST['password'] ?? '';
                $data['phone'] = $_POST['phone'] ?? '';
                $data['role'] = 'customer';
                
                if ($this->user->getUserByName($data['email'])){
                    echo '<script>alert("Email người dùng đã tồn tại. Vui lòng chọn tên khác.");</script>';
                } else {
                    if (!empty($data['fullName']) && !empty($data['email']) && !empty($data['password']) && !empty($data['phone'])) {
                        $this->user->insertUserForUser($data);
                        echo '<script>alert("Đăng kí thành công")</script>';
                        echo'<script>location.href="index.php?page=login";</script>';
                    } else {
                        echo "Tất cả các trường đều bắt buộc.";
                    }
                }
            }
            $this->view('register',$this->data);
        }
        

        public function signinUser(){
            // Bắt đầu session để lưu thông tin người dùng            
            // Lấy danh mục sản phẩm (nếu cần)
            $this->data['categories'] = $this->category->getCate();
            
            // Kiểm tra nếu form đăng nhập đã được gửi
            if (isset($_POST['login'])) {
                // Lấy thông tin tên đăng nhập và mật khẩu từ form
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
        
                // Kiểm tra nếu tên đăng nhập và mật khẩu không rỗng
                if (!empty($email) && !empty($password)) {
                    // Kiểm tra thông tin người dùng
                    $user = $this->user->getUser($email, $password);    
                    
                    // Nếu tìm thấy người dùng
                    if ($user) {
                        // Lưu thông tin người dùng vào session
                        $_SESSION['user'] = $user;  
                        echo '<script>alert("Đăng nhập thành công!"); window.location.href="index.php";</script>';
                        
                    } else {
                        // Nếu không tìm thấy người dùng, hiển thị thông báo lỗi
                        echo '<script>alert("Tên đăng nhập hoặc mật khẩu không chính xác.");</script>';
                    }
                } else {
                    // Nếu không nhập tên đăng nhập hoặc mật khẩu
                    echo '<script>alert("Vui lòng nhập tên đăng nhập và mật khẩu.");</script>';
                }
            }
            
            // Hiển thị trang đăng nhập
            $this->view('login', $this->data);
        }

        public function logout() {
            // Bắt đầu session
            // session_start();
            
            // Xóa thông tin người dùng khỏi session
            unset($_SESSION['user']);
    
            // Chuyển hướng về trang đăng nhập
            header("Location: index.php");
            exit();
        }

        public function viewProfile() {
            $this->data['categories'] = $this->category->getCate();
            // Kiểm tra nếu session không chứa thông tin người dùng
            if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
                echo '<script>alert("Bạn cần đăng nhập để xem thông tin cá nhân!"); window.location.href="index.php?page=login";</script>';
                return;
            }
        
            // Lấy ID người dùng từ session
            $userId = $_SESSION['user']['user_id'] ?? null;
        
            // Kiểm tra nếu không có ID
            if (!$userId) {
                echo '<script>alert("Không tìm thấy ID người dùng!"); window.location.href="index.php";</script>';
                return;
            }
        
            // Lấy thông tin người dùng từ database
            $userInfo = $this->user->getUserById($userId);
        
            // Kiểm tra nếu không tìm thấy thông tin người dùng
            if (!$userInfo) {
                echo '<script>alert("Không tìm thấy thông tin tài khoản!"); window.location.href="index.php";</script>';
                return;
            }
        
            // Truyền thông tin sang view
            $data = ['userInfo' => $userInfo];
            $this->view('profile', $data);
        }
    }

