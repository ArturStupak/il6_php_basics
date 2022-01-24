<?php

include 'parts/header.php'; ?>

<?php

$id=$_GET['id'];
$servername = "localhost";
$username = "root";
$password = "";
$dbName = 'auto_plus';
try {
    $conn = new PDO("mysql:host=$servername;dbname=" . $dbName, $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = "SELECT * FROM ads WHERE id=".$id;
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
            <?php echo "Title: ". $ad['title'];?>
        </div>
        <div class="price">
            <?php echo "Description: " .$ad['description'];?>
        </div>
        <div class="year">
            <?php echo "Manufacturer: " .$ad['manufacturer_id'];?>
        </div>
        <div class="year">
            <?php echo "Model: " .$ad['model_id'];?>
        </div>
        <div class="year">
            <?php echo "Price: " .$ad['price'];?>
        </div>
        <div class="year">
            <?php echo "Year: " .$ad['year'];?>
        </div>
        <div class="year">
            <?php echo "Type: " .$ad['type_id'];?>
        </div>


<!--        <div>-->
<!--           <a href="http://localhost/pamokos/gumtree/ad.php?id=--><?php //echo $ad['id']?><!--">More</a>-->
<!--        </div>-->
        <hr>
    </div>
<?php endforeach?>
</body>


<php?include 'parts/footer.php'; ?>