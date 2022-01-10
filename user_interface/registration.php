<?php
include 'helper.php';
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password1'];
$password2 = $_POST['password2'];



$email = clearEmail($email);
//$users = readFromCSV('user.csv');
//
//checkFreeEmail($email, $users);

$users = readFromCsv('users.csv');

//foreach($users as $user) {
//    if ($email === $user[2]) {
//        echo "Toks email jau egzistuoja". " ".  "<a href='index.php'>Grizti</a>";
//        return false;
//    }
//}
//checkFreeEmail($email, $users);

//foreach($users as $user){
//    if($nickname === $user[2]){
//        $nickname = $nickname.rand(0,100);
//    }
//
//}

if(isPasswordValid($password, $password2) &&
    isEmailValid($email) &&
    isValueUniq($email , EMAIL_FIELD_KEY) &&
    isset($_POST['agree_terms'])){
    $nickname = generateNickName($firstName, $lastName);
    while(!isValueUniq($nickname, NICKNAME_FIELD_KEY)){
        $nickname = $nickname . rand(0,100);
    }
    $data = [];
    $password = hashPassword($password);
    $data[]=  [$firstName, $lastName, $nickname, $email, $password];
    writeToCSV($data, 'users.csv');
}else{
    echo 'Patikrinkite duomenis ir pabandykite dar karta';
}

//if(isset($_POST['agree_terms'])) {
//    writeToCSV($data, 'users.csv');
//}else{
//    echo 'Nesutikote su taisyklemes';
//    die();
//}