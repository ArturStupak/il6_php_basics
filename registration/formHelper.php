<?php

function generateInput($data){
    $input = '';
    $input .= '<input ';
    foreach ($data as $key => $value){
        $input .= $key.'="' .$value.'" ';
    }
    $input .= '>';
    return $input;
}
 function generateSelect($data){
    $select = '';
    $select .= '<select name =" '.$data['name'].'">' ;
        foreach($data['option'] as  $option){
            $select .= '<option value="'.$option.'">'.$option.'</option>';
        }
        $select .= '</select>';
        return $select;

 }

function generateTextArea($data){
    $text = '';
    $text .= '<textarea name ="' .$data['name'] .'"></textarea>';
    $text .= '</textarea>';
    return $text;
}