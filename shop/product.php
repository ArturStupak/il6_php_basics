<?php
include 'helper.php';

$id = $_GET['id'];
$product = getProductByID($id);



?>
<div class="title">
    <?php echo $product['name']; ?>
    <br>
    <?php echo $product['price']; ?>
    <br>
    <a href="<?php echo getProductUrl($product['id'])?>">I krepseli...</a>


</div>