<?php
class SearchModel
{
    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function searchPro($input)
    {
        if (!empty($input)) {
            $query = "SELECT * FROM products WHERE pro_name  LIKE :searchTerm";
            $params = [':searchTerm' => $input . '%'];

            // Lấy kết quả
            $result = $this->db->getAll($query, $params);

            return $result;
        }
        return [];
    }
}
