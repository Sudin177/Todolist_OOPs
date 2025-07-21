<?php
session_start();

require "../class/Task.php";
require "../database/db.php";

if (!isset($_SESSION['userid'])) {
    exit();
}

$db = new Database();
$conn = $db->connect();
$task = new Task($conn);
$trimtask=trim($_POST['task']);
if($trimtask!='')
{
    $task->addtask($_SESSION['userid'],($_POST['task']), $_POST['deadline']);
}
header("Location: index.php");
