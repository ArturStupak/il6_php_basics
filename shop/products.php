<?php
include 'helper.php';

$products = readFromCSV('products.csv');
$products = prepearProducts($products);
?>
<div class="grid">
<?php foreach ($products as $key => $product) : ?>
    <div class="product-wrap">
        <div class="name">
            <?php echo $product['name']?>
        </div>
        <div class="price">
            <?php echo $product['price'] . "Eur"?>

        </div>
        <?php if($product['qty'] > 0): ?>
        <a href="<?php echo getProductUrl($product['id'])?>">I krepseli...</a>
        <?php endif; ?>
    </div>
<?php if(($key + 1) % 3 == 0) : ?>
        <br>
        <br>
        <br>
        <hr>
<?php endif;?>
<?php endforeach; ?>
</div>