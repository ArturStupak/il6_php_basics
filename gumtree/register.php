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

$sql = 'SELECT * FROM cities';
$rez = $conn->query($sql);
$cities = $rez->fetchAll();

?>


<html>
<body>

       <?php
            foreach($cities as $city){
                echo '<option value="'.$city['id'].'">' .$city['name'].'</option>';
            }

       ?>
    </select><br>
<!--    <label for="agree_terms">Sutinku su registracijos taisyklemis</label>-->
<!--    <input type="checkbox" name="agree_terms" id="agree_terms"><br>-->
    <input type="submit" name="register" value="Registruotis">
</form>
</body>

<?php include 'parts/footer.php'; ?>









