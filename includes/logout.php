<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<?php
    $_SESSION['username'] = null;
    $_SESSION['user_id'] = null;  
    $_SESSION['user_firstname'] = null;
    $_SESSION['user_lastname'] = null;
    $_SESSION['user_role'] = null;
    session_unset();
    $_SESSION['success_message'] = "Logged out successfully";
    header("Location: ../index.php");
?>
