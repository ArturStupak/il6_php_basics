<?php
include 'functions.php';

/*$string = 'Hello PHP';
print($string);

$productName = 'adidas';
$productPrice = 23;
$productSize = 43;


$array = [
    'name' => $productName, 
    'price' => $productPrice, 
    'size' => $productSize];
echo "<pre>";
print_r ($array);*/

$title ="nauja antraste mano";
$slug = getSlug($title);
echo $slug;
?>
