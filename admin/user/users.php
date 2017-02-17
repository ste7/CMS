<?php require_once '../../app/init.php'; require_once '../parts/header.php';

$results = DB::getInstance()->get('users');
$user = new User();
$i = 1;
?>

    <h3 class="title">Users</h3>
    <hr>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Joined</th>
            <th>Avatar</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($results->results() as $result): ?>
            <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $result->name; ?></td>
                <td><?php echo $result->last_name; ?></td>
                <td><?php echo $result->username; ?></td>
                <td><?php echo Date_Time::get($result->joined); ?></td>
                <td><img class="img-rounded avatar" src="<?php echo $user->getAvatar($result->id); ?>"></td>
            </tr>
        <?php $i++;; ?>
        <?php endforeach; ?>
        </tbody>
    </table>


<?php require_once '../parts/footer.php'; ?>