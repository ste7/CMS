<?php

class Validate{

    private $_error = array(),
            $_db;

    public function __construct(){
        $this->_db = DB::getInstance();
    }
    

    public function check($input, $fields = array()){
        foreach($fields as $key=>$value){
            foreach($input as $inputKey=>$inputValue){
                if($key == $inputKey){
                    foreach($value as $rule=>$rule_value){
                        if($inputValue == ""){
                            $this->addError($inputKey, "{$inputKey} is required");
                        }else{
                            switch($rule){

                                case $rule == "min";
                                    if(strlen($inputValue) < $rule_value){
                                        $this->addError($inputKey, "{$inputKey} must be a minimum of {$rule_value} characters");
                                    }
                                    break;
                                case $rule == "max";
                                    if(strlen($inputValue) > $rule_value){
                                        $this->addError($inputKey, "{$inputKey} must be a maximum of {$rule_value} characters");
                                    }
                                    break;
                                case $rule == "matches";
                                    if($input['password'] != $input['password_again']){
                                        $this->addError($inputKey, "{$inputKey} must match password");
                                    }
                                    break;
                                case $rule == "unique";
                                    if($this->unique($inputValue)){
                                        $this->addError($inputKey, "{$inputKey} already exist");
                                    }
                                    break;
                            }
                        }
                    }
                }
            }
        }
    }

    public function unique($value){
        $results = $this->_db->get('users', array('username', '=', $value));
        if($results->results()){
            return true;
        }else{
            return false;
        }
    }

    public function addError($field, $value){
        $this->_error[$field] = $value;
    }

    public function error($field){
        if(array_key_exists($field, $this->_error)){
            return replace_underscore($this->_error[$field]);
        }
    }

    public function errorsExists(){
        return $this->_error ? true : false;
    }

    public function errorExists($field){
        if($this->errorsExists()){
            return $this->_error[$field] ? true : false;
        }
        return false;
    }
}