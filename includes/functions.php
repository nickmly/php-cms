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
            echo "<li><a href='index.php?category=". $row['cat_id'] ."'>". $title . "</a></li>";
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
                die("Error! Query failed: " . mysqli_error($db_connect));
            }
        }
    }

    function getCategoryTitle($cat_id) {
        global $db_connect;   

        $query = "SELECT * FROM categories WHERE cat_id = '$cat_id'";
        $result = mysqli_query($db_connect, $query);
        if(!$result) {
            die("Error! Query failed: " . mysqli_error($db_connect));
        }
        return mysqli_fetch_assoc($result)['cat_title'];
    }

    function editCategory() {
        global $db_connect;
        if(isset($_POST['update_cat'])){
            $cat_title = $_POST['cat_update_title'];
            $cat_id = $_GET['update_cat'];
            if($cat_title == "" || empty($cat_title)){
                echo "You must enter a title!";
                return;
            }
            $query = "UPDATE categories SET cat_title = '$cat_title' WHERE cat_id = '$cat_id'";
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                die("Error! Query failed: " . mysqli_error($db_connect));
            }
            header("Location: categories.php");
        }
    }

    function deleteCategory() {
        global $db_connect;
        if(isset($_GET['delete_cat'])){
            $cat_id = $_GET['delete_cat'];
            $query = "DELETE FROM categories WHERE cat_id = '$cat_id'";
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                die("Error! Query failed: " . mysqli_error($db_connect));
            }
            header("Location: categories.php");
        }
    }

    function deletePost() {
        global $db_connect;
        if(isset($_GET['delete_post'])){
            $post_id = $_GET['delete_post'];
            $query = "DELETE FROM posts WHERE post_id = '$post_id'";
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                die("Error! Query failed: " . mysqli_error($db_connect));
            }
            header("Location: posts.php");
        }
    }

    function getPost($id) {
        global $db_connect;
        $query = "SELECT * FROM posts WHERE post_id = $id";
        $result = mysqli_query($db_connect, $query);
        return mysqli_fetch_assoc($result);
    }

    function editPost() {
        global $db_connect;
        if(isset($_POST['post_update'])){
            $post_id = $_GET['update_post'];

            $post_title = $_POST['post_title'];
            $post_category = $_POST['post_cat'];
            $post_author = $_POST['post_author'];
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];
            $post_status = $_POST['post_status'];
    
            $post_image = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];
            $post_date = date('d-m-y');
            $post_comment_count = 0;

            if(empty($post_image)) {
                $query = "SELECT * FROM posts WHERE post_id = $post_id";
                $result = mysqli_query($db_connect, $query);
                $post_image = mysqli_fetch_assoc($result)['post_image'];
            }
            
            move_uploaded_file($post_image_temp, "../images/$post_image"); // Move image to images folder
             
            $query = "UPDATE posts SET post_title = '$post_title',
            post_category_id='$post_category', post_author ='$post_author',
            post_tags ='$post_tags', post_content='$post_content', post_image='$post_image',
            post_status='$post_status', post_date=now(), post_comment_count= $post_comment_count ";
           
           
            $query .= "WHERE post_id = $post_id";
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                die("Error! Query failed: " . mysqli_error($db_connect));
            }
            header("Location: posts.php");
        }
    }

    function addPost() {
        global $db_connect;
        if(isset($_POST['post_submit'])){
            $post_title = $_POST['post_title'];
            $post_category = $_POST['post_cat'];
            $post_author = $_POST['post_author'];
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];
            $post_status = $_POST['post_status'];
    
            $post_image = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];
            $post_date = date('d-m-y');
            $post_comment_count = 4;
            
            move_uploaded_file($post_image_temp, "../images/$post_image"); // Move image to images folder

            $query = "INSERT INTO posts (post_category_id,
                                post_title, post_author, post_date, post_image,
                                post_content, post_tags, post_comment_count, post_status) ";
            $query .= "VALUES($post_category, '$post_title', '$post_author',
                        now(), '$post_image', '$post_content', '$post_tags', '$post_comment_count', '$post_status')";
            
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                die("Error! Query failed: " . mysqli_error($db_connect));
            }
            header("Location: posts.php");
        }
    }

    function getAllPosts() {
        global $db_connect;
        $query = "SELECT * FROM posts";
        $result = mysqli_query($db_connect, $query);
        return $result;
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
                <a href="post.php?p_id=<?php echo $row['post_id']; ?>"><?php echo $title; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
            <hr>
            <p><?php echo $content; ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
        <?php
        }
    }

    function displayPostsInCategory($cat_id) {
        global $db_connect;
        $query = "SELECT * FROM posts WHERE post_category_id = $cat_id ";
        $result = mysqli_query($db_connect, $query);
        while($row = mysqli_fetch_assoc($result)) {
            $title = $row["post_title"];
            $author = $row["post_author"];
            $content = $row["post_content"];
            $date = $row["post_date"];
            $image = $row["post_image"];
            ?>
           
            <h2>
                <a href="post.php?p_id=<?php echo $row['post_id']; ?>"><?php echo $title; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
            <hr>
            <p><?php echo $content; ?></p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $row['post_id']; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

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
            <a href="post.php?p_id=<?php echo $row['post_id']; ?>"><?php echo $title; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
            <hr>
            <img class="img-responsive" src="<?php echo $image; ?>" alt="">
            <hr>
            <p><?php echo $content; ?></p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $row['post_id']; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

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