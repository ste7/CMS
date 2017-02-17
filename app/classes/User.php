<?php

class User{
    private $_db;
    private $_isLoggedIn = false;
    private $_error = array();

    public function __construct(){
        $this->_db = DB::getInstance();

        if(Session::exists('session_name')){
            $this->_isLoggedIn = true;
        }
    }

    public function register($name, $last_name, $username, $patch, $password){
        $salt = Hash::salt(32);

        $this->_db->insert('users', array(
            'name' => Input::get($name),
            'last_name' => Input::get($last_name),
            'username' => Input::get($username),
            'img' => $patch,
            'password' => Hash::makeHash(Input::get($password), $salt),
            'salt' => $salt,
            'joined' => date("Y/m/d")
        ));
    }



    public function login($username, $password){
        $user = $this->_db->get('users', array(
            'username', '=', Input::get($username)
        ));
        if($user->results()){
            if($user->first()->password == Hash::makeHash(Input::get($password), $user->first()->salt)){
                Session::put('session_name', $user->first()->id);
                return true;
            }else{
                $this->addError(1, "Password is wrong");
                
                return false;
            }
        }else{
            $this->addError(0, "Username doesn't exist");
            
            return false;
        }
    }

    public function logOut(){
        $this->_isLoggedIn = false;
        Session::delete('session_name');
    }
    
    public function isLogged(){
        return $this->_isLoggedIn;
    }
    
    public function addError($key, $value){
        $this->_error[$key] = $value;
    }
    public function error($field){
        if(array_key_exists($field, $this->_error)){
            return $this->_error[$field];
        }
    }

    public function getAvatar($id){
        $profile = $this->_db->get('users', array('id', '=', $id));
        if($profile->first()->img){
            $im = str_replace('../', '', $profile->first()->img);
            return APP_URL . $im;
        }else{
            return "https://www.gravatar.com/avatar/?d=mm";
        }
    }
}