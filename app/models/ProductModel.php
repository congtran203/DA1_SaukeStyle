<?php
class ProductModel
{
    private $db;
    function __construct()
    {
        $this->db = new Database();
    }
    public function getAllPro($limit, $offset)
    {
        // Directly insert the $limit and $offset into the SQL query
        $sql = "SELECT * FROM products LIMIT $limit OFFSET $offset";

        return $this->db->getAll($sql);
    }



    function getRandPro()
    {
        $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 8";
        return $this->db->getAll($sql);
    }

    function getHotPro()
    {
        $sql = "SELECT * FROM products 
                    WHERE pro_id IN (
                        SELECT MIN(pro_id) 
                        FROM products 
                        GROUP BY cate_id
                    ) 
                    ORDER BY pro_id ASC 
                    LIMIT 8";
        return $this->db->getAll($sql);
    }

    function getNewPro()
    {
        $sql = "SELECT * FROM products ORDER BY pro_id DESC LIMIT 8";
        return $this->db->getAll($sql);
    }

    function getProById($pro_id)
    {
        if ($pro_id > 0) {
            $sql = "SELECT * FROM products WHERE pro_id = $pro_id";
            return $this->db->getOne($sql);
        } else {
            return null;
        }
    }
    function getProVariants($pro_id)
    {
        $sql = "SELECT * 
                FROM product_variants 
                WHERE pro_id = $pro_id";
        return $this->db->getAll($sql);
    }


    function getVariantById($variant_id)
    {
        if ($variant_id > 0) {
            $sql = "SELECT * FROM product_variants WHERE variant_id = $variant_id";
            return $this->db->getOne($sql);
        } else {
            return null;
        }
    }

    function getProByIdCate($cate_id)
    {
        $sql = "SELECT p.* FROM products p 
        INNER JOIN categories c ON p.cate_id= c.cate_id WHERE c.cate_id = $cate_id ORDER BY RAND() LIMIT 4";
        return $this->db->getAll($sql);
    }

    public function getTotalProducts()
    {
        $query = "SELECT COUNT(*) AS total FROM products";
        $param = [];
        // Assuming getAll() returns an array, we fetch the first row and return the 'total' value
        $result = $this->db->getAll($query, $param);

        // Return the count as an integer
        return (int) $result[0]['total'];  // Adjust based on your getAll() method's return structure
    }
    public function filterProductsByCategory($categoryId)
    {
        $query = "SELECT p.*, c.cate_name 
                  FROM products p
                  LEFT JOIN categories c ON p.cate_id = c.cate_id
                  WHERE p.cate_id = :cate_id";
        $params = [
            ':cate_id' => $categoryId
        ];

        return $this->db->getAll($query, $params);
    }

    public function filterProducts($categoryId, $minPrice = null, $maxPrice = null, $sortOrder = null)
    {
        // Khởi tạo câu SQL cơ bản
        $sql = "SELECT * FROM products WHERE cate_id = :category_id";

        // Thêm điều kiện lọc giá nếu có
        $params = [':category_id' => $categoryId];
        if ($minPrice) {
            $sql .= " AND pro_price >= :min_price";
            $params[':min_price'] = $minPrice;
        }
        if ($maxPrice) {
            $sql .= " AND pro_price <= :max_price";
            $params[':max_price'] = $maxPrice;
        }

        // Thêm điều kiện sắp xếp nếu có
        if ($sortOrder) {
            switch ($sortOrder) {
                case 'name_az':
                    $sql .= " ORDER BY pro_name ASC";
                    break;
                case 'name_za':
                    $sql .= " ORDER BY pro_name DESC";
                    break;
                case 'price_az':
                    $sql .= " ORDER BY pro_price ASC";
                    break;
                case 'price_za':
                    $sql .= " ORDER BY pro_price DESC";
                    break;
            }
        }

        // Sử dụng phương thức getAll từ Database.php để lấy dữ liệu
        return $this->db->getAll($sql, $params);
    }
    // function getNameCate($idcate){
    //     $sql = "SELECT name FROM category WHERE id = $idcate";
    //     return $this->db->getOne($sql);
    // }
    // function getPro($sp){
    //     $sql = "SELECT * FROM products";
    //     if($sp == 1){
    //         $sql .= " WHERE view > 1000 ORDER BY view DESC LIMIT 3";
    //     }else{
    //         $sql .= " ORDER BY id DESC";
    //     }
    //     return $this->db->getAll($sql);
    // }

    // function getIDCate($idpro){
    //     $sql = "SELECT idcate FROM products WHERE id = $idpro";
    //     return $this->db->getOne($sql);
    // }
    // function getCatePro($idcate, $idpro){
    //     $sql = "SELECT * FROM products WHERE idcate = $idcate AND id <> $idpro";
    //     return $this->db->getAll($sql);
    // }

    // function insertPro($data){
    //     $sql = "INSERT INTO products(name,category,idcate,image) VALUES(?,?,?,?,?)";
    //     $param = [$data['name'],$data['category'],$data['idcate'],$data['image']];
    //     return $this->db->insert($sql,$param);
    // }

    // function deletePro($id){
    //     $sql = "DELETE FROM products WHERE id = ?";
    //     return $this->db->delete($sql,[$id]);
    // }

    // function updatePro($data){
    //     $sql = "UPDATE products SET name = ?, category = ?, image = ?, idcate = ? WHERE id = ?";
    //     $param = [$data['name'],$data['category'],$data['image'],$data['idcate'],$data['id']];
    //     $this->db->insert($sql,$param);
    // }
}
