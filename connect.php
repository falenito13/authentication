<?php
define('host','localhost');
define('username','root');
define('password','');
define('dbname','users');


// errors
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);
//

//connect
$pdo = new PDO("mysql:host=". host . ";dbname=" .dbname ,username , password,$pdoOptions);