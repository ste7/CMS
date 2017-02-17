<?php

class File{
    private $_errors = array(),
        $_patch = null,
        $_newImgName = null,
        $_file_ext;

    public function exist($name){
        if(file_exists($_FILES[$name]['tmp_name']) || is_uploaded_file($_FILES[$name]['tmp_name'])){
            return true;
        }else{
            $this->addError("Chose picture");
            return false;
        }
    }

    public function upload($name){
        $file = $_FILES[$name];

        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];

        $file_ext = explode('.', $file_name);
        $this->_file_ext = strtolower(end($file_ext));

        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($this->_file_ext, $allowed)){
            if($file_size <= 2097512){
                $file_name_new = uniqid('', true) . '.' . $this->_file_ext;
                $file_destination = '../../app/img/' . $file_name_new;

                if(move_uploaded_file($file_tmp, $file_destination)){
                    $this->_patch = substr($file_destination, 3);
                }
            }else{
                $this->addError("Picture can't be larger then 2MB");
                return false;
            }
        }else{
            $this->addError("It's not right file extension");
            return false;
        }
    }

    public function createCopy($img){
        if($this->_file_ext == "png"){
            $copy = imagecreatefrompng($img);
            return $copy;
        }else{
            $copy = imagecreatefromjpeg($img);
            return $copy;
        }
    }

    public function output($top, $left, $right, $bottom, $wid, $hei){
        $image = "../" . $this->_patch;
        list($width, $height) = getimagesize($image);

        $new_width = $wid;
        $new_height = $hei;

        $thumb = imagecreatetruecolor($new_width, $new_height);
        $src = $this->createCopy($image);

        //http://php.net/manual/en/function.imagecopyresized.php
        imagecopyresized($thumb, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagejpeg($thumb, $image, 100);

        $create = imagecreatefromjpeg($image);
        $dest = imagecreatetruecolor($right, $bottom);

        imagecopyresampled($dest, $create, 0, 0, $left, $top, $right, $bottom, $right, $bottom);
        $this->_newImgName = uniqid('', true) . '.jpg';
        imagejpeg($dest,  "../img/" . $this->_newImgName, 100);
    }

    public function type(){
        return $this->_file_ext;
    }

    public function filePatch(){
        return $this->_patch;
    }

    public function getName(){
        return $this->_newImgName;
    }

    public function addError($error){
        $this->_errors[] = $error;
    }

    public function error(){
        return $this->_errors ? $this->_errors[0] : false;
    }

    public function delete(){
        unlink('../' . $this->_patch);
    }
}