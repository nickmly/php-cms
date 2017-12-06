<?php 
    include __DIR__ . "/db.php";
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

    function getAllCategories() {
        global $db_connect;
        $query = "SELECT * FROM categories";
        $result = mysqli_query($db_connect, $query);
        return $result;
    }

    function addCategory() {
        global $db_connect;
        if(isset($_POST['submit_cat'])){
            $cat_title = $_POST['cat_title'];
            if($cat_title == "" || empty($cat_title)){
                echo "You must enter a title!";
                return;
            }
            $query = "INSERT INTO categories (cat_title) VALUES ('$cat_title')";
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                echo "Error! Query failed: " . mysqli_error($db_connect);
            }
        }
    }

    function deleteCategory() {
        global $db_connect;
        if(isset($_GET['delete_cat'])){
            $cat_id = $_GET['id'];
            $query = "DELETE FROM categories WHERE cat_id = '$cat_id'";
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                echo "Error! Query failed: " . mysqli_error($db_connect);
            }
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

    function displayPosts($posts) {
        while($row = mysqli_fetch_assoc($posts)){
            
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

    function searchForPosts() {
        global $db_connect;        
        if(isset($_POST['submit'])) {
            $search = $_POST['search'];
            // Select all post_tags similiar to search term
            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search' ";
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                die("Search query failed! " . mysqli_error($db_connect));
            }
            $count = mysqli_num_rows($result);
            echo "<h3>Results found: " . $count . "</h3>";
            if($count > 0)
                displayPosts($result);
        }
    }
?>