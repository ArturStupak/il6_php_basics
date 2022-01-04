<?php

/*$userEmail= "belekasgmail.com";


function isEmailValid($email){
    if(strpos($email, "@")){
        return true;
    }else{
        return false;
    }

}

if(isEmailValid($userEmail)){
    echo clearEmail($userEmail);
}else{
    echo 'Emailas nevalidus';
}


function clearEmail($email){
    $emailLowercases = strtolower($email);
    return trim($emailLowercases);
}*/

/*$name= "Artur";
$surname= "stupak";

echo getNickName($name, $surname);

function getNickName($name, $surName){
    $nameFirst = substr($name, 0, 3);
    $surNameFirst = substr($surName, 0, 3);
    return strtolower($nameFirst . $surNameFirst . rand(1,100));
}*/


/*$title = "jusu kokia nors antraste";
$slug = getSlug($title);
echo $slug;*/


function getSlug($title){
    $title = str_replace(' ', '-', $title);
    $title = strtolower($title);
    return $title;
}

?>