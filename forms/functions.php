<?php

//    $email = $_POST['user_email'];
//    $number1 = $_POST['number'];
//    $number2 = $_POST['number1'];
//    function isEmailValid($email)
//    {
//        if (strpos($email, "@")) {
//            return true;
//        } else {
//            return false;
//        }
//
//    }
//
//    if (isEmailValid($email)) {
//        echo $email;
//    } else {
//        echo "emailas blogas";
//    }
//}
//function suma($number1, $number2){
//    $answer = $number1 + $number2;
//    echo $answer;
//}
//
//suma($number1, $number2);

//switch($_POST['veiksmas']){
//    case "+":
//        echo $number1 + $number2;
//        break;
//    case"-":
//        echo $number1 - $number2;
//        break;
//    case"*":
//        echo $number1 * $number2;
//        break;
//    case"/":
//        echo $number1 / $number2;
//        break;
//}
//If($_POST['Password'] == $_POST['Password1'] && $_POST['Password'] == $_POST['Password2']){
//
//}
$emeilas = $_POST['email'];
$password = $_POST['password'];
$password1 = $_POST['password1'];



function isEmailValid($emeilas){
    if(strpos($emeilas, "@")){
        return true;
    }else{
        return false;
    }

}
function clearEmail($emeilas){
    $emailLowercases = strtolower($emeilas);
    return trim($emailLowercases);
}

if(isEmailValid($emeilas)){
    echo clearEmail($emeilas);
    echo "<br>";
}else{
    echo 'Blogas emailas';
    echo "<br>";
}

switch($password){
    case $password === $password1:
        echo "passwordas validus";
        break;
    default :
        echo "passwordas nevalidus";
        break;

}