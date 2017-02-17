<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo APP_URL . "app/css/style.css" ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo APP_URL . "app/font-awesome/css/font-awesome.min.css" ?>">

    <!--  jquery-ui  -->
    <link rel="stylesheet" href="<?php echo APP_URL . "app/js/jquery-ui/jquery-ui.css" ?>">
    <link rel="stylesheet" href="<?php echo APP_URL . "app/js/jquery-ui/jquery-ui.structure.css" ?>">
    <link rel="stylesheet" href="<?php echo APP_URL . "app/js/jquery-ui/jquery-ui.theme.css" ?>">
    <!--  jquery-ui  -->

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'.body' });</script>
    <title><?php echo url(); ?></title>
</head>
<body>

<?php
$u = new User();
if(!$u->isLogged()){
    Redirect::to('http://localhost/CMS/login.php');
}
$user = DB::getInstance()->get('users', array('id', '=', Session::get('session_name')));
?>

<div class="header-admin">
    <?php include 'sidebar.php'; ?>
    <div class="hdr">
        <a class="user" href="http://localhost/CMS/admin/user/profile.php?user_id=<?php echo $user->first()->id; ?>">
            <span><?php echo $user->first()->username; ?></span>
            <div class="for-img">
                <img class="img-circle" src="<?php echo $u->getAvatar($user->first()->id); ?>">
            </div>
        </a>
    </div>
</div>
<div class="container-admin">