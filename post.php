<?php 
    include "includes/db.php";
    include "includes/header.php";
    include "includes/nav.php";
    include_once "includes/functions.php";
    $post = getPost($_GET['p_id']);
?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->

            <!-- Title -->
            <h1><?php echo $post['post_title']; ?></h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#"><?php echo $post['post_author']; ?></a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post['post_date']; ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="images/<?php echo $post['post_image']; ?>" alt="">

            <hr>

            <!-- Post Content -->
            <p>
                <?php echo $post['post_content']; ?>
            </p>

            <hr>

            <!-- Blog Comments -->
            <?php
                addComment();
            ?>
            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="comment_author">Author</label>
                        <input name="comment_author" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comment_email">Email</label>
                        <input name="comment_email" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comment_content">Content</label>
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button name="create_comment" type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <?php
                $comments = getAllPostComments($_GET['p_id']);
            ?>
            <!-- Comment -->
            <?php
                while($row = mysqli_fetch_assoc($comments)){
            ?>
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $row['comment_author']; ?>
                                <small><?php echo $row['comment_date']; ?></small>
                            </h4>
                            <?php echo $row['comment_content']; ?>
                        </div>
                    </div>
                <?php
                }
            ?>
            
           

        </div>
        <hr>

         <!-- Blog Sidebar Widgets Column -->
         <?php include "includes/sidebar.php"; ?>
        

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
        <!-- /.row -->
    </footer>

</div>
<!-- /.container -->

<?php
    include "includes/footer.php";
?>
