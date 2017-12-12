<?php
    include "includes/admin_header.php";
    include_once "../includes/functions.php";
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(isset($_SESSION['user_id'])) {
        $user = getUser($_SESSION['user_id']); 
        editCurrentUser();       
    }

?>
<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/admin_nav.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="page-header">
                        Profile
                    </h1>                    
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
                            <img class="img-responsive" src="../images/<?php echo $user['user_image']; ?>">
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
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<?php
    include "includes/admin_footer.php";
?>