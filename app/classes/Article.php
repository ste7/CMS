<?php

class Article{
    private $_db;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function getCover($id){
        $cover = $this->_db->get('articles', array('id', '=', $id));
        $img = str_replace('../', '', $cover->first()->img);
        
        return APP_URL . $img;
    }
}