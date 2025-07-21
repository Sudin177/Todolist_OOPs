<?php
session_start();
require "../class/Task.php";
require "../database/db.php";

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit;
}
$db = new Database();
$conn = $db->connect();

$task = new Task($conn);
$tasks = $task->gettask($_SESSION['userid']);
echo"Hello, {$_SESSION['username']}<br><br>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do list</title>
</head>

<body>
    <form action="add.php" method="post">
        <label>Add a task:</label><br>
        <input type="text" name="task" required>
        <input type="date" name="deadline" required>
        <input type="submit" name="add" value="Add"><br>
    </form>
    <ul>
        <?php foreach ($tasks as $t): ?>
            <li>
                <?php echo htmlspecialchars($t['task'])?>
                <a href="delete.php?id=<?=$t['id']?>">Delete</a>
                <a href="edit.php?id=<?=$t['id']?>">Edit</a>
                <u><?php echo htmlspecialchars($t['deadline'])?></u>
            </li>
        <?php endforeach;?>
    </ul>
    <form action="index.php" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>

</html>
<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
}
?>