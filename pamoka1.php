<?php
/*$products = [

[

'name' => 'Siulai',

'price' => 12.4,

'specialprice' => 9.99,

'img' => 'https://siulupinkles.lt/wp-content/uploads/2021/01/Mezgimo-siulai-ritese-italiski-siulai-kasmyras-kasmyro-siulai-silko-siulai-silkas.jpg'

],

[

'name' => 'adata',

'price' => 1.99,

'img' => 'https://www.vle.lt/uploads/_CGSmartImage/70839_3-26c56fce05f1ac6e0247f6daa86648aa.jpg'

],

[

'name' => 'virbalai',

'price' => 3.99,

'specialprice' => 2.99,

'img' => 'https://mezgimomanija.lt/wp-content/uploads/2019/02/3397.jpg'

],

[

    'name' => 'virbalai',

    'price' => 3.99,

    'img' => 'https://mezgimomanija.lt/wp-content/uploads/2019/02/3397.jpg'

],

[

    'name' => 'virbalai',

    'price' => 3.99,

    'img' => 'https://mezgimomanija.lt/wp-content/uploads/2019/02/3397.jpg'

],

[

    'name' => 'virbalai',

    'price' => 3.99,

    'img' => 'https://mezgimomanija.lt/wp-content/uploads/2019/02/3397.jpg'

],

[

    'name' => 'virbalai',

    'price' => 3.99,

    'img' => 'https://mezgimomanija.lt/wp-content/uploads/2019/02/3397.jpg'

],
];

$counter = 0;


foreach($products as $product){

echo '<img width="60" src="'. $product['img'] .'"/>';

echo '<h2>'. $product["name"] . '</h2>';

if(isset($product['specialprice'])) {
    echo '<del>Price:' . $product["price"] . '</del>';
    echo '<h2> Special price:' . $product["specialprice"];
}else{
        echo '<h2> Price:' . $product["price"] . '</h2>';

}


$counter ++;
if($counter % 3 ===0){
    echo '<hr>';
}


}*/


/*for($y = 0; $y < 10; $y ++){
    for($x = 0; $x < 10; $x ++){
        if($y % 2 == 0){
            echo ".";
        }else{
            if($x % 2 == 0){
                echo "#";
            }else {
                echo ".";
            }
        }
    }
    echo"<br>";
}*/
for($years = 2015; $years < 2022; $years++){
        for($months = 1; $months <= 12; $months++){
            if($months % 2 == 0){
                for($day = 1; $day <= 31; $day++){
                    echo $years.' '.$months.' '.$day;
                    echo '<br>';
                }
            }else{
                for($day = 1; $day <= 30; $day++){
                    echo $years.' '.$months.' '.$day;
                    echo '<br>';
                }
            }

       /* for($day = 1; $day <= 31; $day++){

            echo $years.' '.$months.' '.$day;

            echo '<br>';*/

    }
}
?>