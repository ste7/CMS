<?php
require_once '../init.php';
$file = new File();

if($file->exist('file')){
    $file->upload('file');
    $file->output($_POST['top'], $_POST['left'], $_POST['right'], $_POST['bottom'], $_POST['width'], $_POST['height']);

    echo $file->getName();
    Session::put('img_name', "../../app/img/" . $file->getName());
    $file->delete();
}