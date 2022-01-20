<?php
include 'parts/header.php'; ?>
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

$sql = 'SELECT * FROM ads';
$rez = $conn->query($sql);
$ads = $rez->fetchAll();
//echo "<pre>";
//print_r($ads);
?>
<html>
<body>
<?php foreach ($ads as $ad) : ?>
    <div class="product-wrap">
        <div class="name">
            <?php echo $ad['title'];?>
        </div>
        <div class="price">
            <?php echo $ad['price'];?>
        </div>
        <div class="year">
            <?php echo $ad['year'];?>
        </div>
        <hr>
    </div>
<?php endforeach?>
</body>
<?php include 'parts/footer.php'; ?>