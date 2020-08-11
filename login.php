<?php
session_start();
require_once 'connect.php';

if (isset($_POST['login'])) {
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $sql = "SELECT username from users where username=:username";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($user === false) {
        die ('Incorrect username or password');
    } else {
        $validPassword = password_verify($password, password_hash($password,PASSWORD_BCRYPT));
        if ($validPassword) {


            $_SESSION['USER_DATA'] = $user;
            echo "Hello User:" . $_SESSION['USER_DATA']['username'];
            exit;
        }
        else {
            die ('Incorrect username or password1');
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h1>Login</h1>
<form action="login.php" method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password"><br>
    <input type="submit" name="login" value="Login">
</form>
</body>
</html>
