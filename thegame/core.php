<?php

const TOOL_ROCK = 'rock';
const TOOL_PAPER = 'paper';
const TOOL_SCISSORS = 'scissors';

$toolsArray = [
    0 => TOOL_ROCK,
    1 => TOOL_PAPER,
    2 => TOOL_SCISSORS,
];

if(isset($_POST['play'])){
    $playerChoise = $_POST['tool'];
    $pcChoise = rand(0,2);
    $pcChoise = $toolsArray[$pcChoise];
    echo '<table>';
    echo '<tr><td><img width="200" src="image/' . $playerChoise . '.jpg"></td><td>VS</td><td><img width="200" src="image/' . $pcChoise . '.jpg"></td></td></tr>';
    echo '</table>';
    if($playerChoise == $pcChoise){
        $outcome = 'lygusios';
        echo $outcome;
    }elseif($playerChoise == TOOL_ROCK && $pcChoise == TOOL_SCISSORS ){
        $outcome = 'Laimejote';
        echo $outcome;
    }elseif($playerChoise == TOOL_PAPER && $pcChoise == TOOL_ROCK){
        $outcome = 'Laimejote';
        echo $outcome;
    }elseif($playerChoise == TOOL_SCISSORS && $pcChoise == TOOL_PAPER){
        $outcome = 'Laimejote';
        echo '$outcome';
    }else{
        $outcome = 'Pralaimejote';
        echo $outcome;
    }

    $file = fopen('history.csv', 'a');
    fputcsv($file,[$playerChoise,$pcChoise,$outcome]);
    fclose($file);
}

function getResults(){

    $file = fopen('history.csv', 'r');
    $data = [];

    while (!feof($file)){
        $data[] = fgetcsv($file);
    }
    return $data;
}

//$data = getResults();
////$data[] = ['Player played -' . $playerChoise, 'PC played -' .$pcChoise, 'Result' .$outcome]
//array_reverse($data);
//$i=0;
//$win =0;
//$lost = 0;
//foreach($data as $element){
//    if($element[2] === 'Laimejote' ){
//        $win ++;
//    }elseif($element[2] === 'Pralaimejote'){
//        $lost ++;
//    }
//    if ($i++ == 10)break;
////    print_r($element);
////    echo '<br>';
//}
//if($win > $lost){
//    echo 'Player win';
//}else{
//    echo 'Pc win';
//
//}
//echo '<br>';
//echo $win;
//echo '<br>';
//echo $lost;