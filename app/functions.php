<?php

function config($array, $field){
    return $GLOBALS['config'][$array][$field];
}

function _print($results){
    echo "<pre>", print_r($results), "</pre>";
}

function replace_underscore($value){
    return str_replace("_"," ", $value);
}

function is_assoc($array = array()){
    $keys = array_keys($array);
    if(array_keys($keys) !== $keys){
        return true;
    }else{
        return false;
    }
}

function url(){
    $current = basename($_SERVER['REQUEST_URI']);
    $title = chop($current, '.php');
    return ucfirst($title);
}

function escape($text){
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); //ENT_QUOTES - level of escaping
}

function alert(){
    if(!file_exists('../../admin/parts/alert.php')){
        include '../admin/parts/alert.php';
    }else{
        include '../../admin/parts/alert.php';
    }
}