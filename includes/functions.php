<?php 
    include "includes/db.php";
?>
<?php
    function displayAllCategories() {
        global $db_connect;
        $query = "SELECT * FROM categories";
        $result = mysqli_query($db_connect, $query);
        while($row = mysqli_fetch_assoc($result)) {
            $title = $row["cat_title"];
            echo "<li><a href='#'>". $title . "</a></li>";
        }
    }

    function displayAllPosts() {
        global $db_connect;
        $query = "SELECT * FROM posts";
        $result = mysqli_query($db_connect, $query);
        while($row = mysqli_fetch_assoc($result)) {
            $title = $row["post_title"];
            $author = $row["post_author"];
            $content = $row["post_content"];
            $date = $row["post_date"];
            $image = $row["post_image"];
            ?>
           
            <h2>
                <a href="#"><?php echo $title; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
            <hr>
            <img class="img-responsive" src="<?php echo $image; ?>" alt="">
            <hr>
            <p><?php echo $content; ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
        <?php
        }
    }
?>