<?php require_once '../../app/init.php'; require_once '../parts/header.php';

$articles = DB::getInstance()->get('articles');
$i = 1;
?>
    <h3 class="title">List Off Items</h3>
    <hr>
    <?php alert(); ?>
    <table class="table items-table">
        <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Slug</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Created by</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($articles->results() as $result): ?>
            <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><a href="update.php?id=<?php echo $result->id; ?>"><?php echo $result->id; ?></a></td>
                <td><a href="update.php?id=<?php echo $result->id; ?>"><?php echo "/" . $result->slug; ?></a></td>
                <td><a href="update.php?id=<?php echo $result->id; ?>"><?php echo Date_Time::get($result->created); ?></a></td>
                <td><a href="update.php?id=<?php echo $result->id; ?>"><?php echo Date_Time::get($result->updated); ?></a></td>
                <?php $user = DB::getInstance()->get('users', array('id', '=', $result->user_id)); ?>
                <td><a href="update.php?id=<?php echo $result->id; ?>"><?php echo $user->first()->username; ?></a></td>
            </tr>
            <?php $i++;; ?>
        <?php endforeach; ?>
        </tbody>
    </table>



<?php require_once '../parts/footer.php'; ?>