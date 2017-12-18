<?php 
    include_once "includes/functions.php";
?>
<div class="col-md-4">
    <?php
        if(!isLoggedIn()) {
    ?>
        <!-- Login Form -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Login</h4>
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
        </div>
    <?php
        }
    ?>   
    
    <!-- Blog Search Well -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Blog Search</h4>
            <form action="search.php" method="post">
                <div class="input-group">
                    <input name="search" type="text" class="form-control">
                    <span class="input-group-btn">
                        <button name="submit" class="btn btn-default" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                </div> 
            </form>
        </div> 
    </div>

    <!-- Blog Categories Well -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Blog Categories</h4>
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled">
                        <?php
                            displayAllCategories();
                        ?>
                    </ul>
                </div>            
            </div>
        </div>        
    </div>

</div>