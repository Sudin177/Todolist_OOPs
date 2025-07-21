<?php
session_start();
require "../database/db.php";
require "../class/User.php";
if(isset($_SESSION['userid']))
{
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $db = new Database();
    $conn = $db->connect();

    $user = new User($conn);
    $login = $user->login($_POST['username'], $_POST['password']);
    if ($login) {
        $_SESSION['userid'] = $login;
        $_SESSION['username'] = htmlspecialchars($_POST['username']);
        header("Location: index.php");
        exit();
    } else
        echo "Login failed.";
}
?>
<form action="login.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br>
    <input type="submit" name="login" value="Login"><br>
    <a href="register.php"><u>Don't have an account?</u></a>
</form>