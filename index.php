<?php require_once 'app/init.php'; require_once 'app/parts/header.php';

$a = new Article();
$articles = DB::getInstance()->get('SELECT * FROM articles 
                                             WHERE id < (SELECT MAX(id) FROM articles)
                                             ORDER BY id DESC');

if($articles->results()): ?>
    <div class="container">
        <div class="row">
            <?php foreach($articles->results() as $value): ?>
                <div class="col-md-4 article">
                    <span><?php echo Date_Time::get($value->created); ?></span>
                    <a href="page.php?page=<?php echo $value->slug; ?>">
                        <div class="for-img2">
                            <img class="img-responsive center-block" src="<?php echo $a->getCover($value->id); ?>">
                        </div>
                        <h3><?php echo escape($value->title); ?></h3>
                    </a>
                    <p class="text-muted"><?php echo $value->subtitle; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif;

require_once 'app/parts/footer.php';