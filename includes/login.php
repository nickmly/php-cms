<?php 
    include "db.php";
    include_once "functions.php";
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<?php
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        //Sanitize strings
        $username = mysqli_real_escape_string($db_connect, $username);
        $password = mysqli_real_escape_string($db_connect, $password);        

        $query = "SELECT * FROM users WHERE user_username = '$username'";
        $result = mysqli_query($db_connect, $query);
        if(!$result) {
            die("Query failed: " . mysqli_error($db_connect));
        } 
        if(mysqli_num_rows($result) == 0) {
            $_SESSION['error_message'] = "Invalid username or pass";
            header("Location: ../index.php");  
        }

        while($row = mysqli_fetch_assoc($result)){
            $db_id = $row['user_id'];
            $db_username = $row['user_username'];
            $db_password = $row['user_password'];
            $db_firstname = $row['user_firstname'];
            $db_lastname = $row['user_lastname'];
            $db_role = $row['user_role'];

            if($username === $db_username && password_verify($password, $db_password)) {
                $_SESSION['success_message'] = "Logged in successfully";
                if($db_role == 'admin') {
                    header("Location: ../admin");
                } else {
                    header("Location: ../index.php");
                }
               
                $_SESSION['username'] = $db_username;
                $_SESSION['user_id'] = $db_id;
                $_SESSION['user_firstname'] = $db_firstname;
                $_SESSION['user_lastname'] = $db_lastname;
                $_SESSION['user_role'] = $db_role;
            } else {
                $_SESSION['error_message'] = "Invalid username or pass";
                header("Location: ../index.php");                
            }
        }
    }
?>
