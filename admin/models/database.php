<?php
class Database
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=da1;charset=utf8mb4", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Kết nối database thất bại: " . $e->getMessage());
        }
    }

    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function commit()
    {
        $this->pdo->commit();
    }

    public function rollBack()
    {
        $this->pdo->rollBack();
    }

    public function getAll($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll() ?: [];
        } catch (PDOException $e) {
            error_log("FetchAll failed: " . $e->getMessage() . " SQL: $sql Params: " . json_encode($params));
            return [];
        }
    }

    public function getOne($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetch() ?: null;
        } catch (PDOException $e) {
            error_log("FetchOne failed: " . $e->getMessage() . " SQL: $sql Params: " . json_encode($params));
            return null;
        }
    }

    public function insert($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $this->pdo->lastInsertId(); // Trả về ID của bản ghi vừa thêm
        } catch (PDOException $e) {
            error_log("Insert failed: " . $e->getMessage() . " SQL: $sql Params: " . json_encode($params));
            return false;
        }
    }

    public function update($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Update failed: " . $e->getMessage() . " SQL: $sql Params: " . json_encode($params));
            return false;
        }
    }

    public function delete($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Delete failed: " . $e->getMessage() . " SQL: $sql Params: " . json_encode($params));
            return false;
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
