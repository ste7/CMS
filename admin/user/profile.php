<?php require_once '../../app/init.php'; require_once '../parts/header.php';

if(isset($_GET['user_id'])){
    $id = $_GET['user_id'];
}else{
    header('Location: http://localhost/CMS/admin/');
}

$results = DB::getInstance()->get('users', array('id', '=', $id));
$user = new User();

$validate = new Validate();
$file = new File();
if(Input::exists()){
    $requirements = array(
        'name' => array(
            'required' => true,
            'min' => '2',
            'max' => '50'
        ),
        'last_name' => array(
            'required' => 'true',
            'min' => '2',
            'max' => '50'
        ),
        'username' => array(
            'required' => true,
            'min' => '6',
            'max' => '30'
        )
    );
    $validate->check($_POST, $requirements);

    if(!$validate->errorsExists()){
        $patch = $results->first()->img;

        if($file->exist('file')){

            $file->upload('file');
            if(!$file->error()){
                $patch = Session::get('img_name');
            }
        }
        $user = new User();
        $db = new DB();

        $db->update('users', array(
            'name' => Input::get('name'),
            'last_name' => Input::get('last_name'),
            'username' => Input::get('username'),
            'img' => $patch),
            array('id' => $id));

        Session::put('message_name', 'You have successfully updated your profile.');
    }
}
?>

    <h3 class="title">Users</h3>
    <hr>
    <?php alert();

?>
    <div class="row profile-form">
        <form class="form-horizontal" id="frm" method="post" enctype="multipart/form-data">

            <div class="form-group <?php echo $validate->errorExists('name') ? 'has-error' : '' ?>">
                <label class="control-label col-sm-2" for="name">First name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo Input::get('name') ? : $results->first()->name; ?>"><span><?php echo $validate->error('name'); ?></span>
                </div>
            </div>

            <div class="form-group <?php echo $validate->errorExists('last_name') ? 'has-error' : '' ?>">
                <label class="control-label col-sm-2" for="last_name">Last name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name" value="<?php echo Input::get('last_name') ? : $results->first()->last_name; ?>"><span><?php echo $validate->error('last_name'); ?></span>
                </div>
            </div>

            <div class="form-group <?php echo $validate->errorExists('username') ? 'has-error' : '' ?>">
                <label class="control-label col-sm-2" for="username">Username:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php echo Input::get('username') ? : $results->first()->username; ?>"><span><?php echo $validate->error('username'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="joined">Joined:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="joined" name="joined" value="<?php echo $results->first()->joined; ?>" disabled>
                </div>
            </div>

            <div class="form-group <?php echo $validate->errorExists('file') ? 'has-error' : '' ?>">
                <label class="control-label col-sm-2" for="joined">Joined:</label>
                <div class="col-sm-10">
                    <input type="file" id="file" class="btn btn-default" name="file" onchange="readURL(this)"><span><?php echo $file->error(); ?></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="save">Save</button>
                </div>
            </div>

            <?php include '../parts/modal-box.php'; ?>

        </form>
    </div>

    <!-- avatar/output -->
    <div class="prof-img-wrapp" id="prof-img-wrapp">
        <img class="img-rounded" id="img-output" src="<?php echo $user->getAvatar($id); ?>">
    </div>
    <!-- avatar/output -->


<?php require_once '../parts/footer.php'; ?>