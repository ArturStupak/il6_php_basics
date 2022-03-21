<?php

$array = [1, 3, 4, 6, 9 ,2, 3, 4, 5, 5, 7, 8, 9, 10, 1, 4, 5,34, 23, 1, 4, 6, 77, 3, 9];
$average = array_sum($array)/count($array);
$a = [];
$b = [];
$count1 = 0;
$count2 = 0;
foreach ($array as $element){
    if($element < $average){
        $a[] = $element;
        $count1 ++;
    }else{
        $b[] = $element;
        $count2 ++;
    }
}
$averageLower = array_sum($a)/$count1;
$averageHigher = array_sum($b)/$count2;
echo "Lowers numbers average: " . number_format((float)$averageLower, 2, '.', '');
echo "<br>";
echo "Highest numbers average: " . $averageHigher;
echo "<br>";
echo "Count of lowers numbers: " . $count1;
echo "<br>";
echo "Count of highest numbers: " . $count2;
echo "<br>";
echo "<br>";
echo "<br>";


$array2 = [1000, 2303, 444, 5554, 9993, 45454, 4343, 65656, 65659, 43434, 92, 23456, 758595, 344433];
$maxEven = (max(array_filter($array2, function($var){return(!($var & 1));})));
$newValue = $maxEven/100*60;
$ar = array_replace($array2,
    array_fill_keys(
        array_keys($array2, $maxEven),
        $newValue)
);
echo "<pre>";
print_r($array2);
echo "<pre>";
print_r($ar);