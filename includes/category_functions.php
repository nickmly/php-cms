<?php 
    include __DIR__ . "/db.php";
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }  
?>
<?php
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
?>