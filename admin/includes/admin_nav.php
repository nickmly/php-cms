<?php 
    if(session_status() == PHP_SESSION_NONE)
        session_start();
    include_once "../includes/user_functions.php";
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">PHP Blog Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <!-- USER ACTIONS -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="../index.php">
                <i class="fa fa-fw fa-home"></i>Home
            </a>
        </li>      
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i> <?php showCurrentUsername(); ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <li>
                    <a class="dropdown-item" href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>     
    <!-- END USER ACTIONS -->
    <ul class="navbar-nav flex-column mr-auto side-nav">
        <li class="nav-item">
            <a class="nav-link" href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-file"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="posts_dropdown" class="collapse">
                <li class="nav-item">
                    <a href="posts.php">View All Posts</a>
                </li>
                <li class="nav-item">
                    <a href="posts.php?source=add">Add Post</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="categories.php"><i class="fa fa-fw fa-folder-open"></i> Categories</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:;" data-toggle="collapse" data-target="#users_dropdown"><i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="users_dropdown" class="collapse">
                <li>
                    <a href="users.php">View All Users</a>
                </li>
                <li>
                    <a href="users.php?source=add">Add User</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="comments.php"><i class="fa fa-fw fa-comments"></i> Comments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
        </li>
    </ul>
  </div>
</nav>