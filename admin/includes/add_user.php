<?php
    include_once __DIR__ . "/../../includes/functions.php";
    addUser(true);
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_username">Username</label>
        <input type="text" name="user_username" class="form-control">        
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" class="form-control">        
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" class="form-control">        
    </div>
    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="user_image" class="btn btn-default">        
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" class="form-control">        
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <select class="form-control" name="user_role">
            <option value="subscriber">Subscriber</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <div class="form-group">        
        <input type="submit" name="user_submit" class="btn btn-primary" value="Add User">
    </div>
</form>