<?php
include 'formHelper.php';

$inputs = [
    [
        'type' => 'text',
        'name' => 'name',
        'placeholder' => 'Vadras'
    ],
    [
        'type' => 'text',
        'name' => 'last_name',
        'placeholder' => 'pavarde'
    ],
    [
        'type' => 'password',
        'name' => 'password',
        'placeholder' => '******'
    ],
    [
        'type' => 'password',
        'name' => 'password2',
        'placeholder' => '******'
    ],
    [
        'type' => 'submit',
        'name' => 'register',
        'placeholder' => 'registruotis'
    ],
    [
        'type' => 'select',
        'name' => 'childrens_number',
        'option' => [0,1,2,3, '4+']
    ],
    [
        'type' => 'textarea',
        'name' => 'comments',

    ]
];
echo '<form action="registration.php" method="post">';

foreach ($inputs as $input){
    if($input['type'] !== 'select' && $input['type'] !== 'textarea'){
        echo generateInput($input). '<br>';
    }elseif(($input['type'] == 'select')){
        echo generateSelect($input). '<br>';
    }elseif($input['type'] === 'textarea'){
        echo generateTextArea($input);
        echo '<hr>';
    }
//    elseif(($input['type'] == 'textarea')){
//        echo generateTextArea($data);
//    }

}

echo '</forom>';