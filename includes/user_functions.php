<?php 
    include __DIR__ . "/db.php";
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }  
?>
<?php
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

            $user_username = mysqli_real_escape_string($db_connect, $user_username);
            $user_password = mysqli_real_escape_string($db_connect, $user_password);

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
                $_SESSION['success_message'] = "Added user successfully";  
                header("Location: users.php");
            } else {
                $_SESSION['success_message'] = "Successfully signed up!";        
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
            $_SESSION['success_message'] = "Edited user successfully";  
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
            $_SESSION['success_message'] = "Edited user successfully";  
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