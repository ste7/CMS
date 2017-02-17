<?php

class Trythis{
    private $_text = "";

    public function yo(){
        $this->_text = "Message yo_";
        return $this;
    }

    public function hi(){
        return "Message hi_";
    }

    public function yo2(){
        $this->_text = "Message yo_";
        return $this;
    }
}