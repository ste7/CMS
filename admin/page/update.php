<?php require_once '../../app/init.php'; require_once '../parts/header.php';

$validate = new Validate();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $article = DB::getInstance()->get('articles', array('id', '=', $id));
    $a = new Article();
    $file = new File();
    $db = new DB();

    if(isset($_POST['save'])){
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
            )
        );

        $validate->check($_POST, $requirements);

        if(!$validate->errorsExists()){
            if($file->exist('file')){
                $file->upload('file');
                if(!$file->error()){
                    $patch = $file->filePatch();
                }
            }else{
                $patch = $article->first()->img;
            }

            $db->update('articles', array(
                'title' => Input::get('title'),
                'body' => Input::get('body'),
                'subtitle' => Input::get('subtitle'),
                'slug' => Input::get('slug'),
                'img' => $patch,
                'updated' => date("Y-m-d H:i:s")),
                array('id' => $id));

            Session::put('message_name', 'You have successfully updated page.');
        }
    }elseif(isset($_POST['delete'])){
        $db->delete('articles', array('id' => $id));
        Session::put('message_name', 'You have successfully deleted page.');
        Redirect::to('http://localhost/CMS/admin/page/items.php');
    }
}else{
    Redirect::to('http://localhost/CMS/admin/');
}

alert(); ?>

    <h3 class="title">Edit Page</h3>
    <hr>
    <div class="row">
        <form method="post" id="frm" enctype="multipart/form-data">

            <div class="form-group col-sm-9 <?php echo $validate->errorExists('title') ? 'has-error' : ''; ?>">
                <label class="control-label" for="title">Title</label>
                <input class="form-control" type="text" name="title" autocomplete="off" value="<?php echo Input::get('title') ?: $article->first()->title; ?>">
                <span class="help-block"><?php echo $validate->error('title'); ?></span>
            </div>

            <div class="form-group col-sm-3">
                <label for="title">Created</label>
                <input class="form-control" type="text" name="title" autocomplete="off" value="<?php echo $article->first()->created; ?>" disabled>
            </div>

            <div class="form-group col-sm-9 <?php echo $validate->errorExists('slug') ? 'has-error' : ''; ?>">
                <label class="control-label" for="title">Slug</label>
                <input class="form-control" type="text" name="slug" autocomplete="off" value="<?php echo Input::get('slug') ?: $article->first()->slug; ?>">
                <span class="help-block"><?php echo $validate->error('slug'); ?></span>
            </div>

            <div class="form-group col-sm-3">
                <label for="title">Updated</label>
                <input class="form-control" type="text" name="title" autocomplete="off" value="<?php echo Date_Time::get((date("Y-m-d",time()))); ?>" disabled>
            </div>

            <div class="form-group col-sm-9">
                <label class="control-label" for="body">Body</label>
                <textarea class="form-control body" id="body" name="body"><?php echo Input::get('body') ?: $article->first()->body; ?></textarea>
                <span class="help-block"><?php echo $validate->error('body'); ?></span>
            </div>

            <div class="col-sm-3">
                <div class="cover-img">
                    <img id="img" src="<?php echo $a->getCover($article->first()->id); ?>">
                </div>
            </div>

            <label class="control-label col-sm-3 <?php echo $validate->errorExists('file') ? 'has-error' : ''; ?>" for="file">Add picture:</label>
            <div class="col-sm-3">
                <input type="file" id="file" class="btn btn-default file" name="file" onchange="readURL(this)" value="">
                <span class="help-block"><?php echo $file->error(); ?></span>
            </div>

            <div class="form-group col-sm-3">
                <input class="btn btn-success" type="submit" name="save" value="Save">
                <input class="btn btn-danger" type="submit" name="delete" value="Delete">
            </div>

            <div class="form-group col-sm-9 <?php echo $validate->errorExists('subtitle') ? 'has-error' : ''; ?>">
                <label for="subtitle">Subtitle<span> (It will be under the title on the home page)</span></label>
                <textarea class="form-control" id="subtitle" name="subtitle"><?php echo Input::get('subtitle') ?: $article->first()->subtitle; ?></textarea>
                <span class="help-block"><?php echo $validate->error('subtitle'); ?></span>
            </div>

            <?php /*include '../parts/modal-box.php';*/ ?>
            
        </form>
    </div>

<?php require_once '../parts/footer.php'; ?>