    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="http://localhost/CMS/admin/">CMS</a>
        </li>
        <li>
            <span>Content</span>
        </li>
        <li class="<?php echo (url() == 'Items') ? 'active' : ''; ?>">
            <a href="http://localhost/CMS/admin/page/items.php">All Pages<i class="fa fa-file" aria-hidden="true"></i></a>
        </li>
        <li class="<?php echo (url() == 'Create') ? 'active' : ''; ?>">
            <a href="http://localhost/CMS/admin/page/create.php">Create New Page<i class="fa fa-plus" aria-hidden="true"></i></a>
        </li>
        <li>
            <span>Users</span>
        </li>
        <li class="<?php echo (url() == 'Users') ? 'active' : ''; ?>">
            <a href="http://localhost/CMS/admin/user/users.php">All Users<i class="fa fa-list" aria-hidden="true"></i></a>
        </li>
        <li class="<?php echo (url() == 'Register') ? 'active' : ''; ?>">
            <a href="http://localhost/CMS/admin/user/register.php">Add User<i class="fa fa-user-plus" aria-hidden="true"></i></a>
        </li>
        <li>
            <a href="http://localhost/CMS/">Go to website<i class="fa fa-car" aria-hidden="true"></i></a>
        </li>
        <li>
            <a href="http://localhost/CMS/logout.php">Logout<i class="fa fa-hand-o-right" aria-hidden="true"></i></i></a>
        </li>
    </ul>
