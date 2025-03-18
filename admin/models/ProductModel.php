<?php
class ProductModel
{
    private $db;
    private $pdo;

    public function __construct()
    {
        $this->db = new Database();
        $this->pdo = $this->db->getConnection(); // Giả sử Database có phương thức getConnection()
    }

    public function getAllPro()
    {
        $sql = "SELECT * FROM products";
        return $this->db->getAll($sql);
    }

    public function getIdPro($pro_id)
    {
        $sql = "SELECT * FROM products WHERE pro_id = ?";
        return $this->db->getOne($sql, [$pro_id]);
    }

    public function addPro($data)
    {
        try {
            $sql = "INSERT INTO products (pro_name, pro_price, cate_id, pro_image, pro_description) 
                    VALUES (?, ?, ?, ?, ?)";
            $params = [
                $data['pro_name'],
                $data['pro_price'],
                $data['cate_id'],
                $data['pro_image'],
                $data['pro_description'],
            ];
            return $this->db->insert($sql, $params);
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return false;
        }
    }

    public function deletePro($pro_id)
    {
        try {
            $sql = "DELETE FROM products WHERE pro_id = ?";
            return $this->db->delete($sql, [$pro_id]);
        } catch (Exception $e) {
            error_log("Error deleting product: " . $e->getMessage());
            return false;
        }
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories";
        return $this->db->getAll($sql);
    }

    public function updatePro($data)
    {
        $sql = "UPDATE products SET 
                    pro_name = :pro_name,
                    pro_price = :pro_price,
                    cate_id = :cate_id,
                    pro_image = :pro_image,
                    pro_description = :pro_description
                WHERE pro_id = :pro_id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':pro_name' => $data['pro_name'],
            ':pro_price' => $data['pro_price'],
            ':cate_id' => $data['cate_id'],
            ':pro_image' => $data['pro_image'],
            ':pro_description' => $data['pro_description'],
            ':pro_id' => $data['pro_id']
        ]);
    }

    public function getVariantsByProId($pro_id)
    {
        $sql = "SELECT * FROM product_variants WHERE pro_id = ?";
        return $this->db->getAll($sql, [$pro_id]);
    }

    public function addVariant($data)
    {
        $sql = "INSERT INTO product_variants (variant_size, variant_price, variant_material, variant_discounted_price, pro_id) 
                VALUES (?, ?, ?, ?, ?)";
        $params = [
            $data['variant_size'],
            $data['variant_price'],
            $data['variant_material'],
            $data['variant_discounted_price'],
            $data['pro_id']
        ];
        return $this->db->insert($sql, $params);
    }
}
