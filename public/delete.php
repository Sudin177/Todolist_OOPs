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

$task->deletetask((int)$_GET['id'], $_SESSION['userid']);
header("Location: index.php");
exit();
?>
