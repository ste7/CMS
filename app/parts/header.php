<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8N">
    <link rel="stylesheet" href="<?php echo APP_URL . "app/css/style.css" ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title><?php echo url(); ?></title>
</head>
<body>

<?php
$article = DB::getInstance()->get('articles');
$a = new Article();

if($article->results()):
    if(!isset($_GET['page'])): ?>
        <a href="page.php?page=<?php echo $article->last()->slug; ?>">
            <div class="full-width-image">
                <img src="<?php echo $a->getCover($article->last()->id); ?>">
                <div class="jumbotron">
                    <h2 class="display-3"><?php echo escape($article->last()->title); ?></h2>
                </div>
            </div>
        </a>
<?php
    else:
    $article = DB::getInstance()->get('articles', array('slug', '=', $_GET['page'])); ?>
    <a href="page.php?page=<?php echo $article->first()->slug; ?>" class="">
        <div class="full-width-image">
            <img src="<?php echo $a->getCover($article->last()->id); ?>">
            <div class="jumbotron">
                <h2 class="display-3"><?php echo escape($article->first()->title); ?></h2>
            </div>
        </div>
    </a>
<?php
    endif;
endif; ?>