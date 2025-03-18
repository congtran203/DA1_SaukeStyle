<?php
class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "da1";
    private $conn;
    private $stmt;

    function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->database;charset=utf8", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Kết nối thất bại: " . $e->getMessage();
        }
    }

    function query($sql, $params = [])
    {
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->execute($params);
            return $this->stmt;
        } catch (PDOException $e) {
            echo "Lỗi truy vấn: " . $e->getMessage();
            return false;
        }
    }

    function getAll($sql, $params = [])
    {
        $statement = $this->query($sql, $params);
        return $statement ? $statement->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    function getOne($sql, $params = [])
    {
        $statement = $this->query($sql, $params);
        return $statement ? $statement->fetch(PDO::FETCH_ASSOC) : null;
    }

    function insert($sql, $params)
    {
        if ($this->query($sql, $params)) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    function update($sql, $params)
    {
        try {
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            echo "Lỗi cập nhật: " . $e->getMessage();
            return false;
        }
    }

    function delete($sql, $params)
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Lỗi xóa: " . $e->getMessage();
            return false;
        }
    }
}
