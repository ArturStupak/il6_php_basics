<?php
date_default_timezone_set('Europe/Vilnius');
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
include '../vendor/autoload.php';
include '../config.php';
session_start();

if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] !== '/'){
    $path = trim($_SERVER['PATH_INFO'],'/');
//    echo '<pre>';
    $path = explode('/',$path);
    $class = ucfirst($path[0]);
    if(isset($path[1])){
        $method = $path[1];
    }else{
        $method = 'index';
    }

//    $param = $path[2];
//    include 'app/code/Controller/'.$class.'.php';
//    $obj = new $class();



    $class = '\Controller\\'.$class;
    if(class_exists($class)){
        $obj = new $class();
        if(method_exists($obj, $method)){
            if(isset($path[2])){
                $obj->$method($path[2]);
            }else{
               $obj->$method();
            }
        }else{
            $error = new \Controller\Error();
            $error->error404();

        }

    }else{
        $error = new \Controller\Error();
        $error->error404();
    }

}else{
    $obj= new \Controller\Home();
    $obj->index();
}

// domain.lt/controlleris/methodas/params


































//
//
//
//
//include 'FormHelper.php';
//$data = [
//    'type' => 'text',
//    'name' => 'name',
//    'placeholder' => 'Vardas'
//];
//$data2 = [
//    'type' => 'text',
//    'name' => 'last_name',
//    'placeholder' => 'Pavarde'
//];
//$data3 = [
//    'type' => 'email',
//    'name' => 'email',
//    'placeholder' => 'john@gmail.com'
//];
//$data4 = [
//    'type' => 'password',
//    'name' => 'password',
//    'placeholder' => '******'
//];
//$data5 = [
//    'name' => 'city',
//    'option' => [
//        1 => 'Kaunas',
//        2 => 'Vilnius',
//    ]
//
//
//];
//
//$formLogin = new FormHelper('login.php', 'POST');
//$formRegister = new FormHelper('register.php', 'POST');
//
//$formRegister->input($data);
//$formRegister->input($data2);
//$formRegister->input($data3);
//$formRegister->input($data4);
//$formRegister->select($data5);
//$formRegister->textArea('comment', 'komentaras');
//
//
//
//$formLogin->input($data3);
//$formLogin->input($data4);
//
//echo $formLogin->getForm();
//echo '<br>';
//echo $formRegister->getForm();