<?php 
    include __DIR__ . "/db.php";
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }  
?>
<?php
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
            $_SESSION['success_message'] = "Approved comment successfully";  
            header("Location: comments.php");
        } else if(isset($_GET['deny_comment'])){
            $comment_id = $_GET['deny_comment'];
            $query = "UPDATE comments SET comment_status = 'denied' WHERE comment_id = $comment_id";
            $result = mysqli_query($db_connect, $query);
            if(!$result) {
                die("Error! Query failed: " . mysqli_error($db_connect));
            }
            $_SESSION['success_message'] = "Denied comment successfully";  
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
            $_SESSION['success_message'] = "Your comment has been submitted for approval.";  
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

    function editAllComments() {
        global $db_connect;
        if(isset($_POST['checkBoxArray'])) {
            $bulk_options = $_POST['bulk-options'];            
            foreach($_POST['checkBoxArray'] as $checkboxID){
                $query = "";
                switch($bulk_options) {
                    
                    case "approved":
                        $query = "UPDATE comments SET comment_status = '$bulk_options' WHERE comment_id = $checkboxID";
                    break;
                    case "denied":
                        $query = "UPDATE comments SET comment_status = '$bulk_options' WHERE comment_id = $checkboxID";
                    break;
                    case "delete":
                        $query = "DELETE FROM comments WHERE comment_id = $checkboxID";
                    break;
                }
                $result = mysqli_query($db_connect, $query);
                if(!$result) {
                    die("Query failed: " . mysqli_error($db_connect));
                }
            }
           
        }
    }

    //////////////////////////////////
    //////////////////////////////////

?>