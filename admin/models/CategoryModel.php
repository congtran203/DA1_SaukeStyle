<?php
class CategoryModel
{
    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    // Lấy tất cả các danh mục
    function getCate()
    {
        $sql = "SELECT cate_id, cate_name, cate_image FROM categories";
        return $this->db->getAll($sql);
    }

    // Thêm danh mục
    function insertCate($data)
    {
        $sql = "INSERT INTO categories (cate_name, cate_image) VALUES (?, ?)";
        $param = [$data['cate_name'], $data['cate_image']];
        return $this->db->insert($sql, $param);
    }

    // Cập nhật danh mục
    function updateCate($data)
    {
        $sql = "UPDATE categories SET cate_name = ?";
        $param = [$data['cate_name']];

        if (!empty($data['cate_image'])) {
            $sql .= ", cate_image = ?";
            $param[] = $data['cate_image'];
        }

        $sql .= " WHERE cate_id = ?";
        $param[] = $data['cate_id'];

        return $this->db->update($sql, $param);
    }

    // Xóa danh mục
    function deleteCate($cate_id)
    {
        $sql = "DELETE FROM categories WHERE cate_id = ?";
        return $this->db->delete($sql, [$cate_id]);
    }

    // Lấy danh mục theo ID
    function getIdCate($cate_id)
    {
        $sql = "SELECT * FROM categories WHERE cate_id = ?";
        return $this->db->getOne($sql, [$cate_id]);
    }
}
