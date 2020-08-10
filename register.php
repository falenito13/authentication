<?php
require_once 'connect.php';

if (isset($_POST['register'])){

    //ak shegidzliat validation gaaketot
    $username = !empty($_POST['username']) ? trim($_POST['username']) :  null;
    $password= !empty($_POST['password']) ? trim($_POST['password']) :  null;

    //amocebas arsebobs tu ara es user
    $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();

    //moakvs data
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['num'] > 0){
        die('That username already exists!');
}
    //uketebs hashs usaprtxoebistvis

    $password = password_hash($password,PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (username,password) values (:username,:password)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':username',$username);
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
    <label for="password">Password</label>
    <input type="text" id="password" name="password"><br>
    <input type="submit" name="register" value="Register"></button>
</form>
</body>
</html>
