<?php
require_once 'connect.php';

if (isset($_POST['register'])){

    //ak shegidzliat validation gaaketot
    $username = !empty($_POST['username']) ? trim($_POST['username']) :  null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) :  null;
    $password= !empty($_POST['password']) ? trim($_POST['password']) :  null;
    $passwordrepeat= !empty($_POST['passwordrepeat']) ? trim($_POST['passwordrepeat']) :  null;

    //amocebas arsebobs tu ara es user
    $sql = "SELECT COUNT(user_id) AS userId FROM users WHERE username = :username OR  email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email',$email);
    $stmt->execute();

    //moakvs data
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row['userId']> 0) {
        die ("the username or email already exists!");
    }
    if ($password != $passwordrepeat){
        die('That passwords are not the same!');
    }
    //uketebs hashs usaprtxoebistvis

    $password = md5($password);
    $passwordrepeat = password_hash($passwordrepeat,PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (username,email,password) values (:username,:email,:password)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':username',$username);
    $stmt->bindValue(':email',$email);
    $stmt->bindValue(':password',$password);

    $result = $stmt->execute();

    if ($result){
    echo "Thanks for registering";
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
<h1>Register</h1>
<form action="register.php" method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username"><br>
    <label for="email">Email</label>
    <input type="email" id="email" name="email"><br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password"><br>
    <label for="passwordrepeat">Password Repeat</label>
    <input type="password" id="passwordrepeat" name="passwordrepeat"><br>

    <input type="submit" name="register" value="Register"></button>
</form>
</body>
</html>
