<?php
    include_once __DIR__ . "/../../includes/user_functions.php";
    $user = getUser($_GET['update_user']);
    editUser();
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_username">Username</label>
        <input type="text" name="user_username" class="form-control" value="<?php echo $user['user_username']; ?>">        
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" class="form-control" value="<?php echo $user['user_password']; ?>">        
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" class="form-control" value="<?php echo $user['user_email']; ?>">        
    </div>
    <div class="form-group">
        <label for="user_image">User Image</label>
        <img class="img-fluid" src="../images/<?php echo $user['user_image']; ?>">
        <input type="file" name="user_image" class="btn btn-default">        
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" name="user_firstname" class="form-control" value="<?php echo $user['user_firstname']; ?>">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" class="form-control" value="<?php echo $user['user_lastname']; ?>">        
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <select class="form-control" name="user_role">
            <?php 
                if($user['user_role'] == 'subscriber') {
                   echo "<option selected value='subscriber'>Subscriber</option>";
                   echo "<option value='admin'>Admin</option>";
                } else {
                    echo "<option value='subscriber'>Subscriber</option>";
                    echo "<option selected value='admin'>Admin</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">        
        <input type="submit" name="user_update" class="btn btn-primary" value="Update User">
    </div>
</form>