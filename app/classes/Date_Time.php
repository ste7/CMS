<?php

class Date_Time extends DateTime{
    
    public static function get($value){
        if($value){
            $value = new DateTime($value);
            return $value->format('jS M Y');
        }
        return false;
    }
}