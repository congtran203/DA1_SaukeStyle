<?php

class AdUserController
{
    public $data = [];
    public $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    // Hàm render view chung
    public function renderView($view, $data = null)
    {
        if (is_array($data)) {
            extract($data);  // Giải nén mảng dữ liệu cho view
        }
        require_once 'views/' . $view . '.php';
    }

    // Hàm kiểm tra và xử lý mật khẩu
    private function handlePassword($password)
    {
        return !empty($password) ? password_hash($password, PASSWORD_BCRYPT) : null;
    }

    // Hiển thị danh sách người dùng
    public function viewUser()
    {
        $this->data['danhSach'] = $this->user->getAllUsers();
        $this->renderView('user', $this->data);
    }

    // Thêm người dùng mới
    public function addUser()
    {
        if (isset($_POST['adduser'])) {
            // Kiểm tra dữ liệu đầu vào
            if (empty($_POST['full_name']) || empty($_POST['account']) || empty($_POST['password']) || empty($_POST['email'])) {
                echo '<script>alert("Vui lòng điền đầy đủ thông tin!");</script>';
                return;
            }

            $data = [
                'full_name' => $_POST['full_name'],
                'account' => $_POST['account'],
                'password' => $this->handlePassword($_POST['password']),
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'role' => $_POST['role'],
                'phone' => $_POST['phone']
            ];

            // Thêm người dùng vào cơ sở dữ liệu
            $this->user->insertUser($data);
            echo '<script>alert("Thêm người dùng thành công!");</script>';
            echo '<script>location.href="index.php?page=user";</script>';
        } else {
            $this->renderView('adduser', []);  // Truyền mảng rỗng để tránh lỗi
        }
    }

    // Xóa người dùng theo ID
    public function delUser()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $id = $_GET['id'];
            $this->user->deleteUser($id);
            echo '<script>alert("Xóa người dùng thành công!");</script>';
            echo '<script>location.href="index.php?page=user";</script>';
        } else {
            echo '<script>alert("Không tìm thấy ID người dùng!");</script>';
        }
    }

    // Hiển thị form chỉnh sửa người dùng
    public function viewEditUser()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $id = $_GET['id'];
            $this->data['user'] = $this->user->getUserById($id);
            $this->renderView('edituser', $this->data);
        } else {
            echo "Không có dữ liệu!";
        }
    }

    // Cập nhật thông tin người dùng
    public function editUser()
    {
        if (isset($_POST['edituser'])) {
            // Kiểm tra dữ liệu đầu vào
            if (empty($_POST['full_name']) || empty($_POST['account']) || empty($_POST['email'])) {
                echo '<script>alert("Vui lòng điền đầy đủ thông tin!");</script>';
                return;
            }

            $data = [
                'user_id' => $_POST['user_id'],
                'full_name' => $_POST['full_name'],
                'account' => $_POST['account'],
                'password' => $this->handlePassword($_POST['password']),
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'role' => $_POST['role'],
                'phone' => $_POST['phone']
            ];

            // Cập nhật thông tin người dùng
            $this->user->updateUser($data);
            echo '<script>alert("Cập nhật người dùng thành công!");</script>';
            echo '<script>location.href="index.php?page=user";</script>';
        }
    }
}
