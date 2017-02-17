<?php require_once '../../app/init.php'; require_once '../parts/header.php';

$validate = new Validate();
$file = new File();
$db = new DB();
$db = $db->get('users', array('id', '=', Session::get('session_name')));
if(Input::exists()){
    $requirements = array(
        'title' => array(
            'required' => true,
            'max' => '50'
        ),
        'subtitle' => array(
            'required' => true,
            'max' => '200'
        ),
        'body' => array(
            'required' => true
        ),
        'slug' => array(
            'required' => true,
        ),
        'img' => array(
            'required' => true
        )
    );

    $validate->check($_POST, $requirements);

    if(!$validate->errorsExists() && $file->exist('file')){
        $file->upload('file');
        if (!$file->error()) {
            $patch = $file->filePatch();

            $db->insert('articles', array(
                'title' => Input::get('title'),
                'subtitle' => Input::get('subtitle'),
                'body' => Input::get('body'),
                'img' => $patch,
                'created' => date("Y-m-d H:i:s"),
                'updated' => date("Y-m-d H:i:s"),
                'slug' => Input::get('slug'),
                'user_id' => Session::get('session_name')
            ));
            Session::put('message_name', 'You have successfully created new page.');
            Redirect::to('http://localhost/CMS/admin/page/items.php');
        }
    }
}

?>

    <h3 class="title">Create New Page</h3>
    <hr>
    <div class="row create-page">
        <form method="post" enctype="multipart/form-data">

            <div class="form-group col-sm-9 <?php echo $validate->errorExists('title') ? 'has-error' : ''; ?>">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" autocomplete="off" value="<?php echo Input::get('title'); ?>">
                <span class="help-block"><?php echo $validate->error('title'); ?></span>
            </div>

            <div class="form-group col-sm-3">
                <label for="created">Created</label>
                <input class="form-control" type="text" name="created" id="created" autocomplete="off" value="<?php echo Date_Time::get((date("Y-m-d",time()))); ?>" disabled>
            </div>

            <div class="form-group col-sm-9 <?php echo $validate->errorExists('slug') ? 'has-error' : ''; ?>">
                <label for="slug">Slug</label>
                <input class="form-control" type="text" name="slug" id="slug" autocomplete="off" value="<?php echo Input::get('slug'); ?>">
                <span class="help-block"><?php echo $validate->error('slug'); ?></span>
            </div>

            <div class="form-group col-sm-3">
                <label for="author">Author</label>
                <input class="form-control" type="text" name="author" id="author" autocomplete="off" value="<?php echo $db->first()->name . " " . $db->first()->last_name; ?>" disabled>
            </div>

            <div class="form-group col-sm-9">
                <label for="body">Body</label>
                <textarea class="form-control body" id="body" name="body"><?php echo Input::get('body'); ?></textarea>

                <span class="help-block"><?php echo $validate->error('body'); ?></span>
            </div>

            <div class="col-sm-3">
                <div class="cover-img">
                    <img id="img" src="">
                </div>
            </div>

            <label class="control-label col-sm-3 <?php echo $validate->errorExists('file') ? 'has-error' : ''; ?>" for="file">Add picture:</label>
            <div class="col-sm-3">
                <input type="file" id="fl" class="btn btn-default file" name="file" onchange="readURL(this)" value="<?php echo Input::get('file'); ?>">
                <span class="help-block"><?php echo $file->error(); ?></span>
            </div>

            <div class="form-group col-sm-3">
                <input class="btn btn-success" type="submit" value="Save">
                <input class="btn btn-danger" type="reset" value="Reset">
            </div>

            <div class="form-group col-sm-9 <?php echo $validate->errorExists('subtitle') ? 'has-error' : ''; ?>">
                <label for="subtitle">Subtitle<span class="subtitle-info"> (It will be under the title on the home page)</span></label>
                <textarea class="form-control" id="subtitle" name="subtitle"><?php echo Input::get('subtitle'); ?></textarea>
                <span class="help-block"><?php echo $validate->error('subtitle'); ?></span>
            </div>

        </form>
    </div>


<?php require_once '../parts/footer.php'; ?>