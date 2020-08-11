<?php
session_start();
require_once 'connect.php';

if (isset($_POST['login'])) {
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $sql = "SELECT * from users where username=:username AND password=:password";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', md5($password));
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user===false)  {
        die ('Incorrect username or password');
    } else {
        $_SESSION['USER_DATA'] = $user;
        echo "Hello User:".$_SESSION['USER_DATA']['username'];
        }
    }
exit();
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
