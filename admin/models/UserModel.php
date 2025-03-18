<?php
class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database(); // Kết nối Database
    }

    // Lấy thông tin người dùng dựa trên tài khoản và mật khẩu
    public function getUser($account, $password)
    {
        $sql = "SELECT * FROM users WHERE account = ? AND password = ?";
        return $this->db->getOne($sql, [$account, $password]);
    }

    // Lấy thông tin người dùng theo tài khoản
    public function getUserByAccount($account)
    {
        $sql = "SELECT * FROM users WHERE account = ?";
        return $this->db->getOne($sql, [$account]);
    }

    // Lấy danh sách tất cả người dùng
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        return $this->db->getAll($sql);
    }

    // Lấy thông tin người dùng theo ID
    public function getUserById($id)
    {
        if ($id > 0) {
            $sql = "SELECT * FROM users WHERE user_id = ?";
            return $this->db->getOne($sql, [$id]);
        } else {
            return null;
        }
    }

    // Thêm người dùng (cho người dùng thông thường)
    public function insertUserForUser($data)
    {
        $sql = "INSERT INTO users (full_name, account, password, email, address, phone) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $params = [
            $data['full_name'],
            $data['account'],
            $data['password'],
            $data['email'],
            $data['address'],
            $data['phone']
        ];
        return $this->db->insert($sql, $params);
    }

    // Thêm người dùng (cho admin)
    public function insertUser($data)
    {
        $sql = "INSERT INTO users (full_name, account, password, email, address, role, phone) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = [
            $data['full_name'],
            $data['account'],
            $data['password'],
            $data['email'],
            $data['address'],
            $data['role'],
            $data['phone']
        ];
        echo $sql;
        print_r($params);
        return $this->db->insert($sql, $params);
    }


    // Xóa người dùng
    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE user_id = ?";
        return $this->db->delete($sql, [$id]);
    }

    // Cập nhật thông tin người dùng
    public function updateUser($data)
    {
        $sql = "UPDATE users 
                SET full_name = ?, account = ?, password = ?, 
                    email = ?, address = ?, role = ?, phone = ? 
                WHERE user_id = ?";
        $params = [
            $data['full_name'],
            $data['account'],
            $data['password'],
            $data['email'],
            $data['address'],
            $data['role'],
            $data['phone'],
            $data['user_id']
        ];
        return $this->db->update($sql, $params);
    }
}
