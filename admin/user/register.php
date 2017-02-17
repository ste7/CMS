<?php require_once '../../app/init.php';

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
            'max' => '30',
            'unique' => true
        ),
        'password' => array(
            'required' => true,
            'min' => '6',
            'max' => '20'
        ),
        'password_again' => array(
            'required' => true,
            'matches' => true
        )
    );
    $validate->check($_POST, $requirements);

    if(!$validate->errorsExists() && !$file->error()){
        $file->upload('file');
        $patch = $file->filePatch();
        try{
            $user = new User();
            $user->register('name', 'last_name', 'username', $patch, 'password');
            Session::put('message_name', 'You have successfully registered new user.');
            Redirect::to('http://localhost/CMS/admin/');
        }catch(Exception $e){
            $e->getMessage();
        }
    }
}

require '../parts/header.php'; ?>

    <h3 class="title">Register</h3>
    <hr>
    <div class="row register_form">
        
        <form class="form-horizontal" method="post">
            <div class="form-group <?php echo $validate->errorExists('name') ? 'has-error' : '' ?>">
                <label class="control-label col-sm-2" for="name">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo Input::get('name'); ?>"><span><?php echo $validate->error('name'); ?></span>
                </div>
            </div>

            <div class="form-group <?php echo $validate->errorExists('last_name') ? 'has-error' : '' ?>">
                <label class="control-label col-sm-2" for="last_name">Last name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name" value="<?php echo Input::get('last_name'); ?>"><span><?php echo $validate->error('last_name'); ?></span>
                </div>
            </div>

            <div class="form-group <?php echo $validate->errorExists('username') ? 'has-error' : '' ?>">
                <label class="control-label col-sm-2" for="username">Username:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php echo Input::get('username'); ?>"><span><?php echo $validate->error('username'); ?></span>
                </div>
            </div>

            <div class="form-group <?php echo $validate->errorExists('password') ? 'has-error' : '' ?>">
                <label class="control-label col-sm-2" for="password">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" autocomplete="off"><span><?php echo $validate->error('password'); ?></span>
                </div>
            </div>

            <div class="form-group <?php echo $validate->errorExists('password_again') ? 'has-error' : '' ?>">
                <label class="control-label col-sm-2" for="password_again">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password_again" name="password_again" placeholder="Enter password again" autocomplete="off"><span><?php echo $validate->error('password_again'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="register">register</button>
                </div>
            </div>
        </form>
    </div>

<?php require '../parts/footer.php';