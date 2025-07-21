<?php
session_start();

require "../class/Task.php";
require "../database/db.php";

if (!isset($_SESSION['userid']) || !isset($_GET['id'])) {
    exit();
}
$db = new Database();
$conn = $db->connect();
$task = new Task($conn);

$id = (int)$_GET['id'];
$tasks = $task->getTaskById($id);

if (isset($_POST['edit'])) {
    $editedtask = $_POST['task'];
    try {
        if ($task->edittask($id, $editedtask)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Failed to update the task. Please try again.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
<h2>Edit Task:</h2>
<form method="post">
    <input name="task" value="<?php echo $tasks['task'] ?> " required>
    <input type="submit" name="edit" value="Edit">
</form>