<?php
if(Session::exists('message_name')): ?>
    <div class="alert alert-info" role="alert">
        <?php echo Session::get('message_name');Session::delete('message_name'); ?>
    </div>
<?php endif;