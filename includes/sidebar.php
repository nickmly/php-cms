<?php 
    include_once "includes/functions.php";
?>
<div class="col-md-4">
    <?php
        if(!isLoggedIn()) {
    ?>
        <!-- Login Form -->
        <div class="well">
                <h4>Login</h4>
                <form action="includes/login.php" method="post">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username">                
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" name="login" type="submit">Login</button>
                        </span>
                    </div>        
                </form>
            </div>
            <?php
        }
    ?>   

    <!-- Blog Search Well -->
    <div class="well">        
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div> 
            <!-- /.input-group -->
        </form>
        <!-- /.search form -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                        displayAllCategories();
                    ?>
                </ul>
            </div>            
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php"; ?>

</div>