<?php 
    include "includes/db.php";
    include_once "includes/user_functions.php";
?>

 <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" role="navigation">
    <div class="container">
        <a class="navbar-brand" href="index.php">PHP Blog</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-1">
            <span class="navbar-toggler-icon"></span>
        </button>            
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php                    
                    if(getCurrentUserRole() == "admin") {                        
                    ?>
                     <li>
                        <a class="btn btn-light" href="admin/index.php">Admin</a>
                    </li>
                    <?php
                    }
                    if(isLoggedIn()) {
                    ?>
                    <li>
                        <a class="btn btn-light" href="includes/logout.php">Log Out</a>
                    </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a class="btn btn-light" href="register.php">Register</a>
                        </li>
                        <?php
                    }                   
                ?>
            </ul>
        </div>
    </div>
</nav>