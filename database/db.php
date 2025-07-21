<?php
class Database
{
    private $host = "localhost";
    private $db_name = "todo";
    private $username = "root";
    private $password = "";
    private $conn;

    public function connect()
    {
        $this->conn = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            echo "Connection failed:" . $e->getMessage();
        }
        return $this->conn;
    }
}
