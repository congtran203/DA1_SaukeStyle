<?php
    class CategoryModel{
        private $db;
        function __construct(){
            $this->db = new Database();
        }
        function getCate(){
            $sql = "SELECT * FROM categories";
            return $this->db->getAll($sql);
        }
        // function getIdCate($idcate){
        //     if($idcate > 0){
        //         $sql = "SELECT * FROM categories WHERE id = $idcate";
        //         return $this->db->getOne($sql);
        //     }else{
        //         return null;
        //     }
        // }
        // function insertCate($data){
        //     $sql = "INSERT INTO categories(id, name) VALUES(?,?)";
        //     $param = [$data['id'], $data['name']];
        //     return $this->db->insert($sql,$param);
        // }

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