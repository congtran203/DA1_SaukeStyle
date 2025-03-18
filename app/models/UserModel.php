<?php
class UserModel
{
    private $db;

    function __construct()
    {
        $this->db = new Database();
    }


    public function getUser($email,$password) {
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        return $this->db->getOne($sql);
    }

    public function getUserByName($email) {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        return $this->db->getOne($sql);
    }

    public function getAllUser() {
        $sql = "SELECT * FROM users";
        return $this->db->getAll($sql);
    }

    // function getIdUser($iduser){
    //     if($iduser > 0){
    //         $sql = "SELECT * FROM user WHERE id = $iduser";
    //         return $this->db->getOne($sql);
    //     }else{
    //         return null;
    //     }
    // }
    function insertUserForUser($data){
        $sql = "INSERT INTO users(full_name,phone,email,password,role) VALUES(?,?,?,?,?)";
        $param = [$data['fullName'],$data['phone'],$data['email'],$data['password'],$data['role']];
        return $this->db->insert($sql,$param);
    }
    // function insertUserByAdmin($data){
    //     $sql = "INSERT INTO user(name,date,user,pass,role) VALUES(?,?,?,?,?)";
    //     $param = [$data['name'],$data['date'],$data['user'],$data['pass'],$data['role']];
    //     return $this->db->insert($sql,$param);
    // }

    // function deleteUser($id){
    //     $sql = "DELETE FROM user WHERE id = ?";
    //     return $this->db->delete($sql,[$id]);
    // }

    function updateUser($data){
        $sql = "UPDATE user SET name = ?, date = ?, user = ?, pass = ?, role = ? WHERE id = ?";
        $param = [$data['name'],$data['date'],$data['user'],$data['pass'],$data['role'],$data['id']];
        $this->db->insert($sql,$param);
    }

    public function getUserById($userId) {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        return $this->db->getOne($sql, [$userId]);
    }
    
    public function getOrdersByUserId($userId) {
        $sql = "SELECT * FROM orders WHERE user_id = ?";
        return $this->db->getAll($sql, [$userId]);
    }

}