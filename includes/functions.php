<?php 
    include __DIR__ . "/db.php";
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }  
?>
<?php

    //////////////////////////////////
    // ALL
    //////////////////////////////////
    function getTableCount($table) {
        global $db_connect;
        $query = "SELECT COUNT(*) FROM " . $table;
        $result = mysqli_query($db_connect, $query);
        return mysqli_fetch_row($result)[0];
    }
    //////////////////////////////////
    //////////////////////////////////


    //////////////////////////////////
    // CATEGORIES
    //////////////////////////////////

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

    //////////////////////////////////
    //////////////////////////////////

    //////////////////////////////////
    // POSTS
    //////////////////////////////////

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

            if(empty($post_image)) {
                $query = "SELECT * FROM posts WHERE post_id = $post_id";
                $result = mysqli_query($db_connect, $query);
                $post_image = mysqli_fetch_assoc($result)['post_image'];
            }
            
            move_uploaded_file($post_image_temp, "../images/$post_image"); // Move image to images folder
             
            $query = "UPDATE posts SET post_title = '$post_title',
            post_category_id='$post_category', post_author ='$post_author',
            post_tags ='$post_tags', post_content='$post_content', post_image='$post_image',
            post_status='$post_status', post_date=now()";
           
           
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
            $post_comment_count = 0;
            
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

    function getAllPublishedPosts() {
        global $db_connect;
        $query = "SELECT * FROM posts WHERE post_status = 'published'";
        $result = mysqli_query($db_connect, $query);
        return $result;
    }

    function getAllDraftPosts() {
        global $db_connect;
        $query = "SELECT * FROM posts WHERE post_status = 'draft'";
        $result = mysqli_query($db_connect, $query);
        return $result;
    }

    function getAllPosts() {
        global $db_connect;
        $query = "SELECT * FROM posts";
        $result = mysqli_query($db_connect, $query);
        return $result;
    }

    function displayAllPosts() {
        global $db_connect;
        $query = "SELECT * FROM posts WHERE post_status = 'published'";
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
            <a href="post.php?p_id=<?php echo $row['post_id']; ?>">
                <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
            </a>
            <hr>
            <p><?php echo substr($content,0,100); ?></p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $row['post_id']; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
        <?php
        }
    }

    function displayPostsInCategory($cat_id) {
        global $db_connect;
        $query = "SELECT * FROM posts WHERE post_category_id = $cat_id AND post_status = 'published'";
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
            <a href="post.php?p_id=<?php echo $row['post_id']; ?>">
                <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
            </a>
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
            <a href="post.php?p_id=<?php echo $row['post_id']; ?>">
                <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
            </a>
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
            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search'";
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

    function addCommentToPost($post_id){
        global $db_connect;
        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
        $result = mysqli_query($db_connect, $query);
        if(!$result) {
            die("Error! Query failed: " . mysqli_error($db_connect));
        }
    }

    function removeCommentFromPost($post_id){
        global $db_connect;
        $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = $post_id";
        $result = mysqli_query($db_connect, $query);
        if(!$result) {
            die("Error! Query failed: " . mysqli_error($db_connect));
        }
    }
    //////////////////////////////////
    //////////////////////////////////

    //////////////////////////////////
    // COMMENTS
    //////////////////////////////////
    function getAllPendingComments() {
        global $db_connect;
        $query = "SELECT * FROM comments WHERE comment_status='pending'";
        $result = mysqli_query($db_connect, $query);
        return $result;
    }
    function getAllComments() {
        global $db_connect;
        $query = "SELECT * FROM comments";
        $result = mysqli_query($db_connect, $query);
        return $result;
    }

    function getAllPostComments($post_id){
        global $db_connect;
        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'approved' ORDER BY comment_date DESC";
        $result = mysqli_query($db_connect, $query);
        return $result;
    }
    

    function changeCommentStatus(){
        global $db_connect;
        if(isset($_GET['approve_comment'])){
            $comment_id = $_GET['approve_comment'];
            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id";
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                die("Error! Query failed: " . mysqli_error($db_connect));
            }
            header("Location: comments.php");
        } else if(isset($_GET['deny_comment'])){
            $comment_id = $_GET['deny_comment'];
            $query = "UPDATE comments SET comment_status = 'denied' WHERE comment_id = $comment_id";
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                die("Error! Query failed: " . mysqli_error($db_connect));
            }
            header("Location: comments.php");
        }
    }

    function addComment() {
        global $db_connect;
        if(isset($_POST['create_comment'])){
            $comment_post_id = $_GET['p_id'];
            $comment_author = $_POST['comment_author'];
            $comment_email = $_POST['comment_email'];
            $comment_content = $_POST['comment_content'];
            $comment_status = "pending";

            $query = "INSERT INTO comments (comment_post_id, comment_date,
                                    comment_author, comment_email, comment_content,
                                    comment_status) ";
            $query .= "VALUES ($comment_post_id, now(), '$comment_author',
                            '$comment_email', '$comment_content', '$comment_status')";
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                die("Error! Query failed: " . mysqli_error($db_connect));
            }
            addCommentToPost($comment_post_id);
            header("Location: post.php?p_id=$comment_post_id");
        }
    }

    function deleteComment() {
        global $db_connect;
        if(isset($_GET['delete_comment'])){
            $comment_id = $_GET['delete_comment'];
            $query = "DELETE FROM comments WHERE comment_id = $comment_id";
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                die("Error! Query failed: " . mysqli_error($db_connect));
            }
            removeCommentFromPost($_GET['p_id']);
            header("Location: comments.php");
        }
    }

    //////////////////////////////////
    //////////////////////////////////

    
    //////////////////////////////////
    // USERS
    //////////////////////////////////    

    function getAllUsers() {
        global $db_connect;
        $query = "SELECT * FROM users";
        $result = mysqli_query($db_connect, $query);
        return $result;
    }

    function getUser($user_id) {
        global $db_connect;
        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $result = mysqli_query($db_connect,$query);
        return mysqli_fetch_assoc($result);
    }

    function addUser($isAdmin) {
        global $db_connect;
        if(isset($_POST['user_submit'])){
            $user_username = $_POST['user_username'];
            $user_password = $_POST['user_password'];

            //Hash password
            $hash = "$2y$10$"; // run blowfish 10 times
            $salt = "iusesomecrazystrings22"; // random string for salt
            $hashAndSalt = $hash . $salt;
            $hashedPass = crypt($user_password, $hashAndSalt);
            //


            $user_email = $_POST['user_email'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_role = $_POST['user_role'];
    
            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];

            
            move_uploaded_file($user_image_temp, "../images/$user_image"); // Move image to images folder

            $query = "INSERT INTO users (user_username, user_password,
                                        user_email, user_firstname,
                                        user_lastname, user_role, user_image) ";
            $query .= "VALUES('$user_username', '$hashedPass', '$user_email',
                            '$user_firstname', '$user_lastname', '$user_role', '$user_image')";
            
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                die("Error! Query failed: " . mysqli_error($db_connect));
            }
            if($isAdmin) {
                header("Location: users.php");
            } else {                
                header("Location: index.php");
            }
            
        }
    }

    function editUser(){
        global $db_connect;
        if(isset($_POST['user_update'])){
            $user_id = $_GET['update_user'];
            $user_username = $_POST['user_username'];
            $user_password = $_POST['user_password'];
            $user_email = $_POST['user_email'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_role = $_POST['user_role'];
    
            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];

            if(empty($user_image)) {
                $query = "SELECT * FROM users WHERE user_id = $user_id";
                $result = mysqli_query($db_connect, $query);
                $user_image = mysqli_fetch_assoc($result)['user_image'];
            }
            
            move_uploaded_file($user_image_temp, "../images/$user_image"); // Move image to images folder

            $query = "UPDATE users SET user_username = '$user_username', user_password = '$user_password',
                    user_email = '$user_email', user_firstname = '$user_firstname', user_lastname = '$user_lastname',
                    user_role = '$user_role', user_image = '$user_image'";
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                die("Error! Query failed: " . mysqli_error($db_connect));
            }
            header("Location: users.php");
        }
    }

    function editCurrentUser(){
        global $db_connect;
        if(isset($_POST['user_update'])){
            $user_id = $_SESSION['user_id'];
            $user_username = $_POST['user_username'];
            $user_password = $_POST['user_password'];
            $user_email = $_POST['user_email'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_role = $_POST['user_role'];
    
            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];

            if(empty($user_image)) {
                $query = "SELECT * FROM users WHERE user_id = $user_id";
                $result = mysqli_query($db_connect, $query);
                $user_image = mysqli_fetch_assoc($result)['user_image'];
            }
            
            move_uploaded_file($user_image_temp, "../images/$user_image"); // Move image to images folder

            $query = "UPDATE users SET user_username = '$user_username', user_password = '$user_password',
                    user_email = '$user_email', user_firstname = '$user_firstname', user_lastname = '$user_lastname',
                    user_role = '$user_role', user_image = '$user_image'";
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                die("Error! Query failed: " . mysqli_error($db_connect));
            }
            header("Location: users.php");
        }
    }

    function deleteUser() {
        global $db_connect;
        if(isset($_GET['delete_user'])){
            $user_id = $_GET['delete_user'];
            $query = "DELETE FROM users WHERE user_id = $user_id";
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                die("Error! Query failed: " . mysqli_error($db_connect));
            }
        }
    }

    function showCurrentUsername() {
        if(isset($_SESSION['username']))
            echo $_SESSION['username'];
    }

    function isLoggedIn() {
        return isset($_SESSION['username']);
    }

    function getCurrentUserRole(){
        if(isset($_SESSION['user_role'])){
            return $_SESSION['user_role'];
        }
    }
    
    //////////////////////////////////
    //////////////////////////////////
?>