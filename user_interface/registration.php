<!--<input type="text" name="first_name" placeholder="Vardas"><br>-->
<!--<input type="text" name="last_name" placeholder="Pavarde"><br>-->
<!--<input type="email" name="email" placeholder="emailas"><br>-->
<!--<input type="password" name="password1" placeholder="********"><br>-->
<!--<input type="password" name="password2" placeholder="********"><br>-->
<!--<label for="agree_terms">Sutinku su registracijos taisyklemis</label>-->
<!--<input type="checkbox" name="agree_terms" id="agree_terms"><br>-->

<?php
include 'helper.php';
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password1'];
$password2 = $_POST['password2'];

$email = clearEmail($email);

if(isPasswordValid($password, $password2) && isEmailValid($email)){
    $data = [];
    $password = hashPassword($password);
    $data[]=  [$firstName, $lastName, $email, $password];
    writeToCSV($data, 'users.csv');
}else{
    echo 'Patikrinkite duomenis ir pabandykite dar karta';
}