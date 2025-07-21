<?php
class Task
{
    private $conn;
    private $table = "todo";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addtask($userid, $task ,$deadline)
    {
        $query = "INSERT INTO {$this->table} (user_id, task, deadline) VALUES(:userid, :task, :deadline)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':userid' => $userid, ':task' => $task, ':deadline' => $deadline]);
    }
    public function getTaskById($taskid)
    {
        $query = "SELECT * FROM {$this->table} WHERE id= :id ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $taskid]);
        return $stmt->fetch();
    }

    public function gettask($userid)
    {
        $query = "SELECT * FROM {$this->table} WHERE user_id= :userid ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':userid' => $userid]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletetask($taskid, $userid)
    {
        $query = "DELETE FROM {$this->table} WHERE id= :id AND user_id= :userid";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $taskid, ':userid' => $userid]);
    }

    public function edittask($taskid, $task)
    {
        $query = "UPDATE {$this->table} SET task=:task WHERE id=:id;";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':task' => $task,':id' => $taskid]);
    }
}
