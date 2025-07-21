<?php
require "../database/db.php";
require "../class/User.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $conn = $db->connect();
    $user = new User($conn);

    if ($user->register($_POST['username'], $_POST['password'])) {

        header("Location: login.php");
        exit();
    }
    echo "Registration failed !!";
}

?>
<form action="register.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br>
    <input type="submit" name="register" value="Register">
</form>