<?php require_once 'app/init.php'; require_once 'app/parts/header.php';

if(isset($_GET['page'])):
    $slug = Input::get('page');
    $article = DB::getInstance()->get('articles', array('slug', '=', $slug));
    $user = DB::getInstance()->get('users', array('id', '=', $article->first()->user_id));
    $u = new User();
    ?>

    <div class="container my-custom-container">
        <img src="<?php echo $u->getAvatar($user->first()->id); ?>" class="img-circle">
        <p class="text-muted"><?php echo $user->first()->name . " " . $user->first()->last_name; ?></p>
        <?php
        $article = DB::getInstance()->get('articles', array('slug', '=', $slug));
        ?>
        <h5 class="text-muted"><?php echo Date_Time::get($article->first()->created); ?></h5>
        <hr>
        <?php echo $article->first()->body; ?>
    </div>
    
    <?php else:
               Redirect::to('http://localhost/CMS/');
          endif;
require_once 'app/parts/footer.php';