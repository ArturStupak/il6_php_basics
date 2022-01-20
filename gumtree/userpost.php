<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbName = 'auto_plus';
try {
    $conn = new PDO("mysql:host=$servername;dbname=" . $dbName, $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = 'SELECT * FROM cities';
$rez = $conn->query($sql);
$cities = $rez->fetchAll();

if (isset($_POST['register'])) {
    $name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password1'];
    $number = $_POST['number'];


    $sql = 'INSERT INTO users (name, last_name, email, password, phone, city_id)
            VALUES("' . $name . '", "' . $last_name . '", "' . $email . '" , "' . $password . '" ,"' . $number . '", 1)';

//    echo $sql;

    $conn->query($sql);
}
