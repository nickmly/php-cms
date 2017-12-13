<?php 
    include "includes/db.php";
    include "includes/header.php";
    include "includes/nav.php";
    include_once "includes/functions.php";
?>

<!-- Page Content -->


    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Latest Posts
            </h1>

            <?php         
                if(isset($_GET['category'])) {
                    displayPostsInCategory($_GET['category']);
                } else {
                    displayAllPosts();
                }
            ?>           

            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
        

    </div>
    <!-- /.row -->

    <hr> 


<?php
    include "includes/footer.php";
?>
