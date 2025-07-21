<?php
class User
{
    private $conn;
    private $table = "user";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT id FROM user WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            // Username already exists
            return false;
        }

        $query = "INSERT INTO {$this->table} (username,password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindparam(":username", $username);
        $stmt->bindparam(':password' , $hashed);
        $trimuser = trim($username);
        if($trimuser !='')
        {
            return $stmt->execute();
        }
    }


    public function login($username, $password)
    {
        $query = "SELECT * FROM {$this->table} WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        }
        return false;
    }

    public function getuser($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id= :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
