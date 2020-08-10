<?php
session_start();
require_once 'connect.php';

if (isset($_POST['login'])) {
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $sql = "SELECT user_id,username,password from users where username=:username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {
        die ('Incorrect username or password1');
    } else {
        $validPassword = password_verify($passwordAttempt, $user['password']);
        print_r([$validPassword]);
        if ($validPassword) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['logged_in'] = time();
            header('Location: index.php');
            exit;
        }
        else{
                die('Incorrect username or password');
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
    <input type="text" id="password" name="password"><br>
    <input type="submit" name="login" value="Login">
</form>
</body>
</html>
