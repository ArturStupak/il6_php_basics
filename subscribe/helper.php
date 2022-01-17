<?php
const EMAIL_FIELD_KEY = 0;
$email = $_POST['email'];

function isEmailValid($email){
    return strpos($email, '@') !== false;
}
function clearEmail($email){
    return trim(strtolower($email));
}
$email = clearEmail($email);

function readFromCSV($fileName){
    $data = [];
    $file= fopen($fileName, 'r');
    while (!feof($file)){ // sukasi iki failo pabaigos
        $line = fgetcsv($file);
        if(!empty($line)){
            $data[]= $line;
        }
    }
    fclose($file);
    return $data;
}

function isValueUniq($value){
    $users = readFromCSV('history.csv');
    foreach($users as $user){
//        print_r($user);
        if($user[0] === $value){
            return false;
        }
    }
    return true;
}


if(isEmailValid($email) && isValueUniq($email)) {
    $file = fopen('history.csv', 'a');
    fputcsv($file, [$email]);
}else{
    echo 'Patikrinkite Email';

}






