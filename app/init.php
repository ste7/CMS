<?php
session_start();
require_once 'functions.php';

define("APP_URL", "http://localhost/cms/");
define("CURRENT_URL", __DIR__);
$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'dbname' => 'cmsdb'
    ),
    'session' => array(
        'session_name' => 'user',
        'message_name' => 'info',
        'img_name' => 'crop'
    )
);

spl_autoload_register("MyAutoLoad");
function MyAutoLoad($class){
    require_once 'classes/' . $class . '.php';
}

//ALTER TABLE articles AUTO_INCREMENT = 1
//reset mysql table
//http://stackoverflow.com/questions/12651867/mysql-delete-all-rows-from-table-and-reset-id-to-zero
//http://stackoverflow.com/questions/5452760/truncate-foreign-key-constrained-table