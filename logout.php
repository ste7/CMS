<?php require_once 'app/init.php';

$user = new User();
$user->logOut();
Redirect::to('http://localhost/CMS/');