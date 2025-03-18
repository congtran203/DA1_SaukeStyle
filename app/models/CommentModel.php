<?php
    class CommentModel{
        private $db;
        function __construct(){
            $this->db = new Database();
        }
        // function getComment(){
        //     $sql = "SELECT * FROM comments";
        //     return $this->db->getAll($sql);
        // }
        function getCommentsByProId($pro_id){
            if($pro_id > 0){
                $sql = "SELECT * FROM comments WHERE pro_id = $pro_id";
                return $this->db->getAll($sql);
            }else{
                return null;
            }
        }
        function insertComment($data){
            $sql = "INSERT INTO comments(pro_id, content, user_id) VALUES(?,?,?)";
            $param = [$data['pro_id'], $data['content'],$data['user_id']];
            return $this->db->insert($sql,$param);
        }

        // function deleteCate($id){
        //     $sql = "DELETE FROM categories WHERE id = ?";
        //     return $this->db->delete($sql,[$id]);
        // }

        // function updateCate($data){
        //     $sql = "UPDATE categories SET name = ? WHERE id = ?";
        //     $param = [$data['name'],$data['id']];
        //     $this->db->insert($sql,$param);
        // }
    }